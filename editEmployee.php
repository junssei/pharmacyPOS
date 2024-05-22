<?php include('connect.php');
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
    <title>Edit</title>
    <link rel="icon" type="image/x-icon" href="images/logo.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/global.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/edit.css">
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
            <div class="content employee">
                <div class="directory">
                    <div class="directoryinfo">
                        <h1 style="color:gray"> Employee <p>/ Edit</p>
                        </h1>
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    </div>
                </div>
                <div class="subcontent">
                    <?php
                    if ($_GET['employeeID']) {
                        echo "<style> .employee{ display: block; } </style>";
                        $eID = $_GET['employeeID'];
                        $sql = "SELECT * FROM employee WHERE employeeID = '$eID'";
                        $result = mysqli_query($conn, $sql);
                        $rowEmployee = mysqli_fetch_array($result);
                    } else {
                        echo "<script> window.location.href = 'employee.php'; </script>";
                    }
                    ?>
                    <form action="editEmployee.php" method="POST" autocomplete="off">
                        <div class="editForm">
                            <input name="eID" type="hidden" value='<?php echo $rowEmployee['employeeID'] ?>' required> </input>
                            <label> Username </label>
                            <input name="username" type="text" placeholder="Enter Username" value='<?php echo $rowEmployee['username'] ?>' autofocus required>
                            <label> Password </label>
                            <input name="password" type="password" placeholder="Enter Password" value='<?php echo $rowEmployee['password'] ?>' required>
                            <label> Position </label>
                            <input name="position" type="text" placeholder="Enter Position" value='<?php echo $rowEmployee['position'] ?>' required>
                            <label class="adminLabel"> Admin
                                <label class="switch">
                                    <input name="adminAccess" type="checkbox" <?php if ($rowEmployee['admin'] == 1) { ?> value="on" checked <?php } else {  ?> "" <?php } ?>>

                                    <span class="slider round"></span>
                                </label>
                            </label>
                        </div>
                        <div class="editConfirmation">
                            <input class="editBtns" type="Submit" name="editSubmitE" value="Save">
                            <input class="editBtns" type="Submit" name="editCancelE" value="Cancel">
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['editSubmitE'])) {
                        $eID = $_POST['eID'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $position = $_POST['position'];
                        if ($_POST['adminAccess'] == 'on') {
                            $access = 1;
                        } else {
                            $access = 0;
                        }

                        $update_Employee = "UPDATE employee SET username = '$username', password = '$password', position = '$position', admin = '$access' WHERE employeeID = '$eID'";
                        $update_resultE = mysqli_query($conn, $update_Employee);

                        if ($update_resultE) {
                            echo "<script> alert('Update Successfully!') </script>";
                            echo "<script> window.location.href = 'employee.php'; </script>";
                        }
                    } else if (isset($_POST['editCancelE'])) {
                        echo "<script> window.location.href = 'employee.php'; </script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>