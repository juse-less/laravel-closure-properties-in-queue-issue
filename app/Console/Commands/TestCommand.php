<?php

namespace App\Console\Commands;

use App\RandomEmptyClass;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

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

        for ($jobs = 0; $jobs < 5; $jobs++) {
            $this->test();

            ray('End of job');
            ray()->pause();
        }

        ray('End of command');
        ray()->pause();

        return 0;
    }

    protected function test(): void
    {
        for ($instantiations = 0; $instantiations < 5; $instantiations++) {
            $class = new RandomEmptyClass;

            ray('class created');
            ray()->pause();
        }
    }
}
