<?php

use Illuminate\Foundation\Application;

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Interfaces
|--------------------------------------------------------------------------
|
| Aquí enlazamos las interfaces del kernel HTTP y de consola a sus
| implementaciones. Puedes personalizar estas clases en tu aplicación.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Retornar la aplicación
|--------------------------------------------------------------------------
|
| Este script retorna la instancia de la aplicación. El framework la usará
| para manejar peticiones y ejecutar la consola.
|
*/

return $app;
