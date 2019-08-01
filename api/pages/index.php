<?php
header('Access-Control-Allow-Origin: *');
include_once '../config/dbclass.php';
include_once '../entities/pages.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$page = new Page($connection);
$stmt = $page->index();
$count = $stmt->rowCount();

if($count > 0){
    $pages = array();
    $response = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $p = array(
            "id" => $id,
            "name" => $name,
        );

        array_push($response, $p);
    }

    echo json_encode($response);
}else{
    echo json_encode(array('body' => array(), 'count' => 0));
}


?>