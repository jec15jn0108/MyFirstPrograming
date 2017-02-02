<?php
/*
 *  FileName: account.php
 *  Author  :aaaaa
 *  Remark  : accountテーブルへアクセスするクラス
 */

 include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');

 $st = new Stage();

 $stagelist = $_POST['list'];
 $genre = $_POST['genre'];
 $sortlist = $_POST['sortlist'];
 $teamId = $_COOKIE['team'];

 if ((empty($sortlist)) === false) {

   for ($i = 1, $j = 0; $j < count($sortlist); $i++, $j++) {
    $stage = $sortlist[$j];
    $stagenum = $stage - 1;
    $list = $stagelist[$stagenum];
    $st->updateStageNumber($teamId, $list, $i);
  }
} else {
  ;//Do not Shing
}
