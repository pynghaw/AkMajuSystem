<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AK MAJU</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    


<body class="bg-gradient-primary" style="background-color: #FEF6FE;" >

    <div class="container" >

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwUwVZhoZ9WLRV9FkyYJN2MHa-tz1f0MbqUg&usqp=CAU" alt="AK MAJU" style="width:500px; height: 500px;"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="POST" action="registerprocess.php">
                                <div class="form-group row">
                                 <select id="type" class="form-control form-control-user" name="ftype" required>
    <option value="" disabled selected>Register as...</option>
    <option value="1">1 - Staff</option>
    <option value="2">2 - Admin</option>
  
  </select>
                                        
                                </div><br>
                                <div class="form-group row">
                                
                                        <input type="text" name="fname" class="form-control form-control-user" id="name"
                                            placeholder="Username" required>
                                </div><br>
                                <div class="form-group row">
                                
                                        <input type="text" name="fid" class="form-control form-control-user" id="id"
                                            placeholder="UserID" required>
                                </div><br>

                                    <div class="form-group row">
                                        
                                            <select id="gender" class="form-control form-control-user" name="fsex">
    <option value="" disabled selected>Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  
  </select>
                                    </div><br>
                                
                                <div class="form-group row">
                                    <input type="email" name="femail" class="form-control form-control-user" id="Email"
                                        placeholder="Email Address" required>
                                </div><br>
                                <div class="form-group row">
                                    <input type="tel" name="ftel" class="form-control form-control-user" id="PhoneNumber"
                                        placeholder="Phone Number" required>
                                </div><br>
                                <div class="form-group row">
                                    
                                        <input type="password" name="fpwd" class="form-control form-control-user"
                                            id="password" placeholder="Password" required>
                                    </div><br>
                                    <div class="form-group row">
                                        <input type="password" name="frpwd" class="form-control form-control-user"
                                            id="RepeatPassword" placeholder="Repeat Password" required>
                                    </div><br>
                                   <div id="passwordMismatchMessage" style="color: red;"></div>

<script>
    document.getElementById("RepeatPassword").addEventListener("keyup", checkPasswordMatch);

    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var repeatPassword = document.getElementById("RepeatPassword").value;
        var registerButton = document.getElementById("registerButton");
        var errorMessage = document.getElementById("passwordMismatchMessage");

        // Check if the passwords match
        if (password === repeatPassword) {
            // Passwords match, enable the register button and clear the error message
            registerButton.disabled = false;
            errorMessage.innerHTML = "";
        } else {
            // Passwords do not match, disable the register button and display an error message
            registerButton.disabled = true;
            errorMessage.innerHTML = "Passwords do not match!";
        }
    }
</script><br>
                                <div style="text-align: center;">
                                  <button type="submit" id="registerButton" class="btn btn-outline-primary" >Register Account</button>
                                 <button type="reset" class="btn btn-outline-dark">Reset</button>
                            </div>
                        </form>
                                <hr>
                            
                            <div class="text-center">
                                <a class="" href="forgot password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="" href="index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<br><br>
</body>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>





