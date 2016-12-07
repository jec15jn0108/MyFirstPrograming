<?php
/*
 * FileName : login.php
 * Author   : Oouchi yuki
 * Remark   : ログインをする
 */
 include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');

 $ac = new Account();

 $teamId = $_POST['teamid'];
 $accountId = $_POST['accountid'];
 $pass = $_POST['pass'];
 $accountnum = $_POST['accountnum'];

 // $hashed = password_hash($pass, PASSWORD_DEFAULT);

 $result2 = $ac->athentication($teamId, $accountId, $pass);
 if($result2){
   $result = $ac->isTeacher($accountId, $teamId);
   if($result = 0){
     setcookie(accountnum, $accountnum, 0);
   }else{
     ;//DoNothing
   }
   setcookie(teamid, $teamId, 0, "/");
   setcookie(accountid, $accountId, 0, "/");
   header( "Location: ../main.html" );
   exit();
  }else{
   print("ログインに失敗しました<br>");
   print("$teamId : $accountId : $pass : $result2");
 }
