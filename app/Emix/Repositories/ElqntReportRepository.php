<?php namespace Emix\Repositories;

use Emix\Report;

class ElqntReportRepository implements ReportRepositoryInterface
{

    public function getAll()
    {
        return Report::all();
    }

    public function save($report)
    {
        // TODO: Implement save() method.
    }

    public function get($id = null)
    {
        // TODO: Implement get() method.
    }

    public function find($id)
    {
        Report::find($id);
    }

    public function getByType($reportType)
    {
        return Report::whereHas(
            'ReportType',
            function ($q) use ($reportType) {
                $q->where('name', 'like', $reportType->name);

            }
        )->get();
    }
}
