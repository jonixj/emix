<?php namespace Emix\Events;

use Emix\Node;
use Emix\ServerResponse\NodeResponse;

class ContainersWereFetched implements IEvent
{

    protected $node;

    protected $nodeResponse;

    function __construct(Node $node, NodeResponse $nodeResponse)
    {
        $this->node = $node;
        $this->nodeResponse = $nodeResponse;
    }

    public function getNode()
    {
        return $this->node;
    }

    public function getNodeResponse()
    {
        return $this->nodeResponse;
    }

} 