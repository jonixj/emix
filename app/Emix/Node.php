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
 * @property \Emix\Report $report
 */
class Node extends Eloquent
{
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    function __construct()
    {
        Json::$useBuiltinEncoderDecoder = true;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function containers()
    {
        return $this->hasMany('Emix\Container');
    }

    public function reports()
    {
        return $this->hasMany('Emix\Report');
    }

    public function getReports()
    {
        return $this->reports();
    }

    public function getContainers()
    {
        return $this->containers();
    }

    public function populateContainers(NodeGateway $gateway)
    {
        $this->json = null;

        $gateway->setNode($this)->run(
            'vzlist --json',
            function ($line) {
                $this->json .= $line;
            }
        );

        $ccArray = Json::decode($this->json);

        foreach ($ccArray as $cc) {
            // Must be fixed
            if ($this->containers()->where('ctid', $cc->ctid)->exists()) {
                $container = $this->containers()->where('ctid', $cc->ctid)->get()->first();
            } else {
                $container = new Container();
            }
            $container->ctid = $cc->ctid;
            $container->host = $cc->hostname;
            $container->os = $cc->ostemplate;
            $container->status = $cc->status;
            $container->save();
            $this->containers()->save($container);
            // end must be fixed
        }
    }

    public function getLatestReportByCommandName($name)
    {
        return $this->reports()->where('command', $name)->orderBy('created_at','desc')->first();
    }
} 