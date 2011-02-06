<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Attribute {
    const CONSTITUTION = 0;
    const QUICKNESS = 1;
    const STRENGTH = 2;
    const INTELLIGENCE = 3;
    const CHARISMA = 4;
    const WILLPOWER = 5;
    const ESSENCE = 6;
    const MAGIC = 7;

    protected $_type;
    protected $_value;

    public function  __construct($type, $value) {
        $this->_type = $type;
        $this->_value = $value;
    }
    public function getValue() {
        return $this->_value;
    }
    public function getType() {
        return $this->_type;
    }
}
?>
