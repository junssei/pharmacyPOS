<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee</title>
    <link rel="icon" type="image/x-icon" href="images/logo.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/global.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/global.css">
</head>

<body onload="whenActive()">
    <div class="container">
        <?php include('sidebar.php') ?>
        <div class="main">
            <div class="header">
                <div class="icon">
                    <!-- <img class="togglesidebar" src="images/equal.png" alt="toggle" draggable="false"> -->
                </div>
                <div class="timendate">
                    <p class="datime">00:00:00 AM</p>
                    <p class="dadate">Monday, June 12, 2003</p>
                </div>
            </div>

            <div class="content">
                <div class="directory">
                    <div class="directoryinfo">
                        <h1> Employee's </h1>
                        <p> Add, Edit and Delete an Employee </p>
                    </div>
                    <div class="addbtn">
                        <button class="addbtn" onclick="addMedicine()"><img src="images/addUser.svg"> Add Employee </button>
                    </div>
                </div>
                <div class="subcontent">
                    <div class="contentTable">
                        <table class="rowNumbers">
                            <tr>
                                <th> ID </th>
                                <th> Username </th>
                                <th> Password </th>
                                <th> Position </th>
                                <th> Access </th>
                                <th> Action </th>
                            </tr>
                            <?php
                            $fetchEmployee = "SELECT * FROM employee";
                            $exec = mysqli_query($conn, $fetchEmployee);

                            while ($rowMed = mysqli_fetch_array($exec)) {
                                echo "<tr>";
                                echo "<td>" . $rowMed['employeeID'] . "</td>";
                                echo "<td>" . $rowMed['username'] . "</td>";
                                echo "<td>" . $rowMed['password'] . "</td>";
                                echo "<td>" . $rowMed['position'] . "</td>";
                                echo "<td>" . $rowMed['admin'] . "</td>";
                                echo "<td> <a class='editBtn' href='editEmployee.php?employeeID=$rowMed[0]'>Edit</a>
                                <a class='deltBtn' href='delete.php?employeeID=$rowMed[0]'>Delete</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="popupContainer">
                <div class="popupContent">
                    <form action="employee.php" method="POST" autocomplete="off">
                        <div class="popupForm">
                            <label> Username </label>
                            <input name="username" type="text" placeholder="Enter Username" required>
                            <label> Password </label>
                            <input name="password" type="password" placeholder="Enter Password" required>
                            <label> Position </label>
                            <input name="position" type="text" placeholder="Enter Position" required>
                            <label class="adminLabel"> Admin
                                <label class="switch">
                                    <input name="adminAccess" type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </label>

                        </div>
                        <div class="popupConfirmation">
                            <input class="popupBtn" type="submit" name="submit" value="Add"></input>
                            <input class="popupBtn" type="reset" onclick="addMedicine()" value="Cancel"></input>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $position = ucwords($_POST['position']);
                        if ($_POST['adminAccess'] == 'on') {
                            $access = 1;
                        } else {
                            $access = 0;
                        }

                        $sql = "INSERT INTO employee VALUES ('', '$username', '$password', '$position', '$access')";
                        $query = mysqli_query($conn, $sql);

                        if ($query) {
                            echo "<script> window.location.href = 'employee.php' </script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>