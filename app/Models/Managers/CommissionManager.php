<?php

namespace App\Models\Managers;

use App\Models\Commission;
use Illuminate\Database\Eloquent\Collection;

class CommissionManager {

    public static function getTodo(int $count = 20) : Collection {
        $commissions = Commission::where('status', 'NOT LIKE', 'PAID')
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();

        return $commissions;
    }

    public static function getDone(int $count = 20) : Collection {
        $commissions = Commission::where('status', 'LIKE', 'PAID')
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();

        return $commissions;
    }
}
