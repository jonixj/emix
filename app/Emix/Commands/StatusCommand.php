<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 06/07/14
 * Time: 12:17
 */

namespace Emix\Commands;


/**
 * Class StatusCommand
 * @package Emix\Commands
 */
class StatusCommand extends Command implements ICommand
{

    /**
     * @param $containersResponse
     */
    public function processContainerResponse($containersResponse)
    {
        // TODO: Implement processContainerResponse() method.
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return 'StatusCommand';
    }

    /**
     * @return string
     */
    public static function getDescription()
    {
        return 'This is a macro command that summarize server status commands';
    }


    /**
     * Override Command
     * @return mixed
     */
    public function executeNode()
    {
        foreach($this->commands as $cmd){

        }
    }

    /**
     * Override Command
     */
    public function executeContainers()
    {
        $this->gateway->run(
            $this->getContainerScript()[0],
            $this->getContainerScript()[1]
        );
        $containersResponse = self::$response;

        return $this->processContainerResponse($containersResponse);
    }

    /**
     *
     */
    public function getNodeScript()
    {
        // TODO: Implement getNodeScript() method.
    }

    /**
     *
     */
    public function getContainerScript()
    {
        // TODO: Implement getContainerScript() method.
    }

    /**
     *
     */
    public static function getMeasure()
    {
        // TODO: Implement getMeasure() method.
    }

} 