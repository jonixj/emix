<?php namespace Emix\Reporting;

use Emix\Gateways\ServerGatewayInterface;
use Emix\Server;
use Emix\ReportInterface;

class Reporter
{

    protected $gateway;
    protected $report;
    protected $reportType;
    protected $reportConf;

    function __construct(ServerGatewayInterface $gateway, ReportInterface $report)
    {
        $this->gateway = $gateway;
        $this->report = $report;
    }

    public function apply($type)
    {
        $this->reportType = $type;
        $this->report->setReportType($type);
        $this->reportConf = require app('path') . '/config/reports/' . $type->getConfigFileName();
        return $this;
    }

    public function onServer(Server $server)
    {
        $this->server = $server;
        $this->gateway->login($server);
        $this->report->setServer($this->server);
        return $this;
    }

    public function report()
    {
        foreach ($this->reportConf['content'] as $key => $item) {
            $this->report->$key = $item['script']($this->gateway);
        }
        return $this->report;
    }

}