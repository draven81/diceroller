<?php
class SkillList extends Saveable {
    protected  $_skills = array();

    protected function  _getSaveData() {
        return $this->_skills;
    }
    protected function  _setSaveData($savedata) {
        $this->_skills = $savedata;
    }

    public function addSkill(Skill $skill) {
        if(!$this->exists($skill))
            array_push ($this->_skills, $skill);
        return $this;
    }
    public function exists(Skill $skill) {
        foreach($this->_skills as $checkSkill) {
            if($checkSkill->getSkillFingerprint() == $skill->getSkillFingerprint())
                    return true;
        }
        return false;
    }
    public function getSkillById($skillId) {
        foreach($this->_skills as $skill) {
            if($skill->getSkillFingerprint()===$skillId)
                    return $skill;
        }
        return null;
    }
    public function getSkillByName($skillName) {
        foreach($this->_skills as $skill) {
            if($skill->getName()===$skillName)
                    return $skill;
        }
        return null;
    }
    public function getAllSkills() {
        return $this->_skills;
    }
}
?>
