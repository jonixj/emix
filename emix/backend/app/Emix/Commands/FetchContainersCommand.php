<?php namespace Emix\Commands;

use Emix\Events\ContainersWereFetched;
use Emix\NodeResponse;

class FetchContainersCommand extends Command implements ICommand
{
    public function getType()
    {
        return 'action';
    }

    public static function getName()
    {
        return 'FetchContainers';
    }

    public static function getDescription()
    {
        return 'This command gets a list with containers for a specific node';
    }

    public function getNodeScript()
    {
        return [
            'vzlist --json -a -o ctid,hostname,ostemplate,status,ip',
            function ($response) {
                $this->respondToNode($response);
            }
        ];
    }

    /**
     * @param string $response
     */
    public function respondToNode($response)
    {
        $response = new NodeResponse($response);

        $this->raise(new ContainersWereFetched($this->node, $response));
    }

    public function getContainerScript()
    {
        return false;
    }

    public static function getMeasure()
    {
        // TODO: Implement getMeasure() method.
    }

} 