<?php

/**
 * Created by PhpStorm.
 * User: johan
 * Date: 10/07/14
 * Time: 16:42
 */
class CtResponseTest extends TestCase
{
    protected $className = 'Emix\CtResponse';

    public function testCtidWasRemoved()
    {
        $before = [
            'ctid' => 123,
            'uptime' => 1234.43,
            'load' => [0.34, 0.5, 1]
        ];

        $after = [
            'uptime' => 1234.43,
            'load' => [0.34, 0.5, 1]
        ];

        Emix\CtResponse::parseContainerData($before);

        $this->assertEquals($before, $after);
    }

    public function testCreateFromArray()
    {
        $data = [
            'ctid' => 123,
            'uptime' => 1234.43,
            'load' => [0.34, 0.5, 1]
        ];

        $method = self::getPrivateMethod($this->className,'createFromArray');

        $returnedObject = $method->invokeArgs(null,[$data]);

        $this->assertEquals($data,$returnedObject->getResponse());
    }
}