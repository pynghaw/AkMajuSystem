<?php
include 'headermain.php';
include('dbconnect.php');
require 'fpdf186/fpdf.php';

// Query to retrieve invoices along with customer name
$sql = "SELECT i.*, q.q_no, c.c_name
        FROM tb_invoice i
        INNER JOIN tb_quotation q ON i.iv_qno = q.q_no
        INNER JOIN tb_customer c ON q.q_cid = c.c_id
        ORDER BY i.iv_no ASC";
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Customer</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <form method="POST" action="customer-addprocess.php">
                        <div class="container">
                        <fieldset>
                            <h2>Enter Customer Information</h2>
                            <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label mt-4">Name</label>
                            <input type="text" name="cname" class="form-control" placeholder="Enter Name" required>
                            </div>
                        <div class="form-group">
                            <label for="exampleTextarea" class="form-label mt-4">Address</label>
                            <textarea class="form-control" name="cadd" id="exampleTextarea" rows="3" required></textarea>
                            </div>
                        <div class="form-group">
                            <label for="exampleTextarea" class="form-label mt-4">Billing Address</label>
                            <textarea class="form-control" name="cbadd" id="exampleTextarea" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                            <input type="email" name="cemail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label mt-4">Phone Number</label>
                            <input type="text" name="cphone" class="form-control" placeholder="Enter Phone Number" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Register</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <br><br><br>
                        </fieldset>
                        </div>
                    </form>
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
<?php include 'footer.php'; ?>       

