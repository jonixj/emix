<?php namespace Emix\Commands;

use Emix\Gateway\NodeGateway;
use Emix\Node;

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

    /**
     * @param NodeGateway $gate
     */
    function __construct(NodeGateway $gate)
    {
        $this->gate = $gate;
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
    public function getAvailableCommands()
    {
        return [
            'LoadCommand',
            'UptimeCommand',
        ];
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
        $fullClassName = __NAMESPACE__ . "\\" . $name;

        return $fullClassName;
    }
} 