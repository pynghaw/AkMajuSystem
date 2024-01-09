
<?php  
include('mysession.php');
if (!session_id()) {
    session_start();
}
$fid = isset($_SESSION['u_id']) ? $_SESSION['u_id'] : '';

include('dbconnect.php');

$sqlr = "SELECT * FROM tb_user where u_id='$fid'";
$resultr = mysqli_query($con, $sqlr);
$rowr = mysqli_fetch_array($resultr);
include 'headermainadmin.php'; ?>

        <!--**********************************
            Content body start
        ***********************************-->
       <div class="content-body">

            
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="container mt-4">
   <div class="col-lg-8 col-xl-9">
    <div class="profile-content-right profile-right-spacing py-5">
        <div class="tab-content px-3 px-xl-5" id="myTabContent">
            <h2 class="mb-4">Profile</h2>


            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                             <tr>
                                <th scope="row">Role</th>
                                <td>Admin</td>
                            </tr>
                            <tr>
                                <th scope="row">Username</th>
                                <td><?php echo $rowr['u_name']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">User ID</th>
                                <td><?php echo $rowr['u_id']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?php echo $rowr['u_email']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Gender</th>
                                <td><?php echo $rowr['u_sex']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Phone Number</th>
                                <td><?php echo $rowr['u_contNo']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                   
                    <a class="btn btn-primary" href="updateprofile1.php">Update Profile</a>
                </div>
            </div>
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
        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

   

        <!--**********************************
            Content body end
        ***********************************-->


<?php include 'footer.php';?>