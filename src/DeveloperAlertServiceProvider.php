<?php

namespace webit_be\developer_alert;

use Illuminate\Support\ServiceProvider;

class DeveloperAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'developer_alert');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Publishes
        if ($this->app->runningInConsole()) {
            // Publish config file
            $this->publishes([
                __DIR__ . '/../config/alert.php' => config_path('alert.php'),
            ], 'alert');

            // Publish alert migration
            if (!class_exists('CreateAlertsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_alerts_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_alerts_table.php'),
                    // add extra migration here if needed
                ], 'migrations');
            }
        }


    
        // php artisan vendor:publish --provider="webit_be\developer_alert\DeveloperAlertServiceProvider" --tag="alert"
        // php artisan vendor:publish --provider="webit_be\developer_alert\DeveloperAlertServiceProvider" --tag="migrations"
    }

    public function register()
    {
        // Bind config file
        $this->mergeConfigFrom(__DIR__ . '/../config/alert.php', 'alert');
    }
}
