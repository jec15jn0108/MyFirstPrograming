<?php
/*
 * FileName : create_table.php
 * Author   : onogaki
 * Summary  : テーブル作成（実装前用）
 */

try{
  $pdo = new PDO('mysql:host=localhost;dbname=dbg02_15jn1', 'dbg02_15jn1', 'dbg02_15jn1');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "CREATE TABLE team (
    teamID char(32),
    teamName nvarchar(64),
    PRIMARY KEY(teamID)
   )";

  $pdo->exec($sql);

  echo "teamさくせす<br />";

  // $sql = "CREATE TABLE teacher (
  //   teacherID char(16),
  //   teamID char(16),
  //   teacherName nvarchar(63),
  //   pass char(64),
  //   PRIMARY KEY(teacherID, teamID),
  //   FOREIGN KEY(teamID)
  //   REFERENCES team(teamID)
  //  )";
  //
  // $pdo->exec($sql);
  //
  // echo "teacherさくせす<br />";
  //
  // $sql = "CREATE TABLE student (
  //   studentID char(16),
  //   teamID char(16),
  //   pass char(64),
  //   num int,
  //   PRIMARY KEY(studentID, teamID),
  //   FOREIGN KEY(teamID)
  //   REFERENCES team(teamID)
  //  )";
  //
  // $pdo->exec($sql);
  //
  // echo "studentさくせす<br />";

  $sql = "CREATE TABLE account (
    accountID char(32),
    teamID char(32),
    pass char(255) not null,
    isTeacher bit not null,
    PRIMARY KEY(accountID, teamID),
    FOREIGN KEY(teamID)
    REFERENCES team(teamID)
   )";

  $pdo->exec($sql);

  echo "studentさくせす<br />";

  $sql = "CREATE TABLE genre (
    genreID int,
    genreName char(10),
    PRIMARY KEY(genreID)
   )";

  $pdo->exec($sql);

  echo "genreさくせす<br />";

  $sql = "INSERT INTO genre VALUES (1, '順次')";
  $pdo->exec($sql);
  $sql = "INSERT INTO genre VALUES (2, '判断')";
  $pdo->exec($sql);
  $sql = "INSERT INTO genre VALUES (3, '繰返し')";
  $pdo->exec($sql);
  $sql = "INSERT INTO genre VALUES (4, '応用')";
  $pdo->exec($sql);



  $sql = "CREATE TABLE stage (
    stageName char(32),
    teamID char(32),
    genreID int,
    stageFileUrl varchar(255),
    stageNumber int,
    PRIMARY KEY(stageName, teamID),
    FOREIGN KEY(teamID)
    REFERENCES team(teamID),
    FOREIGN KEY(genreID)
    REFERENCES genre(genreID)
   )";

  $pdo->exec($sql);

  echo "stageさくせす<br />";

  $sql = "CREATE TABLE progress (
    progressNumber char(20),
    accountID char(32),
    teamID char(32),
    clearNum int,
    nowStage char(64),
    PRIMARY KEY(progressNumber, accountID, teamID),
    FOREIGN KEY(accountID)
    REFERENCES account(accountID),
    FOREIGN KEY(teamID)
    REFERENCES team(teamID)
   )";

  $pdo->exec($sql);

  echo "progressさくせす<br />";
}catch (PDOException $e){
  echo $e->getMessage();
}
