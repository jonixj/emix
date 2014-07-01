<?php namespace Emix\Gateway;

use \Emix\Node;
use Emix\Repositories\INodeRepository;
use \Illuminate\Remote\RemoteManager;
use \Illuminate\Remote\Connection;

/**
 * Class NodeGateway
 * @package Emix\Gateway
 */
class NodeGateway extends RemoteManager
{

    /**
     * @var
     */
    protected $config;
    /**
     * @var \Emix\Repositories\INodeRepository
     */
    protected $nodeRepository;
    /**
     * @var bool
     */
    protected $specific = false;

    /**
     * @param INodeRepository $nodeRepository
     */
    function __construct(INodeRepository $nodeRepository)
    {
        $this->nodeRepository = $nodeRepository;
    }

    /**
     * @param Node $node
     * @return $this
     */
    function setNode(Node $node)
    {
        $this->specific = $node->name;

        return $this;
    }

    /**
     * Get a remote connection instance.
     *
     * @param  string|array  $name
     * @return \Illuminate\Remote\ConnectionInterface
     */
    public function connection($name = null)
    {
        if ($this->specific){
            return $this->resolve($this->specific);
        }

        if (is_array($name)) return $this->multiple($name);

        $names = [];
        foreach($this->nodeRepository->all() as $node){
            $names[] = $node->name;
        }
        return $this->multiple($names);
    }

    /**
     * @param string $name
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getConfig($name)
    {
        $node = $this->nodeRepository->findByName($name);

        $config = [
            'host' => $node->host,
            'username' => $node->username,
            'password' => $node->password,
            'key' => $node->key,
            'keyphrase' => $node->keyphrase,
            'root' => $node->root,
            'port' => $node->port,
        ];

        if (!is_null($config)) {
            return $config;
        }

        throw new \InvalidArgumentException("Remote connection not defined.");
    }

    /**
     * Make a new connection instance.
     *
     * @param  string  $name
     * @param  array   $config
     * @return \Illuminate\Remote\Connection
     */
    protected function makeConnection($name, array $config)
    {
        $this->setOutput($connection = new Connection(

                $name, $config['host'] . ':' .$config['port'], $config['username'], $this->getAuth($config)

            ));

        return $connection;
    }
}