<?php namespace Emix;

use Zend\Json\Json;

use Emix\Commands\ICommand;

/**
 * Class ContainerResponse
 * @package Emix
 */
class ContainerResponse
{
    /**
     * @var array
     */
    protected $list;


    /**
     * @var
     */
    protected $measure;

    /**
     * @param ICommand $command
     * @param array $list
     */
    function __construct(ICommand $command, $list = [])
    {
        //TODO add some validation here
        $this->measure = $command->getName();
        $this->list = $list;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @return mixed
     */
    public function getMeasure()
    {
        return $this->measure;
    }

    /**
     * @param $ctid
     * @param $measure
     * @param $value
     */
    public function addValuePair($ctid, $measure, $value)
    {
        // We do not want to save the ctid information - as use it as key instead
        if ($measure != 'ctid') {
            $this->list[$ctid][$measure] = $value;
        }
    }

    /**
     * @return mixed
     */
    public function popContainer()
    {
        return array_pop($this->list);
    }

    /**
     * @param $json
     * @return $this
     */
    public function fromVzJson($json)
    {
        $this->list = [];
        $containerData = Json::decode($json);

        foreach ($containerData as $ct) {
            $this->parseContainers($ct);
        }

        return $this;
    }

    /**
     * @param $container
     */
    protected function parseContainers($container)
    {
        $this->list[$container->ctid] = [];

        foreach ($container as $measure => $value) {
            $this->addValuePair($container->ctid, $measure, $value);
        }
    }
}