
<?php
    // Check User Login or not
    if(isset($_SESSION['login_user_id'])){
        $login_user_id = $_SESSION['login_user_id'];
    }else{
        header("location: /sign-out");
    }

    $page_uri =  $_SERVER['REQUEST_URI'];
    $explode_for_client = explode("/",$page_uri);

    // Set Time
    date_default_timezone_set("asia/dhaka");


    ############# Query for login user information START ####################
    $login_user_query_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$login_user_id");
    if($login_user_query_result){
        $login_user_array = mysqli_fetch_assoc($login_user_query_result);
    }else{
        header("location: /sign-out");
    }
    ############# Query for login user information END ####################

    // Check User Available or Not
    if(mysqli_num_rows($login_user_query_result) == 0){
        header("location: /sign-out");
    }elseif($login_user_array['status'] == 0){
        header("location: /sign-out");
    }
    // ------------------------------

    if($login_user_array['role'] >= 7){
        header("location: /sign-out");
    }

    // Check Login User is Client or not
    if($login_user_array['role'] == 5){
        if($explode_for_client[1] == "user-profile" || $explode_for_client[1] == "user-profile-update" || $explode_for_client[1] == "add-blog" || $explode_for_client[1] == "view-blogs" || $explode_for_client[1] == "single_blog"){
            
        }else{
            header("location: /client-dashboard");
        }
        
    }

    // IF Login User is User then he/she access pages
    if($login_user_array['role'] == 6){
        if($explode_for_client[1] == "user-profile" || $explode_for_client[1] == "user-profile-update" || $explode_for_client[1] == "add-blog" || $explode_for_client[1] == "view-blogs" || $explode_for_client[1] == "single_blog" || $explode_for_client[1] == "user-blog" || $explode_for_client[1] == "admin-dashboard" || $explode_for_client[1] == "delete-blog"){
            
        }else{
            header("location: /404-not-found");
        }
    }

    // User Image Path
    $user_image_path = "/dashboard/img/users_img/";

    // Encoding Login User ID
    $user_id = $login_user_id;
    $encript_formula = ceil((($user_id * 123465789 * 98765) / 56789));
    $encoded_id = base64_encode($encript_formula);
    $encoded_login_user_id = preg_replace('/=/i','',$encoded_id);

    // Management Dsignation
    $manage_designation = [1=>"Super Admin","Admin","Modarator","Editor","Client","User","Pending"];


    // Unseen Message Query Start
    $unseen_message_result = mysqli_query($db_connect,"SELECT * FROM messages WHERE status=0");
    if(!$unseen_message_result){
        header("location: /403-forbidden");
    }

    // Pending User Query Start
    $pending_user_result = mysqli_query($db_connect,"SELECT * FROM users WHERE role=7");
    if(!$pending_user_result){
        header("location: /403-forbidden");
    }



?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.themenate.net/enlink-bs/dist/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Dec 2021 13:26:35 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Probizz</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/dashboard/assets/images/logo/logo.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="/dashboard/assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="layout">

            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="/admin-dashboard">
                        <img src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:50px;margin-top:10px">
                        <img class="logo-fold" src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:40px;margin-top:10px;margin-left:15px">
                        
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="/admin-dashboard">
                        <img src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:50px;margin-top:10px">
                        <img class="logo-fold" src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:40px;margin-top:10px;margin-left:15px">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <a href="javascript:void(0);" data-toggle="dropdown">
                                <i class="anticon anticon-bell notification-badge"></i>
                            </a>
                            <div class="dropdown-menu pop-notification">
                                <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                                    <p class="text-dark font-weight-semibold m-b-0">
                                        <i class="anticon anticon-bell"></i>
                                        <span class="m-l-10">Notification</span>
                                    </p>
                                </div>
                                <div class="relative">
                                    <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                                        <?php 
                                            if(mysqli_num_rows($unseen_message_result) != 0){
                                                // Check Last Message
                                                $last_message_result = mysqli_query($db_connect,"SELECT * FROM messages ORDER BY id DESC LIMIT 1");
                                                if(!$last_message_result){
                                                    header("location: /403-forbidden");
                                                }
                                                $last_message_array = mysqli_fetch_assoc($last_message_result);

                                                // Prepare For ago Time
                                                $db_time = $last_message_array['created_at'];
                                                $clean_time = preg_replace('/,/i',' ',$db_time);
                                                $time_second = strtotime($clean_time);
                                        ?>
                                                <a href="/all-messages" class="dropdown-item d-block p-15 border-bottom">
                                                    <div class="d-flex">
                                                        <div class="avatar avatar-blue avatar-icon">
                                                            <i class="anticon anticon-mail"></i>
                                                        </div>
                                                        <div class="m-l-15">
                                                            <p class="m-b-0 text-dark">You received a new message</p>
                                                            <p class="m-b-0"><small><?=(ago($time_second))?></small></p>
                                                        </div>
                                                    </div>
                                                </a>
                                        <?php
                                            }
                                        ?>
                                        
                                        <?php 
                                           if(mysqli_num_rows($pending_user_result) != 0){
                                               if($login_user_array['role'] == 1){

                                                // Get Last Pending User
                                                $last_pending_user_result = mysqli_query($db_connect,"SELECT * FROM users WHERE role=7 ORDER BY id DESC LIMIT 1");
                                                if(!$last_pending_user_result){
                                                    header("location: /403-forbidden");
                                                }
                                                $last_pending_user_array = mysqli_fetch_assoc($last_pending_user_result);

                                                // Prepare For ago Time
                                                $db_time = $last_pending_user_array['created_at'];
                                                $clean_time = preg_replace('/,/i',' ',$db_time);
                                                $time_second = strtotime($clean_time);

                                        ?>
                                                <a href="/pending-users" class="dropdown-item d-block p-15 border-bottom">
                                                    <div class="d-flex">
                                                        <div class="avatar avatar-cyan avatar-icon">
                                                            <i class="anticon anticon-user-add"></i>
                                                        </div>
                                                        <div class="m-l-15">
                                                            <p class="m-b-0 text-dark">New user registered</p>
                                                            <p class="m-b-0"><small><?=(ago($time_second))?></small></p>
                                                        </div>
                                                    </div>
                                                </a>
                                        <?php
                                                }
                                           } 
                                        ?>
                                        
                                        <?php 
                                            if(mysqli_num_rows($unseen_message_result) == 0 && mysqli_num_rows($pending_user_result) == 0){
                                                echo "<span style='display:block;margin:50px 15px'>Don't Have Any New Notification.</span>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">
                                    <img src="<?=($user_image_path . $login_user_array['profile_image'])?>"  alt="Profile Image">
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="avatar avatar-lg avatar-image">
                                            <img src="<?=($user_image_path . $login_user_array['profile_image'])?>" alt="Profile Image">
                                        </div>
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold"><?=(strlen($login_user_array['full_name']) > 11)?(substr($login_user_array['full_name'],0,11)."..."):($login_user_array['full_name'])?></p>
                                            <p class="m-b-0 opacity-07"><?=($login_user_array['designation'])?></p>
                                        </div>
                                    </div>
                                </div>
                                <a href="/user-profile/<?=($encoded_login_user_id)?>" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                            <span class="m-l-10">Edit Profile</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                                <a href="/sign-out" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Logout</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#quick-view">
                                <i class="anticon anticon-appstore"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>    
            <!-- Header END -->

            <?php 
                if($login_user_array['role'] != 5){
            ?>
            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <!-- ------------ -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Dashboard</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/admin-dashboard")?("active"):("")?>">
                                    <a href="/admin-dashboard">Default</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ----------------------------------------------------Dashboard End --> 
                        <?php 
                            if($login_user_array['role'] >= 1 && $login_user_array['role'] <= 4){?> <!--IF MANAGEMENT ACCESS START -->
                            <!-- ----------- -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-file"></i>
                                </span>
                                <span class="title">Management</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/management")?("active"):("")?>">
                                    <a href="/management">M-Members</a>
                                </li>
                                <li class="<?=($page_uri == "/users-info")?("active"):("")?>">
                                    <a href="/users-info">Users Info</a>
                                </li>
                                <li class="<?=($page_uri == "/pending-users")?("active"):("")?>">
                                    <a href="/pending-users">Pending Users</a>
                                </li>
                                <li class="<?=($page_uri == "/pending-review")?("active"):("")?>">
                                    <a href="/pending-review">Pending Review</a>
                                </li>
                                <li class="<?=($page_uri == "/trush-users")?("active"):("")?>">
                                    <a href="/trush-users">Trush Users List</a>
                                </li>
                                <li class="<?=($page_uri == "/all-icons")?("active"):("")?>">
                                    <a href="/all-icons">Icons</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ------------------------------ Management End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dash"></i>
                                </span>
                                <span class="title">Top Header</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/contact-info")?("active"):("")?>">
                                    <a href="/contact-info">Contact Info</a>
                                </li>
                                <li class="<?=($page_uri == "/add-contact-info")?("active"):("")?>">
                                    <a href="/add-contact-info">Add Contact</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ------------------------------ Top Header End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                                <span class="title">Main Menu</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/menu-info")?("active"):("")?>">
                                    <a href="/menu-info">Menu Info</a>
                                </li>
                                <li class="<?=($page_uri == "/menu-add")?("active"):("")?>">
                                    <a href="/menu-add">Add Menu</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- --------------------------------------------------------------- Main Menu End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fab fa-bandcamp"></i>
                                </span>
                                <span class="title">Logo</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/logo-info")?("active"):("")?>">
                                    <a href="/logo-info">Logo Info</a>
                                </li>
                                <li class="<?=($page_uri == "/logo_add")?("active"):("")?>">
                                    <a href="/logo_add">Add Logo</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ---------------------------------------------------- Logo End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fas fa-chalkboard"></i>
                                </span>
                                <span class="title">Banner</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/banner-info")?("active"):("")?>">
                                    <a href="/banner-info">Banner Info</a>
                                </li>
                                <li class="<?=($page_uri == "/banner-add")?("active"):("")?>">
                                    <a href="/banner-add">Add Banner</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ------------------------------------------------------------ Banner End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fab fa-microsoft"></i>
                                </span>
                                <span class="title">Feature</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/feature-info")?("active"):("")?>">
                                    <a href="/feature-info">Feature Info</a>
                                </li>
                                <li class="<?=($page_uri == "/feature-add")?("active"):("")?>">
                                    <a href="/feature-add">Add Feature</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ----------------------------------------- Feature End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fas fa-exclamation-circle"></i>
                                </span>
                                <span class="title">About</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/about-info")?("active"):("")?>">
                                    <a href="/about-info">About Info</a>
                                </li>
                                <li class="<?=($page_uri == "/about-add")?("active"):("")?>">
                                    <a href="/about-add">Add About</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ----------------------------------------------------- About End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fas fa-cogs"></i>
                                </span>
                                <span class="title">Service</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/service-info")?("active"):("")?>">
                                    <a href="/service-info">Service Info</a>
                                </li>
                                <li class="<?=($page_uri == "/service-add")?("active"):("")?>">
                                    <a href="/service-add">Add Service</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- -------------------------------------------------- Service End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fab fa-product-hunt"></i>
                                </span>
                                <span class="title">Portfolio</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/portfolio-info/all")?("active"):("")?>">
                                    <a href="/portfolio-info/all">Portfolio Info</a>
                                </li>
                                <li class="<?=($page_uri == "/portfolio-category-add")?("active"):("")?>">
                                    <a href="/portfolio-category-add">Add P-Category</a>
                                </li>
                                <li class="<?=($page_uri == "/portfolio-add")?("active"):("")?>">
                                    <a href="/portfolio-add">Add Portfolio</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- --------------------------------------------------------- Portfolio End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-area-chart"></i>
                                </span>
                                <span class="title">Business</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/business-info")?("active"):("")?>">
                                    <a href="/business-info">Business Info</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ------------------------------------------------------ Business End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-question"></i>
                                </span>
                                <span class="title">About Company</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/company-info")?("active"):("")?>">
                                    <a href="/company-info">Company Info</a>
                                </li>
                                <li class="<?=($page_uri == "/facility-add")?("active"):("")?>">
                                    <a href="/facility-add">Add Facility</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ------------------------------------------------------------ Subscriber End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fab fa-google-play"></i>
                                </span>
                                <span class="title">Subscribers</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/subscribers")?("active"):("")?>">
                                    <a href="/subscribers">All Subscribers</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ------------------------------------------------------------- About Company End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fas fa-receipt"></i>
                                </span>
                                <span class="title">Pricing Plan</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/packages-info")?("active"):("")?>">
                                    <a href="/packages-info">All Packages</a>
                                </li>
                                <li class="<?=($page_uri == "/create-new-package")?("active"):("")?>">
                                    <a href="/new-package">Create New Package</a>
                                </li>
                                <li class="<?=($page_uri == "/package-service-add")?("active"):("")?>">
                                    <a href="/package-service-add">Add Package Service</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ----------------------------------------------------------------------- Pricing Plan End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fas fa-ellipsis-h"></i>
                                </span>
                                <span class="title">Consultant</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/consultant-header")?("active"):("")?>">
                                    <a href="/consultant-header">Consultant Header</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- -------------------------------------------------------- Consultant End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-phone"></i>
                                </span>
                                <span class="title">Contact US</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/contact-us")?("active"):("")?>">
                                    <a href="/contact-us">Contact US Info</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ------------------------------------------------------------------------------ Contact US End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fas fa-star"></i>
                                </span>
                                <span class="title">Testimonial</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/testimonial-info")?("active"):("")?>">
                                    <a href="/testimonial-info">Testimonial Info</a>
                                </li>
                                <li class="<?=($page_uri == "/add-review")?("active"):("")?>">
                                    <a href="/add-review">Add Review</a>
                                </li>
                                <li class="<?=($page_uri == "/all-review")?("active"):("")?>">
                                    <a href="/all-review">All Review</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ----------------------------------------------------------- Testimonial End-->
                        <?php } ?> <!--IF MANAGEMENT ACCESS END-->


                        
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="far fa-edit"></i>
                                </span>
                                <span class="title">Blog</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <?php 
                                    if($login_user_array['role'] >= 1 && $login_user_array['role'] <= 4){ // IF USER IS management member
                                ?>
                                    <li class="<?=($page_uri == "/blog-info")?("active"):("")?>">
                                        <a href="/blog-info">Blog Info</a>
                                    </li>
                                <?php                                        
                                    }
                                ?>
                                <!-- -------------- -->

                                <?php 
                                    if($login_user_array['role'] == 6){ // IF User Login
                                ?>
                                    <li class="<?=($page_uri == "/user-blog")?("active"):("")?>">
                                        <a href="/user-blog">My Blog</a>
                                    </li>
                                <?php        
                                    }
                                ?>

                                <li class="<?=($page_uri == "/view-blogs")?("active"):("")?>">
                                    <a href="/view-blogs">View Blogs</a>
                                </li>
                                <li class="<?=($page_uri == "/add-blog")?("active"):("")?>">
                                    <a href="/add-blog">Add Blog</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ----------------------------------------------------------------- Blog End-->


                        <?php 
                            if($login_user_array['role'] >= 1 && $login_user_array['role'] <= 4){?> <!--IF MANAGEMENT ACCESS START -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fab fa-facebook-messenger"></i>
                                </span>
                                <span class="title">Message</span><span class="badge badge-primary ml-2"><?=(mysqli_num_rows($unseen_message_result))?></span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/all-messages")?("active"):("")?>">
                                    <a href="/all-messages">All Messages</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- -------------------------------------------------------- Message End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Counter Section</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/counter-info")?("active"):("")?>">
                                    <a href="/counter-info">Counter Info</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ------------ ------------------- Counter Section End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Footer</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/footer-info")?("active"):("")?>">
                                    <a href="/footer-info">Footer Info</a>
                                </li>
                                <li class="<?=($page_uri == "/add-important-link")?("active"):("")?>">
                                    <a href="/add-important-link">Add Important Link</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- ------------ ------------------- Footer Section End-->
                        <?php } ?> <!--IF MANAGEMENT ACCESS END-->


                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-file"></i>
                                </span>
                                <span class="title">Pages</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <!-- Nav Dropdown Start -->
                            <ul class="dropdown-menu">
                                <li class="<?=($page_uri == "/user-profile")?("active"):("")?>">
                                    <a href="/user-profile/<?=($encoded_login_user_id)?>">Profile</a>
                                </li>
                            </ul>
                            <!-- Nav Dropdown End -->
                        </li>
                        <!-- -------------------------------------------------------- Pages End-->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-lock"></i>
                                </span>
                                <span class="title">Authentication</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/sign-up">Registration</a>
                                </li>
                            </ul>
                        </li>
                        <!-- ------------ Authentication End------------------------------->
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->
            <?php
                }
            ?>
            <!-- Page Container START -->
            <div class="page-container">


<?php 
    function ago($time){
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");

        $now = time();

            $difference     = $now - $time;
            $tense         = "ago";

        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] ago ";
    }
?>