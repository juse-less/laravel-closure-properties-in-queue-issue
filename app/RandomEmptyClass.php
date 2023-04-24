<?php

declare(strict_types=1);

namespace App;

use Closure;

class RandomEmptyClass
{
    protected \Closure $closure;

    public function __construct()
    {
        // This doesn't work.
        $this->closure = function () {
            // Random Closure goes here. :)
        };

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

        //$this->closure = Closure::bind(function () {
        //    // Random Closure goes here. :)
        //}, $wrapper, $wrapper);
    }

    public function __destruct()
    {
        ray('destructing RandomEmptyClass', $this);
    }
}
