
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AK MAJU</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body class="h-100" style="background-color: #FEF6FE;">
    
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

    


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        
                        
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                        
                                    </div>
                                    <form action="resetPasswordProcess.php" method='POST'>

                  <div class="form-group ">
                                    <label>New Password</label>
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
</script></div>
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
</script>


    <button type="submit" id="confirm" name="change" class="btn mb-1 btn-success">Confirm</button>
</form>
                                    
                    </div>
                </div>

            </div>

        </div>

    </div>

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





