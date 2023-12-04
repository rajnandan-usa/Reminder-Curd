<?php

ini_set('display_errors', 1);
ini_set('upload_max_filesize', "400M");
ini_set('post_max_size', '400M');
ini_set('max_input_time', 600);
ini_set('max_execution_time', 600);
date_default_timezone_set("Asia/Calcutta"); 

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'crud_reminder';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
