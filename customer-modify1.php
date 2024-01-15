<?php
include 'headermainadmin.php';
include('dbconnect.php');

// Retrieve booking data
if (isset($_GET['id'])) {
    $cid = $_GET['id'];
}

$sqlr = "SELECT * FROM tb_customer WHERE c_id='$cid'";
$resultr = mysqli_query($con, $sqlr);
$rowr = mysqli_fetch_array($resultr);
?>

<!-- Content body start -->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="customer-manage.php">Manage Customer</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Modify Customer</a></li>
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
                            <form method="POST" action="customer-modifyprocess.php">
                                <div class="container">
                                    <fieldset>
                                        <br>
                                        <legend>Modification Form</legend>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="form-label mt-4">Name</label>
                                            <input type="text" name="cname" class="form-control" placeholder="Enter Name" value="<?php echo htmlspecialchars($rowr['c_name']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleTextarea" class="form-label mt-4">Address</label>
                                            <textarea class="form-control" name="cadd" id="exampleTextarea" rows="3" required><?php echo htmlspecialchars($rowr['c_add']); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleTextarea" class="form-label mt-4">Billing Address</label>
                                            <textarea class="form-control" name="cbadd" id="exampleTextarea" rows="3" required><?php echo htmlspecialchars($rowr['c_billAdd']); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                                            <input type="email" name="cemail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo htmlspecialchars($rowr['c_email']); ?>" required>
                                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="form-label mt-4">Phone Number</label>
                                            <input type="text" name="cphone" class="form-control" placeholder="Enter Phone Number" value="<?php echo htmlspecialchars($rowr['c_cont']); ?>" required>
                                        </div>
                                        <input type="hidden" name="cid" value="<?php echo $rowr['c_id']; ?>">
                                        <br>
                                        <button type="submit" class="btn btn-primary">Modify</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                    </fieldset>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div><br><br><br><br>
<!-- Content body end -->

<?php include 'footer.php'; ?>
