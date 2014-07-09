<?php namespace Emix\Listeners;

use Emix\Eventing\EventListener;

class ReportListener extends EventListener
{
    public function whenNodeScriptWasExecuted($event)
    {
        var_dump('DDD');
        /*
        $reportRep = app('Emix\Repositories\IReportRepository');

        list($node, $response) = [$event->node, $event->response];

        $reportRep->createFromNodeResponse($node, $response);
        */
    }

    public function whenContainerScriptWasExecuted($event)
    {/*
        var_dump('asdf');
        $reportRep = app('Emix\Repositories\IReportRepository');

        list($node, $response) = [$event->node, $event->response];

        $reportRep->createFromContainerResponse($node, $response);
*/
    }
} 