<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/payment/notify',
        '/user/paypal/notify',
        'checkout/*/ipay/verify',
        '/lab/payment/*/ipay/verify',
        'checkout/imepay/verify',
        'lab/payment/imepay/verify',
        'checkout/card/verify',
        'checkout/card/cancel',
        'lab/payment/card/verify',
        'lab/payment/card/cancel',
    ];
}
