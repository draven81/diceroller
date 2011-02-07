<?php

require_once 'Classes/Check.php';
require_once 'Classes/CharacterList.php';
require_once 'Classes/SkillList.php';
require_once 'Classes/SkillValue.php';
require_once 'Classes/SkillCheck.php';

//$attributes = new Attributes(5, 5, 3, 7, 8, 2);
//$character = new Character('DeineMudda', $attributes);

$skill = new Skill(Attribute::INTELLIGENCE, 'Computer');
//$skill2 = new Skill(Attribute::INTELLIGENCE, 'Motorrad');
//
$skillList = new SkillList();
$charList = new CharacterList();
$character = $charList->getCharacterById('be3efa9d33a16f5e6cae53fc1a34b78f');
//
$pc = ($skillList->getSkillByName('Computer'));
//$pcValue = new SkillValue($pc, 7);
//$character->addSkill($pcValue);
//
//$charList->addCharacter($character);

//$skillId = $pc->getSkillFingerprint();
//$skillCheck = $character->makeSkillCheck($pc,3,10)->getLatestSkillCheck();
$skillCheck = $character->getLatestSkillCheck();
//$skillCheck->reroll();
var_dump($skillCheck->getResults());
var_dump($skillCheck->getSuccess());



?>