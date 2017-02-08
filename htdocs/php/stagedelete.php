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
$zyun = $st->selectAllStageGenre($teamId, 1);
$bun = $st->selectAllStageGenre($teamId, 2);
$kuri = $st->selectAllStageGenre($teamId, 3);
$ou = $st->selectAllStageGenre($teamId, 4);
for($i = 0, $j = 1; $i < count($zyun); $i++, $j++) {
  $stageName = $zyun[$i];
  $st->updateStageNumber($teamId, $stageName, $j);
}
for($i = 0, $j = 1; $i < count($bun); $i++, $j++) {
  $stageName = $bun[$i];
  $st->updateStageNumber($teamId, $stageName, $j);
}
for($i = 0, $j = 1; $i < count($kuri); $i++, $j++) {
  $stageName = $kuri[$i];
  $st->updateStageNumber($teamId, $stageName, $j);
}
for($i = 0, $j = 1; $i < count($ou); $i++, $j++) {
  $stageName = $ou[$i];
  $st->updateStageNumber($teamId, $stageName, $j);
}
