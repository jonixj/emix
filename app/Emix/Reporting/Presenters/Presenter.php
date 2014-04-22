<?php namespace Emix\Reporting\Presenters;


/**
 * Class Presenter
 * @package Emix\Reporting\Presenters
 */
abstract class Presenter
{

    /**
     * @var
     */
    protected $entity;

    /**
     * @param $entity
     */
    function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        if (method_exists($this, $name)) {
            return $this->{$name}();
        }
        return $this->entity->{$name};
    }

    /**
     * @param $entity
     */
    function setEntity($entity)
    {
        $this->entity = $entity;

        static::$conf = require app('path') . "/config/reports/{$this->reportType->name}.php";
    }

}
