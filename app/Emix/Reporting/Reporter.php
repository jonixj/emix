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
        $this->reportConf = require app('path') . '/config/reports/' . $type->name . '.php';
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
        $reportData = [];
        foreach ($this->reportConf['content'] as $key => $item) {
            $reportData[$key] = ['title' => $item['title'], 'type' => $item['type']];
            $reportData[$key]['value'] = $item['script']($this->gateway);
        }
        $this->report->content = json_encode($reportData);

        return $this->report;
    }

}