<?php
//  Create and return a new application
$app = new Illuminate\Foundation\Application($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));
$app->singleton(Illuminate\Contracts\Http\Kernel::class, Ares\Http\Kernel::class);
$app->singleton(Illuminate\Contracts\Console\Kernel::class, Ares\Console\Kernel::class);
$app->singleton(Illuminate\Contracts\Debug\ExceptionHandler::class, Ares\Exceptions\Handler::class);

return $app;
