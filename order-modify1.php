<?php
include 'headermainadmin.php';
include 'dbconnect.php';

// Check if 'o_no' is set in the URL
if (isset($_GET['o_no'])) {
    $orderno = $_GET['o_no'];

    // Retrieve specific order data based on the provided order number
    $sqlr = "SELECT o.*, c.c_name, i.i_name, i.i_price 
            FROM tb_order o
            INNER JOIN tb_customer c ON o.o_cid = c.c_id
            INNER JOIN tb_inventory i ON o.o_ino = i.i_no
            WHERE o.o_no = '$orderno'";
    
    // Execute the query
    $resultr = mysqli_query($con, $sqlr);
    
    // Fetch the order details
    $rowr = mysqli_fetch_array($resultr);
}

?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Orders</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Modify Order</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <form method="POST" action="order-modifyprocess1.php">
                                <div class="container">
                                    <fieldset>
                                        <br>
                                        <legend>Modification Form</legend>
                                        <div class="form-group">
                                            <label for="exampleSelect1" class="form-label mt-4">Select Item</label>
                                            <br>
                                            <?php
                                            $sql = "SELECT * FROM tb_inventory";
                                            $result = mysqli_query($con, $sql);
                                            echo '<select class="form-select" id="exampleSelect1" name="fino">';
                                            while ($row = mysqli_fetch_array($result)) {
                                                if ($row['i_no'] == $rowr['o_ino']) {
                                                    echo "<option selected='selected' value='" . $row['i_no'] . "'>" . $row['i_name'] . ", RM " . $row['i_price'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $row['i_no'] . "'>" . $row['i_name'] . ", RM " . $row['i_price'] . "</option>";
                                                }
                                            }
                                            echo '</select>';
                                            ?>
                                        </div>

                                        <div>
                                            <label for="exampleInputPassword1" class="form-label mt-4">Quantity</label>
                                            <input type="text" name="fqty" class="form-control" placeholder="Enter Quantity" value="<?php echo $rowr['o_quantity']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="form-label mt-4">Select Order Date</label>
                                            <input type="date" name="fdate" class="form-control" value="<?php echo $rowr['o_date']; ?>" required>
                                        </div>

                                        <input type="hidden" name="fno" value="<?php echo $rowr['o_no']; ?>">
                                        <br>
                                        <button type="submit" class="btn btn-primary">Modify</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                    </fieldset>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->

<?php include 'footer.php'; ?>
