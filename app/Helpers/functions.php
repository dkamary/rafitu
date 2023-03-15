<?php

// Functions

use App\Models\Funfact;
use App\Models\Page;
use App\Models\PageCategory;
use App\Models\RideStatus;
use App\Models\User;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberParseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

if (!function_exists('get_avatar')) {
    /**
     * User Avatar
     *
     * @param int|User|null $user
     * @return string
     */
    function get_avatar($user)
    {
        if (!$user) return asset('avatars/user-01.svg');
        if (is_numeric($user)) {
            $user = User::where('id', '=', (int)$user)->first();
            if (!$user) return asset('avatars/user-01.svg');
        }

        $avatar = $user->getAvatar();
        $userAvatar = $avatar;
        if ($avatar) {
            if (strpos($avatar, 'http') !== false) {
                $userAvatar = $avatar;
            } else {
                $userAvatar = asset('avatars/' . $avatar);
            }
        } else {
            $userAvatar = asset('avatars/user-01.svg');
        }

        return $userAvatar;
    }
}

if (!function_exists('get_funfact_image')) {
    function get_funfact_image(?string $filename)
    {
        $default = asset('assets/images/other/conducteur-512x512.webp');
        if (!$filename) return $default;

        $file = IMAGES_DIR . $filename;
        if (!is_file($file)) return $default;

        return asset('images/' . $filename);
    }
}

if (!function_exists('get_funfact_icon')) {
    function get_funfact_icon(?string $filename)
    {
        $default = asset('assets/images/icons/marker-icon.svg');
        if (!$filename) return $default;

        $file = IMAGES_DIR . $filename;
        if (!is_file($file)) return $default;

        return asset('images/' . $filename);
    }
}

if (!function_exists('display_date')) {

    /**
     * Afficher la date
     *
     * @param string|null $datetime
     * @param string $format
     * @return string
     */
    function display_date(?string $datetime, string $format = 'H:i:s'): string
    {
        if (!$datetime) return 'n/a';

        $date = new DateTime($datetime);
        $now = new DateTime();
        $diff = $now->diff($date);
        if ($diff->d < 1) {
            return 'Aujourd\'hui à ' . $date->format($format);
        } elseif ($diff->d == 1) {
            return 'Hier à ' . $date->format($format);
        } elseif ($diff->d == 2) {
            return 'Avant hier à ' . $date->format($format);
        } else {
            return $date->format('d/m/Y à ' . $format);
        }
    }
}

if (!function_exists('show_date')) {

    function show_date(?string $datetime, $format = 'd/m/Y H:i'): string
    {
        if (!$datetime) return 'n/a';

        $date = new DateTime($datetime);

        return $date->format($format);
    }
}

if (!function_exists('is_mobile')) {

    function is_mobile(): bool
    {

        return preg_match(
            "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
            $_SERVER["HTTP_USER_AGENT"]
        );
    }
}

if (!function_exists('ride_status')) {

    function ride_status(int $status, string $default = 'n/a'): string
    {

        return RideStatus::getStatus($status, $default);
    }
}

if (!function_exists('get_funfacts')) {
    function get_funfacts(int $count = 0, array $includes = [])
    {
        $builder = Funfact::where('is_active', '=', 1);
        if ($count > 0) {
            $builder->limit($count);
        }
        if (count($includes) > 0) {
            $builder->whereIn('id', $includes);
        }

        return $builder->get();
    }
}

if (!function_exists('get_reviews')) {
    function get_reviews(int $userId): float
    {
        $builder = DB::table('review')
            ->select(['note'])
            ->join('reservation', 'reservation.id', '=', 'review.reservation_id')
            ->join('ride', 'ride.id', '=', 'reservation.ride_id')
            ->where('review.is_active', '=', 1)
            ->where('ride.owner_id', '=', $userId);
        $notes = $builder->get();
        $total = 0;
        $count = 0;
        foreach ($notes as $note) {
            $total += (int)$note->note;
            $count++;
        }

        $note = $count > 0 ? ($total / $count) : 0.0;

        return $note;
    }
}

if (!function_exists('post_mostview')) {
    function post_mostview(int $count = 10): array
    {
        $pages = Page::where('page_category_id', '=', PageCategory::BLOG)
            ->orderBy('views', 'DESC')
            ->limit($count)
            ->get();

        $list = [];
        foreach ($pages as $page) {
            $list[] = (object)[
                'id' => $page->id,
                'slug' => $page->slug,
                'title' => $page->title,
                'views' => $page->views,
            ];
        }

        return $list;
    }
}

if (!function_exists('post_latest')) {
    function post_latest(int $count = 10): array
    {
        $pages = Page::where('page_category_id', '=', PageCategory::BLOG)
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();

        $list = [];
        foreach ($pages as $page) {
            $list[] = (object)[
                'id' => $page->id,
                'slug' => $page->slug,
                'title' => $page->title,
                'views' => $page->views,
            ];
        }

        return $list;
    }
}

if (!function_exists('parse_phone_gpt')) {
    function parse_phone_gpt($phoneNumber, $prefix = '+225')
    {
        $phoneNumber = preg_replace("/[\s\-]+/", "", $phoneNumber);
        if (substr($phoneNumber, 0, 1) == "+") {
            $prefix = substr($phoneNumber, 1, strlen($phoneNumber) - 10);
            $number = substr($phoneNumber, strlen($prefix) + 1);
        } elseif (substr($phoneNumber, 0, 2) == "00") {
            $prefix = substr($phoneNumber, 2, strlen($phoneNumber) - 12);
            $number = substr($phoneNumber, strlen($prefix) + 2);
        } elseif (substr($phoneNumber, 0, strlen($prefix) + 1) == "+$prefix") {
            $number = substr($phoneNumber, strlen($prefix) + 2);
        } elseif (substr($phoneNumber, 0, strlen($prefix)) == $prefix) {
            $number = substr($phoneNumber, strlen($prefix));
        } elseif (substr($phoneNumber, 0, 1) == "0") {
            $number = substr($phoneNumber, 1);
        } else {
            $number = $phoneNumber;
        }
        return array("prefix" => $prefix, "number" => $number);
    }
}

if(!function_exists('parse_phone')) {
    function parse_phone(string $phoneNumber, string $prefix = '225') {
        try {
            $number = PhoneNumber::parse($phoneNumber);
        } catch(PhoneNumberParseException $ex) {
            Log::critical($ex->getMessage(), [
                'code' => $ex->getCode(),
                'file' => $ex->getFile(),
                'line' => $ex->getLine(),
            ]);

            if(substr($phoneNumber, 0, 2) == '00') {
                $count = 1;
                $phoneNumber = str_replace('00', '+', $phoneNumber, $count);

                return parse_phone($phoneNumber, $prefix);
            } else {
                return parse_phone('+' . $prefix . $phoneNumber, $prefix);
            }

            return [
                'prefix' => $prefix,
                'number' => $phoneNumber,
                'message' => $ex->getMessage(),
            ];
        }

        return [
            'prefix' => $number->getCountryCode(),
            'number' => $number->getNationalNumber(),
        ];
    }
}
