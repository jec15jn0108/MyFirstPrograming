<?php
/*
 * FileName : test_data.php
 * Author   : onogaki
 * Summary  : テスト用データ入れるよ（実装前用）
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');
$st = new Stage();

$stageName = "test01";
$teamId = "jec01";
$genreId = null;
$stageFileUrl = "/maps/jec01/test01.json";
$answerFileUrl = null;
$stageNumber = 1;

$st->insertStage($stageName, $teamId, $genreId, $stageFileUrl, $answerFileUrl, $stageNumber);
