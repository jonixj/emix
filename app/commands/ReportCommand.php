<?php

use Indatus\Dispatcher\Scheduling\Schedulable;

class ReportCommand extends \Indatus\Dispatcher\Scheduling\ScheduledCommand
{

    protected $controller;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'reports:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all registered commands on all nodes';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        $this->controller = app('ReportsController');
        parent::__construct();
    }

    public function getName()
    {
        return $this->name;
    }


    /**
     * When a command should run
     *
     * @param Schedulable $scheduler
     * @return mixed
     */
    public function schedule(Schedulable $scheduler)
    {
        return $scheduler->everyMinutes(1);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->controller->create();
    }

}
