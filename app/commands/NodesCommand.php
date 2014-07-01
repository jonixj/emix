<?php

use Illuminate\Console\Command;

use \Emix\Repositories\EloquentNodeRepository;

/**
 * Class NodesCommand
 */
class NodesCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'command:populatenodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches and updates all containers on a node';

    /**
     * @var Emix\Repositories\EloquentNodeRepository
     */
    protected $nodeRepository;


    /**
     * Returns a new instance
     *
     */
    public function __construct()
    {
        $this->nodeRepository = new EloquentNodeRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $nodeId = $this->argument("node");

        if (!is_string($nodeId)) {
            $this->error("Invalid node id: {$nodeId}");
            return;
        }

        $this->comment("Looking for node with id {$nodeId} ...");

        if ($node = $this->nodeRepository->find($nodeId)) {
            $this->info("Node with name {$node->name} found");
        } else {
            $this->error("Node with id {$nodeId} could not be found");
        };

        $this->comment("Starts fetching container information from {$node->name} ...");

        $gate = new Emix\Gateway\NodeGateway($this->nodeRepository);

        $node->populateContainers($gate);

        $this->info("Done fetching container information from {$node->name} ...");
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return true;
    }
}
