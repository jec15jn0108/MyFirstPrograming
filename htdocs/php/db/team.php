<?php
/*
 * FileName : team.php
 * Author   : Onogaki Kaichi
 * Remark   : teamテーブルへアクセスするクラス
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/db_operator.php');

class Team extends DbOperator {

  /*
   * 全部取得するよ
   */
  function selectTeamAll(){
    $sql = "SELECT * FROM team";

    try{
      $ret = $this->pdo->query($sql);
    }catch (PDOException $e){
      print($e->getMessage());
      return false;
    }

    return $ret;
  }

  /*
   * 1行SELECT
   */
  function selectTeam($teamId){
    $sql = "SELECT * FROM team WHERE teamID = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $teamId, PDO::PARAM_STR);

    try{
      $stmt->execute();
    }catch (PDOException $e){
      print($e->getMessage() . '<br />');
      return false;
    }

    return $stmt->rowCount();
  }

  function selectTeamName($teamId){
    $sql = "SELECT * FROM team WHERE teamID = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $teamId, PDO::PARAM_STR);

    try{
      $stmt->execute();
    }catch (PDOException $e){
      print($e->getMessage() . '<br />');
      return false;
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC)["teamName"];

    return $result;
  }

  /*
   *  teamテーブルへINSERT
   */
  function insertTeam($teamId, $teamName){
    $sql = "INSERT INTO team VALUES(:id, :name)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $teamId, PDO::PARAM_STR);
    $stmt->bindParam(':name', $teamName, PDO::PARAM_STR);

    try{
      $result = $stmt->execute();
    }catch (PDOException $e){
      print($e->getMessage() . '<br />');
      return false;
    }

    return $stmt->rowCount();
  }


  /*
   *  teamテーブルから1行削除
   */
  function deleteTeam($teamId){
    $sql = "DELETE FROM team WHERE teamID = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $teamId, PDO::PARAM_STR);

    try{
      $result = $stmt->execute();
    }catch (PDOException $e){
      print($e->getMessage() . '<br />');
      return false;
    }

    return $stmt->rowCount();
  }
}
