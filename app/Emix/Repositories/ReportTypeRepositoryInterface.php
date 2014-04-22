<?php namespace Emix\Repositories;


interface ReportTypeRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @return mixed
     */
    public function getAll();
} 