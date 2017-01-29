<?php
/*
* FileName : team.php
* Author   : Onogaki Kaichi
* Remark   : teamテーブルへアクセスするクラス
*/

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');

$ac = new Account();
if (isset($_POST["PostValue01"],$_POST["PostValue02"])) {
  $teamId = $_POST['PostValue01'];
  $isteacher = $_POST["PostValue02"];
} else {
  $teamId = "";
  $isteacher = "";
}
$accountlist;
$accountlist = $ac->selectStudentAccount($teamId, $isteacher);
$accountlist = json_encode($accountlist);
echo ($accountlist);
