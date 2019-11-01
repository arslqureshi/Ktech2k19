<?php
include 'Connection.php';

session_start();
if (($_SESSION['Access']) != true) {
    header("Location:http://localhost/ktech/login.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM COMPETITION WHERE Competition_Id= '$id'";
    $run = mysqli_query($conn, $sql);
    header("Location:http://localhost/ktech/admin.php");
} else {
    echo ("NO");
}
