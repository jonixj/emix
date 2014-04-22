<?php namespace Emix\Repositories;

use Emix\Server;

class ElqntServerRepository implements ServerRepositoryInterface
{
    public function getAll()
    {
        return Server::all();
    }

    public function find($id)
    {
        return Server::find($id);
    }

    public function save($server)
    {
        // TODO: Implement save() method.
    }

    public function get($id = null)
    {
        // TODO: Implement get() method.
    }

}