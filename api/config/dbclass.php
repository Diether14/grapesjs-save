<?php
class DBClass {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "grapes";

    public $connection;

    public function getConnection(){
        $this->connection = null;
        try{
            $this->connection = new PDO('mysql:host=localhost;dbname=grapes', $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOExeption $exeption){
            echo "Error: " . $exeption->getMessage();
        }
        return $this->connection;
    }
}
?>