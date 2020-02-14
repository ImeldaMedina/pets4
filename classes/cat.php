<?php
class Cat extends Pet{


    function play()
    {
        echo $this->getName() . " is playing<br>";
    }

    function talk()
    {
        echo $this->getName() . " is meowing<br>";
    }
}//end of Cat class
