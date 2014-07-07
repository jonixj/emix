<?php namespace Emix\Commands;

use Emix\ContainerResponse;
use Emix\NodeResponse;

class UptimeCommand extends Command implements ICommand
{

    public static function getName()
    {
        return 'uptime';
    }

    public static function getMeasure()
    {
        return 'uptime';
    }

    public static function getDescription()
    {
        return 'This command retrieves the uptime';
    }

    public function getNodeScript()
    {
        return [
            "awk '{print $1}' /proc/uptime",
            function ($line) {
                $response = new NodeResponse($this, ['uptime' => floatval($line)]);

                $this->raise(new NodeScriptWasExecuted($this->node, $response));
            }
        ];
    }

    public function getContainerScript()
    {
        return [
            "vzlist --json -a -o uptime,ctid",
            function ($line) {
                $response = (new ContainerResponse($this))->fromVzJson($line);

                $this->raise(new ContainerScriptWasExecuted($this->node, $response));
            }
        ];
    }

}
