<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/progress.php');

$teamId = $_POST["teamId"];
$stId = $_POST["stId"];

$prg = new Progress();


$data = $prg->selectAccountidProgress($teamId, $stId);

$list = "[";
foreach ($data as $row) {
  $list .= "{\"number\":\"" . $row["progressNumber"] . "\",\"clearNum\":" . $row["clearNum"] . ",\"nowStage\":\"" . $row["nowStage"] . "\"},";
}
$list = rtrim($list, ",");
$list .= "]";

echo($list);
