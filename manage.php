<?php 
include ('mysession.php');
if(!session_id())
{
    session_start();
}
if(isset($_GET['id']))
{
 $fid=$_GET['id'];
}

include('dbconnect.php');


$sqlr = "SELECT * FROM tb_user
LEFT JOIN tb_status ON tb_user.u_status = tb_status.s_status
 where u_id= '$fid'";


// Get the result
$resultr = mysqli_query($con,$sqlr);
$rowr = mysqli_fetch_array($resultr);
include ('headermainadmin.php');
?>

  <div class="content-body">

            
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="container mt-4">

   <div class="container">
          <h2 style="text-align:center;">Manage User</h2><br>
              <form method="POST" action="manageprocess.php">
              

                <div class="form-group mb-4">
                  <label for="userName">Username</label>
                  <?php
                 echo' <input type="text" name="fname" class="form-control" id="userName" value="' . $rowr['u_name'] . '"';
                 ?>
                </div><br>

                <div class="form-group mb-4">
                  <label for="userName">User ID</label>
                  <?php
                 echo' <input type="text" name="fid" class="form-control" id="userID" value="' . $rowr['u_id'] . '" readonly';
                 ?>
                 <div class="small">can`t edit User Id</div>
                </div>

                <div class="form-group mb-4">
                  <label for="email">Email</label>
                  <?php
                  echo' <input type="email" name="femail" class="form-control" id="email" value="' . $rowr['u_email'] . '"';
                  ?>
                </div><br>

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

                <div class="form-group mb-4">
                  <label for="gender">Status</label>
                  <?php  
                           echo' <select id="status" class="form-control form-control-user" name="status">';
   echo' <option value=" '.$rowr['u_status'].'" selected> '.$rowr['u_status'].'-'.$rowr['s_desc'].'</option>';
    echo'<option value="1">1-Activated</option>';
  echo'  <option value="2">2-Deactivated</option>?></td>';
  echo '</select>';
  ?>
                </div><br>


                <div style="text-align: center;">
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


 <?php include 'footer.php';?>