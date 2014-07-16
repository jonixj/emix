<?php namespace Emix\Eventing;

use Illuminate\Log\Writer;


/**
 * Class EventListener
 * @package Emix\Listeners
 */
class EventListener
{
    /**
     * @var \Illuminate\Log\Writer
     */
    protected $log;

    /**
     * @param Writer $log
     */
    function __construct(Writer $log)
    {
        $this->log = $log;
    }

    /**
     * @param $event
     * @return mixed
     */
    public function handle($event)
    {
        $eventName = $this->getEventName($event);

        if ($this->listenerIsRegistered($eventName)) {
            return call_user_func([$this, 'when' . $eventName], $event);
        }

    }

    /**
     * @param $event
     * @return string
     */
    protected function getEventName($event)
    {
        return (new \ReflectionClass($event))->getShortName();
    }

    /**
     * @param String $eventName
     * @return bool
     */
    protected function listenerIsRegistered($eventName)
    {
        $method = "when{$eventName}";

        return method_exists($this, $method);
    }
} 