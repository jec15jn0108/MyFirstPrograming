<?php
/**
 * FileName: add_clear_num.php
 * @author Onogaki
 * Date   : 2017.02.01
 * Remark : progressテーブルのステージクリア数更新
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/progress.php');

$pgr = new Progress();

$teamId = $_POST["teamId"];
$accountId = $_POST["accountId"];
$number = $_POST["number"];

$pgr->addClearNum($teamId, $accountId, $number);
