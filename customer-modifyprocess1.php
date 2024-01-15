<?php 
include 'headermainadmin.php';
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
                            <h4 style="color: green;"><b>Successfully modified customer Information. Here is the detail:</b></h4>
                            <br>
                            <p><b>Name:</b> <?php echo $cname;?></p>
                            <p><b>Address:</b> <?php echo $cadd;?></p>
                            <p><b>Billing Address:</b> <?php echo $cbadd;?></p>
                            <p><b>Email: </b><?php echo $cemail;?></p>
                            <p><b>Contact Number: </b><?php echo $cphone;?></p>
                            <br><br>
                                <div style="text-align: center;">                         
                                <a class="btn btn-primary" href="customer-manage1.php">BACK</a>
                                </div>
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

