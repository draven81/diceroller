<?php
class CharacterList extends Saveable {
    protected $_characters = array();

    protected function  _getSaveData() {
        return $this->_characters;
    }
    protected function  _setSaveData($savedata) {
        if(!is_null($savedata))
            $this->_characters = $savedata;
    }

    public function addCharacter(Character $char) {
        if(!$this->exists($char))
            array_push($this->_characters, $char);
        return $this;
    }
    public function getCharacterById($charId) {
        foreach($this->_characters as $character) {
            if($character->getId() === $charId) return $character;
        }
        return null;
    }
    public function getCharacterByName($charName) {
        foreach($this->_characters as $character) {
            if($character->getName() === $charName) return $character;
        }
        return null;
    }

    public function exists(Character $character) {
        foreach($this->_characters as $character) {
            if($character->getId() == $character->getId())
                    return true;
        }
        return false;
    }
}
?>
