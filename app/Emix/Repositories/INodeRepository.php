<?php namespace Emix\Repositories;

/**
 * Interface INodeRepository
 * @package Emix\Repositories
 */
interface INodeRepository
{

    /**
     * @return \Collection
     */
    public function all();

    /**
     * @param string $id
     * @return \Emix\Node
     */
    public function find($id);

    /**
     * @param $id
     * @return \Emix\Node
     */
    public function findWithContainers($id);

    /**
     * @param $name
     * @return \Emix\Node
     */
    public function findByName($name);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function newInstance(array $attributes = []);

} 