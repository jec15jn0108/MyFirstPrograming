<?php
/*
 * FileName : config_teacher.php
 * Author   : Oouchi yuki
 * Remark   : config_teacherの動きを司る
 */
 include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');

 $ac = new Account();
 $accountId = $_COOKIE['account'];
 $teamId = $_COOKIE['team'];
 $newpass = $_POST['newpass'];
 $hashnewpass = password_hash($newpass, PASSWORD_DEFAULT);
 $currentpass = $_POST['currentpass'];
 $isLogin = $ac->athentication($teamId, $accountId, $currentpass);

 if ($isLogin == true) {
   $ac->updateAccountPass($accountId, $teamId, $hashnewpass);
   setcookie('pass_change_ok_ng', 'パスワードを変更しました', time() + 1, "/");
   echo '<script type="text/javascript">window.location.href = `/config_teacher.html`;</script>';
 } else {
   setcookie('pass_change_ok_ng', 'パスワードが違います', time() + 1, "/");
   echo '<script type="text/javascript">window.location.href = `/config_teacher.html`;</script>';
 }
