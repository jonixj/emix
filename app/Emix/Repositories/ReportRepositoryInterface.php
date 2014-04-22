<?php namespace Emix\Repositories;

use Emix\Report;

Interface ReportRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function save($report);

    public function get($id = null);

    public function getByType($reportType);
}