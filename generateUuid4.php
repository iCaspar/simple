<?php

declare(strict_types=1);

use Ramsey\Uuid\Uuid;

require 'vendor/autoload.php';
echo Uuid::uuid4() . "\n";
