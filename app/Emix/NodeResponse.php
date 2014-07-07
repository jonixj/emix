<?php namespace Emix;

use Emix\Commands\ICommand;

/**
 * Class NodeResponse
 * @package Emix
 */
class NodeResponse
{
    protected $measure;

    protected $data = [];

    /**
     * @param ICommand $command
     * @param $measures
     */
    function __construct(ICommand $command, $measures)
    {
        $this->measure = $command->getName();
        $this->data = $measures;
    }

    /**
     * @param $measure
     * @param $value
     */
    public function addMeasure($measure, $value)
    {
        $this->data = array_add($this->data, $measure, $value);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getMeasure()
    {
        return $this->measure;
    }

}