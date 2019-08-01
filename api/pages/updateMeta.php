<?php
header('Access-Control-Allow-Origin: *');
include_once '../config/dbclass.php';
include_once '../entities/pages.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$name = $_POST['name'];
$id = $_POST['id'];
$page = new Page($connection);
$stmt = $page->updateMeta($name, $id);
if($stmt){
    echo 'Page Succesfuly edited';
}
else{
    echo 'Error';
}
?>