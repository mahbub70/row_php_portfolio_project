
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


// Receive Review Url Code That encode using base64encode() function
$recv_encoded_user_id = $_GET['id'];
$decode_encoded_user_id = base64_decode($recv_encoded_user_id);
$make_int_encoded_user_id = intval($decode_encoded_user_id);
$decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

// Receive User Acual ID
$id = $decript_formula;



###################### Query For Single Client Review START #########################
$review_query_result = mysqli_query($db_connect,"SELECT * FROM reviews WHERE id=$id");
if(!$review_query_result){
    header("location: /403-forbidden");
}
$review_array = mysqli_fetch_assoc($review_query_result);
###################### Query For Single Client Review START #########################



// Client Id
$client_id = $review_array['client_id'];

// Get This Review Client Information
$review_client_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$client_id");
if(!$review_client_result){
    header("location: /403-forbidden");
}
$client_info_array = mysqli_fetch_assoc($review_client_result);



// Management Dsignation
$manage_designation = [1=>"Super Admin","Admin","Modarator","Editor","Client","User","Pending"];

// User Image Path
$user_image_path = "/dashboard/img/users_img/";


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

            
<style>
    .fa-star.checked{
        color:#FF9529;
    }
</style>

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
                    <img src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:50px;">
                    <img class="logo-fold" src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:50px;">
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


            <!-- Content Wrapper START -->
            <div class="main-content">
                <div class="page-header">
                    <h2 class="header-title">Review</h2>
                    <div class="header-sub-title">
                        <nav class="breadcrumb breadcrumb-dash">
                            <a href="/client-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                            <a class="breadcrumb-item" href="/view-all-review">All Reviews</a>
                            <span class="breadcrumb-item active">Single Review</span>
                        </nav>
                    </div>
                </div>
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <div class="d-md-flex align-items-center">
                                        <div class="text-center text-sm-left ">
                                            <div class="avatar avatar-image" style="width: 150px; height:150px">
                                                <img src="<?=($user_image_path . $client_info_array['profile_image'])?>" alt="">
                                            </div>
                                        </div>
                                        <div class="text-center text-sm-left m-v-15 p-l-30">
                                            <h2 class="m-b-5"><?=($client_info_array['full_name'])?></h2>
                                            <p class="text-dark m-b-20"><?=($client_info_array['designation'])?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex font-size-22 m-t-15">

                                            <?php 
                                                for($i = 1; $i <= 5; $i++){
                                            ?>
                                                <span class="fa fa-star <?=($i <= $review_array['rating'])?("checked"):("")?>"></span>
                                            <?php        
                                                }
                                            ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Review</h5>
                                    <p><?=($review_array['review'])?></p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Wrapper END -->




<?php 
    // Include Footer Part
    require '../includes/footer.php';
?>