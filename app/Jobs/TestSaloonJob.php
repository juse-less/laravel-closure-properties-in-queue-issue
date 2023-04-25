<?php

namespace App\Jobs;

use App\Connector;
use App\Request;
use GuzzleHttp\Promise\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestSaloonJob implements ShouldQueue
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
        // Note: Also have a look at the queue worker process' opened file handles,
        //         and you can see that it doesn't close the ones opened by these requests.

        // Note: Using Async it gets even worse.

        $this->testSync();
        //$this->testAsync();

        ray('End of job');
        ray()->pause();
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
