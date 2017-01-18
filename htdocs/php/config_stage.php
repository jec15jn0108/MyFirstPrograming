<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');


    $st = new Stage();
    $ret = $st->selectStageGenre("JN01","1");
    $result = $ret->fetchAll();
    $str = json_encode($result);
    echo json_encode($result);
    // echo '<select name="aaa" multiple="multiple"  size="9" required>' . "\n";
    // foreach($result as $row){
    //   echo ('<option value="' . $row['stageID'] .'">' . $row['stageNumber'].'</option>' . "\n");
    // }
    // echo '<\select>' . "\n";

?>
