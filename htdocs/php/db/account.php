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

   function geAlltAccount(){
     $sql = "SELECT * FROM account";
     try{
       $stmt = $this->pdo->query($sql);
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

  /* studentテーブルより１行DELEAT */
   function deleteAccount($accountId,$teamId){
     $sql = "DELETE FROM account WHERE accountID = :accountId AND teamID = :teamId";
     $stmt = $this->pdo->prepare($sql);
     $stmt->bindParam(':accountId', $studentId, PDO::PARAM_STR);
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
