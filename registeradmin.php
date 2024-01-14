<?php 
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('headermainadmin.php');?>

    


       <div class="content-body">
  <?php if (isset($_SESSION['register1_message'])):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['register1_message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php
    // Unset the session variable to avoid displaying the message again on refresh
    unset($_SESSION['register1_message']);?>
    <?php endif;?>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="container mt-4">
                                
                                 <div style="text-align: right;">
                            <a href="manageuser.php" class="btn btn-danger mb-2 btn-pill">Cancel</a>
                        </div>
                      
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>

                            <form method="POST" action="registerprocessadmin.php">
                                <div class="form-group ">
                                 <select id="type" class="form-control form-control-user" name="ftype" required>
    <option value="" disabled selected>Register as...</option>
    <option value="1">1 - Staff</option>
    <option value="2">2 - Admin</option>
  
  </select>
                                        
                                </div><br>
                                <div class="form-group ">
                                
                                        <input type="text" name="fname" class="form-control form-control-user" id="name"
                                            placeholder="Username" required>
                                </div><br>
                                <div class="form-group ">
                                
                                        <input type="text" name="fid" class="form-control form-control-user" id="id"
                                            placeholder="UserID (MAxlength 10)" required maxlength="10">
                                </div><br>

                                    <div class="form-group ">
                                        
                                            <select id="gender" class="form-control form-control-user" name="fsex">
    <option value="" disabled selected>Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  
  </select>
                                    </div><br>
                                
                                <div class="form-group ">
                                    <input type="email" name="femail" class="form-control form-control-user" id="Email"
                                        placeholder="Email Address" required>
                                </div><br>
                                <div class="form-group ">
                                    <input type="number" name="ftel" class="form-control form-control-user" id="PhoneNumber"
                                        placeholder="Phone Number" required>
                                </div><br>
                                <div class="form-group ">
                                    
                                        <input type="password" name="fpwd" class="form-control form-control-user" id="password" placeholder="Password (At least 6 character)" minlength="6" required>
                                        <script>
    document.getElementById("RepeatPassword").addEventListener("keyup", checkPasswordMatch);

    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var repeatPassword = document.getElementById("RepeatPassword").value;
        var registerButton = document.getElementById("registerButton");
        var errorMessage = document.getElementById("passwordMismatchMessage");
        var correctMessage = document.getElementById("passwordmatchMessage");

        // Check if the passwords match and meet the minimum length requirement
        if (password === repeatPassword && password.length >= 6) {
            // Passwords match and meet the minimum length requirement
            registerButton.disabled = false;
            errorMessage.innerHTML = "";
            correctMessage.innerHTML = "Password match";
        } else {
            // Passwords do not match or do not meet the minimum length requirement
            registerButton.disabled = true;
            errorMessage.innerHTML = "Passwords should match and have a minimum length of 6 characters!";
            
            // Clear correct message if repeatPassword is empty
            correctMessage.innerHTML = repeatPassword ? "" : "";
        }
    }
</script>


                                    </div><br>
                                    <div class="form-group">
        <label>Repeat New Password</label>
                                        <input type="password" name="frpwd" class="form-control form-control-user"
                                            id="RepeatPassword" placeholder="Repeat Password" required>
                                    </div>
                                   <div id="passwordMismatchMessage" style="color: red;"></div>
                                   <div id="passwordmatchMessage" style="color: green;"></div>
                   <script>
    document.getElementById("RepeatPassword").addEventListener("keyup", checkPasswordMatch);

    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var repeatPassword = document.getElementById("RepeatPassword").value;
        var registerButton = document.getElementById("confirm");
        var errorMessage = document.getElementById("passwordMismatchMessage");
        var correctMessage = document.getElementById("passwordmatchMessage");

        // Check if the passworxds match
        if (password === repeatPassword) {
            // Passwords match, enable the register button and clear the error message
            registerButton.disabled = false;
            errorMessage.innerHTML = "";
            correctMessage.innerHTML = "Password match";
        } else {
            // Passwords do not match, disable the register button and display an error message
            registerButton.disabled = true;
            errorMessage.innerHTML = "Passwords do not match!";
            
            // Clear correct message if repeatPassword is empty
            correctMessage.innerHTML = repeatPassword ? "" : "";
        }
    }
</script>

<br>
                                   <div id="passwordMismatchMessage" style="color: red;"></div>

             <script>
    document.getElementById("RepeatPassword").addEventListener("keyup", checkPasswordMatch);

    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var repeatPassword = document.getElementById("RepeatPassword").value;
        var registerButton = document.getElementById("registerButton");
        var errorMessage = document.getElementById("passwordMismatchMessage");
        var correctMessage = document.getElementById("passwordmatchMessage");

        // Check if the passwords match
        if (password === repeatPassword) {
            // Passwords match, enable the register button and clear the error message
            registerButton.disabled = false;
            errorMessage.innerHTML = "";
            correctMessage.innerHTML = "Password match";
        } else {
            // Passwords do not match, disable the register button and display an error message
            registerButton.disabled = true;
            errorMessage.innerHTML = "Passwords do not match!";
            
            // Clear correct message if repeatPassword is empty
            correctMessage.innerHTML = repeatPassword ? "" : "";
        }
    }
</script><br>
                                <div style="text-align: center;">
                                  <button type="submit" id="registerButton" class="btn btn-primary mb-2 btn-pill" >Register Account</button>
                                 <button type="reset" class="btn btn-dark mb-2 btn-pill">Reset</button>
                            </div>
                        </form>
                               <br><br>
                            
                             
                        
                        </div>
                    </div>
                </div>
       </div>
   </div>
</div>

    </div>
<br><br>
</body>


<?php include('footer.php');?>





