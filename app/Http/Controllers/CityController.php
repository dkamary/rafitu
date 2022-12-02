<?php

namespace App\Http\Controllers;

use App\Models\Managers\SearchCityManager;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

define('id', 0);
define('name', 1);
define('ascii_name', 2);
define('alternatenames', 3);
define('latitude', 4);
define('longitude', 5);
define('feature_class', 6);
define('feature_code', 7);
define('country_code', 8);
define('cc2', 9);
define('admin1_code', 10);
define('admin2_code', 11);
define('admin3_code', 12);
define('admin4_code', 13);
define('population', 14);
define('elevation', 15);
define('dem', 16);
define('timezone', 17);
define('modification_date', 18);

class CityController extends Controller
{
    public function index(int $page = 1, int $count = 100) : JsonResponse {
        // $cities = DB::select('SELECT 'id', 'name', 'latitude', 'longitude', 'country_code' FROM 'city' ORDER BY 'name' ASC LIMIT :limit ')
        $cities = DB::table('city2')
            ->select('id', 'name', 'latitude', 'longitude', 'country_code')
            ->orderBy('name')
            ->limit($count)
            ->offset(($page - 1) > 0 ? ($page - 1) : 1)
            ->get()
        ;

        return response()->json([
            'cities' => $cities,
        ]);
    }

    public function search(string $search, int $count = 10) : JsonResponse {
        $cities = SearchCityManager::search($search, $count, 'city2');

        return response()->json([
            'cities' => $cities,
        ]);
    }

    public function searchInText(string $search, int $count = 10) : JsonResponse {
        $bd = fopen(public_path('allCountries.txt'), 'r');
        if(!$bd) {
            throw new Exception('Unable to open database');
        }

        $foundCount = 0;
        $results = [];
        $rowCount = 0;
        while(($row = fgets($bd)) && ($foundCount <= $count)) {
            $rowData = explode("\t", $row);
            // dd([
            //     'row' => $row,
            //     'parsed' => $rowData,
            // ]);
            if(strpos($rowData[name], $search) !== false) {
                $results[] = $rowData;
                ++$foundCount;
            }
            // if(++$rowCount > 100) break;
        }
        fclose($bd);

        dd($results);

        return response()->json($results);
    }
}
