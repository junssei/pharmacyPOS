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
    <title>Medicine</title>
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
                        <h1> Medicine </h1>
                        <p> List of Medicines. </p>
                    </div>
                    <div class="addbtn">
                        <button class="addbtn" onclick="addMedicine()"><img src="images/add.svg"> Add Medicine </button>
                    </div>
                </div>
                <div class="subcontent">
                    <div class="contentTable">
                        <table class="rowNumbers">
                            <tr>
                                <th> ID </th>
                                <th> Generic Name </th>
                                <th> Brand Name </th>
                                <th> Price </th>
                                <th> Stock </th>
                                <!-- <th> Date Added </th> -->
                                <th> Category </th>
                                <th> Action </th>
                            </tr>
                            <?php
                            $fetchMedicines = "SELECT * FROM medicine";
                            $exec = mysqli_query($conn, $fetchMedicines);

                            while ($rowMed = mysqli_fetch_array($exec)) {
                                echo "<tr>";
                                echo "<td>" . $rowMed['medicineID'] . "</td>";
                                echo "<td>" . $rowMed['genericName'] . "</td>";
                                echo "<td>" . $rowMed['brandedName'] . "</td>";
                                echo "<td>" . $rowMed['price'] . "</td>";
                                if ($rowMed['stock'] <= 0) {
                                    echo "<td style='color:red'> Out of Stock </td>";
                                } else {
                                    echo "<td>" . $rowMed['stock'] . "</td>";
                                }
                                echo "<td>" . $rowMed['categoryID'] . "</td>";
                                echo "<td> <a class='editBtn' href='editMedicine.php?medicineID=$rowMed[0]'>Edit</a>
                                <a class='deltBtn' href='delete.php?medicineID=$rowMed[0]'>Delete</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="popupContainer">
                <div class="popupContent">
                    <form action="medicine.php" method="POST" autocomplete="off">
                        <div class="popupForm">
                            <label> Generic Name </label>
                            <input name="genericName" type="text" placeholder="Enter Generic Name" autofocus required> </input>
                            <label> Branded Name </label>
                            <input name="brandedName" type="text" placeholder="Enter Branded Name" required> </input>
                            <label> Price </label>
                            <input name="medicinePrice" type="number" step="0.01" placeholder="Enter Price" min="1" required> </input>
                            <label> Quantity </label>
                            <input name="medicineQuantity" type="number" placeholder="Enter Quantity" min="1" required> </input>
                            <label> Category </label>
                            <select name="medicineCategory" placeholder="Category" required>
                                <option> No Selected </option>
                                <?php
                                $fetchCategory = "SELECT * FROM category";
                                $exec = mysqli_query($conn, $fetchCategory);

                                while ($rowCategory = mysqli_fetch_array($exec)) {
                                    echo "<option value='" . $rowCategory['categoryID'] . "'>" . $rowCategory['categoryName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="popupConfirmation">
                            <input class="popupBtn" type="submit" name="submit" value="Add"></input>
                            <input class="popupBtn" type="reset" onclick="addMedicine()" value="Cancel"></input>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        $genericName = ucwords($_POST['genericName']);
                        $brandedName = ucwords($_POST['brandedName']);
                        $price = $_POST['medicinePrice'];
                        $stock = $_POST['medicineQuantity'];
                        $category = $_POST['medicineCategory'];

                        $sql = "INSERT INTO medicine VALUES ('', '$genericName', '$brandedName', '$price', '$stock',CURRENT_DATE(), '$category')";

                        $query = mysqli_query($conn, $sql);

                        if ($query) {
                            echo "<script> window.location.href = 'medicine.php' </script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>