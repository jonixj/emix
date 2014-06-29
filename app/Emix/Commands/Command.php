<?php namespace Emix\Commands;


Abstract class Command implements ICommand
{

    protected $gateway;
    protected $logger;
    protected static $response;

    function setGateway($gateway)
    {
        $this->gateway = $gateway;
        return $this;
    }

    public function executeNode()
    {
        $this->gateway->run(
            $this->getNodeScript()[0],
            $this->getNodeScript()[1]
        );

        return self::$response;
    }

    public function executeContainers()
    {
        $this->gateway->run(
            $this->getContainerScript()[0],
            $this->getContainerScript()[1]
        );
        $containersResponse = self::$response;

        return $this->processContainerResponse($containersResponse);
    }

    public function execute(){

    }

    abstract public function processContainerResponse($containersResponse);
}