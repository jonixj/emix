<?php

use \Emix\Commands\CommandFactory;
use \Emix\Repositories\INodeRepository;
use \Emix\Reporter;
use \Emix\Repositories\MongoReportRepository;
use \Emix\Commanding\CommandBus;

class ReportsController extends \BaseController
{

    protected $nodeRepository;
    protected $gateway;
    protected $reportRepository;
    protected $commandBus;

    function __construct(
        CommandFactory $cmdFactory,
        INodeRepository $nodeRepository,
        Reporter $reporter,
        MongoReportRepository $reportRepository,
        CommandBus $commandBus
    ) {
        $this->cmdFactory = $cmdFactory;
        $this->nodeRepository = $nodeRepository;
        $this->reporter = $reporter;
        $this->reportRepository = $reportRepository;
        $this->commandBus = $commandBus;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->reportRepository->all();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        foreach ($this->nodeRepository->all() as $node) {
            foreach ($this->cmdFactory->getAvailableCommands() as $cmd) {
                $this->reporter->with($node)->storeAndExec($cmd);
            }
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        var_dump('Stored!');
    }


    public function show($commandName)
    {
        foreach ($this->nodeRepository->all() as $node) {
            $command = CommandFactory::get($commandName, $node);

            $this->commandBus->execute($command);
        }
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
