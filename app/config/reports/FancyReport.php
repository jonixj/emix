<?php

return [

    /*
     * The pretty GUI name of this report type
     */
    'title' => 'Fancy Report',

    /*
     * The entity name of this report
     */
    'name' => 'FancyReport',

    /*
     * The author of this report type
     */
    'creator' => 'Johan Jönsson',

    /*
     * The data content of this report
     */
    'content' => [

        'local_date' => [
            'title' => 'Local date',
            'type' => 'string',
            'script' => function ($gate) {
                    return $gate->run('date');
                },
        ],
    ],

    /**
     * fields and labels to show in the summary list
     */
    'display' => [
        'local_date',
    ],
];
