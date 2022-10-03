<?php

declare(strict_types=1);

define('FIXTURES_DIR', realpath(__DIR__ . '/../../tests/fixtures'));

putenv('APP_ENV=' . $_SERVER['APP_ENV'] = $_ENV['APP_ENV'] = 'test');
putenv('APP_DEBUG=' . $_SERVER['APP_DEBUG'] = $_ENV['APP_DEBUG'] = true);

require_once dirname(__DIR__, 2) . '/config/bootstrap.php';
