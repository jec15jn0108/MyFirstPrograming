<?php
/*
 *  FileName: register.php
 *  Author  :張
 *  Remark  : アカウント作成
 */
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/team.php');


$at = new Account();
$tm = new Team();

$teamId = $_POST['teamid'];
$teamName = $_POST['teamname'];
$accountT = $_POST['accountT'];
$tPass = $_POST['tPass'];
$tPass2 = $_POST['tPass2'];
$accountS = $_POST['accountS'];
$sPass = $_POST['sPass'];
$sPass2 = $_POST['sPass2'];
$isT = true;
$isS = false;

$retTm = $tm->selectTeam($teamId);

if($retTm == 0) {
  $tm->insertTeam($teamId, $teamName);
  $hashT = password_hash($tPass, PASSWORD_DEFAULT);
  $retT = $at->insertAccount($accountT,$teamId,$hashT,$isT);
  $hashS = password_hash($sPass, PASSWORD_DEFAULT);
  $retS = $at->insertAccount($accountS,$teamId,$hashS,$isS);
  header("Location: /");

}else {
  setcookie('team_error', "0", time() + 1, "/");
  echo '<script type="text/javascript">window.location.href = `/register.html`;</script>';
  exit();
}
