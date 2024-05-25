<?php include('connect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_GET['medicineID']) {
    $mID = $_GET['medicineID'];
    $deleteMed = "DELETE FROM medicine WHERE medicineID = '$mID'";
    $deleteResult = mysqli_query($conn, $deleteMed);

    if ($deleteResult) {
        echo "Delete Successfully";
        echo "<script> window.location.href = 'medicine.php'; </script>";
    } else {
        echo "Delete Failed";
        echo "<script> window.location.href = 'medicine.php'; </script>";
    }
} else if ($_GET['categoryID']) {
    $cID = $_GET['categoryID'];
    $deleteCategory = "DELETE FROM category WHERE categoryID = '$cID'";
    $deleteResult = mysqli_query($conn, $deleteCategory);

    if ($deleteResult) {
        echo "Delete Successfully";
        echo "<script> window.location.href = 'category.php'; </script>";
    } else {
        echo "Delete Failed";
        echo "<script> window.location.href = 'category.php'; </script>";
    }
} else if ($_GET['employeeID']) {
    $eID = $_GET['employeeID'];
    $deleteEmployee = "DELETE FROM employee WHERE employeeID = '$eID'";
    $deleteResult = mysqli_query($conn, $deleteEmployee);

    if ($deleteResult) {
        echo "Delete Successfully";
        echo "<script> window.location.href = 'employee.php'; </script>";
    } else {
        echo "Delete Failed";
        echo "<script> window.location.href = 'employee.php'; </script>";
    }
} else {
    echo "<script> window.location.href = 'dashboard.php'; </script>";
}
