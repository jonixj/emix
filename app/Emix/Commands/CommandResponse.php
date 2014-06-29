<?php namespace Emix\Commands;


class CommandResponse
{
    protected $nodeValue;

    protected $containerValues = [];

    function __construct($node, $measure)
    {
        $this->measure = $measure;
        $this->node = $node;
    }

    public function addContainerValue(array $containerResponse)
    {
        $this->containerValues[] = $containerResponse;
    }

    public function setNodeValue($nodeValue)
    {
        $this->nodeValue = $nodeValue;
    }
}