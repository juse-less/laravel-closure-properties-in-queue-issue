<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;

class RunTestJobSynchronouslyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-test-job-synchronously';

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

        for ($jobs = 0; $jobs < 5; $jobs++) {
            TestJob::dispatchSync();
        }

        return 0;
    }
}
