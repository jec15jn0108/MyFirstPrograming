<?php
/*
 * FileName : team.php
 * Author   : Onogaki Kaichi
 * Remark   : teamテーブルへアクセスするクラス
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/team.php');

$te = new Team();
$teamId = $_POST['PostValue01'];
// echo ($teamId);
$name = $te->selectTeamName($teamId);
echo($name);
