<?php

namespace Carkii\Notifier;

use Illuminate\Support\ServiceProvider;
use Carkii\Notifier\Notifier;

class NotifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {   
        // publish files
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('notifier.php'),
        ]);
        // load migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');        
        // load routes
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        // publish views (notifications ex), CSS & JS files
        $this->publishes([
            __DIR__.'/views/example.blade.php' => config('view.paths')[0].'/notifications/example.blade.php',
            __DIR__.'/public/css/notifications.css' => public_path('css/notifications.css'),
            __DIR__.'/public/js/notifications.js' => public_path('js/notifications.js'),
        ]);                    
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {                   
        $this->app->singleton('Carkii\Notifier',Notifier::class);        
    }
}
