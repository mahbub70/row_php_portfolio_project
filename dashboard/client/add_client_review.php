<?php

    session_start();

    // Database Connection File
    require "../includes/db.php";


    // Check User Login or not
    if(isset($_SESSION['login_user_id'])){
        $login_user_id = $_SESSION['login_user_id'];
    }else{
        header("location: /login");
    }


    ############# Query for login user information START ####################
    $login_user_query_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$login_user_id");
    if($login_user_query_result){
        $login_user_array = mysqli_fetch_assoc($login_user_query_result);
    }else{
        header("location: /login");
    }
    ############# Query for login user information END ####################


    // Check User is Client or not
    if($login_user_array['role'] != 5){
        header("location: /login");
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


    $page_uri =  $_SERVER['REQUEST_URI'];


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
                        <img src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:50px;">
                        <img class="logo-fold" src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:50px;">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="/admin-dashboard">
                        <img src="/dashboard/assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="/dashboard/assets/images/logo/logo-fold-white.png" alt="Logo">
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

            <!-- Page Container START -->
            <div class="page-container">









<style>
    .fa-star.checked{
        color:#FF9529;
    }
    .review_box{
        position:relative;
    }
    .review_box .count_box{
        position:absolute;
        right:0;
        top:5px;
        font-size: 12px;
    }
    .rating span{
        font-size: 18px;
        cursor: pointer;
    }
</style>

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Add Review</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/client-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add review</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <form id="ratingForm">

                        <div class="form-group rating">
                            <label for="">Give Rating</label><br>
                            <span class="fa fa-star" data-count="1"></span>
                            <span class="fa fa-star" data-count="2"></span>
                            <span class="fa fa-star" data-count="3"></span>
                            <span class="fa fa-star" data-count="4"></span>
                            <span class="fa fa-star" data-count="5"></span>
                            <div><small id="rating_err" style="color:red"></small></div>
                        </div>
                        <div class="form-group review_box">
                            <label for="formGroupExampleInput2">Give Review</label>
                            <textarea type="text" class="form-control review_input" id="formGroupExampleInput2" placeholder="Enter Your Review" name="desc"></textarea>
                            <div class="count_box"><span id="type_count">0</span>/<span>500</span></div>
                            <div class="invalid-feedback" id="review_err"></div>
                        </div>

                        <button type="submit" name="review_submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper END -->


<?php 
    // Include Footer Part
    require "../includes/footer.php";
?>

<script src="/dashboard/assets/js/client.js"></script>