<?php namespace Emix;

use Emix\Gateway\NodeGateway;
use \Jenssegers\Mongodb\Model as Eloquent;
use Zend\Json\Json;

/**
 * Class Node
 * @package Emix
 * @property string $name
 * @property string $host
 * @property string $port
 * @property string $username
 * @property string $password
 * @property string $key
 * @property string $keyphrase
 * @property string $root
 * @property array $ip
 * @propery ServerState $serverState
 * @property \Emix\Report $report
 */
class Node extends Eloquent implements IServer
{
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function containers()
    {
        return $this->hasMany('Emix\Container');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getReports()
    {
        return $this->reports();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getContainers()
    {
        return $this->containers();
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
     * @param $containersArray
     */
    public function syncContainersFromArray($containersArray)
    {
        foreach ($containersArray as $ct) {

            $container = $this->findOrMakeContainer($ct);

            $container->saveWithParams(
                [
                    'ctid' => $ct->ctid,
                    'ip' => $ct->ip,
                    'host' => $ct->hostname,
                    'os' => $ct->ostemplate,
                    'status' => $ct->status,
                ]
            );

            $this->containers()->save($container);
        }
    }

    /**
     * @param $ctid
     * @return mixed
     */
    public function getContainerByCtid($ctid)
    {
        return $this->containers()->where('ctid', $ctid)->first();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getLatestReportByCommandName($name)
    {
        return $this->reports()->where('measure', $name)->orderBy('created_at', 'desc')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasOne
     */
    protected function getOrCreateServerState()
    {
        return (is_null($this->serverState)) ? (new ServerState)->setNode($this) : $this->serverState;
    }

    /**
     * @param $ct
     * @return Container
     */
    protected function findOrMakeContainer($ct)
    {
        if ($this->containers()->where('ctid', $ct->ctid)->exists()) {
            return $this->containers()->where('ctid', $ct->ctid)->get()->first();
        } else {
            return new Container();
        }
    }
} 
