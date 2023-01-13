<?php

namespace App\Models\Managers;

use App\Models\CommissionPayment;
use App\Models\Notification;
use App\Models\Reservation;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class DashboardManager {
    public static function reservationImpayees() : int {
        $count = Reservation::where('status', 'like', Reservation::STATUS_UNPAID)->count();

        return $count;
    }

    public static function reservationPayees() : int {
        $count = Reservation::where('status', 'like', Reservation::STATUS_PAID)->count();

        return $count;
    }

    public static function chauffeursAvalider() : int {
        $whereRaw = '('
        .'`identification_scan` IS NOT NULL'
        .' OR `licence_scan` IS NOT NULL'
        .' OR `technical_check_scan` IS NOT NULL'
        .' OR `insurrance_scan` IS NOT NULL'
        .' OR `gray_card_scan` IS NOT NULL'
        .')';

        $qb = DB::table('user')
            ->select(['id'])
            ->where('user_status_id', '<>', 5)
            ->whereRaw($whereRaw, [], 'and');

        $count = $qb->count();

        return $count;
    }

    public static function chauffeursValidees() : int {
        $count = User::where('user_status_id', '=', 5)
            ->orderBy('firstname')
            ->orderBy('lastname')
            ->count();

        return $count;
    }

    public static function commissionPayes() : float {
        $sum = DB::table('commission_payment')
            ->where('status', 'like', CommissionPayment::STATUS_PAID)
            ->sum('driver_amount');

        return $sum;
    }

    public static function commissionImpayees() : float {
        $sum = DB::table('commission_payment')
            ->where('status', 'like', CommissionPayment::STATUS_UNPAID)
            ->sum('driver_amount');

        return $sum;
    }

    public static function trajetsLong() : int {
        $parameter = ParamManager::getParameters();
        $count = Ride::where('distance', '>=', $parameter->getDistanceLongTrajet())
            ->where('departure_date', '>', date('Y-m-d H:i:s'))
            ->orderBy('departure_date', 'ASC')
            ->count();

        return $count;
    }

    public static function trajetsQuotidien() : int {
        $count = Ride::where('has_recurrence', '=', 1)
            ->where('departure_date', '>', date('Y-m-d H:i:s'))
            ->orderBy('departure_date', 'ASC')
            ->count();

        return $count;
    }

    public static function notifications(int $count = 10) : ?Collection {
        $notifications = Notification::whereNull('user_id')
            ->where('is_active', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();

        return $notifications;
    }

    public static function trajetParMois(int $month, ?int $year = null) : int {
        if($month < 1 || $month > 12) return 0;
        if(!$year) $year = (int)date('Y');

        return DB::table('ride')
            ->select(['id'])
            ->whereRaw('month(`departure_date`) = ? AND year(`departure_date`) = ?', [$month, $year])
            ->where('ride_status_id', '=', 1)
            ->count();
    }

    public static function trajetParAnnee(?int $year = null) : array {

        return [
            self::trajetParMois(1, $year),
            self::trajetParMois(2, $year),
            self::trajetParMois(3, $year),
            self::trajetParMois(4, $year),
            self::trajetParMois(5, $year),
            self::trajetParMois(6, $year),
            self::trajetParMois(7, $year),
            self::trajetParMois(8, $year),
            self::trajetParMois(9, $year),
            self::trajetParMois(10, $year),
            self::trajetParMois(11, $year),
            self::trajetParMois(12, $year),
        ];
    }

    public static function reservationParMois(string $status, int $mois, ?int $annee = null) : int {
        if($mois < 1 || $mois > 12) return 0;
        if(!$annee) $annee = (int)date('Y');

        $query = DB::table('reservation')
            ->select(['id'])
            ->whereRaw('month(`reservation_date`) = ? AND year(`reservation_date`) = ?', [$mois, $annee]);

        if($status != 'all') {
            $query->where('status', 'like', $status);
        }

        return $query->count();
    }

    public static function reservationParAnnee(string $status = 'all', ?int $annee = null) : array {

        return [
            self::reservationParMois($status, 1, $annee),
            self::reservationParMois($status, 2, $annee),
            self::reservationParMois($status, 3, $annee),
            self::reservationParMois($status, 4, $annee),
            self::reservationParMois($status, 5, $annee),
            self::reservationParMois($status, 6, $annee),
            self::reservationParMois($status, 7, $annee),
            self::reservationParMois($status, 8, $annee),
            self::reservationParMois($status, 9, $annee),
            self::reservationParMois($status, 10, $annee),
            self::reservationParMois($status, 11, $annee),
            self::reservationParMois($status, 12, $annee),
        ];
    }
}
