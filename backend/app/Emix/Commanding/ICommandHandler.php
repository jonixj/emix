<?php namespace Emix\Commanding;

use Emix\Commands\ICommand;

interface ICommandHandler {

    /**
     * Handle the command
     *
     * @param $command

     */
    public function handle(ICommand $command);

} 