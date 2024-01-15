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

<form method="POST" action="const-checkoutsummary1.php">
<div class="checkout-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button onclick="window.location.href='const-checkoutsummary1.php'" type="submit" class="btn mb-1 btn-primary">Checkout <span class="btn-icon-right"><i class="fa fa-shopping-cart"></i></span></button>
                        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                        <input type="hidden" name="discount" value="<?php echo $discount; ?>">
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
