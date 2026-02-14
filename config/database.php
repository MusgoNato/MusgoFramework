<?php 

return [
    'conn' => $_ENV['DB_CONNECTION'] ?? null,
    'host' => $_ENV['DB_HOST'] ?? null,
    'name' => $_ENV['DB_DATABASE'] ?? null,
    'user' => $_ENV['DB_USERNAME'] ?? null,
    'pass' => $_ENV['DB_PASSWORD'] ?? null,
    'port' => $_ENV['DB_PORT'] ?? '3306',
];