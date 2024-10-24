<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (file_exists(dirname(__DIR__) . '/config/bootstrap.php')) {
    require dirname(__DIR__) . '/config/bootstrap.php';
} else {
    if (file_exists(dirname(__DIR__) . '/.env.test.local')) {
        (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env.test.local');
    } else if (file_exists(dirname(__DIR__) . '/.env.test')) {
        (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env.test');
    }    
}