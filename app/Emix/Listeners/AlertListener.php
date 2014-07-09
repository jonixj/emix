<?php namespace Emix\Listeners;

use Emix\Eventing\EventListener;

class AlertListener extends EventListener
{

    public function whenNodeScriptWasExecuted($event)
    {
        var_dump('ALERT WARNING !!!');
    }

} 