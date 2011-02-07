<?php
require_once 'Check.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class SkillCheck {
    protected $_character;
    protected $_skillFingerPrint;
    protected $_skillValue;
    protected $_poolDiceCount;
    protected $_minimum;
    protected $_check;


    public function  __construct(Character $character, Skill $skill, $pool, $minimum) {
        $this->_character = $character;
        $this->_skill = $skill;
        $this->_poolDiceCount = $pool;
        $this->_minimum = $minimum;
        $this->_getCharactersSkillValue();
    }
    private function _getCharactersSkillValue() {
        $skill = $this->_character->getSkillById($this->_skill->getSkillFingerprint());
        return $skill->getValue();
    }
    public function getCheck() {
        if(isset($this->_check))
            return $this->_check;
        else
            throw new Exception('create check first');
    }
    public function execute() {
        $this->check = new Check($this->_getCharactersSkillValue(), $this->_poolDiceCount, $this->_minimum);
        $this->check->execute();
        return $this->check->getResults();
    }
    public function getResults() {
        if(!isset($this->check)) $this->execute ();
        return $this->check->getResults();
    }
    public function getSuccess() {
        if(!isset($this->check)) $this->execute ();
        return $this->check->getSuccess();
    }
    public function getCritCount() {
        if(!isset($this->check)) $this->execute ();
        return $this->check->getCritCount();
    }
    public function reroll() {
        if(!isset($this->check)) $this->execute ();
        return $this->check->reroll();
    }
    public function afterRoll() {
        if(!isset($this->check)) $this->execute ();
        return $this->check->afterRoll();
    }
}
?>
