<?php
/*
 * FileName : login.php
 * Author   : Oouchi yuki
 * Remark   : ログインをする
 */
 include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');
 include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/progress.php');

 $ac = new Account();
 $pg = new Progress();

 $teamId = $_POST['teamid'];
 $accountId = $_POST['accountid'];
 $pass = $_POST['pass'];
 $accountnum = $_POST['accountnum'];

 // $hashed = password_hash($pass, PASSWORD_DEFAULT);

 $isLogin = $ac->athentication($teamId, $accountId, $pass);
 $isExistNum = $pg->selectCount($accountnum, $accountId, $teamId);
 $isTeacher = $ac->isTeacher($accountId, $teamId);

 if ($isLogin == true) {
   if($isTeacher == false){
     if(!empty($accountnum) && $isExistNum == 0){
       setcookie('number', $accountnum, 0, "/"); //生徒ログイン成功
     } else {
       setcookie('login_error', "1", time() + 1, "/");
      //  header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/index.html");
       echo '<script type="text/javascript">window.location.href = `/index.html`;</script>';
       exit();
     }
   }
   setcookie('is_teacher', var_export($isTeacher, true), 0, "/");
   setcookie('team', $teamId, 0, "/");
   setcookie('account', $accountId, 0, "/");
   header( "Location: ../main.html" );
   exit();
 } else {
   setcookie('login_error', "0", time() + 1, "/");
  //  header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/index.html");
   echo '<script type="text/javascript">window.location.href = `/index.html`;</script>';
   exit();
 }
