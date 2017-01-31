<?php
/*
* FileName : team.php
* Author   : Onogaki Kaichi
* Remark   : teamテーブルへアクセスするクラス
*/

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');

$ac = new Stage();
if (isset($_POST["PostValue01"],$_POST["PostValue02"])) {
  $teamId = $_POST['PostValue01'];
  $genreId = $_POST["PostValue02"];
} else {
  $teamId = "";
  $genreId = "";
}
$stagelist;
$stagelist = $ac->selectAllStageGenre($teamId, $genreId);
$stagelist = json_encode($stagelist);
echo ($stagelist);
