<?php
require_once '../autoload.inc.php';
$skillList = new SkillList();

$parentAttribute = (int)$argv[1];
$skillName = (string)$argv[2];
$concentration = (isset($argv[3])?$argv[3]:null);
$skill = new Skill($parentAttribute, $skillName, $concentration);
$skillList->addSkill($skill);
var_dump($skillList);

?>
