
<?php  
include('mysession.php');

if (!session_id()) {
    session_start();
}

if (isset($_GET['id'])) {
    $fno = $_GET['id'];
}

include('dbconnect.php');

// Prepare and bind the SQL statement with a parameter
$sqlr = "SELECT * FROM tb_inventory WHERE i_no = ?";
$stmt = $con->prepare($sqlr);
$stmt->bind_param("s", $fno);

// Execute the prepared statement
$stmt->execute();

// Get the result
$resultr = $stmt->get_result();
$rowr = $resultr->fetch_array();
include 'headermainadmin.php'; ?>
<body>
        <!--**********************************
            Content body start
        ***********************************-->
      <div class="content-body">

            
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="container mt-4">
<div class="container">
    <form method="POST" action="modifyprocess1.php">
        <fieldset>
            <legend>Modify Product Form</legend>

            <div class="form-group">
                <label for="exampleInputP" class="form-label mt-4">Product Name</label>

                <?php
                echo '<input type="text" value="' . $rowr['i_name'] . '" name="InventoryName" class="form-control" id="exampleInputPassword1" placeholder="Product Name"';
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputP" class="form-label mt-4">Product ID</label>

                <?php
                echo '<input type="text" value="' . $rowr['i_no'] . '" name="InventoryNo" class="form-control" id="exampleInputPassword1" placeholder="Product ID" readonly';
                ?>
                <div class="small">can`t edit product id</div>
            </div>

            <div class="form-group">
                <label for="exampleInputP" class="form-label mt-4">Quantity</label>

                <?php
                echo '<input type="number" value="' . $rowr['i_qty'] . '" name="Quantity" class="form-control" id="exampleInputPassword1" placeholder="Quantity"';
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputP" class="form-label mt-4">Cost (RM)</label>

                <?php
                echo '<input type="number" value="' . $rowr['i_cost'] . '" name="cost" class="form-control" id="exampleInputPassword1" placeholder="UnitPrice" step="any"';
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputP" class="form-label mt-4">Mark Up Rate(%)</label>

                <?php
                echo '<input type="number" value="' . $rowr['i_markupRate'] . '" name="rate" class="form-control" id="exampleInputPassword1" placeholder="UnitPrice" step="any"';
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputP" class="form-label mt-4">Unit Price (RM)</label>

                <?php
                echo '<input type="number" value="' . $rowr['i_price'] . '" name="UnitPrice" class="form-control" id="exampleInputPassword1" placeholder="UnitPrice" step="any" disabled';
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputP" class="form-label mt-4">Description</label>

                <?php
                echo '<input type="text" value="' . $rowr['i_desc'] . '" name="description" class="form-control" id="exampleInputPassword1" placeholder="Description"';
                ?>
            </div>
            <br>
            <div style="display: flex; justify-content: center;">
            <button type="submit" class="btn btn-warning btn-sm padd">Modify</button>
</div>
        </fieldset>

    </form>
</div>

<br><br><br>

    
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</body>

        <!--**********************************
            Content body end
        ***********************************-->

        <?php include 
       

        'footer.php'; ?>
</body>
