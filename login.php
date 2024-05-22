<?php
include('connect.php');

session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM employee WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count && $row['admin'] == 1) {
        $_SESSION['id'] = $row['employeeID'];
        $_SESSION['user'] = $row['username'];
        $_SESSION['position'] = $row['position'];
        $_SESSION['adminAccess'] = $row['admin'];
        header("Location: dashboard.php");
    } else if ($count && $row['admin'] == 0) {
        $_SESSION['id'] = $row['employeeID'];
        $_SESSION['user'] = $row['username'];
        $_SESSION['position'] = $row['position'];
        $_SESSION['adminAccess'] = $row['admin'];
        header("Location: pos.php");
    } else {
        echo  '<script>
                    alert("Login failed. Invalid username or password!")
                </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="images/logo.svg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/global.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/global.css">

</head>

<body>
    <div id="container">
        <div id="logos">
            <img src="images/logo.svg" alt="logo" draggable="false" />
        </div>
        <div id="loginbox">
            <form id="loginForm" method="POST" action="#">
                <div id="usernameSect">
                    <label> Username </label><br>
                    <div class="inputbox">
                        <input name="user" type="text" placeholder="Enter Username" autofocus required autocomplete="off"><br>
                    </div>
                </div>
                <div id="passwordSect">
                    <label> Password </label><br>
                    <div class="inputbox">
                        <input name="pass" type="password" placeholder="Enter password" id="passInput" required autocomplete="off">
                        <img src="images/hidden.png" onclick="togglePass()" id="passIcon">
                    </div>
                </div>
                <input id="submitbtn" name="submit" type="submit" value="LOGIN">
            </form>
        </div>
    </div>
</body>

</html>