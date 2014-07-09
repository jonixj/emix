<?php namespace Emix\Events;

use Emix\Node;
use Emix\ContainerResponse;

class ContainerScriptWasExecuted implements IEvent {

    public $node;
    public $response;

    function __construct(Node $node, ContainerResponse $response)
    {
        $this->node = $node;
        $this->response = $response;
    }

}