<?php

protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\LanguageMiddleware::class,
        // Other middlewares
    ],
];
