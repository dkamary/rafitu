<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/paiement/*',
        '/message/send*',
        '/cinetpay/accepte',
        '/cinetpay/transfert',
        '/admin/trajet/valider',
        'admin/upload/televerser',
    ];
}
