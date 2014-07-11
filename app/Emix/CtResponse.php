<?php namespace Emix;

use DateTime;

/**
 * Class CtResponse
 * @package Emix
 */
class CtResponse
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

    /**
     * @param $json
     * @return array
     */
    public static function createManyFromVzJson($json)
    {
        $containersData = Json::decode($json);

        $responses = [];
        foreach ($containersData as $containerData) {
            $responses[] = self::createFromArray($containerData);
        }

        return $responses;
    }

    /**
     * @param $containerData
     * @return ContainerResponse
     */
    protected static function createFromArray($containerData)
    {
        return new CtResponse($containerData);
    }

    /**
     * @param $array
     */
    public static function parseContainerData(&$array)
    {
        // We do not want to save the ctid information - use it as key instead
        unset($array['ctid']);
    }

}