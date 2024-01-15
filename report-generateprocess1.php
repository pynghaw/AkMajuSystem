<?php
include('dbconnect.php');
require 'fpdf186/fpdf.php';

$startDate = $_POST['sdate'];
$endDate = $_POST['edate'];

// INSERT Data into tb_salesreport
// Define your r_id, r_name, r_date, and r_desc here. This is an example.
$query = "SELECT MAX(r_id) FROM tb_salesreport";
$resultid = $con->query($query);
$row = $resultid->fetch_assoc();
$maxId = $row['MAX(r_id)'];
$r_id = $maxId + 1; // Increment the ID value

$r_name = "Sales Report"; // Example name
$r_date = date("Y-m-d"); // Current date
$r_desc = "Sales report from $startDate to $endDate"; // Example description

$insertStmt = $con->prepare("INSERT INTO tb_salesreport (r_id, r_name, r_date, r_desc) VALUES (?, ?, ?, ?)");
$insertStmt->bind_param("isss", $r_id, $r_name, $r_date, $r_desc);
$insertStmt->execute();
$insertStmt->close();

// Prepare and execute query
$sql = $con->prepare("SELECT iv_no, iv_qno, iv_date, iv_upFront, iv_bal FROM tb_invoice WHERE iv_date BETWEEN ? AND ?");
$sql->bind_param("ss", $startDate, $endDate);
$sql->execute();
$result = $sql->get_result();

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

//place img and report id
$imagePath = 'images/akmaju.jpeg';
$pdf->Image($imagePath, 10, 10, 25);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(0, 10, 'Report ID: ' . $r_id . '   Report Date: ' . $r_date, 0, 1, 'R');
$pdf->SetFont('Times', '', 8);
$newYPosition = 20 + 12 + 10;

// Set font for the title
$pdf->SetFont('Times', 'B', 12);
$pdf->SetY($newYPosition);
$pdf->Cell(0, 5, 'PROFIT AND LOSS (Summary) from ' . $startDate . ' to ' . $endDate , 0, 1, 'C'); // Centered title with line 
$pdf->SetDrawColor(0, 0, 0); // Set line color to black
$pdf->SetLineWidth(0.3); // Set line width (adjust as needed)
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Adjust the coordinates and width as needed
$pdf->Ln(); // Add a line break for separation

// Table headers (sum=190)
$pdf->SetLineWidth(0.1);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 10, 'Invoice No', 1);
$pdf->Cell(30, 10, 'Quotation No', 1);
$pdf->Cell(40, 10, 'Date', 1);
$pdf->Cell(45, 10, 'Upfront', 1);
$pdf->Cell(45, 10, 'Balance', 1);
$pdf->Ln();


// Table data
$total = 0;
$grandTotal = 0;
$index = 1; // Initialize the index

$pdf->SetFont('Times', '', 9);
while ($row = $result->fetch_assoc()) {

    $pdf->Cell(30, 10, $row['iv_no'], 1);
    $pdf->Cell(30, 10, $row['iv_qno'], 1);
    $pdf->Cell(40, 10, $row['iv_date'], 1);
    $pdf->Cell(45, 10, $row['iv_upFront'], 1);
    $pdf->Cell(45, 10, $row['iv_bal'], 1);
    $pdf->Ln();
}

// Footer
$pdf->Cell(100, 10, '', 0,);
$pdf->Cell(45, 10, 'GRAND TOTAL', 1,);
$pdf->Cell(45, 10, $grandTotal, 1);
$pdf->Ln();


//Save PDF to a directory
$filePath = 'report/SalesReport_' . $startDate . '_to_' . $endDate . '.pdf';
$pdf->Output('F', $filePath);
$pdf->Output();

// Update Database with File Path
$insertPathStmt = $con->prepare("UPDATE tb_salesreport SET r_filepath = ? WHERE r_id = ?");
$insertPathStmt->bind_param("si", $filePath, $r_id);
$insertPathStmt->execute();
$insertPathStmt->close();


// Close the database connection
$con->close();

?>
