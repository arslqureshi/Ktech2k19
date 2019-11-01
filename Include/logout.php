<?php
session_start();
unset($_SESSION['Access']);
header("Location:http://localhost/ktech/login.php");
