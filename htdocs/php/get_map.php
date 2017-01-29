<?php
/**
 * FileName: get_map.php
 * Author:   Onogaki, Kaichi
 * Date:     2017.01.29
 * Remark:   マップデータの読み込み
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');
$st = new Stage();

$teamId = $_POST['teamId'];
$mapName = $_POST['mapName'];

$stmt = $st->selectStage($teamId, $mapName);
// echo($stmt->fetch(PDO::FETCH_ASSOC)["stageFileUrl"]);
$fileName = $stmt->fetch(PDO::FETCH_ASSOC)["stageFileUrl"];
// echo($fileName);
$data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $fileName);

echo($data);
