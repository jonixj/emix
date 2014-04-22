<?php

/**
 * Servers model config
 */

return array(

    'title' => 'Servers',

    'single' => 'server',

    'model' => 'Emix\Server',

    /**
     * The display columns
     */
    'columns' => array(
        'id',
        'name' => array(
            'title' => 'Server Name',
        ),
        'host' => array(
            'title' => 'Host Name',
        ),
        'port' => [
            'title' => 'Port',
        ],
        'username' => [
            'title' => 'User name'
        ],
        'password' => [
            'title' => 'Password',
            'type' => 'password',
        ],
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
        'name' => array(
            'title' => 'Server Name',
        ),
        'host' => array(
            'title' => 'Host Name',
        ),
    ),

    /**
     * The editable fields
     */
    'edit_fields' => array(
        'name' => array(
            'title' => 'Server Name'
        ),
        'host' => array(
            'title' => 'Host Name',
            'type' => 'text',
        ),
        'port' => [
            'title' => 'Port',
        ],
        'username' => [
            'title' => 'User name'
        ],
        'password' => [
            'title' => 'Password',
            'type' => 'password',
        ],
    ),

);