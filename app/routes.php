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

App::bind(
    'Emix\Repositories\IReportRepository',
    'Emix\Repositories\EloquentReportRepository'
);


Route::get('/', function()
    {
        return "Tjena!";
    });
