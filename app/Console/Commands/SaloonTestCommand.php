<?php

namespace App\Console\Commands;

use App\Connector;
use App\Request;
use Illuminate\Console\Command;

class SaloonTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:saloon-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $connector = new Connector;

        // Note: If multiple requests are made, also have a look at the queue worker process' opened file handles,
        //         and you can see that it doesn't close the ones opened by these requests.
        $connector->send(new Request);

        ray()->pause();

        return 0;
    }
}
