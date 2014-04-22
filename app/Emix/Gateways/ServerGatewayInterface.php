<?php namespace Emix\Gateways;

interface ServerGatewayInterface
{
    public function getConnection();

    public function login($server);

    public function run($cmd, $callback = null);
}