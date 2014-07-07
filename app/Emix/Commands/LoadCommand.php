<?php namespace Emix\Commands;

use Emix\NodeResponse;
use Emix\ContainerResponse;

class LoadCommand extends Command implements ICommand
{
    /**
     * The name of the command
     *
     * @return string
     */
    public static function getName()
    {
        return 'LoadCommand';
    }

    /**
     * The name of the measure given by this command
     *
     * @return string
     */
    public static function getMeasure()
    {
        return 'load';
    }

    /**
     * A description of this command
     *
     * @return string
     */
    public static function getDescription()
    {
        return 'This command returns the current load one the node and its containers';
    }

    /**
     * @return array
     */
    public function getNodeScript()
    {
        return [
            "uptime",
            function ($line) {

                $load = $this->parseNodeOutputAsFloatArray($line);

                $response = new NodeResponse($this, ['load' => $load]);

                $this->raise(new NodeScriptWasExecuted($this->node, $response));
            }
        ];
    }

    /**
     * Returns an array containing the bash command to run on the server and
     * a callback function responsible for parsing and event creation
     *
     * @return array
     */
    public function getContainerScript()
    {
        return [
            "vzlist --json -a -o laverage,ctid",
            function ($line) {
                //FIXME
                $line = str_replace('laverage','load', $line);

                $response = (new ContainerResponse($this))->fromVzJson($line);

                $this->raise(new ContainerScriptWasExecuted($this->node, $response));
            }
        ];
    }

    /**
     * Parses the output string from the server and returns a nice float array
     *
     * @param $line
     * @return array
     */
    protected function parseNodeOutputAsFloatArray($line)
    {
        preg_match_all('/[0-9][.,]+[0-9]+, [0-9]+[.,][0-9]+, [0-9]+[.,][0-9]+/', $line, $out);

        $loadArray = explode(',', $out[0][0]);
        array_map('floatval', $loadArray);

        return $loadArray;
    }
}