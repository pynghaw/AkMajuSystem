<?php
include 'dbconnect.php';

// Set headers to prompt the download of a CSV file
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=customer_data.csv');

// Open a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output the column headings
fputcsv($output, array('Customer ID', 'Name', 'Address', 'Billing Address', 'Email', 'Contact Number'));

// Fetch the data from the database
$sql = "SELECT * FROM tb_customer";
$result = mysqli_query($con, $sql);

// Loop over the rows, outputting them
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

// Close the database connection
mysqli_close($con);
?>
