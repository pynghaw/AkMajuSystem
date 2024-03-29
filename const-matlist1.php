<?php 
include 'headermainadmin.php';
include('dbconnect.php');

$customer_id = $_POST['customer_id'];
$discount = $_POST['discount'];
$state = $_POST['state'];
$distance = $_POST['distance'];
$addpercentage = '';

$states = ['Perlis', 'Kedah', 'Pulau Pinang', 'Perak', 'Selangor', 'Negeri Sembilan', 'Melaka', 'Johor', 'Pahang', 'Terengganu', 'Kelantan', 'Sabah', 'Sarawak', 'Wilayah Persekutuan Labuan'];
$addPercentage = 0;

foreach ($states as $index => $stateName) {
    if ($state == $stateName) {
        $addPercentage = 3 + $index; // Starts at 3 for Perlis and increments by 1 for each subsequent state
        break;
    }
}

//CRUD: Retrieve booking
$sql="SELECT * FROM tb_matlist";

//Execute
$result=mysqli_query($con,$sql);

?>
<body>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Construction</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2>Material List</h2>
                                <p>Price with <?php echo $addPercentage ; ?>% addtional</p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Unit Price (RM)</th>
                                                <th>Quantity</th>
                                                <th>Add/Minus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($row=mysqli_fetch_array($result))
                                                {
                                                    echo "<tr>";
                                                    echo"<td>".$row['m_id']. "</td>";
                                                    echo"<td>".$row['m_name']. "</td>";
                                                    echo"<td>".$row['m_type']. "</td>";
                                                    echo"<td>".$row['m_desc']. "</td>";

                                                    // Calculate the new price
                                                    $originalPrice = $row['m_price'];
                                                    $modifiedPrice = $originalPrice + ($originalPrice * $addPercentage / 100);
                                                    echo"<td>".$modifiedPrice. "</td>"; // Display the modified price
                                                    echo"<td>".$row['m_qty']. "</td>";
                                                    echo "<td>";
                                                        echo "<a href='const-modifyprocess.php?id=".$row['m_id']."&action=add' class='btn btn-warning'>+</a>&nbsp";
                                                        echo "<a href='const-modifyprocess.php?id=".$row['m_id']."&action=minus' class='btn btn-danger'>-</a>";
                                                    echo"</td>";
                                                    echo "</tr>";
                                                } 

                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th>Add/Minus</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
        
        <?php include 'const-checkoutfooter1.php'; ?>
</body>
<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>

<script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
