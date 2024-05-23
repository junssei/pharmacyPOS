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
    <title>Dashboard - Home</title>
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
                        <h1> Dashboard </h1>
                        <p> A quick data overview of the inventory. </p>
                    </div>
                </div>
                <div class="subcontent">
                    <?php

                    $countMedicine = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM medicine"));
                    $countCategories = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM category"));
                    $countReceiptGenerated = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orderf"));
                    $countTotalQuantity = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(quantity) FROM order_medicine"));

                    ?>
                    <div class="dashboardBoxes">
                        <table class="inventoryBox">
                            <tr>
                                <th colspan="2"> Inventory </th>
                            </tr>
                            <tr class="boxValue">
                                <td> <?php echo $countMedicine ?> </td>
                                <td> <?php echo $countCategories ?> </td>
                            </tr>
                            <tr class="boxStatus">
                                <td> Total No. Of Medicines</td>
                                <td> Categories </td>
                            </tr>
                        </table>
                        <table class="quickreportBox">
                            <tr>
                                <th colspan="2"> Report </th>
                            </tr>
                            <tr class="boxValue">
                                <td> <?php echo $countTotalQuantity[0] ?></td>
                                <td> <?php echo $countReceiptGenerated ?> </td>
                            </tr>
                            <tr class="boxStatus">
                                <td> Qty of Medicines Sold </td>
                                <td> Receipt Generated </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>