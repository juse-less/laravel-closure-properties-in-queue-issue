<?php

namespace App\Console\Commands;

use App\Connector;
use App\Request;
use GuzzleHttp\Promise\Utils;
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
        // Note: Because the process terminates after the jobs, the classes are destructed.
        //       Meaning, also the open file handles are closed.

        // Note: Also have a look at the queue worker process' opened file handles,
        //         and you can see that it doesn't close the ones opened by these requests.

        // Note: Using Async it gets even worse.

        for ($jobs = 0; $jobs < 5; $jobs++) {
            $this->testSync();
            //$this->testAsync();

            ray('End of job');
            ray()->pause();
        }

        ray('End of command');
        ray()->pause();

        return 0;
    }

    protected function testSync(): void
    {
        $connector = new Connector;

        for ($requests = 0; $requests < 5; $requests++) {
            $connector->send(new Request);

            ray('Request sent');
            ray()->pause();
        }
    }

    protected function testAsync(): void
    {
        $connector = new Connector;

        $promises = [];

        for ($requests = 0; $requests < 5; $requests++) {
            $promises[] = $connector->sendAsync(new Request);

            ray('Request sent');
            ray()->pause();
        }

        Utils::all($promises)->wait();
    }
}
