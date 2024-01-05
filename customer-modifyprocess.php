<?php 
include 'headermain.php';
include('dbconnect.php');

//retrieve data from form and session
$cid=$_POST['cid'];
$cname=$_POST['cname'];
$cadd=$_POST['cadd'];
$cbadd=$_POST['cbadd'];
$cemail=$_POST['cemail'];
$cphone=$_POST['cphone'];


//INSERT NEW BOOKING
$sql="  UPDATE tb_customer
        SET c_name='$cname', c_add='$cadd', c_billAdd='$cbadd', c_email='$cemail', c_cont='$cphone'
        WHERE c_id='$cid'";

mysqli_query($con,$sql);
mysqli_close($con);

//DISPLAY RESULT

?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
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
                            <h2>Your New Customer Information</h2>
                            <br>
                            <h5>Name: <?php echo $cname;?></h5>
                            <h5>Address: <?php echo $cadd;?></h5>
                            <h5>Billing Address: <?php echo $cbadd;?></h5>
                            <h5>Email: <?php echo $cemail;?></h5>
                            <h5>Contact Number: <?php echo $cphone;?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div><br><br><br><br>
<!--**********************************
    Content body end
***********************************-->
<?php include 'footer.php'; ?>       

