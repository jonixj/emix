<?php namespace Emix\Repositories;

use Emix\Commands\ICommand;
use Emix\Node;
use Emix\NodeResponse;
use Emix\ContainerResponse;

/**
 * Interface IReportRepository
 * @package Emix\Repositories
 */
interface IReportRepository
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param array $attributes
     * @return mixed
     */
    public function newInstance(array $attributes = []);

    /**
     * @param Node $node
     * @param ICommand $cmd
     * @return mixed
     */
    public function getLatestByNodeAndCommand(Node $node, ICommand $cmd);

    /**
     * @param Node $node
     * @param NodeResponse $response
     * @return mixed
     */
    public function createFromNodeResponse(Node $node, NodeResponse $response);

    /**
     * @param Node $node
     * @param ContainerResponse $response
     * @return mixed
     */
    public function createFromContainerResponse(Node $node, ContainerResponse $response);

} 