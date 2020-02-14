<?php
class Dog extends Pet{


    function fetch()
    {
        echo $this->getName() . " is fetching<br>";
    }

    function talk()
    {
        echo $this->getName() . " is barking<br>";
    }

    function type()
    {
        echo $this->getName() . "is a dog<br>";
    }

}//end of Dog class