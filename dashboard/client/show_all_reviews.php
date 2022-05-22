
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


###################### Query For All Review START #########################
$review_query_result = mysqli_query($db_connect,"SELECT * FROM reviews WHERE status=1");
if(!$review_query_result){
    header("location: /403-forbidden");
}
###################### Query Users All Review START #########################

// Management Dsignation
$manage_designation = [1=>"Super Admin","Admin","Modarator","Editor","Client","User","Pending"];


$page_uri =  $_SERVER['REQUEST_URI'];

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
            
        <style>
            .fa-star.checked{
                color:#FF9529;
            }
        </style>

<!-- Content Wrapper START -->
<div class="main-content col-md-10 mt-4">
    <div class="page-header no-gutters">
        <div class="row align-items-md-center">
            <div class="col-md-6">
                <div class="media m-v-10">
                    <div class="avatar avatar-cyan avatar-icon avatar-square">
                        <i class="anticon anticon-star"></i>
                    </div>
                    <div class="media-body m-l-15">
                        <h6 class="mb-0">Total Review (<?=(mysqli_num_rows($review_query_result))?>)</h6>
                        <span class="text-gray font-size-13">Dev Team</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-md-right m-v-10">
                    <div class="btn-group">
                        <button id="list-view-btn" type="button" class="btn btn-default btn-icon active">
                            <i class="anticon anticon-ordered-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <div class="row" id="list-view">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(mysqli_num_rows($review_query_result) != 0){
                                                foreach($review_query_result as $review_row_array){
                                                    
                                                        // Encoding Management Member User ID
                                                        $review_id = $review_row_array['id'];
                                                        $encript_formula = ceil((($review_id * 123465789 * 98765) / 56789));
                                                        $encoded_id = base64_encode($encript_formula);
                                                        $encoded_review_id = preg_replace('/=/i','',$encoded_id);

                                                        $client_id = $review_row_array['client_id'];

                                                        // Query For Getting Client Information
                                                        $client_info_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$client_id");

                                                        if(!$client_info_result){
                                                            header("location: /403-forbidden");
                                                        }

                                                        $client_info_array = mysqli_fetch_assoc($client_info_result);

                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="media align-items-center">
                                                                        <div class="avatar avatar-image">
                                                                            <img src="<?=($user_image_path.$client_info_array['profile_image'])?>" alt="Profile Image">
                                                                        </div>
                                                                        <div class="media-body m-l-15">
                                                                            <h6 class="mb-0"><?=($client_info_array['full_name'])?></h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                
                                                                <td>
                                                                    <?php 
                                                                        for($i = 1; $i <= 5; $i++){
                                                                    ?>
                                                                        <span class="fa fa-star <?=($i <= $review_row_array['rating'])?("checked"):("")?>"></span>
                                                                    <?php        
                                                                        }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                    <?php 
                                                                        if(strlen($review_row_array['review']) > 40){
                                                                            echo substr($review_row_array['review'],0,40) . "...";
                                                                        }else{
                                                                            echo $review_row_array['review'];
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td class="text-right">
                                                                    <a href="/single-review/<?=($encoded_review_id)?>" class="btn btn-primary btn-tone">
                                                                        <i class="anticon anticon-idcard"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                <?php                
                                                            
                                                        }
                                                    }else{
                                                        echo "You Don't Have Any Users.";
                                                    }
                                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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