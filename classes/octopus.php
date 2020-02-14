<?php
class Octopus extends Pet{
    private $_inkColor;

    function play()
    {
        echo $this->getName() . " is playing<br>";
    }

    function talk()
    {
        echo $this->getName() . " is waving its tentacles<br>";
    }

    function type()
    {
        echo $this->getName() . "is an octopus<br>";
    }

    function getInkColor()
    {
        return $this->_inkColor;
    }
    function setInkColor($inkColor)
    {
        $this->_inkColor = $inkColor;
    }
}//end of Cat class

