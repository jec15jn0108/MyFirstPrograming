<?php
/*
 * FileName : config_teacher.php
 * Author   : Oouchi yuki
 * Remark   : ログインをする
 */
 include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');

 function updatePass(){

   $ac = new Account();

   $accountId = $_COOKIE['account'];
   $teamId = $_COOKIE['team'];
   $newpass = $_POST['newpass'];

   $ac->updateAccountPass($accountId, $teamId, $newpass);

 }

 function newTeacherCleate(){
   


 }
