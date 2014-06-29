<?php

use \Emix\Commands\CommandFactory;
use \Emix\Repositories\INodeRepository;
use Emix\Reporter;

class ReportsController extends \BaseController
{

    protected $nodeRepository;
    protected $gateway;
    protected $reportRepository;

    function __construct(CommandFactory $cmdFactory, INodeRepository $nodeRepository, Reporter $reporter, \Emix\Repositories\EloquentReportRepository $reportRepository)
    {
        $this->cmdFactory = $cmdFactory;
        $this->nodeRepository = $nodeRepository;
        $this->reporter = $reporter;
        $this->reportRepository = $reportRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        foreach($this->nodeRepository->all() as $node){
            foreach ($this->cmdFactory->getAvailableCommands() as $cmd)
                $this->reporter->with($node)->storeAndExec($cmd);
        }
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
     * @param  String $command
     * @return Response
     */
    public function show($command)
    {
        $report = $this->reportRepository->getLatestByNodeAndCommand(
            $this->nodeRepository->findByName('PHP virtual server'),
            $this->cmdFactory->getCommand($command)
        );

        return $report;
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
