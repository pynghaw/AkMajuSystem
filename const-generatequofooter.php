<style>
    .checkout-footer {
        position: fixed;
        left: 18%;
        bottom: 20px;
        width: 80%;
        text-align: center;
        padding: 0px 0;
    }

</style>

<?php
$discountAmount = ($discount / 100) * $totalPrice;

// Calculate grand total
$grandTotal = $totalPrice - $discountAmount;

// Insert data into the quotation database
$insertQuotationSql = "INSERT INTO tb_quotation (q_cid, q_date, q_tAmount, q_discPercent, q_discAmount)
                       VALUES ('$customer_id', NOW(), '$grandTotal', '$discount', '$discountAmount')";
$insertQuotationResult = mysqli_query($con, $insertQuotationSql);
?>


<form method="POST" action="const-generatequoprocess.php">
<div class="checkout-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn mb-1 btn-rounded btn-success" style="margin-right: 10px;" onclick="goBack(event)">Go Back</button>
                        <button onclick="window.location.href='const-generatequoprocess.php'" type="submit" class="btn mb-1 btn-flat btn-primary">Generate Quotation</button>
                        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                        <!-- keep -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<div class="footer">
    <div class="copyright">
        <p>Copyright &copy; Designed & Developed by <a href=#>CryptoKnights</a> 2023</p>
    </div>
</div>

<script>
    // JavaScript function to go back to the previous page
    function goBack(event) {
        event.preventDefault();
        window.history.back();
    }
</script>

<!--**********************************
    Scripts
***********************************-->
<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>

<!-- Chartjs -->
<script src="./plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Circle progress -->
<script src="./plugins/circle-progress/circle-progress.min.js"></script>
<!-- Datamap -->
<script src="./plugins/d3v3/index.js"></script>
<script src="./plugins/topojson/topojson.min.js"></script>
<script src="./plugins/datamaps/datamaps.world.min.js"></script>
<!-- Morrisjs -->
<script src="./plugins/raphael/raphael.min.js"></script>
<script src="./plugins/morris/morris.min.js"></script>
<!-- Pignose Calender -->
<script src="./plugins/moment/moment.min.js"></script>
<script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script>
<!-- ChartistJS -->
<script src="./plugins/chartist/js/chartist.min.js"></script>
<script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>



<script src="./js/dashboard/dashboard-1.js"></script>
