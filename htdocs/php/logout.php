<?php
/*
* FileName : logout.php
* Author   : Onogaki, Kaichi
* Date     : 2016/12/16
*/
include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/db_operator.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/progress.php');

$pr = new Progress();
$teamId = $_COOKIE["team"];
$accountId = $_COOKIE["account"];
$pr->deleteProgress($teamId,$accountId);

if (isset($_SERVER['HTTP_COOKIE'])) {
  $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
  foreach($cookies as $cookie) {
    $parts = explode('=', $cookie);
    $name = trim($parts[0]);
    //  setcookie($name, '', time()-1000);
    setcookie($name, '', time()-1000, '/');
  }
  // echo ("<script type='text/javascript'>window.location.href = '/'</script>");
}
