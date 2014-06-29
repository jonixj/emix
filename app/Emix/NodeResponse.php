<?php namespace Emix;

class NodeResponse {

    protected $commandMeasure;
    protected $nodeOutput;
    protected $containerOutput;

    function __construct($commandMeasure, $nodeOutput, array $containerOutput)
    {
        $this->commandMeasure = $commandMeasure;
        $this->nodeOutput = $nodeOutput;
        $this->containerOutput = $containerOutput;
    }
}