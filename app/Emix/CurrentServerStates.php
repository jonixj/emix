<?php namespace Emix;


use Illuminate\Session\Store;

class CurrentServerStates
{

    protected $serverStates;
    protected $session;

    function __construct(Store $session, $serverStates = [])
    {
        $this->session = $session;
        $this->session->put('CurrentServerStates', []);
        $this->serverStates = $serverStates;
    }

    public function get()
    {
        return $this->session->get(CurrentServerStates);
    }


}


