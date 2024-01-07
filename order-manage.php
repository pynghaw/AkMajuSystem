<?php
include 'headermain.php';
include 'dbconnect.php';

// Check if 'sort' is set in the URL
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'o.o_date'; // Default sort by order date

// Query to get order information with sorting
$sql = "SELECT o.*, c.c_name, i.i_name, i.i_price 
        FROM tb_order o
        INNER JOIN tb_customer c ON o.o_cid = c.c_id
        INNER JOIN tb_inventory i ON o.o_ino = i.i_no
        ORDER BY $sort DESC"; // Use the specified sorting column

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

                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="order-place.php" class="btn btn-success"><i class="fa fa-plus-circle" style="font-size:15px;"></i>Add Orders</a>
                                </div>
                                <div class="mx-2">
                                    <button type="button" class="btn btn-secondary" onclick="filterProducts(true)">Show All Products</button>
                                </div>
                                <div class="form-inline">
                                    <label class="sr-only" for="search">Search</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="search" placeholder="Search by Product Name">
                                        <button type="button" class="btn btn-primary" onclick="filterProducts()">Search</button>
                                    </div>
                                </div>

                                <!-- Sorting dropdown -->
                                <div class="mx-2">
                                    <label for="sort" class="mr-2">Sort by:</label>
                                    <select class="form-select" id="sort" onchange="sortOrders(this.value)">
                                        <option value="o.o_date" <?php echo ($sort == 'o.o_date') ? 'selected' : ''; ?>>Order Date</option>
                                        <option value="c.c_name" <?php echo ($sort == 'c.c_name') ? 'selected' : ''; ?>>Customer Name</option>
                                        <option value="i.i_name" <?php echo ($sort == 'i.i_name') ? 'selected' : ''; ?>>Item Name</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="inventoryTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Order Date</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['o_no']; ?></td>
                                                <td><?php echo $row['c_name']; ?></td>
                                                <td><?php echo $row['i_name']; ?></td>
                                                <td><?php echo $row['o_quantity']; ?></td>
                                                <td><?php echo $row['o_date']; ?></td>
                                                <td>
                                                    <a href="order-modify.php?o_no=<?php echo $row['o_no']; ?>" class="btn btn-outline-secondary">Modify</a> &nbsp;
                                                    <a href="order-cancel.php?o_no=<?php echo $row['o_no']; ?>" class="btn btn-outline-danger">Cancel Order</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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

<!-- JavaScript for filtering, sorting, and displaying products -->
<script>
    function filterProducts(showAll = false) {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("inventoryTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; // Index 2 corresponds to the Product Name column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (showAll || txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function sortOrders(sortBy) {
        var url = window.location.href.split('?')[0]; // Get the current URL without parameters
        window.location.href = url + '?sort=' + sortBy;
    }
</script>
