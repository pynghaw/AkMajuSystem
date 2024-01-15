<?php
include('dbconnect.php');
include('pdffooter.php');
require 'fpdf186/fpdf.php';

// Retrieve data from page3.php
$customer_id = $_POST['customer_id'];
$discount = $_POST['discount'];

$insertQuotationSql = "INSERT INTO tb_quotation (q_cid, q_date, q_discPercent) VALUES ('$customer_id', NOW(), '$discount')";
$insertQuotationResult = mysqli_query($con, $insertQuotationSql);

// Check if orders with status 0 exist for the selected customer on the selected date
$orderCheckSql = "SELECT COUNT(*) AS orderCount FROM tb_order WHERE o_cid = $customer_id AND o_status = 0";
$orderCheckResult = mysqli_query($con, $orderCheckSql);
$orderCheckRow = mysqli_fetch_assoc($orderCheckResult);
$orderCount = $orderCheckRow['orderCount'];

if ($orderCount > 0) {
    // Query to retrieve orders with status 0 for the selected customer on the selected date
    $sql = "SELECT o.*, i.i_desc, i.i_price FROM tb_order o
            INNER JOIN tb_inventory i ON o.o_ino = i.i_no
            WHERE o.o_cid = $customer_id AND o.o_status = 0";
    $result = mysqli_query($con, $sql);

    // Fetch Quotation Number from Quotation Database
    $quotationNumberSql = "SELECT q_no FROM tb_quotation ORDER BY q_no DESC LIMIT 1";
    $quotationNumberResult = mysqli_query($con, $quotationNumberSql);
    $quotationNumberRow = mysqli_fetch_assoc($quotationNumberResult);
    $quotationNumber = $quotationNumberRow['q_no'];

    // Fetch Billing Address from Customer Database
    $billingAddressSql = "SELECT c_billAdd FROM tb_customer WHERE c_id = $customer_id";
    $billingAddressResult = mysqli_query($con, $billingAddressSql);
    $billingAddressRow = mysqli_fetch_assoc($billingAddressResult);
    $billingAddress = $billingAddressRow['c_billAdd'];

    // Fetch Quotation Number and Date from Quotation Database
    $quotationInfoSql = "SELECT q_no, q_date FROM tb_quotation ORDER BY q_no DESC LIMIT 1";
    $quotationInfoResult = mysqli_query($con, $quotationInfoSql);
    $quotationInfoRow = mysqli_fetch_assoc($quotationInfoResult);
    $quotationNumber = $quotationInfoRow['q_no'];
    $quotationDate = $quotationInfoRow['q_date'];

    $customerInfoSql = "SELECT c_name, c_billAdd FROM tb_customer WHERE c_id = $customer_id";
    $customerInfoResult = mysqli_query($con, $customerInfoSql);
    $customerInfoRow = mysqli_fetch_assoc($customerInfoResult);
    $customerName = $customerInfoRow['c_name'];
    $billingAddress = $customerInfoRow['c_billAdd'];

    // Create PDF
    $pdf = new FPDF('P', 'mm', 'A4');

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


// Initialize total variables
$total = 0;
$grandTotal = 0;
$index = 1;

// Loop through the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Use the same $q_no value for every order in the loop
    $itemTotal = $row['o_quantity'] * $row['i_price'];

    // Calculate discount amount for each item
    $discountAmountPerItem = ($discount / 100) * $itemTotal;
    $discountedItemTotal = $itemTotal - $discountAmountPerItem;


    // Update order status and quotation number
    $orderUpdateSql = "UPDATE tb_order SET o_status = 0, o_qno = $quotationNumber WHERE o_no = {$row['o_no']}";
    mysqli_query($con, $orderUpdateSql);

    $grandTotal += $discountedItemTotal;
    // Break the item description into two lines
    $descLines = explode("\n", wordwrap($row['i_desc'], 40, "\n"));

    // Use Cell for each line of the item description
    $pdf->Cell(20, 10, $index, 1); // Display sequential index
    $index++; // Increment the index for the next item
    $pdf->Cell(70, 10, $descLines[0], 1);
    $pdf->Cell(15, 10, $row['o_quantity'], 1);

    $formattedUnitPrice = number_format($row['i_price'], 2);
    $formattedDiscountAmountPerItem = number_format($discountAmountPerItem, 2);
    $formattedDiscountedItemTotal = number_format($discountedItemTotal, 2);

    $pdf->Cell(20, 10, $formattedUnitPrice, 1);
    $pdf->Cell(20, 10, $discount, 1); // Display discount percentage
    $pdf->Cell(20, 10, $formattedDiscountAmountPerItem, 1); // Display discount amount per item
    $pdf->Cell(25, 10, $formattedDiscountedItemTotal, 1); // Display total incl. discount
    $pdf->Ln();
}
$updateQuotationSql = "UPDATE tb_quotation SET q_tAmount = '$grandTotal', q_discAmount = '$discountedItemTotal', q_type = 1 WHERE q_no = $quotationNumber";
$updateQuotationResult = mysqli_query($con, $updateQuotationSql);

$formattedGrandTotal=number_format($grandTotal,2);
// Footer
$pdf->Cell(165, 10, 'GRAND TOTAL', 1);
$pdf->Cell(25, 10, $formattedGrandTotal, 1);
$pdf->Ln();

// Output the PDF
    $filePath = 'quotation/advertisement/Quotation_' . $quotationDate . '_' . $quotationNumber . '.pdf';
    $pdfFooter = new PDFFooter();
    $pdfFooter->addFooter($pdf);
    $pdf->Output('F', $filePath);
    $pdf->Output();

    // Update Database with File Path
    $insertPathStmt = $con->prepare("UPDATE tb_quotation SET q_filepath = ? WHERE q_no = ?");
    $insertPathStmt->bind_param("si", $filePath, $quotationNumber);
    $insertPathStmt->execute();
    $insertPathStmt->close();

    // Close the database connection
    $con->close();
} else {
    echo "No pending orders for the selected customer on the selected date.";
}
?>
