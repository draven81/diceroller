<?php
require_once 'Dice.php';

class SixSider extends Dice {
    protected $_sides = 6;
  

    public function  __construct($stackable) {
        parent::__construct($stackable);
    }

}

?>
