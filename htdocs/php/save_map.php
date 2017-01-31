<?php
/**
 * FileName : seva_map.php
 * Author   : Onogaki, Kaichi
 * Date     : 2017.01.30
 * Remark   : ステージデータをファイルに保存する
 */


include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');


$teamId = $_POST['teamId'];
$mapName = $_POST['mapName'];
$mapData = $_POST['mapData'];
$answer = $_POST['answer'];
$blockNum = $_POST['blockNum'];
$genreId = $_POST['genre'];

// echo($teamId . ":" . $mapName . ":" . $mapData . ":" . $answer . ":" . $blockNum);
$txt = "";
$txt .= $mapData;
$txt .= "map.name = '"       . $mapName  . "';";
$txt .= "map.maxBlockNum = "  . $blockNum . ";";
$txt .= "map.answer = '"     . $answer   . "';";


$file = "/maps/" . $teamId . "/" . $mapName . ".txt";

// echo($txt);
// echo($file);
$file = mb_convert_encoding($file, "SJIS");


//DataBase ====================================================================
$st = new Stage();

$cnt = $st->countStage($teamId, $genreId);

$isExist = $st->isExistStage($teamId, $mapName);

if (!$isExist) {
  $st->insertStage($mapName, $teamId, $genreId, $file, $cnt + 1);
  file_put_contents($_SERVER['DOCUMENT_ROOT'] . $file, $txt);
} else {
  echo("false");
}
