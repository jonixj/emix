<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use \Emix\Repositories\MongoNodeRepository;
use Emix\Gateway\NodeGateway;

class NodesCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'nodes:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches and updates all containers on a node';

    /**
     * @var Emix\Repositories\MongoNodeRepository
     */
    protected $nodeRepository;


    /**
     * Returns a new instance
     *
     */
    public function __construct(MongoNodeRepository $nodeRepository)
    {
        $this->nodeRepository = $nodeRepository;
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

        $node = $this->findOrExit($nodeId);

        $this->comment("Starts fetching container information from {$node->name} ...");

        $gate = new NodeGateway($this->nodeRepository);

        $node->populateContainers($gate);

        $this->info("Done fetching container information from {$node->name} ...");
    }

    protected function findOrExit($nodeId)
    {
        $this->comment("Looking for node with id {$nodeId} ...");

        if (!is_string($nodeId)) {
            $this->error("Invalid node id: {$nodeId}");
            return;
        }

        if ($node = $this->nodeRepository->find($nodeId)) {
            $this->info("Node with name {$node->name} found");
        } else {
            $this->error("Node with id {$nodeId} could not be found");
            exit();
        };
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('node', InputArgument::REQUIRED, 'The id of the node to update'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}