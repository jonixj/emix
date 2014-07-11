<?php namespace Emix\Commands;

use Emix\ContainerResponse;
use Emix\Events\ContainerScriptWasExecuted;
use Emix\Events\NodeScriptWasExecuted;
use Emix\NodeResponse;

/**
 * Class UptimeCommand
 * @package Emix\Commands
 */
class UptimeCommand extends Command implements ICommand
{

    /**
     * @return string
     */
    public static function getName()
    {
        return 'uptime';
    }

    /**
     * @return string
     */
    public static function getMeasure()
    {
        return "uptime";
    }

    /**
     * @return string
     */
    public function getType()
    {
        //Todo create a type class
        return 'measure';
    }

    /**
     * @return string
     */
    public static function getDescription()
    {
        return 'This command retrieves the uptime';
    }

    /**
     * @return array
     */
    public function getNodeScript()
    {
        return [
            "awk '{print $1}' /proc/uptime",
            function ($line) {
                /*
                 *FIXME It would be better to just return the response
                 * from this class and handle the events in the handler
                 * Then this class will not need to know about the node
                */
                $response = new NodeResponse($line);

                $this->raise(new NodeScriptWasExecuted($this->node, $this, $response));
            }
        ];
    }

    /**
     * @return array
     */
    public function getContainerScript()
    {
        return [
            "vzlist --json -a -o uptime,ctid",
            function ($line) {
                $response = (new ContainerResponse($this))->fromVzJson($line);

                $this->raise(new ContainerScriptWasExecuted($this->node, $this, $response));
            }
        ];
    }

}
