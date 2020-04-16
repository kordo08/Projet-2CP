<?php
 
 class dbh{
  private $host="localhost";
  private $user="root";
  private $password="";
  private $dbName="projet";
  protected function connect()
  {
  try{
  $pdo= new PDO("mysql::host=$this->host;dbname=$this->dbName",$this->user,$this->password);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
   echo "oooops sorry something went wrong with the connection :( <br>".$e->getMessage();
  }
  return $pdo;
  }
 } 
 
?> 