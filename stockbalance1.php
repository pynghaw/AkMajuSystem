<?php
include('dbconnect.php');
require 'fpdf186/fpdf.php';

// INSERT Data into tb_salesreport
// Define your r_id, r_name, r_date, and r_desc here. This is an example.
$query = "SELECT * FROM tb_inventory WHERE i_status='1' ";
$resultid = $con->query($query);
$row = $resultid->fetch_assoc();

$r_name = "Stock Balance Report"; // Example name
$r_date = date("Y-m-d"); // Current date
$r_desc = "Stock Balance Report"; // Example description

// Prepare and execute query
$sql = $con->prepare("SELECT * FROM tb_inventory WHERE i_status='1' ");
$sql->execute();
$result = $sql->get_result();

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Place img and report id
$imagePath = 'images/akmaju.jpeg';
$pdf->Image($imagePath, 10, 10, 25);
$pdf->SetFont('Times', '', 10);

$pdf->SetFont('Times', '', 8);
$newYPosition = 20 + 12 + 10;

// Set font for the title
$pdf->SetFont('Times', 'B', 12);
$pdf->SetY($newYPosition);
$pdf->Cell(0, 5, 'Stock Balance Report - ' . $r_date, 0, 1, 'C'); // Centered title with line 
$pdf->SetDrawColor(0, 0, 0); // Set line color to black
$pdf->SetLineWidth(0.3); // Set line width (adjust as needed)
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Adjust the coordinates and width as needed
$pdf->Ln(); // Add a line break for separation

// Table headers (sum=190)
$pdf->SetLineWidth(0.1);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 10, 'Product ID', 1);
$pdf->Cell(30, 10, 'Product Name', 1);
$pdf->Cell(40, 10, 'Description', 1);
$pdf->Cell(45, 10, 'Quantity Balance', 1);
$pdf->Cell(45, 10, 'Unit Price', 1);
$pdf->Ln();



$pdf->SetFont('Times', '', 9);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['i_no'], 1);
    $pdf->Cell(30, 10, $row['i_name'], 1);
    $pdf->Cell(40, 10, $row['i_desc'], 1);
    $pdf->Cell(45, 10, $row['i_qty'], 1);
    $pdf->Cell(45, 10, $row['i_price'], 1);
    $pdf->Ln();
}

// Save PDF to a directory
$filePath = 'report/StockbalanceReport1_' . $r_date . '.pdf';
$pdf->Output('F', $filePath);
$pdf->Output();

// Close the database connection
$con->close();
?>
