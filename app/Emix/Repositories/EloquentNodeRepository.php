<?php namespace Emix\Repositories;

use Emix\Node;

class EloquentNodeRepository implements INodeRepository
{
    public function all()
    {
        return Node::all();
    }

    public function find($id)
    {
        return Node::findOrFail($id);
    }

    public function findWithContainers($id)
    {
        return Node::with(
            [
                'containers',
            ]
        )->find($id);
    }

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

    public function findByName($name)
    {
        return Node::where('name', $name)->first();
    }

} 