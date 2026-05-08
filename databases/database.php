<?php

class Database{
    private $host = "localhost";
    private $db_name="livraria";
    private $username="root";
    private $password="";
    public $conn;

    public function getConnection(){
        $this->conn=null;
        try{
            $this->connect = new PDO("mysql:host=" .$this->host.";dbname" .$this->password );
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo"Erro de conexão" .$exception->getMessage();
        }
        return $this->conn;
    }
}
?>