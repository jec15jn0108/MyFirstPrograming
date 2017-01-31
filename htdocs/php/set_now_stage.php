<?php
/**
 * FileName: set_now_stage.php
 * @author Onogaki
 * Date   : 2017.02.01
 * Remark : progressテーブルへ現在のステージを更新
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/progress.php');

$pgr = new Progress();

$teamId = $_POST["teamId"];
$accountId = $_POST["accountId"];
$number = $_POST["number"];
$map = $_POST["map"];

$pgr->updateNowStage($teamId, $accountId, $number, $map);
