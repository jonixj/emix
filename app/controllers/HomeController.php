<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    protected $node;

    function __construct(Emix\Node $node)
    {
        $this->node = $node;
    }

    public function index()
	{
        $this->node->hejsan = "Hello world";
        $this->node->save();
        echo 'Titta: ' . $this->node->hejsan;
	}

}
