<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 06/07/14
 * Time: 22:50
 */

namespace Emix;


interface IServer {

    public function getHost();

    public function getPort();
}