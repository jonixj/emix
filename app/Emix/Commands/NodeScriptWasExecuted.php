<?php namespace Emix\Commands;


class NodeScriptWasExecuted {

    public $node;
    public $response;

    function __construct($node, $response)
    {
        $this->node = $node;
        $this->response = $response;
    }

}