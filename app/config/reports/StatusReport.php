<?php

return [

    /*
     * The pretty GUI name of this report type
     */
    'title' => 'Server Status Report',
    /*
     * The entity name of this report
     */
    'name' => 'status_report',
    /*
     * The autor of this report type
     */
    'creator' => 'Johan Jönsson',
    /*
     * The data content of this report
     */
    'content' => [

        'uptime' => [
            'type' => 'number',
            'title' => 'Server Uptime',
            'script' => function ($gateway) {
                    $cmd = 'cat /proc/uptime | awk \'{ print $1}\'';

                    return (float)$gateway->run($cmd);
                },
            'notice_level' => 23552,
            'alert_level' => 235525,
        ],
        'user' => [
            'type' => 'string',
            'title' => 'Server Uptime',
            'script' => function ($gateway) {
                    $cmd = 'whoami';
                    return trim($gateway->run($cmd));
                },
        ],
        'current_dir' => [
            'title' => 'Server Uptime',
            'type' => 'string',
            'script' => function ($gate) {
                    return $gate->run('pwd');
                },
        ],
    ],
    /**
     * fields and labels to show in the summary list
     */
    'display' => [
        'uptime',
       // 'server_load',
        'current_dir',
        'created_at',
    ],
];