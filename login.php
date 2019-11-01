<?php
include 'Include/Connection.php';
session_start();
$msg = "";

?>

<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];

    $sql = "SELECT * FROM Admin WHERE Admin_pass='$userpass' AND Admin_Name='$username'";
    $run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($run) > 0) {
        $_SESSION['Access'] = true;
        header("Location:http://localhost/ktech/admin.php");
    } else {
        $msg = "WRONG USER NAME OR PASSWORD!";
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>

<body>

    <header>
        <div class="logo">
            <img src="images/logo.png" alt="logo" width="100%" height="100%">
        </div>
        <h3>KTECH</h3>
    </header>


    <div class="main_section">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="username" placeholder="Admin User Name" required>
            <input type="password" name="userpass" placeholder="Password" required>
            <p><?php echo ($msg); ?> </p>
            <br>
            <input type="submit" name="login" id="login_btn">
        </form>

    </div>

</body>

</html>