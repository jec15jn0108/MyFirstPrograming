<?php
/*
 * FileName : progress.php
 * Author   : Oouch Yuuki
 * Remark   : team_progressテーブルへアクセスするクラス
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/db/db_operator.php');

class Progress extends DbOperator {

/* 全件取得 */
function selectProgressAll(){
  $sql = "SELECT * FROM progress";

  try{
    $ret = $this->pdo->query($sql);
  }catch (PDOException $e){
    print($e->getMessage());
    return false;
  }

  return $ret;
}

/* 生徒IDごとのselect */
function selectAccountidProgress($teamId, $accountId){
  $sql = "SELECT * FROM progress WHERE accountID = :acId AND teamID = :teId";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':acId', $accountId, PDO::PARAM_STR);
  $stmt->bindParam(':teId', $teamId, PDO::PARAM_STR);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage() . '<br>');
    return false;
  }

  return $stmt;
}

/* 1行select */
function isExist($progressNumber, $accountId, $teamId){
  $sql = "SELECT COUNT(*) AS cnt FROM progress WHERE progressNumber = :pgnum AND accountID = :acId AND teamID = :teId";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':pgnum', $progressNumber, PDO::PARAM_INT);
  $stmt->bindParam(':acId', $accountId, PDO::PARAM_STR);
  $stmt->bindParam(':teId', $teamId, PDO::PARAM_STR);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage() . '<br>');
    return false;
  }

  return $stmt->fetch(PDO::FETCH_ASSOC)["cnt"];
}

/* count取得用select */
function getCountById($teamId, $accountId){
  $sql = "SELECT COUNT(*) AS count FROM progress WHERE accountID = :acId AND teamID = :teId";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':acId', $accountId, PDO::PARAM_STR);
  $stmt->bindParam(':teId', $teamId, PDO::PARAM_STR);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage() . '<br>');
    return false;
  }

  return $stmt->fetch(PDO::FETCH_ASSOC)["count"];
}
/* progressテーブルに1行INSERT */
function insertProgress($progressNumber, $accountId, $teamId, $clearNum, $nowStage){
  $sql = "INSERT INTO dbg02_15jn1.progress VALUES (:progressNumber,:accountID,:teamID,:clearNum,:nowStage)";
  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':progressNumber', $progressNumber,PDO::PARAM_STR);
  $stmt->bindParam(':accountID', $accountId, PDO::PARAM_STR);
  $stmt->bindParam(':teamID',$teamId, PDO::PARAM_STR);
  $stmt->bindParam(':clearNum',$clearNum, PDO::PARAM_INT);
  $stmt->bindParam(':nowStage',$nowStage, PDO::PARAM_INT);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage());
    return false;
  }
  return $stmt->rowCount();
}


/* progressテーブルから1行DELETE */
function deleteProgress($teamId, $accountId, $number){
  $sql = "DELETE FROM progress WHERE accountID = :accountId AND teamID = :teamId AND progressNumber = :num";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);
  $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
  $stmt->bindParam(':num', $number, PDO::PARAM_STR);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage() . '<br>');
    return false;
  }

  return $stmt->rowCount();
}

/*teamIDを元にすべてを無に還す*/
function deleteProgressAll($teamId){
  $sql = "DELETE FROM progress WHERE teamID = :teamId";
  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam('teamId', $teamId, PDO::PARAM_STR);

  try{
    $result = $stmt->execute();
  } catch (PDOException $e){
    print($e->getMessage() . '<br />');
    return false;
  }
  return $stmt->rowCount();
}

/*
 *　UPDATE類
 */

/* progressテーブルのclearNumをUPDATE */
function addClearNum($teamId, $accountId, $number){
  $sql = "UPDATE progress SET clearNum = clearNum + 1 WHERE accountID = :accountId AND teamID = :teamId AND progressNumber = :num";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
  $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);
  $stmt->bindParam(':num', $number, PDO::PARAM_STR);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage() . '<br>');
    return false;
  }
  return $stmt->rowCount();
}

/* progressテーブルのnowStageをUPDATE */
function updateNowStage($teamId, $accountId, $number, $value){
  $sql = "UPDATE progress SET nowStage = :value WHERE accountID = :accountId AND teamID = :teamId AND progressNumber = :num";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':value', $value, PDO::PARAM_INT);
  $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
  $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);
  $stmt->bindParam(':num', $number, PDO::PARAM_STR);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage() . '<br>');
    return false;
  }
  return $stmt->rowCount();
}

}
