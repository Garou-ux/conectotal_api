<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://simecproyectos.net',     // producción
        'http://localhost',               // navegadores locales (sin puerto)
        'http://localhost:*',             // cualquier puerto local (ej. 4200, 8080)
        'http://127.0.0.1',               // también sin puerto
        'http://127.0.0.1:*',             // cualquier puerto
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,  // habilítalo si usas tokens/cookies
];



