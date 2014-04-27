<?php namespace Emix;

use Jenssegers\Mongodb\Model as Eloquent;
use Emix\Reporting\Presenters\PresentableTrait;
use Emix\ReportInterface;

class Report extends Eloquent implements ReportInterface
{

    use PresentableTrait;

    protected $presenter = 'Emix\Reporting\Presenters\Report';

    public function server()
    {
        return $this->belongsTo('Emix\Server');
    }

    public function reportType()
    {
        return $this->belongsTo('Emix\ReportType');
    }

    public function setReportType($reportType)
    {
        $this->reportType()->associate($reportType);
    }

    public function getServer()
    {
        return $this->server();
    }

    public function getContentAttribute($value)
    {
        return json_decode($value);
    }

    public function setServer($server)
    {
        $this->server()->associate($server);
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
