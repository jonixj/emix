<?php namespace Emix\Listeners;

use Emix\Eventing\EventListener;
use Emix\Events\ContainerScriptWasExecuted;
use Emix\Events\NodeScriptWasExecuted;
use Emix\Measure;

/**
 * Class StateListener
 * @package Emix\Listeners
 */
class StateListener extends EventListener
{

    /**
     * @param NodeScriptWasExecuted $event
     */
    public function whenNodeScriptWasExecuted(NodeScriptWasExecuted $event)
    {
        $this->log->info('StateListener was initiated for node');

        if ($event->getCommand()->getType() !== 'measure') {
            return;
        }

        $event->getNode()->addMeasure(
            new Measure($event->getCommand()->getMeasure(), $event->getResponse()->getResponse())
        );
    }

    /**
     * @param ContainerScriptWasExecuted $event
     */
    public function whenContainerScriptWasExecuted(ContainerScriptWasExecuted $event)
    {
        $this->log->info('StateListener was initiated for containers');

        if ($event->getCommand()->getType() !== 'measure') {
            return;
        }

        foreach ($event->getNode()->containers as $container) {
            if ($data = $event->getResponse()->getContainerByCtid($container->ctid)) {
                $container->addMeasure(new Measure($event->getCommand()->getMeasure(), $data));
            } else {
                $this->log->warning("Didn't find ct {$container->ctid} in {$event->getNode()->name}");
            }
        }
    }
}