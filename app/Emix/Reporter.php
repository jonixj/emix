<?php namespace Emix;

use Emix\Commands\ICommand;
use Emix\Gateway\NodeGateway;
use Emix\Repositories\IReportRepository;
use Log;

/**
 * Class Reporter
 * @package Emix
 */
class Reporter
{
    /**
     * @var Repositories\IReportRepository
     */
    protected $reportRepository;
    /**
     * @var
     */
    protected $node;
    /**
     * @var Gateway\NodeGateway
     */
    protected $gateway;
    /**
     * @var
     */
    protected $report;

    /**
     * @param NodeGateway $gateway
     * @param IReportRepository $reportRepository
     */
    function __construct(NodeGateway $gateway, IReportRepository $reportRepository)
    {
        $this->gateway = $gateway;
        $this->reportRepository = $reportRepository;
    }

    /**
     * @param $node
     * @return $this
     */
    public function with($node)
    {
        $this->gateway->setNode($this->node = $node);

        return $this;
    }

    /**
     * @param ICommand $cmd
     */
    public function storeAndExec(ICommand $cmd)
    {
        try {
            $cmd->setGateway($this->gateway)->executeNode($cmd);
            $cmd->setGateway($this->gateway)->executeContainers($cmd);
        } catch (\Exception $e) {
            LOG::warning("Could not execute command {$cmd->name} on node {$this->node->name}");
        }
    }
    /*
    private function storeAndExecOnNode(ICommand $cmd)
    {


        $this->reportRepository
            ->newInstance(['command' => $cmd::getMeasure(), $cmd::getMeasure() => $nodeValue])
            ->setNode($this->node)
            ->save();

        LOG::info("Command {$cmd->getName()} was run on node: {$this->node->name}");
    }

    private function storeAndExecOnContainers(ICommand $cmd)
    {
        $ctValues =

        foreach ($this->node->containers as $container) {
            if (!isset($ctValues[$container->ctid])) {
                LOG::warning("Could not find the container with ctid {$container->ctid} on {$this->node->name}");
                continue;
            }
            $this->reportRepository
                ->newInstance(['command' => $cmd::getMeasure(), $cmd::getMeasure() => $ctValues[$container->ctid]])
                ->setContainer($container)
                ->save();
        };
    }
    */
} 
