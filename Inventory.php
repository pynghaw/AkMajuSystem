<?php  
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');


// Display success message
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
}

$sql = "SELECT * FROM tb_inventory";
$result = mysqli_query($con, $sql);
$count = 0;
include 'headernotification.php';
include 'headermain.php';

?>

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
            background-color: #D5F3FE;
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
            width: 120px;
        }

        .fixed-table th:nth-child(4),
        .fixed-table td:nth-child(4) {
            width: 200px;
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
            width: 120px;
        }
    </style>

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="container mt-4">
                            <h1 class="mb-4" style="text-align: center;">Inventory</h1><br><br>
                           <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="AddInventory.php" class="btn btn-success"><i class="fa fa-shopping-cart"></i>Add Inventory</a>
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
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        while ($row = mysqli_fetch_array($result)) {
                                            $count++;
                                        ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['i_no']; ?></td>
                                                <td><?php echo $row['i_name']; ?></td>
                                                <td><?php echo $row['i_desc']; ?></td>
                                                <td><?php echo $row['i_qty']; ?></td>
                                                <td>RM <?php echo $row['i_price']; ?></td>
                                                <td>
                                                    <a href="modify.php?id=<?php echo $row['i_no']; ?>" class="btn btn-warning btn-sm padd"><i class="bi bi-pencil-square"></i> Modify</a>
                                                    <a href="Delete.php?id=<?php echo $row['i_no']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
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
