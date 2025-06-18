<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\Authenticate;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}
