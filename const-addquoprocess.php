<?php
//connect to the database
include('dbconnect.php');

//retrieve data from registration form
$customer_id = $_POST['customer_id'];
$discount = $_POST['discount'];
$totalPrice = $_POST['totalPrice'];

//calculate
$discountAmount = ($discount / 100) * $totalPrice;
$grandTotal = $totalPrice - $discountAmount;

//Create-SQL Insert Statement
$insertQuotationSql = "INSERT INTO tb_quotation (q_cid, q_date, q_tAmount, q_discPercent, q_discAmount)
                        VALUES ('$customer_id', NOW(), '$grandTotal', '$discount', '$discountAmount')";
//Execute SQL
$insertQuotationResult = mysqli_query($con, $insertQuotationSql);

//Close DB Connection
mysqli_close($con);

//Redirect to Next Page
header('Location:const-generatequoprocess.php');
?>