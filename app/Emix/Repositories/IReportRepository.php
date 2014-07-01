<?php namespace Emix\Repositories;


use Emix\Commands\ICommand;
use Emix\Node;

interface IReportRepository
{
    public function newInstance(array $attributes = []);

    public function getLatestByNodeAndCommand(Node $node, ICommand $cmd);

} 