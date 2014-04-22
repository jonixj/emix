<?php namespace Emix\Reporting\Presenters;

use DateTime;
use DateInterval;

/**
 * Class Report
 * @package Emix\Reporting\Presenters
 */
class Report extends Presenter
{
    /**
     * @var
     */
    protected static $conf;

    /**
     * @param $entity
     */
    function __construct($entity)
    {
        parent::__construct($entity);

        static::$conf = require app('path') . "/config/reports/{$this->reportType->name}.php";
    }

    /**
     * @return string
     */
    function tableHeadRow()
    {
        $html = "<th>server</th>";
        foreach (static::$conf['display'] as $val) {
            $html .= "<th>{$val}</th>";
        }

        return $html;
    }

    /**
     * @param $reportFields
     * @return string
     */
    function tableRow($reportFields = false)
    {
        $html = "";
        if (!$reportFields) {
            $reportFields = static::$conf['display'];
            $html .= "<td>{$this->entity->server->name}</td>";
        }

        foreach ($reportFields as $field) {
            $html .= "<td>{$this->{$field}}</td>";
        }
        return $html;
    }

    /**
     * @return mixed
     */
    function created_at()
    {
        return $this->entity->created_at->diffForHumans();
    }

    /**
     * @return string
     */
    public function uptime()
    {
        $format = $this->getUptimeAsInterval()->d > 0 ? '%dd %H:%I:%S' : '%H:%I:%S';

        return $this->getUptimeAsInterval()->format($format);
    }

    /**
     * @return mixed
     */
    public function getUptimeAsInterval()
    {
        $started = (new DateTime)->sub(new DateInterval('PT' . intval($this->entity->uptime) . 'S'));

        return $started->diff((new DateTime()));
    }
} 