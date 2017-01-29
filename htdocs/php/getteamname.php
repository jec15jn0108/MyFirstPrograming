<?php
/*
* FileName : team.php
* Author   : Onogaki Kaichi
* Remark   : teamテーブルへアクセスするクラス
*/

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/team.php');

$te = new Team();
if (isset($_POST["PostValue01"])) {
  $teamId = $_POST['PostValue01'];
} else {
  $teamId = "";
}
// echo ($teamId);
$name = $te->selectTeamName($teamId);
echo($name);
