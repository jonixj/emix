<?php namespace Emix\Listeners;

use Emix\Eventing\EventListener;

class ReportListener extends EventListener
{
    public function whenNodeScriptWasExecuted($event)
    {
        $reportRep = app('Emix\Repositories\IReportRepository');

        list($node, $response) = [$event->node, $event->response];

        $reportRep->createFromNodeResponse($node, $response);
    }

    public function whenContainerScriptWasExecuted($event)
    {
        $reportRep = app('Emix\Repositories\IReportRepository');

        list($node, $response) = [$event->node, $event->response];

        $reportRep->createFromContainerResponse($node, $response);
    }
} 