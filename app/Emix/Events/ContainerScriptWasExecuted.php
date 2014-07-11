<?php namespace Emix\Events;

use Emix\Node;
use Emix\ContainerResponse;
use Emix\Commands\ICommand;

/**
 * Class ContainerScriptWasExecuted
 * @package Emix\Events
 */
class ContainerScriptWasExecuted implements IEvent {

    /**
     * @var \Emix\Node
     */
    public $node;
    /**
     * @var \Emix\Commands\ICommand
     */
    protected $command;
    /**
     * @var \Emix\ContainerResponse
     */
    public $response;

    /**
     * @param Node $node
     * @param ICommand $command
     * @param ContainerResponse $response
     */
    function __construct(Node $node, ICommand $command, ContainerResponse $response)
    {
        $this->node = $node;
        $this->command = $command;
        $this->response = $response;
    }

    /**
     * @return Node
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
     * @return ContainerResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

}