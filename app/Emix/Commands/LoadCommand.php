<?php namespace Emix\Commands;

class LoadCommand extends Command implements ICommand
{

    public static function getName()
    {
        return 'LoadCommand';
    }

    public static function getMeasure()
    {
        return 'load';
    }

    public static function getDescription()
    {
        return 'This command returns the current load one the node and its containers';
    }

    protected function getNodeScript()
    {
        return [
            "uptime",
            function ($line) {
                preg_match_all('/: ([0-9]+,[0-9]+)/', $line, $out);
                if (isset($out[0][0])) {
                    $value = substr($out[0][0], 2);
                } else {
                    preg_match_all('/: ([0-9]+.[0-9]+)/', $line, $out);
                    $value = substr($out[0][0], 2);
                }
                self::$response = $value;
            }
        ];
    }

    protected function getContainerScript()
    {
        return [
            "uptime",
            function ($line) {
                preg_match_all('/: ([0-9]+,[0-9]+)/', $line, $out);
                if (isset($out[0][0])) {
                    $value = substr($out[0][0], 2);
                } else {
                    preg_match_all('/: ([0-9]+.[0-9]+)/', $line, $out);
                    $value = substr($out[0][0], 2);
                }
                self::$response = $value;
            }
        ];
    }

    public function processContainerResponse($containersResponse)
    {
        return [123 => 4];
    }
}