<?php namespace Emix\Commands;

use Emix\Node;
use \Emix\Eventing\EventGenerator;
/**
 * Class Command
 * @package Emix\Commands
 */
Abstract class Command implements ICommand
{

    use EventGenerator;

    /**
     * @var
     */
    protected $gateway;

    /**
     * @var \Emix\Node
     */
    protected $node;

    /**
     * @param Node $node
     */
    function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @param $gateway
     * @return $this
     */
    function setGateway($gateway)
    {
        $this->gateway = $gateway;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * @return Node
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * Execute the script on the node and run a callback function
     */
    public function executeNode()
    {
        $this->gateway->run(
            $this->getNodeScript()[0],
            $this->getNodeScript()[1]
        );
    }

    /**
     * Execute the script on the containers on the node and run a callback function*
     */
    public function executeContainers()
    {
        $this->gateway->run(
            $this->getContainerScript()[0],
            $this->getContainerScript()[1]
        );
    }

    /**
     * Execute the scripts on both the node and its containers
     */
    public function execute()
    {
        $this->executeNode();
        $this->executeContainers();
    }

}