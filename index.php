<?php
require_once 'autoload.inc.php';
$skillList = new SkillList();
$charList = new CharacterList();
$character = $charList->getCharacterById('be3efa9d33a16f5e6cae53fc1a34b78f');
$pc = ($skillList->getSkillByName('Computer'));
$skillCheck = $character->makeSkillCheck($pc,3,10)->getLatestSkillCheck();
var_dump($skillCheck->getResults());
var_dump($skillCheck->getSuccess());
?>