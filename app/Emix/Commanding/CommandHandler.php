<?php namespace Emix\Commanding;

use Emix\Gateway\NodeGateway;
use Emix\Eventing\EventDispatcher;
use Emix\Commands\ICommand;

class CommandHandler
{
    protected $gateway;
    protected $dispatcher;

    function __construct(NodeGateway $gateway, EventDispatcher $dispatcher)
    {
        $this->gateway = $gateway;
        $this->dispatcher = $dispatcher;
    }

    /**
     * A default implementation for handling a command
     *
     * @param $command
     * @return mixed
     */
    public function handle(ICommand $command)
    {
        $this->gateway->setNode($command->getNode());

        $command->setGateway($this->gateway);

        $command->execute();

        $this->dispatcher->dispatch($command->releaseEvents());
    }

} 