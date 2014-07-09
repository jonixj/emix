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
class Node extends Eloquent implements IServer
{
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Used for container population
     *
     * @var mixed
     */
    private $json;

    /**
     *
     */
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getServerState()
    {
        return $this->serverState()->first();
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

    public function addMeasure(Measure $measure)
    {
        $state = is_null($this->getServerState()) ? new ServerState : $this->getServerState()->first();

        $state->addMeasure($measure)->setNode($this)->save();
    }

    /**
     * @param NodeGateway $gateway
     */
    public function populateContainers(NodeGateway $gateway)
    {
        //FIXME this method needs a total remake (extract to own class?)
        $this->json = null;

        $gateway->setNode($this)->run(
            'vzlist --json -a -o ctid,hostname,ostemplate,status,ip',
            function ($line) {
                $this->json .= $line;
            }
        );
        $this->json = explode('[', $this->json);

        $this->json = '[' . $this->json[1] . ']';

        $ccArray = Json::decode($this->json);

        foreach ($ccArray as $cc) {
            // Must be fixed
            if ($this->containers()->where('ctid', $cc->ctid)->exists()) {
                $container = $this->containers()->where('ctid', $cc->ctid)->get()->first();
            } else {
                $container = new Container();
            }
            $container->ip = $cc->ip;
            $container->ctid = $cc->ctid;
            $container->host = $cc->hostname;
            $container->os = $cc->ostemplate;
            $container->status = $cc->status;
            $container->save();
            $this->containers()->save($container);
            // end must be fixed
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
} 
