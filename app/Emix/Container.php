<?php namespace Emix;

use Jenssegers\Mongodb\Model as Eloquent;

class Container extends Eloquent implements IServer
{

    public function Node()
    {
        return $this->belongsTo('Emix\Node');
    }

    public function reports()
    {
        return $this->hasMany('Emix\Report');
    }

    public function getLatestReportByCommandName($name)
    {
        return $this->reports()
            ->where('measure', $name)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function saveWithParams($params)
    {
        foreach ($params as $param => $val) {
            $this->$param = $val;
        }
        $this->save();
    }

}