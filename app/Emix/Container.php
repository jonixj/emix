<?php namespace Emix;

use Jenssegers\Mongodb\Model as Eloquent;

/**
 * Class Container
 * @package Emix
 */
class Container extends Eloquent implements IServer
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Node()
    {
        return $this->belongsTo('Emix\Node');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany('Emix\Report');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function serverState()
    {
        return $this->hasOne('Emix\ServerState');
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param Measure $measure
     */
    public function addMeasure(Measure $measure)
    {
        $this->getOrCreateServerState()->addMeasure($measure)->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasOne
     */
    protected function getOrCreateServerState()
    {
        return (is_null($this->serverState)) ? (new ServerState)->setContainer($this) : $this->serverState;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getLatestReportByCommandName($name)
    {
        return $this->reports()
            ->where('measure', $name)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * @param $params
     */
    public function saveWithParams($params)
    {
        foreach ($params as $param => $val) {
            $this->$param = $val;
        }
        $this->save();
    }

}