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
    <title>Sales Report</title>
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
                        <h1> Sales Report </h1>
                        <p> Sales related report of the pharmacy. </p>
                    </div>
                </div>
                <div class="subcontent">
                    <div class="contentTable">
                        <table class="rowNumbers">
                            <tr>
                                <th> Order Date </th>
                                <th> Order ID </th>
                                <th> Payment </th>
                                <th> Reference No </th>
                                <th> Medicine </th>
                            </tr>
                            <?php
                            $fetchOrder = "SELECT * FROM orderf";
                            $execOrder = mysqli_query($conn, $fetchOrder);
                            while ($rowOrder = mysqli_fetch_array($execOrder)) {
                                $orderID = $rowOrder['orderID'];

                                $paymentID = $rowOrder['paymentID'];
                                $fetchPayment = "SELECT * FROM payment WHERE paymentID = '$paymentID'";
                                $resultPayment = mysqli_query($conn, $fetchPayment);
                                $rowPayment = mysqli_fetch_array($resultPayment, MYSQLI_ASSOC);

                                echo "<tr>";
                                echo "<td>" . $rowOrder['orderDate'] . "</td>";
                                echo "<td>" . $rowOrder['orderID'] . "</td>";
                                echo "<td>" . $rowPayment['amount'] . "</td>";
                                echo "<td>" . $rowPayment['reference_num'] . "</td>";
                                echo "<td>";

                                $fetchOrderMedicine = "SELECT order_medicine.quantity, medicine.genericName FROM order_medicine INNER JOIN medicine ON order_medicine.medicineID = medicine.medicineID WHERE orderID = $orderID";
                                $execOrderMedicine = mysqli_query($conn, $fetchOrderMedicine);
                                while ($rowOrderMedicine = mysqli_fetch_array($execOrderMedicine)) {
                                    echo "x" . $rowOrderMedicine['quantity'] . " " . $rowOrderMedicine['genericName'] . ", ";
                                }

                                echo "</td>";
                                echo "</tr>";
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