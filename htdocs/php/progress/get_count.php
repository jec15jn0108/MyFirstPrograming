<?php
/**
 * FileName: get_count.php
 * @author Onogaki
 * Date   : 2017.02.01
 * Remark : 指定の生徒アカウントでログイン中の人数を取得
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/progress.php');

$teamId = $_POST["teamId"];
$stId = $_POST["stId"];

$prg = new Progress();

$cnt = $prg->getCountById($teamId, $stId);

echo($cnt);
