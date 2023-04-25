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
        // Note: Because the process terminates after the job, the classes are destructed.
        //       Meaning, also the open file handles are closed.

        // Note: Also have a look at the queue worker process' opened file handles,
        //         and you can see that it doesn't close the ones opened by these requests.

        $connector = new Connector;

        for ($jobs = 0; $jobs < 5; $jobs++) {
            for ($requests = 0; $requests < 5; $requests++) {
                $connector->send(new Request);

                ray('Request sent');
                ray()->pause();
            }

            ray('End of job');
            ray()->pause();
        }

        ray('End of command');
        ray()->pause();

        return 0;
    }
}
