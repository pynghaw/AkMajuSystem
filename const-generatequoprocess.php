<?php 
include('dbconnect.php');
require_once('fpdf186/fpdf.php'); // Include the FPDF library

// Start the total price at 0
$totalPrice = 0;

// Fetch data from the database
$sql = "SELECT * FROM tb_matlist";
$result = mysqli_query($con, $sql);

// Create a new PDF document
$pdf = new FPDF('P','mm', 'A4');

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Check Out Summary');
$pdf->SetSubject('Check Out Summary PDF Document');
$pdf->SetKeywords('FPDF, PDF, example, sample');

// Add a page
$pdf->AddPage();

//place img and report id
$imagePath = 'images/akmaju.jpeg';
$pdf->Image($imagePath, 10, 10, 25);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(120, 12); //coordinate of address
$pdf->Cell(0, 2, 'AK MAJU RESOURCES SDN . BHD', 0, 1, 'L');
$pdf->Ln();
$pdf->SetXY(117, 16); //coordinate of address
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 2.5, 
    "    No. 39 & 41, Jalan Utama 3/2, Pusat Komersial Sri Utama,\n
    Segamat, Johor, Malaysia- 85000\n
    07-9310717, 010-2218224\n
    akmaju.acc@gmail.com\n
    Company No : 1088436 K", 0, 'L');
$newYPosition = 20 + 12 + 10;

// Title
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY($newYPosition);
$pdf->Cell(0, 5, 'QUOTATION', 0, 1, 'C'); // Centered title with line 
$pdf->SetDrawColor(0, 0, 0); // Set line color to black
$pdf->SetLineWidth(0.3); // Set line width (adjust as needed)
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Adjust the coordinates and width as needed
$pdf->Ln();

//lines under title
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 5, 'TO,', 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 2.5, 
    "No. 39 & 41, Jalan Utama 3/2, Pusat Komersial Sri Utama,\n
    Segamat, Johor, Malaysia- 85000\n
    07-9310717, 010-2218224\n
    akmaju.acc@gmail.com\n
    Company No : 1088436 K", 0, 'L');
$pdf->SetXY(126, 56);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(0, 2.5, 
    "    QUATATION NUMBER\n
    QUATATION DATE\n
    TERMS OF PAYMENT\n
    SST REGISTRATION. NO.", 0, 'L');
// Add the Cell on the right
$pdf->SetXY(170, 56);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 2.5, 
    "    1054\n
    22-oct-2023\n
    LO\n
    000", 0, 'L');
$pdf->Ln();
$pdf->Ln(8);


//below billing address
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 8, 'Dear Sir/Madam, herewith is our Quotation generated for your perusal.', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 8, 'ITEM DETAILS', 0, 1, 'L');

//Header
$pdf->SetLineWidth(0.3);
$pdf->SetFont('Arial', 'B', 8); // Bold font for headers
$pdf->Cell(10, 10, 'ID', 1, 0, 'C');
$pdf->Cell(30, 10, 'Name', 1, 0, 'C');
$pdf->Cell(25, 10, 'Type', 1, 0, 'C');
$pdf->Cell(45, 10, 'Description', 1, 0, 'C');
$pdf->Cell(30, 10, 'Unit Price', 1, 0, 'C');
$pdf->Cell(20, 10, 'Quantity', 1, 0, 'C');
$pdf->Cell(30, 10, 'Material Price', 1, 1, 'C'); // 1 for line break

$pdf->SetFont('Arial', '', 8); // Reset font

// Loop through your data and add rows to the table
while ($row = mysqli_fetch_array($result)) {
    if ($row['m_qty'] > 0) {
        $materialPrice = $row['m_price'] * $row['m_qty'];
        $totalPrice += $materialPrice;

        $pdf->Cell(10, 10, $row['m_id'], 1);
        $pdf->Cell(30, 10, $row['m_name'], 1);
        $pdf->Cell(25, 10, $row['m_type'], 1);
        $pdf->Cell(45, 10, $row['m_desc'], 1);
        $pdf->Cell(30, 10, $row['m_price'], 1);
        $pdf->Cell(20, 10, $row['m_qty'], 1);
        $pdf->Cell(30, 10, number_format($materialPrice, 2), 1, 1); // Line break after each row
    }
}

// Add the total price row
$pdf->SetFont('Arial', 'B', 10); // Bold font for total
$pdf->Cell(170, 10, 'Total Price: ', 1, 0, 'R'); // Right aligned
$pdf->SetFont('Arial', '', 9); // Regular font for the total price
$pdf->Cell(20, 10, number_format($totalPrice, 2), 1, 1); // Formatted total price

// Output the PDF to the browser
$pdf->Output();

// Close the database connection
mysqli_close($con);

?>
