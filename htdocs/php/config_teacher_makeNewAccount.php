<?php
/*
 * FileName : config_teacher_changepass.php
 * Author   : Oouchi yuki
 * Remark   : config_teacherの動きを司る
 */
 include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');

 $ac = new Account();
 $teamId = $_COOKIE['team'];
 $newId = $_POST['newid'];
 $newPass = $_POST['newpass'];
 $hashNewpass = password_hash($newPass, PASSWORD_DEFAULT);
 $isTeacher = 1;

 $ovcheck = $ac->overlapCheck($teamId,$newId);

 if ($ovcheck == true) {
   setcookie('ovcheck', '登録済み', time() + 1, "/");
   echo '<script type="text/javascript">window.location.href = `/config_teacher.html`;</script>';
 } else {
   $ac->insertAccount($newId,$teamId,$hashNewpass,$isTeacher);
   setcookie('registsuccess', '登録成功です！', time() + 1, "/");
   echo '<script type="text/javascript">window.location.href = `/config_teacher.html`;</script>';
 }
