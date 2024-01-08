<?php
include 'dbconnect.php';
require 'fpdf186/fpdf.php';

// Check if the quotation number is provided in the URL
if (isset($_GET['iv_no'])) {
    $iv_no = $_GET['iv_no'];

    // Retrieve the file path for the existing PDF file based on the quotation number
    // You need to adjust this query based on your database structure
    $pdfFilePathQuery = "SELECT iv_filepath FROM tb_invoice WHERE iv_no = $iv_no";
    $pdfFilePathResult = mysqli_query($con, $pdfFilePathQuery);

    if ($pdfFilePathResult && $pdfFilePathRow = mysqli_fetch_assoc($pdfFilePathResult)) {
        $pdfFilePath = $pdfFilePathRow['iv_filepath'];

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
        echo 'Invalid invoice number.';
    }
} else {
    // Display an error if the quotation number is not provided in the URL
    echo 'Invoice number not provided.';
}
?>
