<?php
include('dbconnect.php');
include('pdffooter.php');
require 'fpdf186/fpdf.php';

$customer_id = $_POST['customer_id'];
$iv_no = $_POST['iv_no'];
$deldate = $_POST['deldate'];
$deladd = $_POST['deladd'];
$terms = $_POST['terms'];

// Fetch customer details and other necessary data from tb_quotation
$quotationDetailsSql = "SELECT q.*,c.c_name
                        FROM tb_quotation q
                        INNER JOIN tb_customer c ON q.q_cid = c.c_id
                        WHERE q.q_no = (SELECT iv_qno FROM tb_invoice WHERE iv_no = '$iv_no')";
$quotationDetailsResult = mysqli_query($con, $quotationDetailsSql);
$quotationDetails = mysqli_fetch_assoc($quotationDetailsResult);

// Fetch order details with the same o_qno
$orderDetailsSql = "SELECT o.*, i.i_desc, i.i_price, i.i_name
                    FROM tb_order o
                    INNER JOIN tb_inventory i ON o.o_ino = i.i_no
                    WHERE o.o_qno = (SELECT iv_qno FROM tb_invoice WHERE iv_no = '$iv_no')";
$orderDetailsResult = mysqli_query($con, $orderDetailsSql);

// Initialize grand total as 0
$grandTotal = 0;
$customerName = $quotationDetails['c_name'];
// Insert data into tb_delorder
$insertDOSql = "INSERT INTO tb_delorder (d_ino, d_date, d_terms, d_recpAdd)
                VALUES ('$iv_no', '$deldate', '$terms', '$deladd')";
mysqli_query($con, $insertDOSql);

// Get the inserted delivery order number
$deliveryOrderNo = mysqli_insert_id($con);
$filePath = 'deliveryorder/do_'  . $deliveryOrderNo . '.pdf';
// Create PDF
$pdf = new FPDF('P','mm', 'A4');

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Delivery Order');
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
$pdf->Cell(0, 5, 'DELIVERY ORDER', 0, 1, 'C'); // Centered title with line 
$pdf->SetDrawColor(0, 0, 0); // Set line color to black
$pdf->SetLineWidth(0.3); // Set line width (adjust as needed)
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Adjust the coordinates and width as needed
$pdf->Ln();

//lines under title
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 5, 'TO,', 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(30, 3, "$customerName\n
$deladd");
$pdf->SetXY(126, 56);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(0, 2.5, 
    "    DELIVERY ORDER NO\n
    DELIVERY DATE\n
    TERMS OF PAYMENT\n
    SST REGISTRATION. NO.", 0, 'L');
// Add the Cell on the right
$pdf->SetXY(170, 56);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 2.5, 
"$deliveryOrderNo\n\n" .
"$deldate\n\n" .
    "$terms\n\n" .
    "000", 0, 'L');
$pdf->Ln();
$pdf->Ln(8);


//below billing address
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 8, 'Dear Sir/Madam, herewith is our Delivery Order generated for your perusal.', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 8, 'ITEM DETAILS', 0, 1, 'L');


// Header
$pdf->SetLineWidth(0.1);
$pdf->SetFont('Times', 'B', 5);
$pdf->Cell(15, 10, 'S.NO', 1);
$pdf->Cell(40, 10, 'ITEM CODE', 1);
$pdf->Cell(115, 10, 'DESCRIPTION', 1);
$pdf->Cell(20, 10, 'QUANTITY', 1);
$pdf->Ln();

// Content
$pdf->SetFont('Times', '', 5);
$index = 1; // Initialize the index

while ($row = mysqli_fetch_assoc($orderDetailsResult)) {
    // Break the item description into two lines
    $descLines = explode("\n", wordwrap($row['i_desc'], 40, "\n"));

    // Use Cell for each line of the item description
    $pdf->Cell(15, 10, $index, 1); // Display sequential index
    $pdf->Cell(40, 10, $row['i_name'], 1);
    $pdf->Cell(115, 10, $descLines[0], 1);
    $pdf->Cell(20, 10, $row['o_quantity'], 1);
    $pdf->Ln();

    $index++; // Increment the index for the next item

    // Accumulate the total of o_quantity
    $grandTotal += $row['o_quantity'];
}

// Update the grand total in the database
$updateDOSql = "UPDATE tb_delorder SET d_gTotal = '$grandTotal' WHERE d_no = '$deliveryOrderNo'";
mysqli_query($con, $updateDOSql);
$updateDOSql = "UPDATE tb_delorder SET d_filepath = '$filePath' WHERE d_no = '$deliveryOrderNo'";
mysqli_query($con, $updateDOSql);

// Continue with the PDF generation

$pdf->SetFont('Times', 'B', 5, 'R');
$pdf->Cell(55, 10, '', 0);
$pdf->SetFont('Times', '', 5);
$pdf->Cell(115, 10, 'GRAND TOTAL', 1);
$pdf->Cell(20, 10, $grandTotal, 1); // Display the grand total
$pdf->Ln(); // Add a line break after the grand total
// Output the PDF

$pdfFooter = new PDFFooter();
$pdfFooter->addFooter($pdf);
$pdf->Output('F', $filePath);
$pdf->Output();


// Close the database connection
$con->close();
?>
