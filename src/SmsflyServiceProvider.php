<?php

namespace Nekkoy\GatewaySmsfly;

use Illuminate\Support\ServiceProvider;

/**
 *
 */
class SmsflyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(\Nekkoy\GatewaySmsfly\Services\GatewayService::class, function ($app) {
            return new \Nekkoy\GatewaySmsfly\Services\GatewayService();
        });

        $this->app->singleton('gateway-smsfly', function ($app) {
            return new \Nekkoy\GatewaySmsfly\Services\GatewaySmsflyService();
        });
    }

    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/config.php' => config_path('gateway-smsfly.php')], 'config');
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'gateway-smsfly');
    }
}
