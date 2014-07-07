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
        return Node::with(
            [
                'containers',
            ]
        )->find($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static
     */
    public function findWithContainersAndReports($id)
    {
        return Node::with(
            [
                'containers',
                'reports' => function ($query) {
                        $query->where('created_at', '>', new \DateTime('yesterday'));
                    },
                'containers.reports' => function ($query) {
                        $query->orderBy('created_at', 'desc')->where('created_at', '>', new \DateTime('yesterday'));
                    },
            ]
        )->find($id);
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
     * @return mixed
     */
    public function allWithContainers()
    {
        return Node::with(
            [
                'containers',
                'reports' => function ($query) {
                        $query->where('created_at', '>', new \DateTime('today'));
                    },
                'containers.reports' => function ($query) {
                        $query->orderBy('created_at', 'desc')->where('created_at', '>', new \DateTime('today'));
                    },
            ]
        )->take(100)->get();
    }
}