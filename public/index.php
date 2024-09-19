<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Start the session
session_start();

// Include the config file
require_once '../app/config/config.php';

// Include other core files
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';
require_once '../app/core/App.php';

// Instantiate the core app class
$app = new App();
