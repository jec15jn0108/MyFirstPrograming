<?php
/*
 * FileName : db_operator.php
 * Author   : Onogaki Kaichi
 * Remark   : データベースアクセス系のスーパークラス
 */

class DbOperator {

 protected $pdo = null;

 private $dsn = "mysql:host=localhost;dbname=dbg02_15jn1";
 private $user = "dbg02_15jn1";
 private $pass = "dbg02_15jn1";

 function __construct() {
   try{
     $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
     $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }catch (PDOException $e){
     print('Connection failed:' . $e->getMessage() . '<br>');
   die();
   }
 }

 function __destruct(){
   $this->pdo = null;
 }
}
