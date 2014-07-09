<?php namespace Emix\Listeners;

use Emix\Eventing\EventListener;
use Emix\Events\NodeScriptWasExecuted;
use Emix\Measure;

class StateListener extends EventListener
{

    public function whenNodeScriptWasExecuted(NodeScriptWasExecuted $event)
    {
        var_dump('StateListener was initiated');

        if ($event->getCommand()->getType() !== 'measure') {
            return;
        }

        $event->getNode()->addMeasure(
            new Measure($event->getCommand()->getMeasure(), $event->getResponse()->getResponse())
        );

    }

} 