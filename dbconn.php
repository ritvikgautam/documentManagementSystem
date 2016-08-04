<?php
$servername = "localhost";
$susername = "root";
$spassword = "123456";
$dbname = "alphara";
$conn = mysql_connect($servername, $susername, $spassword);
mysql_select_db('alphara', $conn);
/*if ($conn->connect_error) {
    die("Connection failed with database! " . $conn->connect_error);
}*/ 

?>