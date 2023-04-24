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
use Saloon\Contracts\PendingRequest;

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
        //$connector->middleware()->onRequest(function (PendingRequest $pendingRequest): void {
        //
        //});

        $promises = [];

        for ($i = 0; $i < 5; $i++) {
            $request = new Request;
            //$request->middleware()->onRequest(function (PendingRequest $pendingRequest): void {
            //
            //});

            $promises[] = $connector->sendAsync($request);
        }

        ray()->pause();

        Utils::all($promises)->wait();

        ray()->pause();
    }
}
