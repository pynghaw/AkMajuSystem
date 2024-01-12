<?php  
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');





$sql = "SELECT * FROM tb_inventory";
$result = mysqli_query($con, $sql);
$count = 0;


include 'headernotification.php';
include 'headermainadmin.php';

?>



<body>

    <!--**********************************
        Content body start
    ***********************************-->
    <style>
        /* Set fixed width for table cells */
        .fixed-table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse; /* Add border-collapse property */
        }

        .fixed-table th, .fixed-table td {
            word-wrap: break-word; /* Wrap long words */
            overflow-wrap: break-word;
            padding: 8px;
            border: 1px solid #ddd; /* Add border property */
        }

        .fixed-table th {
            background-color: #8B85FB;
        }

        /* Adjust the width and borders of the columns */
        .fixed-table th:first-child,
.fixed-table td:first-child {
    width: 50px;
}

.fixed-table th:nth-child(2),
.fixed-table td:nth-child(2) {
    width: 80px;
}

.fixed-table th:nth-child(3),
.fixed-table td:nth-child(3) {
    width: 150px;
}

.fixed-table th:nth-child(4),
.fixed-table td:nth-child(4) {
    width: 250px;
}

.fixed-table th:nth-child(5),
.fixed-table td:nth-child(5) {
    width: 80px;
}

.fixed-table th:nth-child(6),
.fixed-table td:nth-child(6) {
    width: 100px;
}

.fixed-table th:nth-child(7),
.fixed-table td:nth-child(7) {
    width: 60px;
}

.fixed-table th:nth-child(8),
.fixed-table td:nth-child(8) {
    width: 100px;
}

.fixed-table th:nth-child(9),
.fixed-table td:nth-child(9) {
    width:80px;
}

    </style>

    <div class="content-body">
        <? php // Display success message
if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            {$_SESSION['success_message']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";

    unset($_SESSION['success_message']);
}

// Display error message
if (isset($_SESSION['error_message'])) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            {$_SESSION['error_message']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";

    unset($_SESSION['error_message']);
}?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="container mt-4">
                            <h1 class="mb-4" style="text-align: center;">Inventory</h1><br><br>
                           <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="AddInventory1.php" class="btn btn-success"><i class="fa fa-plus-circle" style="font-size:15px;"></i>Add Inventory</a>
                                </div>
                                <div class="mx-2">
                                    <button type="button" class="btn btn-secondary" onclick="showAllProducts()">Show All Products</button>
                                </div>
                                <div class="form-inline">
                                    <label class="sr-only" for="search">Search</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="search" placeholder="Search by Product Name">
                                        <button type="button" class="btn btn-primary" onclick="searchInventory()">Search</button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table id="inventoryTable" class="table fixed-table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Cost</th>
                                            <th>Mark Up Rate</th>
                                            <th>Unit Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $lowStockProducts = []; 
                                        while ($row = mysqli_fetch_array($result)) {
                                            $count++;
                                            // Check if quantity is less than 5 and store in array
                                            if ($row['i_qty'] < 5) {
                                                $lowStockProducts[] = $row;
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['i_no']; ?></td>
                                                <td><?php echo $row['i_name']; ?></td>
                                                <td><?php echo $row['i_desc']; ?></td>
                                                <td><?php echo $row['i_qty']; ?></td>
                                                 <td>RM <?php echo $row['i_cost']; ?></td>
                                                  <td> <?php echo $row['i_markupRate']; ?>%</td>
                                                <td>RM <?php echo $row['i_price']; ?></td>
                                                <td>
                                                    <a href="modify1.php?id=<?php echo $row['i_no']; ?>" class="btn btn-warning btn-sm padd"><i class="bi bi-pencil-square"></i> Modify</a><br><br>

                                                    <a href="Delete1.php?id=<?php echo $row['i_no']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                                    
                                                </td>
                                            </tr>
                                              
                                        <?php
                                        }
                                        ?>
                                 <?php if (!empty($lowStockProducts)) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong style="font-size: 20px;">Low in stock:</strong>
        <ul>
            <?php foreach ($lowStockProducts as $product) : ?>
                <li><b>Product: </b><?php echo $product['i_name']; ?> (Quantity left: <?php echo $product['i_qty']; ?>)</li>
            <?php endforeach; ?>
        </ul>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
<?php endif; ?>

                                    </tbody>
                                </table>

<?php 
$color = 'grey';
echo "<p style='color: $color;'><i>Total Product: $count</i></p>";
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    mysqli_close($con);
    include 'footer.php';
    ?>

</body>

<script>
    function searchInventory() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("inventoryTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; // Index 2 corresponds to the Product Name column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
        
    }
</script>

<script>
    function showAllProducts() {
        var table, tr;
        table = document.getElementById("inventoryTable");
        tr = table.getElementsByTagName("tr");

        for (var i = 0; i < tr.length; i++) {
            tr[i].style.display = "";
        }
    }
</script>
