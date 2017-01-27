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
function selectAccountidProgress($accountId, $teamId){
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
function selectProgress($progressNumber, $accountId, $teamId){
  $sql = "SELECT * FROM progress WHERE progressNumber = :pgnum AND accountID = :acId AND teamID = :teId";

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

  return $stmt;
}

/* count取得用select */
function selectCount($progressNumber, $accountId, $teamId){
  $sql = "SELECT COUNT(*) AS count FROM progress WHERE progressNumber = :pgnum AND accountID = :acId AND teamID = :teId";

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
function deleteProgress($accountId, $teamId){
  $sql = "DELETE FROM progress WHERE accountID = :accountId AND teamID = :teamId";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
  $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);

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
function updateClearNum($accountId, $teamId, $value){
  $sql = "UPDATE progress SET clearNum = :value WHERE accountID = :accountId AND teamID = :teamId";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':value', $value, PDO::PARAM_INT);
  $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
  $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);

  try{
    $stmt->execute();
  }catch (PDOException $e){
    print($e->getMessage() . '<br>');
    return false;
  }
  return $stmt->rowCount();
}

/* progressテーブルのnowStageをUPDATE */
function updateNowStage($accountId, $teamId, $value){
  $sql = "UPDATE progress SET nowStage = :value WHERE accountID = :accountId AND teamID = :teamId";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':value', $value, PDO::PARAM_INT);
  $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
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
