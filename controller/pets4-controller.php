<?php
class PetController
{
    private $_f3; //router
    private $_val; //validation


    public function __construct($f3)
    {
        $this->_f3 = $f3;
    }
    public function home()
    {
        echo "<h1>My Pets</h1>";
        echo "<a href='order'>Order a Pet</a>";
    }

    public function findAnimal($params, $f3)
    {
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
    }
    public function order1($f3)
    {
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
        echo $template->render('views/form1.html');

    }
    public function order2($f3)
    {
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



    }

    public function summary()
    {
        //var_dump($_POST);

        $views = new Template();
        echo $views->render('views/results.html');
    }

}
