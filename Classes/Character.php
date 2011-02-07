<?php
class Character {
    protected $_skills;
    protected $_attributes;
    protected $_name;
    protected $_id;
    protected $_lastSkillCheck;

    public function  __construct($name, Attributes $attributes, Array $skills=array()) {
        $this->_skills = $skills;
        $this->_attributes = $attributes;
        $this->_name = $name;
        $this->_id = md5($this->_name);
    }

    public function getId() {
        return $this->_id;
    }
    public function getName() {
        return $this->_name;
    }
    public function addSkill(SkillValue $skill) {
        $this->_skills[] = $skill;
    }
    public function getSkillById($skillId) {
        foreach($this->_skills as $skill) {
            if($skill->getSkill()->getSkillFingerprint()==$skillId)
                    return $skill;
        }

    }
    public function getSkillByName($skillName) {
        foreach($this->_skills as $skill) {
            if($skill->getSkill()->getName()==$skillName)
                    return $skill;
        }
    }
    public function makeSkillCheck(Skill $skill, $pool, $minimum) {
        $this->_lastSkillCheck = new SkillCheck($this, $skill, $pool, $minimum);
        $this->_lastSkillCheck->execute();
        return $this;
    }
    public function getLatestSkillCheck() {
        return $this->_lastSkillCheck;
    }

}
?>
