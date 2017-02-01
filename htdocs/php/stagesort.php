<?php
/*
 *  FileName: account.php
 *  Author  :aaaaa
 *  Remark  : accountテーブルへアクセスするクラス
 */

 include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/stage.php');

 $st = new Stage();

 $list = $_POST['list'];
 $genre = $_POST['genre'];
 $team = $_COOKIE['team'];

 if ((empty($list)) === false) {

   $sortlist = explode(",", $list);

   for ($i = 1; $i < count($sortlist) + 1; $i++) {
    
  }
}
