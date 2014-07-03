<?php namespace Emix\Commands;

class StatusReportCommand extends Command
{
    protected $commands;

    function __construct(UptimeCommand $uptimeCmd)
    {
        $this->commands = [$uptimeCmd];
    }
    
    public function getName()
    {
        return 'StatusReport';
    }
    
    public function getDescription()
    {
        return 'Fetches some kind of information';    
    }
    
    protected function processContainerResponse($containerResponse)
    {
        return [];
    }

    public function execute()
    {
        foreach ($this->commands as $c) {
            $c->execute();
        }
    }
}
