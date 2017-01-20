<?php
/*
 * FileName : team.php
 * Author   : Onogaki Kaichi
 * Remark   : teamテーブルへアクセスするクラス
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');

$ac = new Account();
$teamId = $_POST['PostValue01'];
$accountId = $_POST['PostValue02'];
$isTeacher = $_POST['PostValue03'];
// echo ($teamId);
$result1 = $ac->selectTeacherNum($teamId,$isTeacher);
if($result1 == 0){
  $delPro = deleteProgressAll($teamId);
  $delStg = deleteStageAll($teamId);
  $delAc = deleteAccountAll($teamId);
  $delTe = deleteTeam($teamId);
} else {
  $delTe = $ac->deleteAccount($accountId,$teamId);
}

if(($delPro and $delStg and $delAc and $delTe) != 0){
  $result = true;
} else {
  $result = false;
}
echo($result);
