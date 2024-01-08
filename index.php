<?php
session_start();

// Connect to DB
include("dbconnect.php");

// ... rest of your code
include("headernotification.php")
?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AK MAJU</title>
    <!-- Favicon icon -->
     <link rel="icon" type="image/jpg" sizes="16x16" href="images/akmaju.jpg">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
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

    



    <body class="bg-gradient-primary" style="background-color: #FEF6FE;">
<?php if (isset($_SESSION['error_message'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['error_message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
    <div class="container" >

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
 

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"><img src="data:image/png;base64,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" alt="AK MAJU" style="width:400px; height: 400px;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">AK MAJU SYSTEM</h1>
                                        <h5 >Welcome Back!</h5>
                                    </div>
                                    <form method="POST" action="loginprocess.php">

                                        <div class="form-group">
                                            <input type="text" name="fname" class="form-control form-control-user"
                                                id="name" 
                                                placeholder="Username" required>
                                        </div><br>
                                        <div class="form-group">
                                            <input type="password" name="fpwd" class="form-control form-control-user"
                                                id="Password" placeholder="Password" required>
                                        </div>
                                          <br>
  <button type="submit" id="login"class="btn mb-1 btn-primary">login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="" href="forgot password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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





