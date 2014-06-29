<?php namespace Emix\Commands;

class UserCommand extends Command implements ICommand
{

    public static function getName()
    {
        return 'UserCommand';
    }

    public static function getMeasure()
    {
        return 'user';
    }

    public static function getDescription()
    {
        return 'This command returns the current user';
    }

    protected function getNodeScript()
    {
        return [
            "whoami",
            function ($line) {
                self::$response = $line;
            }
        ];
    }

    protected function getContainerScript()
    {
        return [
            "whoami",
            function ($line) {
                self::$response = $line;
            }
        ];
    }

    public function processContainerResponse($containersResponse)
    {
        return [123 => 'johan'];
    }

}