<?php namespace Emix;

use \Eloquent;

class ReportType extends Eloquent
{

    public function reports()
    {
        return $this->hasMany('Emix\Report');
    }

} 