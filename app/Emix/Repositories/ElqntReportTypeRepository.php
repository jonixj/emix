<?php namespace Emix\Repositories;

use Emix\ReportType;

class ElqntReportTypeRepository implements ReportTypeRepositoryInterface
{
    public function getAll()
    {
        return ReportType::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return ReportType::find($id);
    }
}