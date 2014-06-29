<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('nodes', 'NodesController');
Route::resource('commands', 'CommandsController');
Route::resource('reports', 'ReportsController');

App::bind(
    'Emix\Repositories\INodeRepository',
    'Emix\Repositories\EloquentNodeRepository'
);

Route::get('/', function()
    {
        preg_match_all('/: ([0-9]+,[0-9]+)/','20:32:38 up 15:13, 2 users, load average: 0,00, 0,02, 0,05 ',$out);
        dd(substr($out[0][0],2));
    });
