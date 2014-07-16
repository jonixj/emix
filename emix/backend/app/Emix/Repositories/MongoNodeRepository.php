<?php namespace Emix\Repositories;

use Emix\Node;

class MongoNodeRepository implements INodeRepository
{
    /**
     * @var
     */
    protected $node;

    /**
     * @param $node
     */
    function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->node->all();
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->node->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function newInstance(array $attributes = [])
    {
        return $this->node->newInstance($attributes);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static
     */
    public function findWithContainers($id)
    {
        return $this->allWithContainers()->find($id);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return Node::where('name', $name)->first();
    }

    /**
     * @return Node
     */
    public function allWithContainers()
    {
        return Node::with(['containers',])->get();
    }

    public function allWithState(){
        return Node::with(['serverState',])->get();
    }

    /**
     * @return Node
     */
    public function allWithContainersAndState()
    {
        return Node::with(['serverState','containers','containers.serverState'])->get();
    }
}