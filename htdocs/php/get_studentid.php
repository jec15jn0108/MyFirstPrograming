<?php
/*
* FileName : team.php
* Author   : Onogaki Kaichi
* Remark   : teamテーブルへアクセスするクラス
*/

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');

$ac = new Account();
if (isset($_POST["teamId"])) {
  $teamId = $_POST['teamId'];
  // $isteacher = $_POST["PostValue02"];
} else {
  $teamId = "";
  // $isteacher = "";
}
$accountlist;
$accountlist = $ac->selectStudentAccount($teamId);
$accountlist = json_encode($accountlist);
echo ($accountlist);
