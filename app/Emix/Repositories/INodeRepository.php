<?php namespace Emix\Repositories;

interface INodeRepository {

    public function all();

    public function find($id);

    public function findWithContainers($id);

    public function findByName($name);

} 