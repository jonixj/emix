<?php

return [

    /*
     * The pretty GUI name of this report type
     */
    'title' => 'Test Status Report',
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
            'alert_limit' => 1562656,
            'script' => function ($gateway) {
                    $cmd = 'cat /proc/uptime | awk \'{ print $1}\'';

                    return (float) $gateway->run($cmd);
                },
        ],
    ],
    /**
     * fields and labels to show in the summary list
     */
    'display' => [
        'uptime',
        'user',
        'current_dir',
        'created_at',
    ],
];