<?php
/*
 * FileName : genre.php
 * Author   : Onogaki Kaichi
 * Remark   : genreテーブルへアクセスするクラス
 */
include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/db_operator.php');

 class Genre extends DbOperator {

   /*=========================================================
    * SELECT
    ==========================================================*/
   /*
    * 全部取得するよ
    */
   function selectGenreAll(){
     $sql = "SELECT * FROM genre";

     try{
       $ret = $this->pdo->query($sql);
     }catch (PDOException $e){
       print($e->getMessage() . '<br>');
     }

     return $ret;
   }

   /*
    * 1行SELECT
    */
   function selectStage($genreId){
     $sql = "SELECT * FROM genre WHERE genreID = :genreId";
     $stmt = $this->pdo->prepare($sql);
     $stmt->bindParam(':genreId', $genreId, PDO::PARAM_STR);

     try{
       $stmt->execute();
     }catch (PDOException $e){
       print($e->getMessage() . '<br>');
       return false;
     }

     return $stmt;
   }
