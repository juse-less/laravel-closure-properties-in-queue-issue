<?php

namespace App\Jobs;

use App\RandomEmptyClass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->test();

        ray('End of job');
        ray()->pause();
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
