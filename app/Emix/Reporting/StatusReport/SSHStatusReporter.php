<?php namespace Emix\Reporting;

class SSHStatusReporter extends Reporter implements StatusReporterInterface
{

    public function report()
    {
        $this->report->uptime = $this->getUptime();
        $this->report->load = $this->getLoad();
        $this->report->cpu = $this->getCPU();

        return $this->report;
    }

    /**
     * Get server uptime in seconds
     *
     * @return float
     */
    public function getUptime()
    {
        $cmd = 'cat /proc/uptime | awk \'{ print $1}\'';

        return (float) $this->gateway->run($cmd);
    }

    public function getLoad()
    {
        $cmd = "uptime | grep -o '[0-9]\+\.[0-9]\+*'";

        return $this->gateway->run($cmd);
    }

    public function getCPU()
    {
        $cmd = "cat /proc/cpuinfo | grep 'model name' | cut -d: -f2 | head -n 1";

        return $this->gateway->run($cmd);
    }
}