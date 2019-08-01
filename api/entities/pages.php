<?php
class Page{
    private $connection;
    private $table_name = "pages";

    public $id;
    public $name;
    public $html;
    public $json;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function index(){
        $sql = 'SELECT id, name FROM pages ORDER BY id DESC';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function view($id){
        $sql = 'SELECT id, name, html FROM pages WHERE id ='.$id;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function updateMeta($name, $id){
        $sql = 'UPDATE pages SET name=? WHERE id=?';
        $stmt = $this->connection->prepare($sql);
        if($stmt->execute([$name, $id])){
            return true;
        }else{
            return false;
        }
    }
    public function updatePage($html, $id){
        $sql = 'UPDATE pages SET html=? WHERE id=?';
        $stmt = $this->connection->prepare($sql);
        if($stmt->execute([$html, $id])){
            return true;
        }else{
            return false;
        }
    }
    public function delete($id){
        $sql = 'DELETE FROM pages WHERE id ='.$id;
        $stmt = $this->connection->prepare($sql);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function create($name, $html){
        $sql = "INSERT INTO pages (name, html, json) VALUES (?,?,?)";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute([$name, $html, $html]);
        return $this->view($this->connection->lastInsertId());
    }
}
?>