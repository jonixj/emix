<?php namespace Emix;

use Emix\Commands\ICommand;
use Emix\Gateway\NodeGateway;
use Emix\Repositories\IReportRepository;
use Log;

class Reporter
{
    protected $reportRepository;
    protected $node;
    protected $gateway;
    protected $report;

    function __construct(NodeGateway $gateway, IReportRepository $reportRepository)
    {
        $this->gateway = $gateway;
        $this->reportRepository = $reportRepository;
    }

    public function with($node)
    {
        $this->gateway->setNode($this->node = $node);

        return $this;
    }

    public function storeAndExec(ICommand $cmd)
    {
        $measure = $cmd::getMeasure();

        try {
            $nodeValue = $cmd->setGateway($this->gateway)->executeNode($cmd);
            LOG::info("Command {$cmd->getName()} was run on node: {$this->node->name}");
        } catch (\Exception $e) {
            LOG::warn("Could not execute command on node {$this->node->name}");
            return;
        }

        $this->reportRepository
            ->newInstance(['command' => $measure, $measure => $nodeValue])
            ->setNode($this->node)
            ->save();

        try {
            $ctValues = $cmd->setGateway($this->gateway)->executeContainers($cmd);
        } catch (\Exception $e) {
            LOG::warn("Could not execute command on nodes on server {$this->node->name}");
        }

        foreach ($this->node->containers as $container) {
            if (!isset($ctValues[$container->ctid])) {
                LOG::warn("Could not find the container with ctid {$container->ctid} on {$this->node->name}");
                continue;
            }
            $this->reportRepository
                ->newInstance(['command' => $measure, $measure => $ctValues[$container->ctid]])
                ->setContainer($container)
                ->save();
        };
    }
} 
