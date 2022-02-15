<?php

namespace Ngeblog\Tag;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views/', 'tag');

        Route::group([
                'prefix' => 'api',
                'middleware' => ['api']
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/routes/api.php');
            });

        Blade::include('tag::components.tag', 'tag');
    }
}
