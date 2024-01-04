<style>
    .checkout-footer {
        position: fixed;
        left: 0;
        bottom: 40px;
        width: 100%;
        background-color: #888;
        color: white;
        text-align: center;
        padding: 10px 0;
    }

    .checkout-footer button {
        background-color: black;
        color: white;
        padding: 10px 20px;
        margin: 10px 10px 10px 0;
        border: none;
        cursor: pointer;
    }

    .checkout-footer button:hover {
        background-color: lightgrey;
    }

    button.go-back-button {
        background-color: #4CAF50; /* Green background */
        color: white;
    }

    button.go-back-button:hover {
        background-color: #45a049; /* Darker green on hover */
    }
</style>


<div class="checkout-footer">
    <button class="go-back-button" onclick="goBack()">Go Back</button>
    <button onclick="window.location.href='const-generatequoprocess.php'">Generate Quotation</button>
</div>

<div class="footer">
    <div class="copyright">
        <p>Copyright &copy; Designed & Developed by <a href=#>CryptoKnights</a> 2023</p>
    </div>
</div>

<script>
    // JavaScript function to go back to the previous page
    function goBack() {
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
