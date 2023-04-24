<?php

namespace App\Jobs;

use App\Connector;
use App\Request;
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
        $connector = new Connector;

        // Note: If multiple requests are made, also have a look at the queue worker process' opened file handles,
        //         and you can see that it doesn't close the ones opened by these requests.
        $connector->send(new Request);

        ray()->pause();
    }
}
