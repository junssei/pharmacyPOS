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
    <title>Category</title>
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
                        <h1> Category </h1>
                        <p> List of Category. </p>
                    </div>
                    <div class="addbtn">
                        <button class="addbtn" onclick="addMedicine()"><img src="images/add.svg"> Add Category </button>
                    </div>
                </div>
                <div class="subcontent">
                    <div class="contentTable">
                        <table class="rowNumbers">
                            <tr>
                                <th> ID </th>
                                <th> Category Name </th>
                                <th> Action </th>
                            </tr>
                            <?php
                            $fetchCategory = "SELECT * FROM category";
                            $exec = mysqli_query($conn, $fetchCategory);

                            while ($rowCategory = mysqli_fetch_array($exec)) {
                                echo "<tr>";
                                echo "<td>" . $rowCategory['categoryID'] . "</td>";
                                echo "<td>" . $rowCategory['categoryName'] . "</td>";
                                echo "<td> <a class='editBtn' href='editCategory.php?categoryID=$rowCategory[0]'>Edit</a>
                                <a class='deltBtn' href='delete.php?categoryID=$rowCategory[0]'>Delete</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="popupContainer">
                <div class="popupContent">
                    <form action="category.php" method="POST" autocomplete="off">
                        <div class="popupForm">
                            <label> Category Name </label>
                            <input name="categoryName" type="text" placeholder="Category Name" autofocus required> </input>
                        </div>
                        <div class="popupConfirmation">
                            <input class="popupBtn" type="submit" name="submit" value="Add"></input>
                            <input class="popupBtn" type="reset" onclick="addMedicine()" value="Cancel"></input>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        $category = ucwords($_POST['categoryName']);

                        $sql = "INSERT INTO category(categoryName) VALUES ('$category')";

                        $query = mysqli_query($conn, $sql);

                        if ($query) {
                            echo "<script> window.location.href = 'category.php' </script>";
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>