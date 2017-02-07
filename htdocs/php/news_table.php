<?php

class NewsTable {

  private $dns = "mysql:dbname=takmi_news;host=localhost";
  private $user = "takmi";
  private $pass = "mclt";
  private $pdo = null;

  function __construct(){
    try {
      $this->pdo = new PDO($this->dns, $this->user, $this->pass);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      print('Connection Error. <br />');
      print($e->getMessage());
    }
  }

  function __destruct(){
    $this->pdo = null;
  }

  function addNews($title, $contents){
    $sql = 'INSERT INTO news VALUES(NOW(), :title, :contents)';

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':contents', $contents, PDO::PARAM_STR);

    try{
      $stmt->execute();
    }catch(PDOException $e){
      print($e->getMassage());
    }
  }

  function showAllNews(){
    $sql = 'SELECT * FROM news ORDER BY date DESC';

    try{
      $stmt = $this->pdo->query($sql);

      while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

        $date = substr($result['date'], 0, 10);

        print('<h3>' . $result['title'] . '</h3>');
        print('<h5>' . $date . '</h5>');
        print('<p>' . $result['contents'] . '</p>');
      }

    }catch(PDOException $e){
      print($e->getMassage());
    }

  }


  function show5News(){
    $sql = 'SELECT * FROM news ORDER BY date DESC';
    try{
      $stmt = $this->pdo->query($sql);

      $retStr = "";
      for ($i=0; $i < 5; $i++) {
        if($result = $stmt->fetch(PDO::FETCH_ASSOC)){

          $retStr .= '<a href="/news"><h4>' . $result['title'] . '</h4></a>';
          $retStr .= '<p>' . $result['contents'] . '</p>';
        }
      }

    }catch(PDOException $e){
      print($e->getMassage());
    }

    return $retStr;
  }
}
