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
        $spacingY = $s->getParameter('spacing-y', 3);
        $spacingX = $s->getParameter('spacing-x', 3);
        $size = $s->getParameter('size', 'large');
        $className = 'border rounded';
        $title = 'Formulaire de contact';

        return view('pages._partials.contact', [
            'size' => $size,
            'spacingX' => $spacingX,
            'spacingY' => $spacingY,
            'className' => $className,
            'title' => $title,
        ])->render();
    }
}
