<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 07/07/14
 * Time: 01:15
 */

namespace Emix\Commands;


class ContainerScriptWasExecuted {

    public $node;
    public $response;

    function __construct($node, $response)
    {
        $this->node = $node;
        $this->response = $response;
    }

}