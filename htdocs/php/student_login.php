<?php
/**
 */

include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/progress.php');

$pg = new Progress();

$number = $_POST["number"];

$accountId = $_COOKIE["account"];
$teamId = $_COOKIE["team"];


if (!empty($number) and $pg->isExist($number, $accountId, $teamId) == 0) {
   setcookie('number', $number, 0, "/"); //生徒ログイン成功
   $pg->insertProgress($number, $accountId, $teamId, 0, null);
  //  echo("main");
   header("Location: /main.html");
  //  exit();
} else {
 setcookie('login_error', "1", time() + 1, "/");
 header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/student_login.html");
 // echo '<script type="text/javascript">window.location.href = `/index.html`;</script>';
 // exit();
}
