<?php
include 'headermain.php';
include 'dbconnect.php';

// Query to get order information
$sql = "SELECT o.*, c.c_name, i.i_name, i.i_price 
        FROM tb_order o
        INNER JOIN tb_customer c ON o.o_cid = c.c_id
        INNER JOIN tb_inventory i ON o.o_ino = i.i_no
        ORDER BY o.o_date DESC";

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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Orders</a></li>
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
                            <h2>Manage Orders</h2>

                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Order ID</th>';
                                echo '<th>Customer Name</th>';
                                echo '<th>Item Name</th>';
                                echo '<th>Quantity</th>';
                                echo '<th>Order Date</th>';
                                echo '<th>Operation</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['o_no'] . '</td>';
                                    echo '<td>' . $row['c_name'] . '</td>';
                                    echo '<td>' . $row['i_name'] . '</td>';
                                    echo '<td>' . $row['o_quantity'] . '</td>';
                                    echo '<td>' . $row['o_date'] . '</td>';
                                    echo '<td><a href="ordermodify.php?id=' . $row['o_no'] . '" class="btn btn-outline-secondary">Modify</a> &nbsp;';
                                    echo '<a href="ordercancel.php?id=' . $row['o_no'] . '" class="btn btn-outline-danger">Cancel Order</a></td>';
                                    echo '</tr>';
                                }

                                echo '</tbody>';
                                echo '</table>';
                            } else {
                                echo '<p>No orders found.</p>';
                            }
                            ?>

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

<?php
include 'footer.php';
mysqli_close($con);
?>
