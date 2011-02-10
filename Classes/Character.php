<?php
class Character {
    protected $_skills;
    protected $_attributes;
    protected $_name;
    protected $_id;
    protected $_lastSkillCheck;
    protected $_version = 2;

    public function  __construct($name, Attributes $attributes, Array $skills=array()) {
        $this->_skills = new SplObjectStorage();
        foreach($skills as $skillToAdd) {
            $this->_skills->attach($skillToAdd);
        }
        $this->_attributes = $attributes;
        $this->_name = $name;
        $this->_id = md5($this->_name);
    }

    /**
     *  gets characters id;
     * @return string
     */
    public function getId() {
        return $this->_id;
    }
    /**
     *  gets characters name
     * @return string
     */
    public function getName() {
        return $this->_name;
    }
    /**
     *
     * @param SkillValue $skill
     * @return Character
     */
    public function addSkill(SkillValue $skill) {
        if($this->_skills->contains($skill))
                throw new RuntimeException ("character already contains the skill ".$skill->getSkill()->getName());

        $this->_skills->attach($skill);
        return $this;
    }
    /**
     *
     * @param Skill $skill
     * @return boolean
     */
    public function hasSkillValueOf(Skill $skill) {
        while($this->_skills->valid()) {
            if($this->_skills->current()->getSkill()->getId()==$skill->getId())
                    return true;
            $this->_skills->next();
        }
        return false;
    }

    /**
     *
     * @param Skill $skill
     * @return SkillValue
     */
    public function getSkillValueOf(Skill $skill) {
        $this->_skills->rewind();
        while($this->_skills->valid()) {
            $current = $this->_skills->current();
            if($current->getSkill()->getId()==$skill->getId())
                    return $current;
            $this->_skills->next();
        }

    }
    /**
     *
     * @param Skill $skill
     * @param int $pool
     * @param int $minimum
     * @return Character
     */
    public function makeSkillCheck(Skill $skill, $pool, $minimum) {
        $this->_lastSkillCheck = new SkillCheck($this, $skill, $pool, $minimum);
        $this->_lastSkillCheck->execute();
        return $this;
    }
    /**
     *
     * @return SkillCheck
     */
    public function getLatestSkillCheck() {
        return $this->_lastSkillCheck;
    }

    /**
     *  restores character from backend
     * @param string $characterId
     * @return Character
     */
    public static function restore($characterId) {
        $className = get_called_class().'_'.$characterId;
        if(!file_exists($className.'.save')) throw new Exception ('no file');
        $item = implode("", @file($className.'.save'));
        $character = (unserialize($item));
        return $character;
    }

    public function  __destruct() {
        $this->save();
    }
    /**
     *  saves character to backend
     * @return Character
     */
    public function save() {
        $className = get_class($this).'_'.$this->getId();
        $saveableItem = serialize($this);
        if($fp = fopen($className.'.save', 'w')) {
            if(fwrite($fp,$saveableItem) === FALSE )
                    throw new Exception ("Could not save");
        }
        return $this;
    }

}
?>
