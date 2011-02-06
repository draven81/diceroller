<?php
require_once 'Attributes.php';
require_once 'Skill.php';
require_once 'Saveable.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Character {
    protected $_skills;
    protected $_attributes;
    protected $_name;
    protected $_id;

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
}
?>
