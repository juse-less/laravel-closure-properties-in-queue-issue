<?php

declare(strict_types=1);

namespace App;

use Closure;
use Saloon\Contracts\PendingRequest;
use Saloon\Enums\Method;

class Request extends \Saloon\Http\Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/user';
    }

    public function boot(PendingRequest $pendingRequest): void
    {
        // For whatever reason, when giving the PendingRequest a _Closure_ middleware, it doesn't work.
        // Doing the same but on a new instance of a Request or Connector, it does work, however.
        // This will still allow the Connector to destruct, and thereby the Guzzle client, and close the open file handles.
        // However, this Request is not destructed.

        // Doesn't work.
        $pendingRequest->middleware()->onRequest(function (PendingRequest $pendingRequest): void {

        });

        // Works.
        //$pendingRequest->middleware()->onRequest(Closure::bind(function () {
        //    // Random Closure goes here. :)
        //}, new class {}));
    }

    public function __destruct()
    {
        ray('destructing Request', $this);
    }
}
