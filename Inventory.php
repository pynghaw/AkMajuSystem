<?php 

include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

$sql = "SELECT * FROM tb_inventory";
$result = mysqli_query($con, $sql);
include ('headermain.php');
?>

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
    <h2 class="mb-4">Inventory</h2>

    <style>
        .inventory-card {
            border: 2px solid #333;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .inventory-table {
            width: 100%;
            max-width: 400px; /* Adjust the max-width to your desired value */
            border-collapse: collapse;
            margin-top: 15px;
        }

        .inventory-table th,
        .inventory-table td {
            border: none; /* Remove border lines */
            padding: 10px;
            text-align: left; /* Align text to the left */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .inventory-table th {
            text-align: left; /* Align header text to the center */
            font-weight: bold;
        }
    </style>

    <div class="row">
        <?php
        $count = 0;
        while ($row = mysqli_fetch_array($result)) {
            $count++;
            echo '<div class="col-md-6">';
            echo '<div class="inventory-card">';
            echo ' <p>No: ' . $count . '</p>';
            echo '<h4 style="text-align: center; word-wrap: break-word;"><b> ' . $row['i_name'] . '</b></h4><hr>';
            
            echo '<table class="inventory-table">';
            echo '<tr>';
            echo '<th>Product ID</th>';
            echo '<td>' . $row['i_no'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<th>Quantity</th>';
            echo '<td>' . $row['i_qty'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<th>Unit Price</th>';
            echo '<td>RM ' . $row['i_price'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<th>Description</th>';
            echo '<td>' . $row['i_desc'] . '</td>';
            echo '</tr>';
            
            echo '</table><br>';
            
            echo '<a href="modify.php?id=' . $row['i_no'] . '" class="btn btn-warning btn-sm padd"><i class="bi bi-pencil-square"></i> Modify</a>';
            echo '   <a href="Delete.php?id=' . $row['i_no'] . '" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</a>';
            echo '</div>';
            echo '</div>';

            // Check if we need to start a new row
            if ($count % 2 == 0) {
                echo '</div><div class="row">';
            }
        }
        ?>
    </div>
</div>

<br><br>
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

<?php 
mysqli_close($con);
include ('footer.php');?>