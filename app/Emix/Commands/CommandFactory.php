<?php namespace Emix\Commands;

use Emix\Gateway\NodeGateway;
use Emix\Node;
use Illuminate\Foundation\Application;

/**
 * Class CommandFactory
 * @package Emix\Commands
 */
class CommandFactory
{

    /**
     * @var \Emix\Gateway\NodeGateway
     */
    protected $gate;

    protected $app;

    /**
     * @param NodeGateway $gate
     */
    function __construct(NodeGateway $gate, Application $app)
    {
        $this->gate = $gate;
        $this->app = $app;
    }

    /**
     * @return NodeGateway
     */
    public function getGate()
    {
        return $this->gate;
    }

    /**
     * @return array
     */
    public function getAllCommands()
    {
        return [
            $this->app->make('Emix\Commands\LoadCommand'),
            $this->app->make('Emix\Commands\UptimeCommand'),
        ];
    }

    public function getCommandDetailsAsArray()
    {
        foreach ($this->getAllCommands() as $cmd) {
            $commands[] = ['name' => $cmd->getName(), 'description' => $cmd->getDescription()];
        }

        return $commands;
    }

    /**
     * @param $name
     * @param Node $param
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public static function get($name, Node $param = null)
    {
        $fullClassName = self::getFullClassName($name);

        if (!class_exists($fullClassName)) {
            throw new \InvalidArgumentException;
        }

        return new $fullClassName($param);
    }

    /**
     * @param $name
     * @return string
     */
    protected static function getFullClassName($name)
    {
        $fullClassName = '\\' . __NAMESPACE__ . "\\" . $name;

        return $fullClassName;
    }
} 