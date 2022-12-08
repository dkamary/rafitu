<?php

namespace App\Models\Managers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SearchCityManager {

    public static function searchCity(?string $search = null, int $count = 10, string $tablename = 'city_restricted') : Collection {
        if(!$search) return new Collection();

        $search = self::manageSearchString($search);
        $builder = DB::table($tablename)
            ->selectRaw('id, name, latitude, longitude, country_code, MATCH (name) AGAINST(? IN BOOLEAN MODE) as score', [$search])
            ->orderBy('score', 'desc')
            ->limit($count);

        $builder
            ->whereRaw('MATCH (name) AGAINST(? IN BOOLEAN MODE) > 0', [$search])
            // ->whereRaw('name LIKE ?', '%' . $search . '%', 'or')
            ;

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

    public static function searchRide(?string $search = null, int $count = 10, string $field = 'departure_label') : Collection {
        if(!$search) return new Collection();

        $search = self::manageSearchString($search);

        $select = sprintf('id, %s as label, MATCH (%s) AGAINST(? IN BOOLEAN MODE) as score', $field, $field);
        $where = sprintf('MATCH (%s) AGAINST(? IN BOOLEAN MODE)', $field);

        $builder = DB::table('ride')
            ->selectRaw($select, [$search])
            ->orderBy('score', 'desc')
            ->limit($count);

        $builder->whereRaw($where, [$search]);

        $rides = $builder->get();

        if($rides->count() == 0) {
            $builder = DB::table('ride')
                ->selectRaw(sprintf('id, %s as label', $field))
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
