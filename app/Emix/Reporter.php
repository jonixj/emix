<?php namespace Emix;

use Emix\Commands\CommandResponse;
use Emix\Commands\ICommand;
use Emix\Gateway\NodeGateway;
use Carbon\Carbon;

class Reporter
{
    protected $node;
    protected $gateway;
    protected $report;

    function __construct(NodeGateway $gateway, Report $report)
    {
        $this->gateway = $gateway;
        $this->report = $report;
    }

    public function with($node)
    {
        $this->node = $node;

        $this->gateway->setNode($this->node);

        return $this;
    }

    public function storeAndExec(ICommand $cmd)
    {
        $measure = $cmd::getMeasure();

        try {
            $nodeValue = $cmd->setGateway($this->gateway)->executeNode($cmd);
            echo 'Succeeded with server: ' . $this->node->name;
        }catch (\Exception $e){
            echo 'Failed with server: ' . $this->node->name;
            return;
        }


        $report = new Report();
        $report->setNode($this->node);
        $report->$measure = $nodeValue;
        $report->save();
        try {
            $containerValues = $cmd->setGateway($this->gateway)->executeContainers($cmd);
        }catch (\Exception $e){

        }


        foreach ($this->node->containers as $container) {
            $report = new Report();
            $report->command = $measure;
            $report->setContainer($container);
            $report->$measure = isset($containerValues[$container->container_id]) ? $containerValues[$container->container_id] : 0;
            $report->save();

            echo $container->name;
        };
    }
} 