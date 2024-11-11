<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Adjust paths to your needs

    'allowed_methods' => ['*'], // Allow all HTTP methods (GET, POST, PUT, DELETE)

    'allowed_origins' => ['http://localhost:3000'], // Your Next.js frontend URL

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Allow all headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Set to true if you are using cookies with your API
];
