<?php

// Turn on error reporting -- this is critical!
ini_set('display_errors',1);
error_reporting(E_ALL);

//Require autoload file
require("vendor/autoload.php");
require_once ('model/validation-functions.php');

//If you start a session, do if AFTER
// the autoload
session_start();

//Instantiate F3
$f3 = Base::Instance();

//set debug level
$f3->set('DEBUG', 3);

//define an array of colors
$f3->set('colors', array('pink', 'green', 'blue'));

//Define a default route
$f3->route("GET /", function (){
    echo "<h1>My Pets</h1>";
    echo "<a href='order'>Order a Pet</a>";
});

$f3->route("GET /@animal", function($f3, $params) {
    $animal = $params['animal'];
    switch ($animal) {
        case 'chicken':
            echo "Cluck!";
            break;
        case 'dog':
            echo "Woof!";
            break;
        case 'cat':
            echo "Meow!";
            break;
        case 'horse':
            echo "Nay!";
            break;
        case 'cow':
            echo "Moo!";
            break;
        default:
            $f3->error(404);
    }
});

$f3->route("GET|POST /order", function($f3) {
    $_SESSION = array();
    if(isset($_POST['animal'])){
        $animal = $_POST['animal'];
        if(validString($animal)){
            $_SESSION['animal']= $animal;
            if($animal === "dog"){
                $pet =new Dog();
            }
            elseif($animal === "cat"){
                $pet = new Cat();
            }
            elseif($animal === "octopus"){
                $pet = new Octopus();
            }
            else{
                $pet = new Pet();
            }
            $_SESSION['pet']=$pet;

            $f3->reroute('/order2');
        }else{
            $f3->set("errors['animal']", "Please enter an animal.");
        }
    }
    $template = new Template;
//    $views = new Template();
    echo $template->render('views/form1.html');

});

$f3->route("GET|POST /order2", function($f3) {
    /*//var_dump($_POST);
    $_SESSION['animal'] = $_POST['animal'];
    //var_dump($_SESSION);*/
    if (isset($_POST['color'])) {
        $color = $_POST['color'];
        $name = $_POST['name'];
        if (validColor($color) && validString($name)) {
            $_SESSION['pet']->setColor($color);
            $_SESSION['pet']->setName($name);
            $_SESSION['color'] = $color;
            $f3->reroute('/results');
        }
        else {
            $f3->set("errors['color']", "Please enter a color.");
            $f3->set("errors['name']", "Please enter a name.");
        }
    }
    $views = new Template();
    echo $views->render('views/form2.html');

});

$f3->route("GET|POST /results", function() {
    //var_dump($_POST);

    $views = new Template();
    echo $views->render('views/results.html');
});

//Run f3
$f3->run();