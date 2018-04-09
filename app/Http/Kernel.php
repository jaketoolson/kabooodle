<?php
/**
 * This file is part of Kabooodle.
 * Copyright (c) 2017. Kabooodle,LLC <help@kabooodle.com>
 */

namespace Kabooodle\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Kabooodle\Http\Middleware\ApiAllowAuthAndNonAuthMiddleware;
use Kabooodle\Http\Middleware\DisableRestfulResource;
use Kabooodle\Http\Middleware\ReferralProgramMiddleware;

/**
 * Class Kernel
 * @package Kabooodle\Http
 */
class Kernel extends HttpKernel
{
    /**
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Fideloper\Proxy\TrustProxies::class,
        \Kabooodle\Http\Middleware\HTTPSMiddleware::class,
        \Barryvdh\Cors\HandleCors::class,
        \Kabooodle\Http\Middleware\TerminableMiddleware::class,
    ];

    /**
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Kabooodle\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Kabooodle\Http\Middleware\StoreMessageBag::class,
//            \Kabooodle\Http\Middleware\ReferralProgramMiddleware::class, // We only need this for the referral page
            \Kabooodle\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:15,10',
            'bindings',
        ],
    ];

    /**
     * @var array
     */
    protected $routeMiddleware = [
        'disabled' => DisableRestfulResource::class,
        'auth' => \Kabooodle\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \Kabooodle\Http\Middleware\RedirectIfAuthenticated::class,
        'subscribed' => \Kabooodle\Http\Middleware\Subscribed::class,
        'creditcardrequired' => \Kabooodle\Http\Middleware\CreditCardOnFileRequiredMiddleware::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'jwt.auth' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
        'jwt.refresh' => \Tymon\JWTAuth\Http\Middleware\RefreshToken::class,
        'jwt.renew' => \Tymon\JWTAuth\Http\Middleware\AuthenticateAndRenew::class,
        'referral' => \Kabooodle\Http\Middleware\ReferralProgramMiddleware::class, // We only need this for the referral page
        'api_allow_auth_and_non' => ApiAllowAuthAndNonAuthMiddleware::class // Checks and stores JTW token, gracefully lets non auth too
    ];
}
