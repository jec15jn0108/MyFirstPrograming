<?php
/*
 *  FileName: account.php
 *  Author  :張
 *  Remark  : accountテーブルへアクセスするクラス
 */
 include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/db/db_operator.php');

 class Account extends DbOperator{
   function insertAccount($NewId,$NewTeamId,$NewPass,$isTeacher){
     $sql = "INSERT INTO dbg02_15jn1.account VALUES (:NewId,:NewTeamId,:NewPass,:isTeacher)";
     $stmt = $this->pdo->prepare($sql);
     $stmt->bindParam(':NewId', $NewId,PDO::PARAM_STR);
     $stmt->bindParam(':NewTeamId', $NewTeamId, PDO::PARAM_STR);
     $stmt->bindParam('NewPass',$NewPass, PDO::PARAM_STR);
     $stmt->bindParam(':isTeacher',$isTeacher, PDO::PARAM_STR);

     try{
       $stmt->execute();
     }catch (PDOException $e){
       print($e->getMessage());
       return false;
     }
     return $stmt->rowCount();
   }

   function getAllAccount(){
     $sql = "SELECT * FROM account";
     try{
       $stmt = $this->pdo->query($sql);
       // $result = $stmt->fetch(PDO::FETCH_ASSOC);
     } catch (PDOException $e) {
      print($e->getMessage() . '<br />');
       return false;
     }
     return $stmt;
   }

    /*studentテーブルより１行SELECT*/
   function selectAccount($accountId){
     $sql = "SELECT * FROM account WHERE accountID = :accountId";
     $stmt = $this->pdo->prepare($sql);
     $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);

     try{
       $stmt->execute();
     }catch (PDOException $e){
       print($e->getMessage() . '<br />');
       return false;
     }
     return $stmt;
   }

   /*アカウントテーブルより同一団体内すべてのstudentアカウントIDを取得*/
   function selectStudentAccount($teamId){
     $sql = "SELECT * FROM account WHERE teamID = :teamId AND isTeacher = 0";
     $stmt = $this->pdo->prepare($sql);
     $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);
    //  $stmt->bindParam(':isteacher', $isTeacher, PDO::PARAM_STR);

     try{
       $stmt->execute();
     }catch (PDOException $e){
       print($e->getMessage() . '<br />');
       return false;
     }
     $result = $stmt->fetchall(PDO::FETCH_COLUMN, 0);
     return $result;
   }

   /* ユーザ認証 */
   function athentication($teamId, $accountId, $pass) {
    //  $sql = "SELECT * FROM account WHERE teamID = :teamId AND accountID = :accountId AND pass = :pass";
     $sql = "SELECT * FROM account WHERE teamID = :teamId AND accountID = :accountId";
     $stmt = $this->pdo->prepare($sql);
     $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);
     $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
    //  $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

     try{
       $stmt->execute();
     }catch (PDOException $e){
       print($e->getMessage() . '<br />');
       return false;
     }

     $result = password_verify($pass, $stmt->fetch(PDO::FETCH_ASSOC)["pass"]);

     if ($stmt->rowCount() == 1 && $result == true) {
       return true;
     } else {
       return false;
     }
   }

   /* 同一アカウントがあるかどうか調べる */
   function overlapCheck($teamId, $accountId) {
    //  $sql = "SELECT * FROM account WHERE teamID = :teamId AND accountID = :accountId AND pass = :pass";
     $sql = "SELECT * FROM account WHERE teamID = :teamId AND accountID = :accountId";
     $stmt = $this->pdo->prepare($sql);
     $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);
     $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);

     try{
       $stmt->execute();
     }catch (PDOException $e){
       print($e->getMessage() . '<br />');
       return false;
     }

     if ($stmt->rowCount() == 1) {
       return true;
     } else {
       return false;
     }
   }

   /* 教師用IDかどうかを判定する　*/
    function isTeacher($accountId, $teamId){
      $sql = "SELECT * FROM account WHERE teamID = :teamId AND accountID = :accountId";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
      $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);

      try{
        $stmt->execute();
      }catch(PDOException $e){
        print($e->getMessage() . '<br />');
        return false;
      }

      $result = $stmt->fetch(PDO::FETCH_ASSOC)["isTeacher"];

      if ($stmt->rowCount() == 1 && $result == 1) {
        return true;
      } else {
        return false;
      }
    }

  /* studentテーブルより１行DELEAT */
   function deleteAccount($accountId,$teamId){
     $sql = "DELETE FROM account WHERE accountID = :accountId AND teamID = :teamId";
     $stmt = $this->pdo->prepare($sql);
     $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
     $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);

     try{
       $result = $stmt->execute();
     }catch (PDOException $e){
       print($e->getMessage() . '<br />');
       return false;
     }
     return $stmt->rowCount();
   }

     /* studentテーブルのパスワード(pass)の更新　*/
   function updateAccountPass($accountId,$teamId,$Newpass){
     $sql = "UPDATE account SET pass = :Newpass WHERE accountID = :accountId AND teamID = :teamId";
     $stmt = $this->pdo->prepare($sql);
     $stmt->bindParam(':Newpass', $Newpass, PDO::PARAM_STR);
     $stmt->bindParam(':accountId', $accountId, PDO::PARAM_STR);
     $stmt->bindParam(':teamId', $teamId, PDO::PARAM_STR);

     try{
      $stmt->execute();
     }catch (PDOException $e){
       print($e->getMessage());
     }
     return $stmt->rowCount();
   }
}
