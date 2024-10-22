<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$_SESSION['orderedItems'] = array();
$_SESSION['countItems'] = 0;
$_SESSION['charge'] = 0;
$_SESSION['refNo'] = 0;
$_SESSION['payID'] = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>POS View</title>
    <meta charset="UTF-8">
    <script src="js/pos.js"></script>
    <script src="js/global.js"></script>
    <link rel="stylesheet" href="css/pos.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="icon" type="image/x-icon" href="images/logo.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="header">
            <img class="logo" src="images/logo.svg">
            <div class="profileNdate">
                <div class="timendate">
                    <p class="datime">00:00:00 AM</p>
                    <p class="dadate">Monday, June 12, 2003</p>
                </div>
                <div class="userbox">
                    <div class="profileimage">
                        <img class="userprofile" src="images/User1.png" alt="profile" draggable="false">
                        <img class="changeprofile" src="images/camera.png" alt="cameraicon" draggable="false">
                    </div>
                    <div class="profilename">
                        <div class="usernamebox">
                            <p class="username">
                                <?php echo $_SESSION['user'] ?>
                            </p>
                            <img src="images/downnicon.png" onclick="usermenuToggle()" alt="downIcon">
                        </div>
                        <p class="userposition">
                            <?php echo $_SESSION['position'] ?>
                        </p>

                    </div>
                    <div class="usermenu">
                        <div class="usermenuLinks">
                            <?php if ($_SESSION['adminAccess'] === "1") { ?> <a href='dashboard.php'> Home </a> <?php } ?>
                            <a> Profile </a>
                            <a class="usermenuLogout" href='logout.php'> Logout </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="left-content">
                <!-- <div id="categories">
                    <button"> Show All </button>
                    <?php
                    // $queryC = "SELECT * FROM category";
                    // $query_runC = mysqli_query($conn, $queryC);
                    // while ($rowCat = mysqli_fetch_array($query_runC)) {
                    //     echo "<button>" . $rowCat['categoryName'] . "</button>";
                    // }
                    ?>
                </div> -->
                <div class="productMenu">
                    <div class="search" method="GET">
                        <input type="text" id="myInput" name="search" maxlength="32" onkeyup="myFunction()" placeholder="Search for medicine..." autocomplete="off">
                        <img src="/images/search.png">
                    </div>
                    <div class="list">
                        <table id="myTable">
                            <tr>
                                <!-- <th> </th> -->
                                <th> Generic Name </th>
                                <th> Branded Name </th>
                                <th> Price </th>
                            </tr>
                            <!-- <tr class="rowItems">
                                <td> Biogesic </td>
                                <td> Biogesic </td>
                                <td> 10 </td>
                            </tr> -->
                            <?php
                            // if (isset($_GET['search']) && !empty($_GET['search'])) {
                            //     $search = ucwords($_GET['search']);
                            //     $query = "SELECT * FROM medicine WHERE genericName = '$search' || brandedName = '$search'";
                            // } else {
                            //     $query = "SELECT * FROM medicine";
                            // }

                            $query = "SELECT * FROM medicine";
                            $query_run = mysqli_query($conn, $query);
                            while ($rowMed = mysqli_fetch_array($query_run)) {
                                echo "<tr class='product-row'" . $rowMed['categoryID'] . "' data-id='" . $rowMed['medicineID'] . "' data-genericName='" . $rowMed['genericName'] . "' data-brandName='" . $rowMed['brandedName'] . "' data-price='" . $rowMed['price'] . "' data-stock=" . $rowMed['stock'] . ">";
                                echo "<td>" . $rowMed['genericName'] . "</td>";
                                echo "<td>" . $rowMed['brandedName'] . "</td>";
                                echo "<td>" . $rowMed['price'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <?php

            ?>
            <form class="right-content" method="POST" action="">
                <div class="cartSection">
                    <table id="cartTable">
                        <tr>
                            <th> Generic Name </th>
                            <th> Brand Name </th>
                            <th width="50px"> Quantity </th>
                            <th width="50px"> Price </th>
                            <th width="50px"> Subtotal </th>
                            <th width="50px"> Action </th>
                        </tr>
                        <!-- <tr>
                            <td> Ibuprofen </td>
                            <td class="quantityInput">
                                <span class="num"> 1 </span>
                                <span><span class="minus">-</span><span class="plus">+</span></span>
                            </td>
                            <td> 458.38 </td>
                            <td> 458.38 </td>
                            <td><img src="/images/bin.png" onclick="delItem(this);"></td>
                        </tr> -->
                    </table>
                </div>
                <div class="tallySection">
                    <table id="tallyTable">
                        <tr>
                            <th> Subtotal </th>
                            <td id="numQty" width="100px"> 0 </td>
                            <th width="100px"> </th>
                            <td id="numSubtotal" width="100px"> 0.00 </td>
                            <td width="100px"> </td>
                        </tr>
                        <tr>
                            <th> Total </th>
                            <td> </td>
                            <th> </th>
                            <th id="numTotal"> 0.00 </th>
                            <th><input type="hidden" name="totalAmount" value="" id="totalAmount"></th>
                        </tr>
                    </table>
                </div>
                <div class="paymentSection">
                    <div class="paymentInput">
                        <div class="payInput">
                            <input type="number" name="cashAmount" placeholder="Cash Amount..." step="0.01" value="" min="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16" required>
                            <input type="number" name="referenceNum" placeholder="GCash Reference Number..." value="" min="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="32">
                        </div>
                        <div class="payButton">
                            <input type="submit" name="payEnter" value="PAY">
                        </div>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST['payEnter'])) {
                $employeeID = $_SESSION['id'];
                $refNum = $_POST["referenceNum"];
                $cashAmount = $_POST["cashAmount"];
                $totalAmount = $_POST["totalAmount"];
                $count = 0;

                if ($cashAmount >= $totalAmount) {
                    $sqltoPayment = "INSERT INTO payment (amount, reference_num) VALUES ('$cashAmount', '$refNum')";
                    mysqli_query($conn, $sqltoPayment);
                    $paymentID = mysqli_insert_id($conn);

                    $sqltoTransaction = "INSERT INTO orderf (employeeID, paymentID, orderDate) VALUES ('$employeeID', '$paymentID', CURRENT_DATE())";
                    mysqli_query($conn, $sqltoTransaction);
                    $transactionID = mysqli_insert_id($conn);

                    if (isset($_POST['medicines']) && isset($_POST['quantities']) && isset($_POST['subtotals'])) {
                        $medicines = $_POST['medicines'];
                        $quantities = $_POST['quantities'];
                        $subtotals = $_POST['subtotals'];

                        for ($i = 0; $i < count($medicines); $i++) {
                            $medicineID = $medicines[$i];
                            $quantity = $quantities[$i];
                            $subtotal = $subtotals[$i];

                            $sqltoOrder_Medicine = "INSERT INTO order_medicine VALUES ('$transactionID', '$medicineID', '$quantity')";
                            mysqli_query($conn, $sqltoOrder_Medicine);

                            $sqltoMedicineUpdateQty = "UPDATE medicine SET stock = stock - $quantity WHERE medicineID = '$medicineID'";
                            mysqli_query($conn, $sqltoMedicineUpdateQty);

                            $count = count($medicines);
                            echo "<script> console.log('$count') </script>";
                            array_push($_SESSION['orderedItems'], array($medicineID, $quantity, $subtotal));
                        }
                        $_SESSION['countItems'] = $count;
                    } else {
                        echo "<script> alert('No Medicines Added'); </script>";
                    }

                    $_SESSION['refNo'] = $refNum;
                    $_SESSION['payID'] = $paymentID;
                    $_SESSION['charge'] = $cashAmount;
                    echo "<script> alert('Pay Successfully!'); </script>";
                    echo "<script> location.replace('receipt.php'); </script>";
                } else {
                    echo "<script> alert('Not enough money!'); </script>";
                }
            }
            ?>
        </div>
    </div>

</body>

</html>