<?php

namespace johnclendvoy\MakeAll;

use johnclendvoy\MakeAll\Commands\MakeAll;

use Illuminate\Support\ServiceProvider;

class MakeAllServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'johnclendvoy');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'johnclendvoy');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/makeall.php' => config_path('makeall.php'),
            ], 'makeall.config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/johnclendvoy'),
            ], 'makeall.views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/johnclendvoy'),
            ], 'makeall.views');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/johnclendvoy'),
            ], 'makeall.views');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/makeall.php', 'makeall');

        // Register the service the package provides.
        // $this->app->singleton('makeall', function ($app) {
        //     return new MakeAll;
        // });

        $this->app->bind('command.make:all', MakeAll::class);

        $this->commands([
            'command.make:all',
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    // public function provides()
    // {
    //     return ['makeall'];
    // }
}