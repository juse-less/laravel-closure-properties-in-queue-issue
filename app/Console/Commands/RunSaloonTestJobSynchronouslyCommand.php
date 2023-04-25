<?php

namespace App\Console\Commands;

use App\Jobs\TestSaloonJob;
use Illuminate\Console\Command;

class RunSaloonTestJobSynchronouslyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-saloon-test-job-synchronously';

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

        for ($jobs = 0; $jobs < 5; $jobs++) {
            TestSaloonJob::dispatchSync();
        }

        return 0;
    }
}
