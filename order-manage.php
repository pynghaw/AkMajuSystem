<?php
include 'headermain.php';
include 'dbconnect.php';

// Check if 'status' is set in the URL
$status = isset($_GET['status']) ? $_GET['status'] : 0; // Default status is pending (0)

// Check if 'sort' is set in the URL
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'o.o_date'; // Default sort by order date

// Query to get order information with filtering and sorting
$sql = "SELECT o.*, c.c_name, i.i_name, i.i_price 
        FROM tb_order o
        INNER JOIN tb_customer c ON o.o_cid = c.c_id
        INNER JOIN tb_inventory i ON o.o_ino = i.i_no
        WHERE o.o_status = $status
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

                            <div class="d-flex justify-content-between mb-3">

                            <div>
                                    <label for="status" class="mr-2">Show:</label>
                                    <select class="form-select" id="status" onchange="filterOrders(this.value)">
                                        <option value="0" <?php echo ($status == 0) ? 'selected' : ''; ?>>Pending Orders</option>
                                        <option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Confirmed Orders</option>
                                    </select>
                                </div>
                                <!-- Sorting dropdown -->
                                <div class="mr-3">
                                    <label for="sort" class="mr-2">Sort by:</label>
                                    <select class="form-select" id="sort" onchange="sortOrders(this.value)">
                                        <option value="o.o_date" <?php echo ($sort == 'o.o_date') ? 'selected' : ''; ?>>Order Date</option>
                                        <option value="c.c_name" <?php echo ($sort == 'c.c_name') ? 'selected' : ''; ?>>Customer Name</option>
                                        <option value="i.i_name" <?php echo ($sort == 'i.i_name') ? 'selected' : ''; ?>>Item Name</option>
                                    </select>
                                </div>

                                <!-- Filtering dropdown for pending/confirmed orders -->
                                
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
                <?php
                if ($status == 0) {
                    // Display "Operation" column header only for pending orders
                ?>
                    <th>Operation</th>
                <?php
                }
                ?>
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
                    <?php
                    if ($status == 0) {
                        // Display "Operation" column cells only for pending orders
                    ?>
                        <td>
                            <a href="order-modify.php?o_no=<?php echo $row['o_no']; ?>" class="btn btn-outline-secondary">Modify</a> &nbsp;
                            <a href="order-cancel.php?o_no=<?php echo $row['o_no']; ?>" onclick="return confirmDelete();" class="btn btn-outline-danger">Cancel Order</a>
                        </td>
                    <?php
                    }
                    ?>
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
    function filterOrders(status) {
        var url = window.location.href.split('?')[0]; // Get the current URL without parameters
        window.location.href = url + '?status=' + status;
    }

    function sortOrders(sortBy) {
        var url = window.location.href.split('?')[0]; // Get the current URL without parameters
        window.location.href = url + '?sort=' + sortBy;
    }

    function confirmDelete() {
        return confirm("Are you sure you want to cancel this order?");
    }
</script>
