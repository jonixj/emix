<?php

/**
 * Servers model config
 */

return array(

    'title' => 'Reports',

    'single' => 'report',

    'model' => 'Emix\Report',

    /**
     * The display columns
     */
    'columns' => array(
        'id',
        'server_name' => array(
            'title' => 'Server Name',
            'relationship' => 'getServer',
            'select' => "(:table).name"
        ),
        'uptime' => array(
            'title' => 'Uptime',
            'sort_field' => 'uptime',
            'date_format' => 'yy-mm-dd', //optional, will default to this value
            'time_format' => 'HH:mm',
        ),
        'load' => array(
            'title' => 'Load',
            'sort_field' => 'load'
        ),
        'cpu' => array(
            'title' => 'CPU',
            'sort_field' => 'cpu'
        ),
        'storage' => array(
            'title' => 'Storage',
        ),
        'created_at' => array(
            'title' => 'Date Added',
            'sort_field' => 'created_at',
        ),

    ),

    /**
     * The filter set
     */
    'filters' => array(
        'id',
        'server' => array(
            'title' => 'Server',
            'type' => 'relationship',
            'name_field' => 'name',
            'options_sort_field' => "name",
        )
    ),

    /**
     * The editable fields
     */
    'edit_fields' => array(
        'storage' => [
            'title' => 'Storage',
            'type' => 'number'
        ],
        'cpu' => [
            'title' => 'CPU',
            'type' => 'number',
        ],
        'uptime' => array(
            'type' => 'number',
            'title' => 'Uptime',
            'symbol' => '(s)', //optional, defaults to ''
            'decimals' => 0, //optional, defaults to 0
            'thousands_separator' => ' ', //optional, defaults to ','
            'decimal_separator' => '.', //optional, defaults to '.'
        )
    ),

);