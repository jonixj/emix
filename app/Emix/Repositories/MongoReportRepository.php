<?php namespace Emix\Repositories;

use Emix\Commands\ICommand;
use Emix\Report;
use Emix\Node;
use Emix\NodeResponse;
use Emix\ContainerResponse;

class MongoReportRepository implements IReportRepository
{
    protected $report;

    function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function getLatestByNodeAndCommand(Node $node, ICommand $cmd)
    {
        return $this->report
            ->where('node_id', $node->_id)
            ->where($cmd->getMeasure(), 'exists', true)
            ->orderBy('_id', '-1')
            ->take(1)
            ->get();
    }

    public function getLatestReportsForAllNodes(ICommand $cmd)
    {
        $lastRun = $this->getLastReportDateByCommand($cmd);

        return $this->report->where($cmd->getMeasure(), 'exists')->where('created_at', $lastRun)->get();
    }

    protected function getLastReportDateByCommand(ICommand $cmd)
    {
        return $this->report
            ->where($cmd->getMeasure(), 'exists', true)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->created_at;
    }

    public function createFromContainerResponse(Node $node, ContainerResponse $response)
    {
        foreach ($response->getList() as $ctid => $data) {
            $instanceVars = [
                'measure' => $response->getMeasure(),
                'data' => $data
            ];

            $this->report->newInstance($instanceVars)->setContainer($node->getContainerByCtid($ctid))->save();
        }
    }

    public function createFromNodeResponse(Node $node, NodeResponse $response)
    {
        $instanceVars = [
            'measure' => $response->getMeasure(),
            'data' => $response->getData()
        ];

        return $this->report->newInstance($instanceVars)->setNode($node)->save();
    }

    public function newInstance(array $attributes = [])
    {
        return $this->report->newInstance($attributes);
    }


    public function all()
    {
        return $this->report->all();
    }
}