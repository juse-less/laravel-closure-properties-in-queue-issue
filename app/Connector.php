<?php

declare(strict_types=1);

namespace App;

use Closure;
use Saloon\Contracts\PendingRequest;

class Connector extends \Saloon\Http\Connector
{
    //protected Closure $closure;

    public function __construct()
    {
        // This doesn't work.
        //$this->closure = function () {
        //    // Random Closure goes here. :)
        //};

        // This doesn't work (see next snippet of a wrapped class).
        //$this->closure = (function () {
        //    // Random Closure goes here. :)
        //})(...);

        // This works.
        // Note: Using an invocable class to make it callable, then using first-class callable syntax to turn it into a Closure.
        //$this->closure = (new class {
        //    public function __invoke()
        //    {
        //        // Random invocable class goes here. :)
        //    }
        //})(...);

        // This works.
        // Note: Since it worked with the class snippet above, I tried binding the Closure to an empty, anonymous, class,
        //         which is really what the previous snippet does.
        //$this->closure = Closure::bind(function () {
        //    // Random Closure goes here. :)
        //}, new class {});

        // This also works.
        // Note: On top of the previous example, I'm providing the explicit anonymous class instance as the bind target.

        //$wrapper = new class {};
        //
        //$this->closure = Closure::bind(function () {
        //    // Random Closure goes here. :)
        //}, $wrapper, $wrapper);
    }

    public function resolveBaseUrl(): string
    {
        return 'https://tests.saloon.dev';
    }

    public function boot(PendingRequest $pendingRequest): void
    {
        // For whatever reason, when giving the PendingRequest a _Closure_ middleware, it doesn't work.
        // Doing the same but on a new instance of a Request or Connector, it does work, however.
        // This cause the Connector to not destruct, and therefore not kill the Guzzle stuff (keeping file handles open).

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
        ray('destructing Connector', $this);
    }
}
