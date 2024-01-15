<?php
include 'headermainadmin.php';
include 'dbconnect.php';

// Query to retrieve delivery orders along with customer name
$sql = "SELECT d.*, c.c_name
        FROM tb_delorder d
        INNER JOIN tb_invoice i ON d.d_ino = i.iv_no
        INNER JOIN tb_quotation q ON i.iv_qno = q.q_no
        INNER JOIN tb_customer c ON q.q_cid = c.c_id
        WHERE d.d_status = 0";
$result = mysqli_query($con, $sql);

?>

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Delivery Order Management</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h2>Manage Delivery Order</h2>
                        <?php
                        // Check if there are delivery orders
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table fixed-table table-bordered">';
                            echo '<thead class="thead-dark">';
                            echo '<tr>';
                            echo '<th>Delivery Order No</th>';
                            echo '<th>Customer Name</th>';
                            echo '<th>Delivery Date</th>';
                            echo '<th>Terms of Payment</th>';
                            echo '<th>Delivery Address</th>';
                            echo '<th  style="text-align: center;">Operation</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['d_no'] . '</td>';
                                echo '<td>' . $row['c_name'] . '</td>';
                                echo '<td>' . $row['d_date'] . '</td>';
                                echo '<td>' . $row['d_terms'] . '</td>';
                                echo '<td>' . $row['d_recpAdd'] . '</td>';
                                echo '<td  style="text-align: center;"><a href="do-review.php?d_no=' . $row['d_no'] . '" class="btn btn-secondary btn-sm padd">View</a> &nbsp;';
                                echo '<a href="do-delete1.php?d_no=' . $row['d_no'] . '" class="btn btn-danger btn-sm padd">Delete</a></td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo 'No delivery orders found.';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
