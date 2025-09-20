<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://simecproyectos.net',   // tu frontend en producción
        'http://localhost:4200',        // si algún día pruebas con Angular/Vue
        'http://127.0.0.1:8000'         // si pruebas API en local
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];

