<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');
  $st = new Stage();
  $ret = $st->selectStageGenre($teamId,$genreId);
  $result = $ret->fetchAll();
  echo '<select name="aaa" multiple="multiple"  size="9" required>' . "\n";
  foreach($result as $row){
    echo ('<option value="' . $row['stageID'] .'">' . $row['stageNumber'].'</option>' . "\n");
  }
  echo '<\select>' . "\n";
?>
