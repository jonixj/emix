<?php namespace Emix\Events;

use Emix\ServerResponse\NodeResponse;
use Emix\Node;
use Emix\Commands\ICommand;

/**
 * Class NodeScriptWasExecuted
 * @package Emix\Commands
 */
class NodeScriptWasExecuted implements IEvent
{

    /**
     * @var NodeResponse
     */
    protected $node;
    /**
     * @var NodeResponse
     */
    protected $response;

    /**
     * @var ICommand
     */
    protected $command;

    /**
     * @param Node $node
     * @param ICommand $command
     * @param NodeResponse $response
     */
    function __construct(Node $node, ICommand $command, NodeResponse $response)
    {
        $this->node = $node;
        $this->command = $command;
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @return \Emix\Commands\ICommand
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @return NodeResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

}