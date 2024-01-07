<?php
include 'headermain.php';
include 'dbconnect.php';

// Query to get order information
$sql="  SELECT * FROM tb_customer";

$result = mysqli_query($con, $sql);
?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Customer</a></li>
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
                            <h2>Manage Customer</h2>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Customer ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Billing Address</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['c_id']; ?></td>
                                                <td><?php echo $row['c_name']; ?></td>
                                                <td><?php echo $row['c_add']; ?></td>
                                                <td><?php echo $row['c_billAdd']; ?></td>
                                                <td><?php echo $row['c_email']; ?></td>
                                                <td><?php echo $row['c_cont']; ?></td>
                                                <td><?php echo '<a href="customer-modify.php?id=' . $row['c_id'] . '" class="btn btn-outline-secondary">Modify</a> &nbsp;';
                                                        echo '<a href="customer-remove.php?id=' . $row['c_id'] . '" class="btn btn-outline-danger">Remove</a>';?></td>
                                            </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            <?php
                        } else {
                            echo "<p>No records found.</p>";
                        }
                        ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div><br><br><br><br>
<!--**********************************
    Content body end
***********************************-->
<?php include 'customer-generatefooter.php'; ?>       

 
<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>


<script src="./plugins/sweetalert/js/sweetalert.min.js"></script>
<script src="./plugins/sweetalert/js/sweetalert.init.js"></script>

