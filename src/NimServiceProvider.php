<?php namespace Aobo\Neteaseim;

use Illuminate\Support\ServiceProvider;

class NimServiceProvider extends ServiceProvider {

    /**
    * Bootstrap the application services.
    *
    * @return void
    */
    public function boot()
    {

        // $this->mergeConfigFrom(__DIR__.'/config/easemob.php', 'easemob');
    }

    /**
    * Register the service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->publishes([

            __DIR__.'/config/neteaseim.php' => config_path('neteaseim.php'),

        ]);

        $this->app->singleton('neteaseim', function($app){

            return new NimClass($app['config']['neteaseim']);

        });

        $this->app->booting( function($app){

            $aliases = $app['config']['aliases'];

            if(empty($aliases['Neteaseim'])){

                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('Neteaseim','Aobo\Neteaseim\Facades\Nim');

            }
        });
    }
}
