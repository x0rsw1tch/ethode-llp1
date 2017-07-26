<?php

namespace App\Providers;

use Laravel\Dusk\DuskServiceProvider;

/**
 * Register any application services.
 *
 * @return void
 */
public function register()
{
    if ($this->app->environment('local', 'testing')) {
        $this->app->register(DuskServiceProvider::class);
    }
}

