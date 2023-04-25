<?php

namespace App\Console\Commands;

use App\Jobs\TestSaloonJob;
use Illuminate\Console\Command;

class QueueSaloonTestJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:queue-saloon-test-job';

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
        for ($jobs = 0; $jobs < 5; $jobs++) {
            TestSaloonJob::dispatch();
        }

        return 0;
    }
}
