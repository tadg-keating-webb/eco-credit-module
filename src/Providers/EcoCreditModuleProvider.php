<?php

namespace TadgKeatingWebb\EcoCreditModule\Providers;

use Illuminate\Support\ServiceProvider;

class EcoCreditModuleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
