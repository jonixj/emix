<?php namespace Emix;

use \Jenssegers\Mongodb\Model as Eloquent;

/**
 * Class Report
 * @package Emix
 */
class Report extends Eloquent
{

    protected $guarded = array();

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function node()
    {
        return $this->belongsTo('Emix\Node');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function container()
    {
        return $this->belongsTo('Emix\Container');
    }

    /**
     * @param Node $node
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setNode(Node $node)
    {
        return $this->node()->associate($node);
    }

    /**
     * @param Container $container
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setContainer(Container $container)
    {
        return $this->container()->associate($container);
    }
} 