<?php
include 'headermain.php';
include 'dbconnect.php';

$customer_id = $_POST['customer_id'];
$discount = $_POST['discount'];

// CRUD: Retrieve inventory with discounted prices
$sql = "SELECT i.*, COALESCE(o.o_quantity, 0) AS o_quantity
        FROM tb_inventory i
        LEFT JOIN tb_order o ON i.i_no = o.o_ino";

// Execute
$result = mysqli_query($con, $sql);

$sqlr = "SELECT i.* FROM tb_inventory i WHERE i.i_qty > 0 AND i.i_status='1'";

// Execute
$resultr = mysqli_query($con, $sqlr);
?>

<body>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Advertisement</a></li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>Inventory List</h2>
                            <p>Price with <?php echo $discount; ?>% Discount</p>

                            <!-- Add Order Section -->
                            <div>
                                <h3>Add Order</h3>
                                <form id="addOrderForm">
                                    <label for="selectItem">Select Item:</label>
                                    <select id="selectItem">
                                        <?php
                                        // Display available items for selection
                                        while ($row = mysqli_fetch_array($resultr)) {
                                            // Calculate discounted unit price
                                            $discountedPrice = $row['i_price'] * (1 - $discount / 100);
                                            echo "<option value='{$row['i_no']}' data-desc='{$row['i_desc']}' data-unit-price='{$discountedPrice}'>{$row['i_name']} (RM {$discountedPrice})</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="number" id="orderQuantity" placeholder="Quantity" min="0">
                                    <button type="button" class="btn btn-success btn-sm padd"onclick="addOrder()">Add Order</button>
                                </form>
                            </div>

                            <!-- Display Orders Section -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Unit Price (RM)</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selectedOrdersBody"></tbody>
                                </table>
                            </div>

                            <!-- Proceed to Checkout Button -->
                            <div>
                                <input type="hidden" id="customer_id" value="<?php echo $customer_id; ?>">
                                <input type="hidden" id="discount" value="<?php echo $discount; ?>">
                                <button type="button" class="btn btn-primary btn-sm padd" onclick="proceedToCheckout()">Proceed to Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var selectedOrders = [];

        function addOrder() {
            var selectedItem = document.getElementById('selectItem');
            var orderQuantity = document.getElementById('orderQuantity');

            if (orderQuantity.value && orderQuantity.value > 0) {
                var selectedOption = selectedItem.options[selectedItem.selectedIndex];
                var desc = selectedOption.getAttribute('data-desc');
                var unitPrice = selectedOption.getAttribute('data-unit-price');
                var discount = document.getElementById('discount').value;
                var order = {
                    id: selectedItem.value,
                    name: selectedOption.text,
                    desc: desc,
                    unitPrice: unitPrice,
                    quantity: orderQuantity.value
                };

                selectedOrders.push(order);
                displayOrders();
            } else {
                alert('Please enter a valid quantity.');
            }
        }

        function displayOrders() {
            var selectedOrdersBody = document.getElementById('selectedOrdersBody');
            selectedOrdersBody.innerHTML = '';

            for (var i = 0; i < selectedOrders.length; i++) {
                var order = selectedOrders[i];
                selectedOrdersBody.innerHTML +=
                    '<tr>' +
                    '<td>' + order.id + '</td>' +
                    '<td>' + order.name + '</td>' +
                    '<td>' + order.desc + '</td>' +
                    '<td>' + order.unitPrice + '</td>' +
                    '<td>' + order.quantity + '</td>' +
                    '<td><button type="button" onclick="removeOrder(' + i + ')">Remove</button></td>' +
                    '</tr>';
            }
        }

        function removeOrder(index) {
            selectedOrders.splice(index, 1);
            displayOrders();
        }

        function proceedToCheckout() {
            var queryString = '';
            for (var i = 0; i < selectedOrders.length; i++) {
                var order = selectedOrders[i];
                queryString += 'id[]=' + encodeURIComponent(order.id) + '&name[]=' + encodeURIComponent(order.name) +
                    '&desc[]=' + encodeURIComponent(order.desc) + '&unitPrice[]=' + encodeURIComponent(order.unitPrice) +
                    '&quantity[]=' + encodeURIComponent(order.quantity) + '&';
            }

            queryString = queryString.slice(0, -1);
            var customerId = document.getElementById('customer_id').value;
            queryString += '&customer_id=' + encodeURIComponent(customerId);
            var discount = document.getElementById('discount').value;
            window.location.href = 'order-checkout.php?' + queryString + '&discount=' + encodeURIComponent(discount);
        }
    </script>
</body>

<!-- Include your script tags for plugins, common, custom scripts, etc. -->
<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>

<script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</html>
