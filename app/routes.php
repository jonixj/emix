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

use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\ListRenderer;

Route::get(
    '/',
    function () {
        /*
        $factory = new MenuFactory();
        $menu = $factory->createItem('My menu');
        $menu->setChildrenAttributes(['class' => 'nav navbar-nav']);
        $menu->addChild('Home')->setUri('/')->addChild('Summer house');
        $menu->addChild('Servers', array('uri' => '/servers'));

        $types = App::make('Emix\Repositories\ReportTypeRepositoryInterface');
        $reportMenu = $menu->addChild('Reports', array('uri' => '/reports'));
        foreach($types->getAll() as $reportType){
            $reportMenu->addChild($reportType);
        }

        $menu->addChild('Admin', array('uri' => '/admin'));

        $renderer = new ListRenderer(new \Knp\Menu\Matcher\Matcher());
         dd($renderer->render($menu));
        */
	//$users = DB::collection('reports')->get();
	//dd($users);
        return View::make('welcome');
}
);//->before('auth');

Route::resource('servers', 'ServersController');
Route::get('reports/create/{type}', 'ReportsController@create');
Route::resource('sessions', 'SessionsController');
Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);

Route::resource('reports', 'ReportsController');

App::bind(
    'Emix\Repositories\ReportRepositoryInterface',
    'Emix\Repositories\ElqntReportRepository'
);

App::bind(
    'Emix\ReportInterface',
    'Emix\Report'
);

App::bind(
    'Emix\Repositories\ServerRepositoryInterface',
    'Emix\Repositories\ElqntServerRepository'
);

App::bind(
    'Emix\Gateways\ServerGatewayInterface',
    'Emix\Gateways\SSHServerGateway'
);

App::bind(
    'Emix\Repositories\ReportTypeRepositoryInterface',
    'Emix\Repositories\ElqntReportTypeRepository'
);
