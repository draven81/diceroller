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


    public function  __construct(Character $character, $skillId, $pool, $minimum) {
        $this->_character = $character;
        $this->_skillFingerPrint = $skillId;
        $this->_poolDiceCount = $pool;
        $this->_minimum = $minimum;
        $this->_getCharactersSkillValue();
    }
    private function _getCharactersSkillValue() {
        $skill = $this->_character->getSkillById($this->_skillFingerPrint);
        return $skill->getValue();
    }
    public function execute() {
        $this->check = new Check($this->_getCharactersSkillValue(), $this->_poolDiceCount, $this->_minimum);
        $this->check->execute();
        return $this->check->getResults();
    }
}
?>
