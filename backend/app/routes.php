<?php

Route::resource('nodes', 'NodesController');
Route::resource('commands', 'CommandsController');
Route::resource('states', 'ServerStatesController');

App::bind(
    'Emix\Repositories\INodeRepository',
    'Emix\Repositories\MongoNodeRepository'
);
App::bind(
    'Emix\Repositories\IReportRepository',
    'Emix\Repositories\MongoReportRepository'
);

Route::get(
    '/',
    function () {
        return 'This is the backend of eMix';
    }
);
Route::get('commands/execute/{command}', 'CommandsController@execute');
