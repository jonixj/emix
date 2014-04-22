<?php

class HomeController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function __construct()
    {
    }

    /*
        public function report()
        {
            $server = new Server($id);
            $reporter = new SSHReporter();
            $report = new StatusReport($server, $reporter);
            $report->make();
        }
    */

    /**
     * This code will be moved to the SSH reporter
     */
    public function runSSH()
    {
        $commands = [
            "load" => "uptime | grep -o '[0-9]\+\.[0-9]\+*'",
            "uptime" => 'cat /proc/uptime | awk \'{ print $1}\'',
            "totalMem" => "free -m | grep Mem:",
            "swap" => "free -m | grep Swap:",
            // blir knas om output är tomt "storage-vz" => "df -h | grep /vz"
            "cpu" => "cat /proc/cpuinfo | grep 'model name' | cut -d: -f2 | head -n 1",

        ];
        $outputs = [];
        SSH::run(
            array_values($commands),
            function ($line) use (&$outputs) {
                $outputs[] = $line;
            }
        );

        $i = 0;
        $result = [];
        foreach ($commands as $key => $command) {
            $result[$key] = $outputs[$i];
            $i++;
        }
        dd($result);
    }

    public function showWelcome()
    {
        return View::make('welcome');
    }

}