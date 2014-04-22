<?php

return [

    /*
     * The pretty GUI name of this report type
     */
    'title' => 'VPS Load Report',

    /*
     * The entity name of this report
     */
    'name' => 'VPSLoad',

    /*
     * The autor of this report type
     */
    'creator' => 'Emil Jönsson',

    /*
     * The data content of this report
     */
    'content' => [

        'uptime' => [
            'title' => 'Uptime',
            'type' => 'string',
            'script' => function ($gate) {
                    $cmd = 'cat /proc/uptime | awk \'{ print $1}\'';
                    return $gate->run($cmd);
                },
        ],
    ],

    /**
     * fields and labels to show in the summary list
     */
    'display' => [
        'uptime',
    ],
];