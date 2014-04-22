<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 07/04/14
 * Time: 15:15
 */

namespace Emix\Reporting;


class Report {

    protected $fields;

    function __construct()
    {
        // TODO: Implement __construct() method.
    }

    public function setField($fieldName, $dataType, $value) {
        $fields = ['hej' => function(){return 'hej';}];

    }


}



return [
  'cpu' => [
      'title' => 'CPU Usage',
      'type' => 'number',
      'value' => function($gateway) {
              $cmd = 'whoami';
              return $gateway->run($cmd);
          },
  ],
];