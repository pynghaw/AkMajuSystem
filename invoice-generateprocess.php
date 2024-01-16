<?php
include('dbconnect.php');
include('pdffooter-invoice.php');
require 'fpdf186/fpdf.php';

$q_no = $_POST['q_no'];
$upfront = $_POST['upfront'];

// Fetch customer details and other necessary data from tb_quotation
$quotationDetailsSql = "SELECT q.*, c.c_billAdd, c.c_name
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
$billingaddress = $quotationDetails['c_billAdd'];
$customerName = $quotationDetails['c_name'];

// Save the current date as the date of generating the invoice
$currentDate = date('Y-m-d');


$iv_balance = $quotationDetails['q_tAmount'] - $upfront;

$updateQuotationStatusSql = "UPDATE tb_quotation SET q_status = 1 WHERE q_no = $q_no";
mysqli_query($con, $updateQuotationStatusSql);

$insertInvoiceSql = "INSERT INTO tb_invoice (iv_cid, iv_qno, iv_upFront, iv_bal, iv_date, iv_tAmount) 
                     VALUES ($customer_id, $q_no, $upfront, $iv_balance, '$currentDate', {$quotationDetails['q_tAmount']})";
mysqli_query($con, $insertInvoiceSql);

// Fetch iv_no and iv_date from the inserted invoice
$invoiceDetailsSql = "SELECT iv_no, iv_date FROM tb_invoice WHERE iv_qno = $q_no";
$invoiceDetailsResult = mysqli_query($con, $invoiceDetailsSql);
$invoiceDetails = mysqli_fetch_assoc($invoiceDetailsResult);


$orderDetailsSql = "SELECT o.*, i.i_desc, i.i_price
                    FROM tb_order o
                    INNER JOIN tb_inventory i ON o.o_ino = i.i_no
                    WHERE o.o_qno = $q_no";
$orderDetailsResult = mysqli_query($con, $orderDetailsSql);
$filePath = 'invoice/Invoice_' . $invoiceDetails['iv_date'] . '_' . $invoiceDetails['iv_no'] . '.pdf';
// Update Database with File Path
$insertPathStmt = $con->prepare("UPDATE tb_invoice SET iv_filepath = ? WHERE iv_no = ?");
$insertPathStmt->bind_param("si", $filePath, $invoiceDetails['iv_no']);
$insertPathStmt->execute();
$insertPathStmt->close();

// Fetch updated invoice details
$updatedInvoiceDetailsSql = "SELECT iv_no, iv_date FROM tb_invoice WHERE iv_qno = $q_no";
$updatedInvoiceDetailsResult = mysqli_query($con, $updatedInvoiceDetailsSql);
$updatedInvoiceDetails = mysqli_fetch_assoc($updatedInvoiceDetailsResult);

// Create PDF
$pdf = new FPDF('P','mm', 'A4');

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Invoice');
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
$pdf->Cell(0, 5, 'INVOICE', 0, 1, 'C'); // Centered title with line 
$pdf->SetDrawColor(0, 0, 0); // Set line color to black
$pdf->SetLineWidth(0.3); // Set line width (adjust as needed)
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Adjust the coordinates and width as needed
$pdf->Ln();

//lines under title
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 5, 'TO,', 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(30, 3, "$customerName\n
$billingaddress");
$pdf->SetXY(126, 56);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(0, 2.5, 
    "    INVOICE NUMBER\n
    INVOICE DATE\n
    TERMS OF PAYMENT\n
    SST REGISTRATION. NO.", 0, 'L');
// Add the Cell on the right
$pdf->SetXY(170, 56);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 2.5, 
"{$invoiceDetails['iv_no']}\n\n" .
"{$invoiceDetails['iv_date']}\n\n" .
    "LO\n\n" .
    "000", 0, 'L');
$pdf->Ln();
$pdf->Ln(8);


//below billing address
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 8, 'Dear Sir/Madam, herewith is our Invoice generated for your perusal.', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 8, 'ITEM DETAILS', 0, 1, 'L');


// Header
$pdf->SetLineWidth(0.1);
$pdf->SetFont('Times', 'B', 5);
$pdf->Cell(15, 10, 'S.NO', 1);
$pdf->Cell(75, 10, 'ITEM DESCRIPTION', 1);
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

while ($row = mysqli_fetch_assoc($orderDetailsResult)) {
    $itemTotal = $row['o_quantity'] * $row['i_price'];
    $total += $itemTotal;
    $discount = $quotationDetails['q_discPercent'];
    // Calculate discount amount for each item
    $discountAmountPerItem = ($discount / 100) * $itemTotal;
    $discountedItemTotal = $itemTotal - $discountAmountPerItem;
    $grandTotal += $discountedItemTotal;
 
    $orderUpdateSql = "UPDATE tb_order SET o_ivno = {$updatedInvoiceDetails['iv_no']} WHERE o_no = {$row['o_no']}";
    mysqli_query($con, $orderUpdateSql);

    // Break the item description into two lines
    $descLines = explode("\n", wordwrap($row['i_desc'], 40, "\n"));

    // Use Cell for each line of the item description
    $pdf->Cell(15, 10, $index, 1); // Display sequential index
    $index++; // Increment the index for the next item
    $pdf->Cell(75, 10, $descLines[0], 1);
    $pdf->Cell(15, 10, $row['o_quantity'], 1);

    $formattedUnitPrice = number_format($row['i_price'], 2);
    $formattedDiscountAmountPerItem = number_format($discountAmountPerItem, 2);
    $formattedDiscountedItemTotal = number_format($discountedItemTotal, 2);

    $pdf->Cell(20, 10, $formattedUnitPrice, 1);
    $pdf->Cell(20, 10, $quotationDetails['q_discPercent'], 1); // Display discount percentage
    $pdf->Cell(20, 10, $formattedDiscountAmountPerItem, 1); // Display discount amount per item
    $pdf->Cell(25, 10, $formattedDiscountedItemTotal, 1); // Display total incl. discount
    $pdf->Ln();
}

$formattedGrandTotal=number_format($grandTotal,2);
$formattedUpFront=number_format($upfront,2);
$formattediv_balance=number_format($iv_balance,2);
// Footer
$pdf->Cell(125, 10, '', 0,);
$pdf->Cell(40, 10, 'GRAND TOTAL', 1,);
$pdf->Cell(25, 10, $formattedGrandTotal, 1);
$pdf->Ln();
$pdf->Cell(125, 10, '', 0,);
$pdf->Cell(40, 10, 'UP FRONT', 1);
$pdf->Cell(25, 10, $formattedUpFront, 1);
$pdf->Ln();
$pdf->Cell(125, 10, '', 0,);
$pdf->Cell(40, 10, 'BALANCE', 1);
$pdf->Cell(25, 10, $formattediv_balance, 1);
$pdf->Ln();

// Output the PDF
$pdfFooter = new PDFFooter();
$pdfFooter->addFooter($pdf);

$pdf->Output('F', $filePath);
$pdf->Output();

$pdf->Close();


// Close the database connection
$con->close();
?>
