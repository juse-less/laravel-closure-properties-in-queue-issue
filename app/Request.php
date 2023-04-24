<?php

declare(strict_types=1);

namespace App;

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
        // This cause the Connector to not destruct, and therefore not kill the Guzzle stuff (keeping file handles open).

        //$pendingRequest->middleware()->onRequest(function (PendingRequest $pendingRequest): void {
        //
        //});
    }
}
