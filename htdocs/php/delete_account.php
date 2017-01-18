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
// echo ($teamId);
$result = $ac->deleteAccount($accountId,$teamId);
echo($result);
