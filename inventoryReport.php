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
    <title>Inventory Report</title>
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
                        <h1> Inventory Report </h1>
                        <p> Inventory related report of the pharmacy. </p>
                    </div>
                </div>
                <div class="subcontent">
                    <div class="contentTable">
                        <table class="rowNumbers">
                            <tr>
                                <th> Date Added </th>
                                <th> Medicine ID </th>
                                <th> Generic Name </th>
                                <th> Brand Name </th>
                            </tr>
                            <?php


                            $fetchMedicines = "SELECT * FROM medicine";
                            $exec = mysqli_query($conn, $fetchMedicines);

                            while ($rowMed = mysqli_fetch_array($exec)) {
                                echo "<tr>";
                                echo "<td>" . $rowMed['dateAdded'] . "</td>";
                                echo "<td>" . $rowMed['medicineID'] . "</td>";
                                echo "<td>" . $rowMed['genericName'] . "</td>";
                                echo "<td>" . $rowMed['brandedName'] . "</td>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>