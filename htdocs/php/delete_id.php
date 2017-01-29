<?php
/*
* FileName : delete_id.php
* Author   : Onogaki Kaichi
* Remark   : 最後の教師IDか判断し削除処理をする
*/

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/team.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/progress.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');

$ac = new Account();
$te = new Team();
$pr = new Progress();
$st = new Stage();

$teamId = $_POST['PostValue01'];
$accountId = $_POST['PostValue02'];
$isTeacher = $_POST['PostValue03'];

if($isTeacher){
  $isTeacher = true;
} else {
  $isTeacher = false;
}

$result1 = $ac->selectTeacherNum($teamId, $isTeacher);
if($result1 == 1){
  $pr->deleteProgressAll($teamId);
  $st->deleteStageAll($teamId);
  $ac->deleteAccountAll($teamId);
  $te->deleteTeam($teamId);
} else {
  $ac->deleteAccount($accountId,$teamId);
}
echo($result1);
