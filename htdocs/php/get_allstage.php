<?php
/*
* FileName : team.php
* Author   : Onogaki Kaichi
* Remark   : teamテーブルへアクセスするクラス
*/

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');

$ac = new Stage();
if (isset($_POST["PostValue01"])) {
  $teamId = $_POST['PostValue01'];
  // $genreId = $_POST["PostValue02"];
} else {
  $teamId = "";
  $genreId = "";
}
$stagelist = [];
for ($i = 1; $i <= 4; $i++){
  array_push($stagelist , $ac->selectAllStageGenre($teamId, $i));
}
$stagelist = json_encode($stagelist);
echo ($stagelist);
