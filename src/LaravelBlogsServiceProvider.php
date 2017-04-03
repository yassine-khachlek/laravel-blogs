<?php

namespace Yk\LaravelBlogs;

use Illuminate\Support\ServiceProvider;
use File;

class LaravelBlogsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return  void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->app->router->group(['namespace' => 'Yk\LaravelBlogs\App\Http\Controllers', 'middleware' => ['web']],
            function(){
                require __DIR__.'/routes/web.php';
            }
        );

        $this->loadViewsFrom(resource_path('views/vendor/yk/laravel-blogs'), 'Yk\LaravelBlogs');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Yk\LaravelBlogs');

        $this->publishes([
            __DIR__.'/resources/assets' => public_path('vendor/yk/laravel-blogs'),
        ], 'public');

        $this->publishes([
            __DIR__.'/config' => config_path('vendor/yk/laravel-blogs'),
        ]);

    }
    
    /**
     * Register the application services.
     *
     * @return  void
     */
    public function register()
    {
        if (File::exists(config_path('vendor/yk/laravel-blogs/languages.php'))) {
            $this->mergeConfigFrom(
                config_path('vendor/yk/laravel-blogs/languages.php'), 'yk.laravel-blogs.languages'
            );
        }else{
            $this->mergeConfigFrom(
                __DIR__.'/config/languages.php', 'yk.laravel-blogs.languages'
            );
        }
    }
}