<?php
require_once 'Attribute.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Attributes {
    public $constitution;
    public $quickness;
    public $strength;
    public $intelligence;
    public $charisma;
    public $willpower;
    public $essence;
    public $magic;

    public function  __construct($con,$qui,$str,$cha,$int,$wil,$ess=6,$mag=6) {
        $this->constitution = new Attribute(ATTRIBUTE::CONSTITUTION, $con);
        $this->quickness = new Attribute(ATTRIBUTE::QUICKNESS, $qui);
        $this->strength = new Attribute(ATTRIBUTE::STRENGTH, $str);
        $this->intelligence = new Attribute(ATTRIBUTE::INTELLIGENCE, $int);
        $this->charisma = new Attribute(ATTRIBUTE::CHARISMA, $cha);
        $this->willpower = new Attribute(ATTRIBUTE::WILLPOWER, $wil);
        $this->essence = new Attribute(ATTRIBUTE::ESSENCE, $ess);
        $this->magic = new Attribute(ATTRIBUTE::MAGIC, $mag);
    }
}
?>
