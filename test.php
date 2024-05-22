<?php
include('connect.php');

$query = "SELECT * FROM medicine";
$query_run = mysqli_query($conn, $query);

$medicine = []; // Initialize the array outside the loop

while ($rowMed = mysqli_fetch_array($query_run)) {
    $medicine[] = [
        $rowMed['medicineID'],
        $rowMed['genericName'],
        $rowMed['brandedName'],
        $rowMed['price'],
        $rowMed['quantity']
    ];
}

// Display the data

echo (count($medicine));
echo $medicine[1][1];

echo "<br>";
for ($i = 0; $i < count($medicine); $i++) {
    for ($j = 0; $j < count($medicine[$i]); $j++) {
        echo $medicine[$i][$j] . ", "; // Added a space for better readability
    }
    echo "<br>"; // Added a line break for better readability
}
