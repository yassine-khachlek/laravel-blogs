<?php

namespace Yk\LaravelBlogs;

use Illuminate\Support\ServiceProvider;

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

        /**
        * Routing
        * Extend the app routes by adding a route group under the package namespace.
        */

        /*

        */

        /**
        * Views
        * Load the package views under the package namespace.
        */

        /*

        */

        /*
        $this->publishes(
            [
                __DIR__.'/resources/views' => base_path('resources/views/vendor/Yk/LaravelBlog'),
            ]
        );

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/Yk/LaravelBlog'),
        ], 'public');

        $this->publishes([
            __DIR__.'/config' => config_path('vendor/Yk/LaravelBlog'),
        ]);

        $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
        
        $kernel->pushMiddleware('Yk\LaravelBlog\App\Http\Middleware\MiddlewareYkLaravelBlog');

        

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Yk\LaravelBlog\App\Console\Commands\YkLaravelBlog::class,
            ]);
        }
        */
    }
    
    /**
     * Register the application services.
     *
     * @return  void
     */
    public function register()
    {
        /*
        $this->mergeConfigFrom(
            __DIR__.'/config/app.php', 'packages.Yk.LaravelBlog.app'
        );

        $this->app->bind('YkLaravelBlog', function(){
            return $this->app->make('Yk\LaravelBlog\Classes\YkLaravelBlog');
        });
        */
    }
}