<?php

class DBConnection{
  const DB_USER = "root";
  const DB_PASS = "";
  private $pdo_object;

  public function __construct(){
    $this->dsn = "mysql:host=localhost;dbname=news";
    $this->pdo_object = new PDO($this->dsn,DBConnection::DB_USER,DBConnection::DB_PASS);
    $this->pdo_object->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    $this->pdo_object->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE);
    $this->pdo_object->exec("SET NAMES utf8");
  }

  public function insertToTable($sql,$args=array()){
    $sql = "insert into user values()"
    $this->pdo_object->prepare($sql);
    $this->pdo_object->exec($args);
  }
}

?>