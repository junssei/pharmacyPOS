<?php include('connect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

echo "<style> body{
    background-color: #000;
}</style>";

$mID = $_GET['medicineID'];
$cID = $_GET['categoryID'];
$eID = $_GET['employeeID'];

if ($mID) {
    $deleteMed = "DELETE FROM medicine WHERE medicineID = '$mID'";
    $deleteResult = mysqli_query($conn, $deleteMed);

    if ($deleteResult) {
        echo "Delete Successfully";
        echo "<script> window.location.href = 'medicine.php'; </script>";
    } else {
        echo "Delete Failed";
        echo "<script> window.location.href = 'medicine.php'; </script>";
    }
} else if ($cID) {
    $deleteCategory = "DELETE FROM category WHERE categoryID = '$cID'";
    $deleteResult = mysqli_query($conn, $deleteCategory);

    if ($deleteResult) {
        echo "Delete Successfully";
        echo "<script> window.location.href = 'category.php'; </script>";
    } else {
        echo "Delete Failed";
        echo "<script> window.location.href = 'category.php'; </script>";
    }
} else if ($eID) {
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
