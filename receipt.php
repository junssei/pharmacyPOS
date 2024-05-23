<?php
include('connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/receipt.css">
    <link rel="stylesheet" href="css/global.css">
    <title>Receipt</title>
</head>

<body>
    <div class="container">
        <div class="receiptContainer">
            <div class="receiptHeader">
                <img src="images/greenLogoWName.svg">
                <p> Sabayle, Iligan City, 9200 Lanao del Norte </p>
            </div>
            <div class="receiptDateAndTags">
                <p> <?php echo date("m/d/Y"); ?> </p>
                <p> PAYMENT#<span><?php echo $_SESSION['payID'] ?></span></p>
            </div>
            <table class="receiptOrders">
                <!-- <tr>
                    <td> 1 </td>
                    <td> Ibuprofen </td>
                    <td align="right"> 400 </td>
                </tr> -->
                <?php
                $charge = $_SESSION['charge'];
                $subtotal = 0;

                for ($i = 0; $i < $_SESSION['countItems']; $i++) {
                    $qty = $_SESSION['orderedItems'][$i][1];
                    $medicineID = $_SESSION["orderedItems"][$i][0];
                    $itemSubTotal = $_SESSION['orderedItems'][$i][2];

                    $fetchMedicines = "SELECT * FROM medicine WHERE medicineID = '$medicineID'";
                    $exec = mysqli_query($conn, $fetchMedicines);
                    $row = mysqli_fetch_array($exec, MYSQLI_ASSOC);

                    echo "<tr>";
                    echo "<td>" . $qty . "</td>";
                    echo "<td>" . $row['genericName'] . "</td>";
                    echo "<td align='right'>" . $itemSubTotal . "</td>";
                    echo "</tr>";

                    $subtotal = $subtotal + $itemSubTotal;
                }

                $total = $subtotal;
                $change = $charge - $total;
                ?>
            </table>
            <table class="receiptTotal">
                <tr>
                    <td></td>
                    <td> <?php echo "Items: " . $_SESSION['countItems'] ?></td>
                    <td align="right"></td>
                </tr>
                <tr>
                    <td></td>
                    <td> Subtotal </td>
                    <td align="right"> <?php echo $subtotal ?> </td>
                </tr>
                <tr>
                    <td></td>
                    <td> Total</td>
                    <td align="right"> <?php echo $total ?> </td>
                </tr>
                <tr>
                    <td></td>
                    <td> Charge </td>
                    <td align="right"> <?php echo $charge ?> </td>
                </tr>
            </table>

            <div class="receiptChange">
                <p> GCashRefNo. <span><?php echo $_SESSION['refNo'] ?></span></p>
                <p> CHANGE: <span> <?php echo $change ?> </span> </p>
            </div>
            <div class="receiptFooter">
                <p> Thank you for purchasing </p>
            </div>

        </div>
        <div class="receiptButtons">
            <a href="pos.php"> GO BACK </a>
            <a href=""> PRINT </a>
        </div>
    </div>

</body>

</html>