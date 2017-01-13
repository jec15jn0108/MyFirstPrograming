<?php
/*
 *  FileName: register.php
 *  Author  :張
 *  Remark  : アカウント作成
 */
  include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/team.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/register.html');

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
    $hashS = password_hash($studentPass, PASSWORD_DEFAULT);
    $retS = $at->insertAccount($accountS,$teamId,$hashS,$isS);
    $_SESSION['teamId'] = "";
    header("Location: /index.html");

  }else {
    $_SESSION['teamId'] = "団体IDが存在しています";
  }
  session_unset();
