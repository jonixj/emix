<?php namespace Emix\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(
            function () {
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('UnderlyingClass', 'Fideloper\Example\Facades\UnderlyingClass');
            }
        );
    }
}