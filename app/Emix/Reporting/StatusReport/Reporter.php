<?php namespace Emix\Reporting;

use Emix\StatusReportInterface;
use Emix\Gateways\ServerGatewayInterface;

abstract class Reporter implements StatusReporterInterface
{
    protected $server;
    protected $gateway;
    protected $report;

    public function __construct(StatusReportInterface $report, ServerGatewayInterface $gateway)
    {
        $this->report = $report;
        $this->gateway = $gateway;
    }

    public function fromServer($server)
    {
        $this->server = $server;
        $this->gateway->login($server);
        $this->report->setServer($server);
        return $this;
    }

    abstract public function report();

}