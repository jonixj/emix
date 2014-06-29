<?php namespace Emix;

use \Jenssegers\Mongodb\Model as Eloquent;

class Report extends Eloquent
{
    protected function node()
    {
        return $this->belongsTo('Emix\Node');
    }

    protected function container()
    {
        return $this->belongsTo('Emix\Container');
    }

    public function setNode(Node $node)
    {
        return $this->node()->associate($node);
    }

    public function setContainer(Container $container)
    {
        return $this->container()->associate($container);
    }
} 