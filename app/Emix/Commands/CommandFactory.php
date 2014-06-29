<?php namespace Emix\Commands;

use Emix\Gateway\NodeGateway;

class CommandFactory
{

    protected $gate;

    function __construct(NodeGateway $gate)
    {
        $this->gate = $gate;
    }

    public function getGate()
    {
        return $this->gate;
    }

    public function getAvailableCommands()
    {
        return [
            new LoadCommand,
            new UserCommand,
        ];
    }

    public function getCommand($name)
    {
        $fullClassName = __NAMESPACE__ . "\\" . $name;
        if (!class_exists($fullClassName)) {
            throw new \InvalidArgumentException;
        }
        return new $fullClassName();
    }
} 