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
            <div class="content category">
                <div class="directory">
                    <div class="directoryinfo">
                        <h1 style="color:gray"> Category <p>/ Edit</p>
                        </h1>
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    </div>
                </div>
                <div class="subcontent">
                    <?php
                    if ($_GET['categoryID']) {
                        echo "<style> .category{ display: block; } </style>";
                        $cID = $_GET['categoryID'];
                        $sql = "SELECT * FROM category WHERE categoryID = '$cID'";
                        $result = mysqli_query($conn, $sql);
                        $rowCat = mysqli_fetch_array($result);
                    } else {
                        echo "<script> window.location.href = 'category.php'; </script>";
                    }
                    ?>
                    <form action="editCategory.php" method="POST" autocomplete="off">
                        <div class="editForm">
                            <input name="cID" type="hidden" value='<?php echo $rowCat['categoryID'] ?>' required> </input>
                            <label> Category </label>
                            <input name="categoryName" type="text" placeholder="Enter Category Name" value='<?php echo $rowCat['categoryName'] ?>' autofocus required> </input>
                        </div>
                        <div class="editConfirmation">
                            <input class="editBtns" type="Submit" name="editSubmitC" value="Save">
                            <input class="editBtns" type="Submit" name="editCancelC" value="Cancel">
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['editSubmitC'])) {
                        $cID = $_POST['cID'];
                        $categoryName = ucwords($_POST['categoryName']);

                        $update_Ctgry = "UPDATE category SET categoryName = '$categoryName' WHERE categoryID = '$cID'";
                        $update_resultC = mysqli_query($conn, $update_Ctgry);

                        if ($update_resultC) {
                            echo "<script> alert('Update Successfully!') </script>";
                            echo "<script> window.location.href = 'category.php'; </script>";
                        }
                    } else if (isset($_POST['editCancelC'])) {
                        echo "<script> window.location.href = 'category.php'; </script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>