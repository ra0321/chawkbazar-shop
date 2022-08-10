<?php

namespace Marvel\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        config([
            'lighthouse' => File::getRequire(__DIR__ . '/../../config/lighthouse.php'),
        ]);
    }
}
