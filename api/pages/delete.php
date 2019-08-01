<?php
header('Access-Control-Allow-Origin: *');
include_once '../config/dbclass.php';
include_once '../entities/pages.php';
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$page = new page($connection);
$id = $_REQUEST['id'];
if($page->delete($id)){
    echo json_encode(array('success' => true, 'message' => 'record deleted'));
}
else{
    echo json_encode(array('success' => false, 'message' => 'record not deleted'));
}

?>