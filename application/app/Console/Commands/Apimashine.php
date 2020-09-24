<?php

namespace App\Console\Commands;

use App\Libraries\Systeminfo;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class Apimashine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apimashine';

    // Created with :
    // http://patorjk.com/software/taag/#p=display&f=Graffiti&t=Type%20Something%20
    private $myconsolelogo = "
                        █████╗ ██████╗ ██╗      ███╗   ███╗ █████╗ ███████╗██╗  ██╗██╗███╗   ██╗███████╗
                        ██╔══██╗██╔══██╗██║      ████╗ ████║██╔══██╗██╔════╝██║  ██║██║████╗  ██║██╔════╝
                        ███████║██████╔╝██║█████╗██╔████╔██║███████║███████╗███████║██║██╔██╗ ██║█████╗
                        ██╔══██║██╔═══╝ ██║╚════╝██║╚██╔╝██║██╔══██║╚════██║██╔══██║██║██║╚██╗██║██╔══╝
                        ██║  ██║██║     ██║      ██║ ╚═╝ ██║██║  ██║███████║██║  ██║██║██║ ╚████║███████╗
                        ╚═╝  ╚═╝╚═╝     ╚═╝      ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═╝╚═╝  ╚═══╝╚══════╝
                            ┬ ┬┌┬┐┌┬┐┌─┐┌─┐┌┬┐┌─┐─┐ ┬┬┌┬┐┬ ┬┌┬┐┬─┐┌─┐┬ ┬┬  ┌─┐┌┬┐┌┬┐┌─┐ ┌─┐┌─┐┌┬┐
                            ├─┤ │  │ ├─┘└─┐│││├─┤┌┴┬┘│││││ ││││├┬┘│ ││ ││  ├┤  │  │ ├┤  │  │ ││││
                            ┴ ┴ ┴  ┴ ┴  └─┘┴ ┴┴ ┴┴ └─┴┴ ┴└─┘┴ ┴┴└─└─┘└─┘┴─┘└─┘ ┴  ┴ └─┘o└─┘└─┘┴ ┴
                        ";

    protected $description = "";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment($this->myconsolelogo);

        $systemInfo = new Systeminfo();
        $rez = $systemInfo->serverOSInfo();
        $this->comment($rez);
    }
}
