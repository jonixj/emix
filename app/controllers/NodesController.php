<?php

use Emix\Repositories\INodeRepository;
use \Emix\Gateway\NodeGateway;
class NodesController extends \BaseController
{

    protected $nodeRepository;
    protected $gateway;

    function __construct(INodeRepository $nodeRepository, NodeGateway $gateway)
    {
        $this->nodeRepository = $nodeRepository;
        $this->gateway = $gateway;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        /*
        $nodes = $this->nodeRepository->allWithContainers();

        return View::make('start')->withNodes($nodes);
        */

        return $this->nodeRepository->allWithState();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('nodes/create');
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
        $node = $this->nodeRepository->find($id);
        return $node;
        //return View::make('start')->withNode($node);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $node = $this->nodeRepository->find($id);

        return View::make('nodes.edit')->withNode($node);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $node = $this->nodeRepository->find($id);

        $node->populateContainers($this->gateway);
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
