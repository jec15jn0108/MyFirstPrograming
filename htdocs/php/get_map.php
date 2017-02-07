<?php
/**
 * FileName: get_map.php
 * Author:   Onogaki, Kaichi
 * Date:     2017.01.29
 * Remark:   マップデータの読み込み
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');
$st = new Stage();

// $mapName = $_POST['mapName'];
$teamId = $_POST['teamId'];
$genreId = $_POST['genre'];
$num = intval($_POST['number']);

$stmt = $st->selectStageByGenreAndNumber($teamId, $genreId, $num);
// $stmt = $st->selectStage($teamId, $mapName);
// echo($stmt->fetch(PDO::FETCH_ASSOC)["stageFileUrl"]);
$fileName = $stmt->fetch(PDO::FETCH_ASSOC)["stageFileUrl"];
// echo($fileName);
$data = file_get_contents(mb_convert_encoding($_SERVER['DOCUMENT_ROOT'] . $fileName, "SJIS"));

echo($data);
