<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="AK MAJU" />
  
    <title>AK MAJU</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/jpg" sizes="16x16" href="images/akmaju.jpg">
    <!-- Pignose Calender -->
    <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

</head>

<body>

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

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="staff.php" style="color: white; font-size:25px; font-family: ;">
                   <b> AK MAJU</b>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                   
                </div>
                <div class="header-right">
                    <ul>
                        
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                
                               <i class="fa fa-user-circle-o" style="font-size:36px; color:black;margin-top: 25px;"></i>
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="profile.php"><i class="icon-user "></i> <span>Profile</span></a>
                                        </li>
                                        
                                        
                                        <hr class="my-2">
                                        
                                        <li><a href="logout.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="staff.php">Home 1</a></li>
                            <!-- <li><a href="./index-2.html">Home 2</a></li> -->
                        </ul>
                    
                    <li class="nav-label">Apps</li>
                      <li>
                        <a href="profile.php" aria-expanded="false">
                            <i class="icon-user "></i><span class="nav-text">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                           <i class="fa fa-archive"></i> <span class="nav-text">Inventory</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="Inventory.php">View Inventory</a></li>
                            <li><a href="AddInventory.php">Add Inventory</a></li>
                            
                        </ul>
                    </li>
                     <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-user"></i> <span class="nav-text">Customer</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="customer-add.php">Add Customer</a></li>
                            <li><a href="customer-manage.php">Manage Customer</a></li>
                            
                        </ul>
                    </li>
                  
                    <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
        <i class="fa fa-shopping-cart menu-icon"></i> <span class="nav-text">Order</span>
    </a>
    <ul aria-expanded="false">
        <li>
            <a class="has-arrow" href="javascript:void()">Place Order</a>
            <ul aria-expanded="false">
                <li><a href="order-place.php">Advertisement</a></li>
                <li><a href="const-selectcust.php">Construction</a></li>
            </ul>
        </li>
        <li><a href="order-manage.php">Manage Order</a></li>
    </ul>
</li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-file menu-icon"></i> <span class="nav-text">Quotation</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                            <a href="adv-managequo.php">Advertising</a>
                            </li>
                            <li>
                            <a href="const-managequo.php">Construction</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="invoice-manage.php" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Invoice</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-truck menu-icon"></i> <span class="nav-text">Delivery Order</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="do-generate-1.php">Generate</a></li>
                            <li><a href="do-manage.php">Manage</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-envelope menu-icon"></i> <span class="nav-text">Reporting</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="reporting.php">Generate Report</a></li>
                            <li><a href="report-manage.php">Manage Report</a></li>
                            
                        </ul>
                    </li>
                   
                </ul>
            </div>
        </div>

        <!--**********************************
            Sidebar end
        ***********************************-->
    ?>