<?php

// Deployment link: cs4640.cs.virginia.edu/jbl5xq/project/index.php

session_start();

// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

// Parse the query string for command
$command = "login";
if (isset($_GET["command"]))
    $command = $_GET["command"];

// If the user's email is not set in the cookies, then it's not
// a valid session (they didn't get here from the login page),
// so we should send them over to log in first before doing
// anything else!


// Instantiate the controller and run
$controller = new NetflixController($command);
$controller->run();