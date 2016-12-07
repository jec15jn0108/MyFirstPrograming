<?php
/*
* FileName : stage.php
* Author   : Onogaki Kaichi
* Remark   : stageテーブルへアクセスするクラス
*/
include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/db_operator.php');

class Stage extends DbOperator {

 /*=========================================================
  * SELECT
  ==========================================================*/

 /*
  * 全部取得するよ
  */
 function selectStageAll(){
   $sql = "SELECT * FROM stage";

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
 function selectStage($teamId, $stageId){
   $sql = "SELECT * FROM stage WHERE stageID = :stageId AND teamID = :teamId";
   $stmt = $this->pdo->prepare($sql);
   $stmt->bindParam(':stageId', $stageId, PDO::PARAM_STR);
   $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);

   try{
     $stmt->execute();
   }catch (PDOException $e){
     print($e->getMessage() . '<br>');
     return -1;
   }

   return $stmt;
 }

 /*
  * genreIDごとにSELECT
  */
  function selectStageGenre($teamID, $genreID){
    $sql = "SELECT * FROM stage WHERE teamID = :teamId AND genreID = :genreId";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);
    $stmt->bindParam(':genreId', $genreId, PDO::PARAM_STR);

    try{
      $stmt->execute();
    }catch (PDOException $e){
      print($e->getMessage() . '<br>');
      return false;
    }

    return $stmt;
  }

  /*=========================================================
   * INSERT
   ==========================================================*/
 /*
  *  stageテーブルへINSERT
  */
 function insertStage($teamId, $genreId, $stageFileUrl, $answerFileUrl, $stageNumber){
   $sql = "INSERT INTO stage (
     teamID, genreID, stageFileUrl, answerFileUrl, stageNumber
   ) VALUES(
     :teamId, :genreId, :stageFileUrl, :answerFileUrl, :stageNumber
   )";
   $stmt = $this->pdo->prepare($sql);
   $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);
   $stmt->bindParam(':genreId', $genreId, PDO::PARAM_STR);
   $stmt->bindParam(':stageFileUrl', $stageFileUrl, PDO::PARAM_STR);
   $stmt->bindParam(':answerFileUrl', $answerFileUrl, PDO::PARAM_STR);
   $stmt->bindParam(':stageNumber', $stageNumber, PDO::PARAM_INT);
   try{
     $stmt->execute();
   }catch (PDOException $e){
     print($e->getMessage() . '<br>');
     return false;
   }

   return $stmt->rowCount();
 }


 /*=========================================================
  * DELETE
  ==========================================================*/
 /*
  *  stageテーブルから1行DELETE
  */
 function deleteStage($teamId, $stageId){
   $sql = "DELETE FROM stage WHERE stageID = :stageId AND teamID = :teamId";
   $stmt = $this->pdo->prepare($sql);
   $stmt->bindParam(':stageId', $stageId, PDO::PARAM_STR);
   $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);

   try{
     $stmt->execute();
   }catch (PDOException $e){
     print($e->getMessage() . '<br>');
     return false;
   }

   return $stmt->rowCount();
 }


 /*=========================================================
  * UPDATE
  ==========================================================*/
 /*
  * stageテーブルの
  * genreID を更新
  */
function updateStageGenre($teamId, $stageId, $value){
  $sql = "UPDATE stage SET genreID = :value WHERE stageID = :stageId AND teamID = :teamId";
  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':value', $value, PDO::PARAM_STR);
  $stmt->bindParam(':stageId', $stageId, PDO::PARAM_STR);
  $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage() . '<br>');
    return false;
  }
  return $stmt->rowCount();
}


 /*
  * stageテーブルの
  * stageNumber を更新
  */
function updateStageNumber($teamId, $stageId, $value){
  $sql = "UPDATE stage SET stageNumber = :value WHERE stageID = :stageId AND teamID = :teamId";
  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':value', $value, PDO::PARAM_STR);
  $stmt->bindParam(':stageId', $stageId, PDO::PARAM_STR);
  $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage() . '<br>');
    return false;
  }
  return $stmt->rowCount();
}

}
