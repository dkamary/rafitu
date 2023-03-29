<?php

namespace App\Models\Managers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SearchCityManager {

    public static function searchCityOptimized(?string $search = null, int $count = 10, array $country = [], string $table = 'city2') : Collection {
        if(!$search || strlen(trim($search)) == 0) return new Collection();

        $search = trim($search);

        $builder = DB::table($table);

        $builder
            ->select()
            ->orderBy('name')
            ->limit($count);

        if($country != []) {
            $sqlRaw = '';
            $first = true;
            foreach($country as $c) {
                $sqlRaw .= (!$first ? ' OR ' : '') . '`country_code` LIKE "' . $c . '"';
                $first = false;
            }

            if($sqlRaw != '') {
                $builder->whereRaw('(' . $sqlRaw . ')');
            }
        }

        $words = explode(' ', $search);
        $sqlRaw = '';
        $first = true;

        foreach($words as $w) {
            if(strlen($w) < 3) continue;

            $sqlRaw .= (!$first ? ' OR ' : '');
            $sqlRaw .= '`name` LIKE "%' . $w . '%"';
            $first = false;
        }

        if($sqlRaw != '') {
            $builder->whereRaw('(' . $sqlRaw .')');
        }

        // $builder->whereRaw(sprintf('MATCH(`name`) AGAINST ("%s") > 0', $search));

        // dd($builder->toSql());
        $results = $builder->get();

        if($results->count() == 0) return $results;

        $array = [];

        // Meilleur occurence
        foreach($results as $city) {
            if(substr_count($city->name, $search) > 0) {
                $index = 'city-' . $city->id;
                $array[$index] = $city;
            }
        }

        // Nombre d'occurrence
        foreach($words as $w) {
            foreach($results as $city) {
                if(substr_count($city->name, $w) > 0) {
                    $index = 'city-' . $city->id;
                    if(!isset($array[$index])) {
                        $array[$index] = $city;
                    }
                }
            }
        }

        $cities = new Collection(array_values($array));

        // dd([
        //     'results' => $results->toArray(),
        //     'array' => $array,
        //     'no-duplicate' => self::manageDuplicateCityName($cities)->toArray(),
        // ]);

        return new Collection(array_values($array));
    }

    public static function searchCity(?string $search = null, int $count = 10, string $tablename = 'city_restricted') : Collection {
        if(!$search) return new Collection();

        // $search = self::manageSearchString($search);
        $cities = new Collection();
        $builder = DB::table($tablename);

        $builder
            ->selectRaw('id, name, latitude, longitude, country_code, MATCH (name) AGAINST(?) as score', [$search])
            ->orderBy('score', 'desc')
            ->limit($count);

        $builder
            ->whereRaw('MATCH (name) AGAINST(?) > 0', [$search])
            // ->whereRaw('name LIKE ?', '%' . $search . '%', 'or')
            ->whereRaw('(country_code LIKE "CI" OR country_code LIKE "FR")')
            ;

            dd($builder->toSql());

        $cities = $builder->get();

        // if($cities->count() == 0) {
        //     $search = str_replace(['+', '-'], '', $search);

        //     $builder = DB::table($tablename)
        //         ->selectRaw('id, name, latitude, longitude, country_code')
        //         // ->groupBy('name', 'country_code')
        //         ->orderBy('name', 'asc')
        //         ->limit($count);
        //     $builder->whereRaw('name LIKE ?', ['%' . $search .'%']);
        //     $words = explode(' ', $search);
        //     if(count($words) > 0) {
        //         foreach($words as $w) {
        //             $builder->orWhereRaw('name LIKE ?', ['%' . $w . '%']);
        //         }
        //     }

        //     $cities = $builder->get();
        // }

        return self::manageDuplicateCityName($cities);
    }

    public static function searchRide(?string $search = null, int $count = 10, ?string $field = 'departure_label') : Collection {
        if(!$search) return new Collection();
        if(!$field) $field = 'departure_label';

        $search = self::manageSearchString($search);

        $select = sprintf('id, %s as name, MATCH (%s) AGAINST(? IN BOOLEAN MODE) as score', $field, $field);
        $where = sprintf('MATCH (%s) AGAINST(? IN BOOLEAN MODE)', $field);

        $builder = DB::table('ride')
            ->selectRaw($select, [$search])
            ->orderBy('score', 'desc')
            ->limit($count);

        $builder->whereRaw($where, [$search]);

        $rides = $builder->get();

        if($rides->count() == 0) {
            $builder = DB::table('ride')
                ->selectRaw(sprintf('id, %s as name', $field))
                ->orderBy('label', 'asc')
                ->limit($count);

            $builder->whereRaw(sprintf('%s LIKE ?', $field), ['%' . $search .'%']);

            $search = str_replace(['+', '-'], '', $search);
            $words = explode(' ', $search);

            if(count($words) > 0) {
                foreach($words as $w) {
                    $builder->orWhereRaw(sprintf('%s LIKE ?', $field), ['%' . $w .'%']);
                }
            }

            // print_r($builder->toSql());
            // exit;

            $rides = $builder->get();
        }

        return $rides;
    }

    public static function manageSearchString(string $search) : string {
        $search = trim($search);
        $words = explode(' ', $search);
        if(count($words) == 1) return '+'.$search;
        $words = array_map(function($word) {
            return (strlen($word) == 1 ? '-' : '+') .$word;
        }, $words);

        return implode(' ', $words);
    }

    public static function manageDuplicateCityName(Collection &$cities) : Collection {
        $map = [];
        $array = array_filter($cities->toArray(), function($city) use(&$map) {
            $index = $city->name . '-' . $city->country_code;

            if(isset($map[$index])) return false;

            return $map[$index] = true;
        });

        return new Collection($array);
    }
}
