<?php

namespace Lara\Comment;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Comment::class => CommentPolicy::class
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
        
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'comment');

        $this->mergeConfigFrom(__DIR__.'/../config/comment.php', 'comment');

        Route::group(['middleware' => ['web']], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        Blade::include('comment::comments.index', 'commentsIndex');
    }
}
