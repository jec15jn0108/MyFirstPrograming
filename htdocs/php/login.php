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
 $progressnum = $_POST['accountnum'];
 $clearnum = 0;
 $nowstage = 0;

 // $hashed = password_hash($pass, PASSWORD_DEFAULT);

 $isLogin = $ac->athentication($teamId, $accountId, $pass);
 $isExistNum = $pg->isExist($progressnum, $accountId, $teamId);
 $isTeacher = $ac->isTeacher($accountId, $teamId);

 if ($isLogin == true) {
   if($isTeacher == false){
     if(!empty($progressnum) && $isExistNum == 0){
       setcookie('number', $progressnum, 0, "/"); //生徒ログイン成功
       $pg->insertProgress($progressnum, $accountId, $teamId, $clearnum, $nowstage);
     } else {
       setcookie('login_error', "1", time() + 1, "/");
      //  header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/index.html");
       echo '<script type="text/javascript">window.location.href = `/index.html`;</script>';
       exit();
     }
   } else {
     ;//DoNotThing
   }
   setcookie('is_teacher', var_export($isTeacher, true), 0, "/");
   setcookie('team', $teamId, 0, "/");
   setcookie('account', $accountId, 0, "/");
   setcookie('stage_genre', 1, 0, "/");
   setcookie('stage_number', 1, 0, "/");
   header( "Location: ../main.html" );
   exit();
 } else {
   setcookie('login_error', "0", time() + 1, "/");
  //  header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/index.html");
   echo '<script type="text/javascript">window.location.href = `/index.html`;</script>';
   exit();
 }
