<?php namespace Emix\Reporting\Presenters;

use Emix\Reporting\Presenters\Exceptions\PresenterException;

/**
 * Class PresentableTrait
 * @package Emix\Reporting\Presenters
 */
trait PresentableTrait
{
    /**
     * @var
     */
    protected static $instance;

    /**
     * @return mixed
     * @throws Exceptions\PresenterException
     */
    public function present()
    {
        if (!$this->presenter || !class_exists($this->presenter)) {
            throw new PresenterException('A protected $presenter must be set to a valid presenter class');
        }

        if (!isset(static::$instance)) {
            static::$instance = new $this->presenter($this);
        }

        static::$instance->setEntity($this);

        return static::$instance;
    }

    /**
     * @param $type
     * @param bool $fields
     * @return mixed
     */
    public static function config($type, $fields = false)
    {
        $conf = require app('path') . '/config/reports/' . $type . '.php';

        if ($fields) {
            return $conf[$fields];
        }

        return $conf;
    }

    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        if (is_null(parent::__get($name))) {
            //dd("magic");
            return "N/A";
        }

        return parent::__get($name);
    }

} 