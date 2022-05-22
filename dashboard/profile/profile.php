<?php
    session_start();

    // Includes Database File
    require '../includes/db.php';
    
    

    // Receive User Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive User Acual ID
    $id = $decript_formula;

    ################# Get user information query START ##################
    $user_query_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$id");
    if($user_query_result){
        $user_info_array = mysqli_fetch_assoc($user_query_result);
    }else{
        header("location: /login");
    }
    ################# Get user information query END ##################


    // Query For User Social Lnks 
    $user_social_links_result = mysqli_query($db_connect,"SELECT * FROM user_social_links WHERE user_id=$id");
    if(!$user_social_links_result){
        header("location: /403-forbidden");
    }

    // Header File Includes
    require "../includes/header.php";


    // Check this is valid user or client or not
    if($login_user_array['role'] == 5 || $login_user_array['role'] == 6){
        if($login_user_array['id'] != $id){
            header("location: /404-not-found");
        }
    }
    

?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Profile</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Profile</span>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- Update Button -->
                <div class="text-right mb-2">
                    <a class="btn btn-primary" href="/user-profile-update/<?=($recv_encoded_user_id)?>" role="button">Edit / Update</a>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-md-flex align-items-center">
                            <div class="text-center text-sm-left ">
                                <div class="avatar avatar-image" style="width: 150px; height:150px">
                                    <img src="<?=($user_image_path . $user_info_array['profile_image'])?>" alt="Profile Image" style="object-fit:cover;">
                                </div>
                            </div>
                            <div class="text-center text-sm-left m-v-15 p-l-30">
                                <h2 class="m-b-5"><?=($user_info_array['full_name'])?></h2>
                                <p class="text-opacity font-size-13"><?=($user_info_array['user_name'])?></p>
                                <p class="text-dark m-b-20"><?=($user_info_array['designation']=='')?('Update your designation'):($user_info_array['designation'])?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="d-md-block d-none border-left col-1"></div>
                            <div class="col">
                                <ul class="list-unstyled m-t-10">
                                    <li class="row">
                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                            <span>Email: </span> 
                                        </p>
                                        <p class="col font-weight-semibold"><?=($user_info_array['email'])?></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                            <span>Phone: </span> 
                                        </p>
                                        <p class="col font-weight-semibold"><?=($user_info_array['phone_number']=='')?('Update Your Mobile Number'):($user_info_array['phone_number'])?></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Location: </span> 
                                        </p>
                                        <p class="col font-weight-semibold"><?=($user_info_array['location']=='')?('Update Your Location'):($user_info_array['location'])?></p>
                                    </li>
                                </ul>
                                <div class="d-flex font-size-22 m-t-15">
                                    <?php 
                                        if(mysqli_num_rows($user_social_links_result) != 0){
                                            foreach($user_social_links_result as $social_row_array){
                                    ?>
                                            <a href="<?=($social_row_array['link'])?>" class="text-gray p-r-20">
                                                <i class="<?=($social_row_array['icon'])?>"></i>
                                            </a> 
                                    <?php            
                                            }
                                        }else{
                                            echo "<small>Please Update Your Social Links.</small>";
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
                        <h5>Bio</h5>
                        <p><?=($user_info_array['bio']=='')?('Update Your Bio'):($user_info_array['bio'])?></p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper END -->

    
<?php 
    // Footer File Includes
    require "../includes/footer.php";
?>