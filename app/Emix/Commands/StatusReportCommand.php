<?php namespace Emix\Commands;

class StatusReportCommand extends Command
{
    protected $commands;

    function __construct(UptimeCommand $uptimeCmd)
    {
        $this->commands = [$uptimeCmd];
    }

    public function execute()
    {
        foreach ($this->commands as $c) {
            $c->execute();
        }
    }
}