<?php namespace Emix;

use Jenssegers\Mongodb\Model as Eloquent;

class Container extends Eloquent
{

    public function Node()
    {
        return $this->belongsTo('Emix\Node');
    }

    public function reports()
    {
        return $this->hasMany('Emix\Report');
    }

}