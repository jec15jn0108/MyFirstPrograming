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

$delPro = 0;
$delStg = 0;
$delAc = 0;
$delTe = 0;


$teamId = $_POST['PostValue01'];
$accountId = $_POST['PostValue02'];
$isTeacher = $_POST['PostValue03'];

if($isTeacher){
  $isTeacher = 1;
} else {
  $isTeacher = 0;
}

$result1 = $ac->selectTeacherNum($teamId, $isTeacher);
if($result1 == 1){
  $delPro = $pr->deleteProgressAll($teamId);
  $delStg = $st->deleteStageAll($teamId);
  $delAc = $ac->deleteAccountAll($teamId);
  $delTe = $te->deleteTeam($teamId);
} else {
  $delTe = $ac->deleteAccount($accountId,$teamId);
}

if(($delPro AND $delStg AND $delAc AND $delTe) != 0){
  $result = "true";
} else {
  $result = "false";
}
echo ($result);
