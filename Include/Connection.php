<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$db = "ktech";

$conn = mysqli_connect($serverName, $userName, $password, $db);

if (!$conn) {
    die("Connection Failed");
}
?>