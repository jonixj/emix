<?php namespace Emix\Repositories;


use Emix\Commands\ICommand;
use Emix\Report;
use Emix\Node;

class EloquentReportRepository implements IReportRepository
{
    protected $report;

    function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function getLatestByNodeAndCommand(Node $node, ICommand $cmd)
    {
        $report = $this->report
            ->where('node_id', $node->_id)
            ->where($cmd->getMeasure(), 'exists', true)
            ->orderBy('_id', '-1')
            ->take(1)
            ->get();

        return $report;
    }


} 