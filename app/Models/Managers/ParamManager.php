<?php

namespace App\Models\Managers;

use App\Models\Parameter;

class ParamManager {
    private static $_parameter = null;

    public static function getParameters() : Parameter {
        if(self::$_parameter) return self::$_parameter;

        self::$_parameter = Parameter::where('id', '=', 1)->first();

        if(self::$_parameter) return self::$_parameter;

        self::$_parameter = new Parameter([
            'com_longtrajet' => 10.0,
            'com_quotidien' => 8.0,
            'dist_longtrajet' => 30000,
        ]);

        return self::$_parameter;
    }

    public function get(string $param) {
        return (self::getParameters())->$param;
    }
}
