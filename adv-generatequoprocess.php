<?php
include('dbconnect.php');
require 'fpdf186/fpdf.php';

// Retrieve data from page3.php
$customer_id = $_POST['customer_id'];
$order_date = $_POST['order_date'];
$discount = $_POST['discount'];

// Query to retrieve orders for the selected customer on the selected date
$sql = "SELECT o.*, i.i_desc, i.i_price FROM tb_order o
        INNER JOIN tb_inventory i ON o.o_ino = i.i_no
        WHERE o.o_cid = $customer_id AND o.o_date = '$order_date'";
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


// Create PDF
$pdf = new FPDF();
$pdf->AddPage();

// Title
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, 'QUOTATION', 0, 1, 'C'); // Centered title with line 
$pdf->SetDrawColor(0, 0, 0); // Set line color to black
$pdf->SetLineWidth(0.5); // Set line width (adjust as needed)
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Adjust the coordinates and width as needed


// Billing Address and Quotation No and Date
$pdf->SetFont('Times', 'B', 8);
$pdf->Cell(80, 10, 'To,', 0);
$pdf->SetFont('Times', '', 8);
$pdf->Cell(0, 10, 'Quotation No: ' . $quotationNumber . '   Quotation Date: ' . $quotationDate, 0, 1, 'R');
$pdf->SetFont('Times', '', 8);
// Use multiCell for better formatting
$pdf->MultiCell(30, 5, $billingAddress);
$pdf->Ln(); // Add a line break for separation



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
$pdf->Output('quotation.pdf', 'D');
?>
