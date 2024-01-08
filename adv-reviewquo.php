<?php
include 'dbconnect.php';
require 'fpdf186/fpdf.php';

// Check if the quotation number is provided in the URL
if (isset($_GET['q_no'])) {
    $q_no = $_GET['q_no'];

    // Retrieve the file path for the existing PDF file based on the quotation number
    // You need to adjust this query based on your database structure
    $pdfFilePathQuery = "SELECT q_filepath FROM tb_quotation WHERE q_no = $q_no";
    $pdfFilePathResult = mysqli_query($con, $pdfFilePathQuery);

    if ($pdfFilePathResult && $pdfFilePathRow = mysqli_fetch_assoc($pdfFilePathResult)) {
        $pdfFilePath = $pdfFilePathRow['q_filepath'];

        // Check if the file exists
        if (file_exists($pdfFilePath)) {
            // Output the PDF file
            header('Content-type: application/pdf');
            readfile($pdfFilePath);
            exit;
        } else {
            // Display an error if the file doesn't exist
            echo 'PDF file not found.';
        }
    } else {
        // Display an error if the quotation number is not valid
        echo 'Invalid quotation number.';
    }
} else {
    // Display an error if the quotation number is not provided in the URL
    echo 'Quotation number not provided.';
}
?>
