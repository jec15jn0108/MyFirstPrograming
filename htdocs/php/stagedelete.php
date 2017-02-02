<?php
/*
 *  FileName: account.php
 *  Author  :aaaaa
 *  Remark  : accountテーブルへアクセスするクラス
 */

 include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');

 $st = new Stage();

 $deletelist = $_POST['deletelist'];
 $teamId = $_COOKIE['team'];

 if ((empty($deletelist)) === false) {

   for ($i = 0; $i < count($deletelist); $i++) {
    $deletestage = $deletelist[$i];
    $st->deleteStage($teamId, $deletestage);
  }
} else {
  ;//Do not Shing
}
