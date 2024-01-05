
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

    <div class="container" >

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwUwVZhoZ9WLRV9FkyYJN2MHa-tz1f0MbqUg&usqp=CAU" alt="AK MAJU" style="width:400px; height: 400px;"></div>
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
  <button type="submit" id="login"class="btn btn-outline-primary">login</button>
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





