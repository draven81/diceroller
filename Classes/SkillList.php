<?php
class SkillList extends Saveable {
    protected  $_skills = array();

    protected function  _getSaveData() {
        return $this->_skills;
    }
    protected function  _setSaveData($savedata) {
        $this->_skills = $savedata;
    }

    /**
     *
     * @param Skill $skill
     * @return SkillList 
     */
    public function addSkill(Skill $skill) {
        if(!$this->exists($skill))
            array_push ($this->_skills, $skill);
        return $this;
    }

    /**
     *
     * @param Skill $skill
     * @return boolean
     */
    public function exists(Skill $skill) {
        foreach($this->_skills as $checkSkill) {
            if($checkSkill->getSkillFingerprint() == $skill->getSkillFingerprint())
                    return true;
        }
        return false;
    }

    /**
     *
     * @param int $skillId
     * @return Skill
     */
    public function getSkillById($skillId) {
        foreach($this->_skills as $skill) {
            if($skill->getId()===$skillId)
                    return $skill;
        }
        throw new Exception("no skill found with id ".$skillId);
    }
    /**
     *
     * @param int $skillId
     * @return boolean
     */
    public function hasSkillById($skillId) {
         foreach($this->_skills as $skill) {
            if($skill->getId()===$skillId)
                    return true;
        }
        return false;
    }
    /**
     *
     * @param string $skillName
     * @return boolean
     */
    public function hasSkillByName($skillName) {
        foreach($this->_skills as $skill) {
           if(strtolower($skill->getName())===strtolower($skillName))
                    return true;
        }
        return false;
    }
    /**
     *
     * @param string $skillName
     * @return Skill
     */
    public function getSkillByName($skillName) {
        foreach($this->_skills as $skill) {
            if(strtolower($skill->getName())===strtolower($skillName))
                    return $skill;
        }
        throw new Exception("no skill found with name ".$skillName);
    }

    /**
     *
     * @return array
     */
    public function getAllSkills() {
        return $this->_skills;
    }
}
?>
