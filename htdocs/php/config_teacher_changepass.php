<?php
/*
* FileName : config_teacher_changepass.php
* Author   : Oouchi yuki
* Remark   : config_teacherの動きを司る
*/
include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');

$ac = new Account();
$accountId = $_COOKIE['account'];
$teamId = $_COOKIE['team'];
$newpass = $_POST['changeTpass'];
$re_typingpass = $_POST['re-typingTpass'];
$hashnewpass = password_hash($newpass, PASSWORD_DEFAULT);
$currentpass = $_POST['currentTpass'];
if ((empty($newpass) AND empty($re_typingpass) AND empty($currentpass)) === false){
  $isLogin = $ac->athentication($teamId, $accountId, $currentpass);
  if ($isLogin == true) {
    if($newpass === $re_typingpass){
      $ac->updateAccountPass($accountId, $teamId, $hashnewpass);
      setcookie('result', 'パスワードを変更しました', time() + 1, "/");
      echo '<script type="text/javascript">window.location.href = `/config_teacher.html`;</script>';
    } else {
      setcookie('result', '入力値が間違っています', time() + 1, "/");
      echo '<script type="text/javascript">window.location.href = `/config_teacher.html`;</script>';
    }
  } else {
    setcookie('result', 'パスワードが違います', time() + 1, "/");
    echo '<script type="text/javascript">window.location.href = `/config_teacher.html`;</script>';
  }
} else {
  setcookie('result', '入力値に空白は認められません', time() + 1, "/");
  echo '<script type="text/javascript">window.location.href = `/config_teacher.html`;</script>';
}
