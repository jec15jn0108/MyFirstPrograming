<?php
/*
 * FileName : test_data.php
 * Author   : onogaki
 * Summary  : テスト用データ入れるよ（実装前用）
 */
try{
  $pdo = new PDO('mysql:host=localhost;dbname=dbg02_15jn1', 'dbg02_15jn1', 'dbg02_15jn1');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "INSERT INTO ";

  print("さくせす");
}catch(PDOException $e){
  print($e->getMessage());
}
