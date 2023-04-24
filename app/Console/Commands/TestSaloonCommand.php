<?php

namespace App\Console\Commands;

use App\Jobs\TestSaloonJob;
use Illuminate\Console\Command;

class TestSaloonCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-saloon-command';

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
        for ($i = 0; $i < 5; $i++) {
            TestSaloonJob::dispatch();
        }

        return 0;
    }
}
