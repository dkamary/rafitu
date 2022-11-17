<?php

namespace App\Models\Managers;

use App\Models\Faq;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\ShortcodeFacade;

class ShortCodeManager {
    public static function process(?string $rawContent = null) : string {
        if(!$rawContent) return '';

        $facade = new ShortcodeFacade();
        $facade->addHandler('faq', [self::class, 'faq']);
        $facade->addHandler('newsletter', [self::class, 'newsletter']);
        $facade->addHandler('contact', [self::class, 'contact']);

        return $facade->process($rawContent);
    }

    public static function faq(ShortcodeInterface $s) : string {
        $faq = Faq::where('is_active', '=', 1)->orderBy('rank')->get();

        return view('pages._partials.faq', ['faq' => $faq])->render();
    }

    public static function newsletter(ShortcodeInterface $s) : string {
        return 'My Newsletter forms';
    }

    public static function contact(ShortcodeInterface $s) : string {
        return 'My Contact forms';
    }
}
