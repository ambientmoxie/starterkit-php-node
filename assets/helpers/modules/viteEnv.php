<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../../");
$dotenv->load();

function viteEnv($envVar)
{
    return $_ENV[$envVar];
}
