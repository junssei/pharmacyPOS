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
            <div class="content medicine">
                <div class="directory">
                    <div class="directoryinfo">
                        <h1 style="color:gray"> Medicine <p>/ Edit</p>
                        </h1>
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    </div>
                </div>
                <div class="subcontent">
                    <?php
                    if ($_GET['medicineID']) {
                        echo "<style> .medicine{ display: block; } </style>";
                        $mID = $_GET['medicineID'];
                        $sql = "SELECT * FROM medicine WHERE medicineID = '$mID'";
                        $result = mysqli_query($conn, $sql);
                        $rowMed = mysqli_fetch_array($result);
                        // } else {
                        //     echo "<script> window.location.href = 'medicine.php'; </script>";
                    }
                    ?>
                    <form action="editMedicine.php" method="POST" autocomplete="off">
                        <div class="editForm">
                            <input name="mID" type="hidden" value='<?php echo $rowMed['medicineID'] ?>' required> </input>
                            <label> Generic Name </label>
                            <input name="genericName" type="text" placeholder="Enter Generic Name" value='<?php echo $rowMed['genericName'] ?>' autofocus required> </input>
                            <label> Branded Name </label>
                            <input name="brandName" type="text" placeholder="Enter Brand Name" value='<?php echo $rowMed['brandedName'] ?>' required> </input>
                            <label> Price </label>
                            <input name="medicinePrice" type="number" step="0.01" placeholder="Enter Price" min="1" value='<?php echo $rowMed['price'] ?>' required> </input>
                            <label> Quantity </label>
                            <input name="medicineQuantity" type="number" placeholder="Enter Quantity" min="1" value='<?php echo $rowMed['stock'] ?>' required> </input>
                            <label> Category </label> <?php $categoryID = $rowMed['categoryID'] ?>
                            <select name="medicineCategory" placeholder="Category" required>
                                <?php
                                $fetchCategoryValue = "SELECT * FROM category WHERE categoryID = '$categoryID'";
                                $exec = mysqli_query($conn, $fetchCategoryValue);
                                $rowCat = mysqli_fetch_array($exec);

                                if ($rowMed['categoryID'] == $rowCat['categoryID']) {
                                    echo "<option value='" . $rowCat['categoryID'] . "'>" . $rowCat['categoryName'] . "</option>";
                                }
                                ?>
                                <?php
                                $fetchCategory = "SELECT * FROM category WHERE categoryID != '$categoryID'";
                                // $fetchCategory = "SELECT * FROM category";
                                $exec = mysqli_query($conn, $fetchCategory);
                                while ($rowCategory = mysqli_fetch_array($exec)) {
                                    echo "<option value='" . $rowCategory['categoryID'] . "'>" . $rowCategory['categoryName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="editConfirmation">
                            <input class="editBtns" type="Submit" name="editSubmitM" value="Save">
                            <input class="editBtns" type="Submit" name="editCancelM" value="Cancel">
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['editSubmitM'])) {
                        $mID = $_POST['mID'];
                        $genericName = ucwords($_POST['genericName']);
                        $brandName = ucwords($_POST['brandName']);
                        $price = $_POST['medicinePrice'];
                        $stock = $_POST['medicineQuantity'];
                        $category = $_POST['medicineCategory'];

                        $update_Med = "UPDATE medicine SET genericName = '$genericName', brandedName = '$brandName', price = '$price', stock = '$stock', dateAdded = CURRENT_DATE(), categoryID = '$category' WHERE medicineID = '$mID'";
                        $update_resultM = mysqli_query($conn, $update_Med);

                        if ($update_resultM) {
                            echo "<script> alert('Update Successfully!') </script>";
                            echo "<script> window.location.href = 'medicine.php'; </script>";
                        }
                    } else if (isset($_POST['editCancelM'])) {
                        echo "<script> window.location.href = 'medicine.php'; </script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>