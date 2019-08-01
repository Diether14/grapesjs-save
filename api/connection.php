<?php
    $user = 'root';
    $pass = '';
    $pdo = new PDO('mysql:host=localhost;dbname=react_db', $user, $pass);
    header('Access-Control-Allow-Origin: *');
?>