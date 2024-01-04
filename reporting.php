<?php 
  include('dbconnect.php');
  include 'headermain.php';

?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="report-generateprocess.php">
                            <div class="container">
                                <form method="POST" action="generatequotation_2.php">
                                    <div class="container">
                                        <fieldset>
                                            <br>
                                            <h2 class="mb-4">Generate Monthly Sales Report</h2>

                                            <!-- Start Date Selection -->
                                            <div class="form-group">
                                                <label for="startDate" class="form-label mt-4">Start Date</label>
                                                <input type="date" class="form-control" id="startDate" name="sdate" style="width: 300px;">
                                            </div>

                                            <br>

                                            <!-- End Date Selection -->
                                            <div class="form-group">
                                                <label for="endDate" class="form-label mt-4">End Date</label>
                                                <input type="date" class="form-control" id="endDate" name="edate" style="width: 300px;">
                                            </div>

                                            <br>

                                            <button type="submit" class="btn btn-primary">Generate Report</button>
                                        </fieldset>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include 'footer.php'; ?>

