<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\Paginator;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
    ];

    public function boot()
    {
        $this->registerPolicies();
        Paginator::useBootstrap();
    }
}
