<?php namespace Emix\Gateways;

use Emix\Gateways\ServerGatewayInterface;
use Net_SSH2;

class SSHServerGateway implements ServerGatewayInterface
{

    /**
     * The SecLib connection instance.
     *
     * @var \Net_SSH2
     */
    protected $ssh;
    protected $user;
    protected $pass;
    protected $host;
    protected $port;
    protected $server;

    /**
     * Gets the current ssh connection or creates a new one
     * @return Net_SSH2
     */
    public function getConnection()
    {
        if ($this->ssh) {
            return $this->ssh;
        }

        if (! $this->host ) {
            throw new \InvalidArgumentException('Login credentials must be set.');
        }

        return $this->ssh = new Net_SSH2($this->host, $this->port);
    }

    /**
     * Fetch connection settings from a Emix\server object
     * @param $server
     * @return $this
     */
    public function setServer($server)
    {
        $this->user = $server->getUsername();
        $this->pass = $server->getPassword();
        $this->host = $server->getHost();
        $this->port = $server->getPort();
        $this->server = $server;

        return $this;
    }

    /**
     * Connect to the SSH server.
     *
     * @param  string $username
     * @return bool
     */
    public function login($server)
    {
        if (!$this->server) {
            $this->setServer($server);
        }
        //$key = new \Crypt_RSA;
        //$key->setPassword('');

        //$key->loadKey(file_get_contents('../sshkey/id_rsa.pub'));

        $this->getConnection()->login($this->user, $this->pass);
    }

    /**
     * Executes a command and return the result
     * @param $cmd
     * @param $callback
     * @return String
     */
    public function run($cmd, $callback = null)
    {
        return $this->getConnection()->exec($cmd, $callback);
    }
}