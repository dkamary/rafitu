<?php

namespace App\Models\Managers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SearchCityManager {
    public static function search(string $search, int $count = 10, string $tablename = 'city_restricted') : Collection {
        $builder = DB::table($tablename)
            ->selectRaw('id, name, latitude, longitude, country_code, MATCH (name) AGAINST(? IN BOOLEAN MODE) as score', [$search])
            ->orderBy('score', 'desc')
            ->limit($count);
        $search = self::manageSearchString($search);

        $builder->whereRaw('MATCH (name) AGAINST(? IN BOOLEAN MODE) > 0', [$search]);

        $builder->limit($count);

        $cities = $builder->get();

        return $cities;
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
}
