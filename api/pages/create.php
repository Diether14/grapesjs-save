<?php
header('Access-Control-Allow-Origin: *');
include_once '../config/dbclass.php';
include_once '../entities/pages.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$name = $_POST['name'];
$html = $_POST['html'];
$page = new Page($connection);
$stmt = $page->create($name, $html);
$count = $stmt->rowCount();
if($count > 0){
    $pages = array();
    $pages['body'] = array();
    $pages['count'] = $count;

    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
}else{
    echo json_encode(array('body' => array()));
}
?>