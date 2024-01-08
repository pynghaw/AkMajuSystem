<?php
include('dbconnect.php');
require 'fpdf186/fpdf.php';
$q_no = $_POST['q_no'];
$upfront = $_POST['upfront'];

    // Fetch customer details and other necessary data from tb_quotation
    $quotationDetailsSql = "SELECT q.*, c.c_billAdd
                            FROM tb_quotation q
                            INNER JOIN tb_customer c ON q.q_cid = c.c_id
                            WHERE q.q_no = $q_no";
    $quotationDetailsResult = mysqli_query($con, $quotationDetailsSql);

    if (!$quotationDetailsResult) {
        // Handle the case when the query fails
        echo 'Error fetching quotation details.';
        exit;
    }

    $quotationDetails = mysqli_fetch_assoc($quotationDetailsResult);

    // Extract necessary details from the quotation
    $customer_id = $quotationDetails['q_cid'];
    $billing_address = $quotationDetails['c_billAdd'];

    // Save the current date as the date of generating the invoice
    $currentDate = date('Y-m-d');

    // Insert the new invoice into the tb_invoice table
    

    // Fetch iv_no and iv_date from the inserted invoice
    $invoiceDetailsSql = "SELECT iv_no, iv_date FROM tb_invoice WHERE iv_qno = $q_no";
    $invoiceDetailsResult = mysqli_query($con, $invoiceDetailsSql);
    $invoiceDetails = mysqli_fetch_assoc($invoiceDetailsResult);

    // Fetch order details with the same o_qno
    $orderDetailsSql = "SELECT o.*, i.i_desc, i.i_price
                        FROM tb_order o
                        INNER JOIN tb_inventory i ON o.o_ino = i.i_no
                        WHERE o.o_qno = $q_no";
    $orderDetailsResult = mysqli_query($con, $orderDetailsSql);

$iv_balance = $quotationDetails['q_tAmount'] - $upfront;

$insertInvoiceSql = "INSERT INTO tb_invoice (iv_qno,iv_upFront, iv_bal, iv_date) VALUES ($q_no, $upfront, $iv_balance, '$currentDate')";
    mysqli_query($con, $insertInvoiceSql);

// Create PDF
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
$pdf->MultiCell(30, 2.5, "$customerName\n
$billingAddress");
$pdf->SetXY(126, 56);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(0, 2.5, 
    "    QUOTATION NUMBER\n
    QUATATION DATE\n
    TERMS OF PAYMENT\n
    SST REGISTRATION. NO.", 0, 'L');
// Add the Cell on the right
$pdf->SetXY(170, 56);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 2.5, 
    "    $quotationNumber\n
    $quotationDate\n
    LO\n
    000", 0, 'L');
$pdf->Ln();
$pdf->Ln(8);


//below billing address
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 8, 'Dear Sir/Madam, herewith is our Quotation generated for your perusal.', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 8, 'ITEM DETAILS', 0, 1, 'L');


// Header
$pdf->SetLineWidth(0.1);
$pdf->SetFont('Times', 'B', 5);
$pdf->Cell(20, 10, 'S.NO', 1);
$pdf->Cell(70, 10, 'ITEM DESCRIPTION', 1);
$pdf->Cell(15, 10, 'QUANTITY', 1);
$pdf->Cell(20, 10, 'UNIT PRICE (RM)', 1);
$pdf->Cell(20, 10, 'DISC % (RM)', 1);
$pdf->Cell(20, 10, 'DISC AMOUNT (RM)', 1);
$pdf->Cell(25, 10, 'TOTAL INCL. DISC (RM)', 1);
$pdf->Ln();

// Content
$pdf->SetFont('Times', '', 5);

$total = 0;
$grandTotal = 0;
$index = 1; // Initialize the index

while ($row = mysqli_fetch_assoc($result)) {
    $itemTotal = $row['o_quantity'] * $row['i_price'];
    $total += $itemTotal;

    // Calculate discount amount for each item
    $discountAmountPerItem = ($discount / 100) * $itemTotal;
    $discountedItemTotal = $itemTotal - $discountAmountPerItem;
    $grandTotal += $discountedItemTotal;

    // Break the item description into two lines
    $descLines = explode("\n", wordwrap($row['i_desc'], 40, "\n"));

    // Use Cell for each line of the item description
    $pdf->Cell(20, 10, $index, 1); // Display sequential index
    $index++; // Increment the index for the next item
    $pdf->Cell(70, 10, $descLines[0], 1);
    $pdf->Cell(15, 10, $row['o_quantity'], 1);
    $pdf->Cell(20, 10, $row['i_price'], 1);
    $pdf->Cell(20, 10, $discount, 1); // Display discount percentage
    $pdf->Cell(20, 10, $discountAmountPerItem, 1); // Display discount amount per item
    $pdf->Cell(25, 10, $discountedItemTotal, 1); // Display total incl. discount
    $pdf->Ln();
}

// Footer
$pdf->Cell(165, 10, 'GRAND TOTAL', 1);
$pdf->Cell(25, 10, $grandTotal, 1);
$pdf->Ln();

// Output the PDF
$filePath = 'quotation/advertisement/Quotation_' . $quotationDate . '_' . $quotationNumber . '.pdf';
$pdf->Output('F', $filePath);
$pdf->Output();

// Update Database with File Path
$insertPathStmt = $con->prepare("UPDATE tb_quotation SET q_filepath = ? WHERE q_no = ?");
$insertPathStmt->bind_param("si", $filePath, $quotationNumber);
$insertPathStmt->execute();
$insertPathStmt->close();


// Close the database connection
$con->close();
?>
