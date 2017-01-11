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
 $currentpass = $_POST['currentpass'];
 $isLogin = $ac->athentication($teamId, $accountId, $pass);

 if ($isLogin == true) {
   $ac->updateAccountPass($accountId, $teamId, $newpass);
 } else {
   setcookie('pass_error', 'パスワードが違います', time() + 1, "/");
   echo '<script type="text/javascript">window.location.href = `/config_base.html`;</script>';
 }
}
