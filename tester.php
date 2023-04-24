<?php

declare(strict_types=1);

use App\RandomEmptyClass;

require 'vendor/autoload.php';

for ($i = 0; $i < 5; $i++) {
    $class = new RandomEmptyClass;

    ray('class created');
    ray()->pause();
}

ray('End of script');
ray()->pause();
