<?php namespace Emix;

use DateTime;

/**
 * Class NodeResponse
 * @package Emix
 */
class NodeResponse
{

    /**
     * @var string
     */
    protected $response;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @param string $response
     */
    function __construct($response)
    {
        $this->response = $response;
        $this->created = new DateTime();
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }
}