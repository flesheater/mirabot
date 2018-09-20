<?php

/**
 * @file
 * Glue code .
 */

// Autoloading.
require __DIR__ . '/../vendor/autoload.php';

// Including our custom bot class.
use Webham\Mirabot\Mirabot;

// Loading our config if it exists.
$config = [];
if (file_exists(__DIR__ . '/../conf/config.php')) {
  require __DIR__ . '/../conf/config.php';
}

// Creating instance of our bot.
$chatbot = new Mirabot($config);

$chatbot->listen();
