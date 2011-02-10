<?php
class SkillValue {
    protected $_skill;
    protected $_value;

    public function  __construct(Skill $skill, $value) {
        $this->_skill = $skill;
        $this->_value = $value;
    }
    public function getValue() {
        return $this->_value;
    }

    /**
     *
     * @return Skill
     */
    public function getSkill() {
        return $this->_skill;
    }
    
}
?>
