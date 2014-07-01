<?php namespace Emix\Commands;

use Zend\Json\Json;

class LoadCommand extends Command implements ICommand
{
    protected $json;

    public static function getName()
    {
        return 'LoadCommand';
    }

    public static function getMeasure()
    {
        return 'load';
    }

    public static function getDescription()
    {
        return 'This command returns the current load one the node and its containers';
    }

    protected function getNodeScript()
    {
        return [
            "uptime",
            function ($line) {
                preg_match_all('/[0-9]+.[0-9]+, [0-9]+.[0-9]+, [0-9]+.[0-9]+/', $line, $out);
                if (isset($out[0][0])) {
                } else {
                    preg_match_all('[0-9]+,[0-9]+, [0-9]+,[0-9]+, [0-9]+,[0-9]+/', $line, $out);
                }
                $value = explode(',',$out[0][0]);
                foreach($value as $i => $v){
                    $value[$i] = (float) $v;
                }
                self::$response = $value;
            }
        ];
    }

    protected function getContainerScript()
    {
        $this->json = "";
        return [
            "vzlist --json -o laverage,ctid",
            function ($line) {
                $this->json .= $line;
                $load = Json::decode($this->json);
                self::$response = $load;
            }
        ];
    }

    public function processContainerResponse($containersResponse)
    {
        $ccArray = [];
        foreach ($containersResponse as $cc) {
            $ccArray[$cc->ctid] = $cc->laverage;
        }
        return $ccArray;
    }
}