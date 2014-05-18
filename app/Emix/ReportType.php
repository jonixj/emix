<?php namespace Emix;

use Jenssegers\Mongodb\Model as Eloquent;

class ReportType extends Eloquent implements ReportTypeInterface
{
    protected $collection = 'reporttypes';

    public function reports()
    {
        return $this->hasMany('Emix\Report');
    }

    public function getConfigFileName()
    {
        return $this->_id . ".php";
    }

    function __toString()
    {
        return $this->_id;
    }
}