<?php
class Skill {
    protected $_parentAttribute;
    protected $_skillName;
    protected $_concentration;
    protected $_skillId;

    public function getSkillFingerprint() {
        return $this->_skillId;
    }
    public function getName() {
        return $this->_skillName;
    }

    public function  __construct($parentAttribute, $skillName, $concentration = null) {
        $this->_parentAttribute = $parentAttribute;
        $this->_skillName = $skillName;
        $this->_skillId = md5($this->_skillName.(isset($this->_concentration)?$this->_concentration:''));
    }
}


?>
