<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Load cached env vars if the .env.local.php file exists
// Run "composer dump-env prod" to create it (requires symfony/flex >=1.2)
if (is_array($env = @include dirname(__DIR__) . '/.env.local.php')) {
    foreach ($env as $key => $value) {
        $_ENV[$key] = $_ENV[$key] ?? (isset($_SERVER[$key]) && 0 !== strpos($key, 'HTTP_') ? $_SERVER[$key] : $value);
    }
} elseif (!class_exists(Dotenv::class)) {
    throw new \RuntimeException('Please run "composer require symfony/dotenv" to load the ".env" files configuring the application.');
} else {
    // load all the .env files
    (new Dotenv(false))->loadEnv(dirname(__DIR__) . '/.env');
}

$_SERVER += $_ENV;
$_SERVER['APP_ENV'] = $_ENV['APP_ENV'] = ($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? null) ?: 'dev';
$_SERVER['APP_DEBUG'] = $_SERVER['APP_DEBUG'] ?? $_ENV['APP_DEBUG'] ?? 'prod' !== $_SERVER['APP_ENV'];
$_SERVER['APP_DEBUG'] = $_ENV['APP_DEBUG'] = (int) $_SERVER['APP_DEBUG'] || filter_var($_SERVER['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN) ? '1' : '0';

$errorLevel = error_reporting();

if ($_SERVER['APP_ENV'] !== 'dev') {
    $errorLevel = $errorLevel & ~E_NOTICE & ~E_USER_NOTICE & ~E_USER_DEPRECATED & ~E_DEPRECATED & ~E_STRICT;
}

error_reporting($errorLevel);
