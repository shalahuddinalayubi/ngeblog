<?php

namespace Ngeblog\Post;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Ngeblog\Post\Models\Post;
use Ngeblog\Post\Policies\PostPolicy;

class PostServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

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
        $this->registerPolicies();
        
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'post');

        Route::group(['middleware' => ['web']], function () {
            $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        });
    }
}
