<?php

namespace Briofy\Meta\Providers;

use Briofy\Meta\Repositories\IMetaRepository;
use Briofy\Meta\Repositories\MetaRepository;
use Illuminate\Support\ServiceProvider;

class MetaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/briofy-meta.php', 'briofy-meta');
    }

    public function boot()
    {
        if (config('briofy-meta.routes.api.enabled')) $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

            $this->publishes([
                __DIR__.'/../Config/briofy-tag.php' => config_path('briofy-tag.php'),
            ], 'briofy-tag-config');
        }

        $this->app->bind(IMetaRepository::class, MetaRepository::class);
    }
}
