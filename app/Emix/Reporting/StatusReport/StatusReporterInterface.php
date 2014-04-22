<?php namespace Emix\Reporting;

interface StatusReporterInterface
{

    public function getUptime();

    public function getLoad();

    public function getCPU();
}