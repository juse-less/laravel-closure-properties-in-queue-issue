<?php

declare(strict_types=1);

use App\Connector;
use App\Request;

require 'vendor/autoload.php';

$connector = new Connector;

for ($i = 0; $i < 5; $i++) {
    $connector->send(new Request);

    ray('Request sent');
    ray()->pause();
}

ray('End of script');
ray()->pause();
