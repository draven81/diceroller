<?php
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
    /**
     * get SkillChecks character
     * @return Character
     */
    public function getCharacter() {
        return $this->_character;
    }
    /**
     * returns the Value of the given Skill of Checks character
     * @return int
     */
    private function _getCharactersSkillValue() {
        return $this->getCharacter()->getSkillValueOf($this->_skill)->getValue();
    }

    /**
     * return instance of check
     * @return Check
     */
    public function getCheck() {
        if(!isset($this->_check))
                if(!isset($this->_check)) $this->_initCheck ();

        return $this->_check;
    }

    protected function _initCheck() {

    }
    public function execute() {
        if(!isset($this->_check)) $this->_initCheck ();

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
