<?php

class ReportsController extends \BaseController
{
    /**
     * @var Emix\Repositories\ReportRepositoryInterface
     */
    protected $report;

    /**
     * @var Emix\Repositories\ReporterRepositoryInterface
     */
    protected $reporter;

    /**
     * @var Emix\Repositories\ServerRepositoryInterface
     */
    protected $server;

    public function __construct(
        Emix\Repositories\ReportRepositoryInterface $report,
        Emix\Repositories\ReportTypeRepositoryInterface $reportType,
        Emix\Reporting\Reporter $reporter,
        Emix\Repositories\ServerRepositoryInterface $server
    ) {
        $this->report = $report;
        $this->reportType = $reportType;
        $this->reporter = $reporter;
        $this->server = $server;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $reports = $this->report->getAll();
        $reportTypes = $this->reportType->getAll();

        $data = ['reports' => $reports, 'reportTypes' => $reportTypes];

        return View::make('reports.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $reportType = $this->reportType->find(3);

        foreach ($this->server->getAll() as $server) {
            $report = $this->reporter->apply($reportType)->onServer($server)->report();
            $report->save();
        }

        return "The reports have been created";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $reportType = App::make('Emix\ReportType')->find($id);

        $reports = $this->report->getByType($reportType);

        return View::make('reports.show')->with('reports', $reports);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}