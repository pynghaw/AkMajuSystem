
<?php  
include('mysession.php');
if (!session_id()) {
    session_start();
}
$fid = isset($_SESSION['u_id']) ? $_SESSION['u_id'] : '';

include('dbconnect.php');


$sqlr = "SELECT * FROM tb_user where u_id='$fid' ";


// Get the result
$resultr = mysqli_query($con,$sqlr);
$rowr = mysqli_fetch_array($resultr);
include 'headermain.php'; ?>

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
          <h2>Profile</h2>
              <form method="POST" action="updateprofileprocess.php">
              

                <div class="form-group mb-4">
                  <label for="userName">Username</label>
                  <?php
                 echo' <input type="text" name="fname" class="form-control" id="userName" value="' . $rowr['u_name'] . '"';
                 ?>
                </div>

                <div class="form-group mb-4">
                  <label for="userName">User ID</label>
                  <?php
                 echo' <input type="text" name="fid" class="form-control" id="userID" value="' . $rowr['u_id'] . '" readonly';
                 ?>
                 <div class="small">can`t edit user ID</div>
                </div>

                <div class="form-group mb-4">
                  <label for="email">Email</label>
                  <?php
                  echo' <input type="email" name="femail" class="form-control" id="email" value="' . $rowr['u_email'] . '"';
                  ?>
                </div>

                <div class="form-group mb-4">
<label for="gender">Gender</label>
<select id="gender" class="form-control form-control-user" name="sex">
    <option value="<?php echo $rowr['u_sex']; ?>" selected><?php echo $rowr['u_sex']; ?></option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
</select>

  
                </div>

                <div class="form-group mb-4">
                  <label for="phone">Phone Number</label>
                  <?php
                  echo' <input type="text" name="phonenumber" class="form-control" id="phone" value="' . $rowr['u_contNo'] . '"';
                  ?>
                </div><br>


                <div >
                  <button type="submit" class="btn btn-primary mb-2 btn-pill">Update Profile</button>
                </div>
              </form>
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

        <?php include 
        

        'footer.php'; ?>

