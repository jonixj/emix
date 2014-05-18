<?php

class ServersController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $reportType = 'StatusReport';
        $reportFields = Emix\Report::config($reportType, 'display');

        $servers = App::make('Emix\Repositories\ServerRepositoryInterface')->getAll();

        return View::make('servers')->with(['servers' => $servers, 'reportFields' => $reportFields, 'reportType' => $reportType]);
    }
}