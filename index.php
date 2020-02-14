<?php

// Turn on error reporting -- this is critical!
ini_set('display_errors',1);
error_reporting(E_ALL);

//Require autoload file
require("vendor/autoload.php");
require_once ('model/validation-functions.php');
require_once('controller/pets4-controller.php');

//If you start a session, do if AFTER
// the autoload
session_start();

//Instantiate F3
$f3 = Base::Instance();

//set debug level
$f3->set('DEBUG', 3);

//define an array of colors
$f3->set('colors', array('pink', 'green', 'blue'));

//Instantiate controller object
$controller= new PetController($f3);

//Define a default route
$f3->route("GET /", function (){
    $GLOBALS['controller']->home();
});

$f3->route("GET /@animal", function($f3, $params) {
    $GLOBALS['controller']->findAnimal($params,$f3);
});

$f3->route("GET|POST /order", function($f3) {
    $GLOBALS['controller']->order1($f3);
});

$f3->route("GET|POST /order2", function($f3) {
    $GLOBALS['controller']->order2($f3);
});

$f3->route("GET|POST /results", function() {
    $GLOBALS['controller']->summary();
});

//Run f3
$f3->run();