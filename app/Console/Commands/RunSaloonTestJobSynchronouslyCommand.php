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
        TestSaloonJob::dispatchSync();

        return 0;
    }
}
