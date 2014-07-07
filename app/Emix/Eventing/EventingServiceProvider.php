<?php namespace Emix\Eventing;

use Illuminate\Support\ServiceProvider;

class EventingServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $listeners = $this->app['config']->get('emix.listeners');

        foreach ($listeners as $listener) {
            $this->app['events']->listen('Emix.Commands.*', $listener);
        }
    }

} 