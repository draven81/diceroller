<?php

abstract class Dice {
    protected $_sides;
    protected $_stackable;
    protected $_result;

    public function  __construct($stackable=false) {
        $this->_stackable = $stackable;
        return $this;
    }

    public function getResult() {
        return $this->_result;
    }
    public function roll() {
        if($this->_stackable)
                $this->_result = $this->roll_stackable ();
        else
                $this->_result = $this->roll_simple ();

        return $this;
    }

    private function roll_stackable($stack=0) {
        $current_roll = $this->roll_simple();
        $stack+=$current_roll;
        if($current_roll==$this->_sides) {
            $stack = $this->roll_stackable($stack);
        } 
        return $stack;
    }

    private function roll_simple() {
        return rand(1,$this->_sides);
    }
    
}
?>
