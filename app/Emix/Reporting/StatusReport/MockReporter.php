<?php namespace Emix\Reporting;

use Emix\Server;
use Emix\Repositories;
use Emix\Reporting;
use Emix\ReportInterface;
use Emix\Reporting\StatusReporterInterface;

class MockReporter implements StatusReporterInterface
{
    protected $report;

    public function __construct(ReportInterface $report)
    {
        $this->report = $report;
    }

    public function fromServer($server)
    {
        $this->server = $server;
        return $this;
    }

    public function make()
    {
        // TODO: Implement make() method.
    }

    public function prepare(Server $server)
    {
        $this->report->uptime = $this->getUptime();
        $this->report->load = $this->getLoad();
        $this->report->cpu = $this->getCPU();
        $this->report->storage = $this->getStorage();
        $this->report->setServer($server);
        return $this->report;
    }

    public function getUptime()
    {
        return mt_rand(0, 60 * 60 * 24 * 365);
    }

    public function getLoad()
    {
        return mt_rand(0, 10000) / 100;
    }

    public function getCPU()
    {
        return mt_rand(0, 100) / 100;
    }

    public function getStorage()
    {
        return mt_rand(0, 1000);
    }

}