<?php namespace Emix\Listeners;

use Emix\Events\ContainersWereFetched;
use Emix\Eventing\EventListener;
use Emix\Repositories\INodeRepository;
use Illuminate\Log\Writer;
use Zend\Json\Json;

/**
 * Class ActionListener
 * @package Emix\Listeners
 */
class ActionListener extends EventListener
{
    /**
     * @var \Illuminate\Log\Writer
     */
    protected $log;

    /**
     * @var \Emix\Repositories\INodeRepository
     */
    protected $nodeRepository;

    /**
     * @param Writer $log
     * @param INodeRepository $nodeRepository
     */
    function __construct(Writer $log, INodeRepository $nodeRepository)
    {
        $this->log = $log;
        $this->nodeRepository = $nodeRepository;

        Json::$useBuiltinEncoderDecoder = true;
    }


    /**
     * @param ContainersWereFetched $event
     */
    public function whenContainersWereFetched(ContainersWereFetched $event)
    {
        var_dump('We found some containers!');

        $nodeResponse = $event->getNodeResponse();

        $node = $event->getNode();

        $containers = Json::decode($nodeResponse->getResponse());

        $node->syncContainersFromArray($containers);
    }

} 