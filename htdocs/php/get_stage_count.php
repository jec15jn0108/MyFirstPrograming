<?php
/**
 * FileName: get_stage_count.php
 * Author  : Onogaki, Kaichi
 * Date    : 2017.01.31
 * Remark  : ジャンルごとのステージの数を戻す
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');

$teamId = $_POST['teamId'];
// $genreId = $_POST['genre'];


$st = new Stage();
$cntStr = "";
for ($i = 1; $i <= 4; $i++) {
  $cntStr .= $st->countStage($teamId, $i) . ",";
}
$cntStr = rtrim($cntStr, ",");
echo($cntStr);
