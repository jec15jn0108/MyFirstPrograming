<?php
/*
* FileName : config_teacher_changepass.php
* Author   : Oouchi yuki
* Remark   : config_teacherの動きを司る
*/
include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/account.php');

$ac = new Account();
$teamId = $_COOKIE['team'];
$newId = $_POST['newSid'];
$newpass = $_POST['newSpass'];
$re_typingnewpass = $_POST['re-typingnewSpass'];
$hashNewpass = password_hash($newpass, PASSWORD_DEFAULT);
$isTeacher = false;
echo($isTeacher);
if ((empty($newId) AND empty($newpass) AND empty($re_typingnewpass)) === false){
  $ovcheck = $ac->overlapCheck($teamId,$newId);

  if ($ovcheck == true) {
    setcookie('ovcheck', '登録済み', time() + 1, "/");
    echo '<script type="text/javascript">window.location.href = `/config_student.html`;</script>';
  } else {
    if($newpass === $re_typingnewpass){
      $ac->insertAccount($newId, $teamId, $hashNewpass, $isTeacher);
      setcookie('registsuccess', '登録成功です！', time() + 1, "/");
      echo '<script type="text/javascript">window.location.href = `/config_student.html`;</script>';
    } else {
      setcookie('registsuccess', '入力値が間違っています', time() + 1, "/");
      echo '<script type="text/javascript">window.location.href = `/config_student.html`;</script>';
    }
  }
} else {
  setcookie('registsuccess', '入力値に空白は認められません', time() + 1, "/");
  echo '<script type="text/javascript">window.location.href = `/config_student.html`;</script>';
}
