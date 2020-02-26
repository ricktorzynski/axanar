<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Helpers/database.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

/** @var \Illuminate\Contracts\Http\Kernel $kernel */
$kernel = $app->make(Kernel::class);

$response = $kernel->handle($request = Request::capture());
$response->send();

$kernel->terminate($request, $response);
