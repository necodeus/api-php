<?php 

// Load Composer's autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env file
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Load helper functions
require __DIR__ . '/../src/helpers.php';

// Load everything that is needed for tests
require __DIR__ . '/../src/rest/controllers/BaseController.php';
