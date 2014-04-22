<?php namespace Emix\Repositories;

Interface ServerRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function save($server);

    public function get($id = null);

}