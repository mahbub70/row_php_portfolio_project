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
    ################# Get user information query END ##################--------------------------------------------------------

    // User Database Password
    $user_account_password = $user_info_array['password'];




    // Declaring Empty Variable
    $new_name = $new_email = $new_phone = $form_password = $new_location = "";


################################## Name Section Start ##########################################
    // Name Validation and editing Start
    if(isset($_POST['name-submit'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $new_name = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['n-name']));
            $form_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['user-password']));
        }

        // RegEx Speacial Characters with preg_metch function
        $speacial_characters = "^\S*(?=\S*[\W])\S*$^";
        $available_speacial_characters = preg_match($speacial_characters,$new_name);
         // Name Validate Start
        $max_name_characters = 30;
        if($new_name == ''){
            $name_err='Please enter your <strong>Name.</strong>';
        }elseif(strlen($new_name) > $max_name_characters){
            $name_err='Your name is <strong>too large.</strong> Please Keep it short.';
        }else{
            if($available_speacial_characters){
                $name_err='<strong>Speacial characters</strong> not allowed in name filed.';
            }else{
                if(password_verify($form_password,$user_account_password)){
                    // If Password Matched With Database
                    $name_update = "UPDATE users SET full_name='$new_name' WHERE id=$id";
                    $name_result = mysqli_query($db_connect,$name_update);
                    if($name_result){
                        $name_update_success = "Hi! " . "<strong>" . $new_name . "</strong>" . " Successfully Update Your Name";
                    }else{
                        $name_query_faild = "Update <strong>Faild!</strong>";
                    }
                }else{
                    $pass_err_name = "Password <strong>didn't match</strong>. Please try again.";
                }
            }
        }
        // Name Validate End
    }
   // Name Validation and editing End-------------------------------------------------------------------------------------



################################## Email Section Start ##########################################
    // When Click Email Submit Button Email Validation Start and Update to Database
    if(isset($_POST['email-submit'])){
        // Receiving Values From Form Input Email Field
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $form_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['user-password']));
            $new_email = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['n-email']));
        }
        // RegEx Email Validation with preg_match function
        $regex_email_validation_code = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        $valid_email = preg_match($regex_email_validation_code,$new_email);
         // Email Validation Start
            ################## Email Match Query Start ###################
            $email_match_query_result = mysqli_query($db_connect, "SELECT * FROM users WHERE email='$new_email'");
            $match_email_row = mysqli_num_rows($email_match_query_result);
            ################## Email Match Query End ###################---------------------------------------------
            if($match_email_row == 1){
                $email_err='Your Email is Already <strong>Exist</strong>.';
            }elseif($new_email == ''){
                $email_err='Please enter your <strong>Email.</strong>';
            }elseif(!$valid_email){
                $email_err='Email address is <strong>not valid.</strong> Please enter a valid email.';
            }else{
                // Check User Account Password Match or Not 
                if(password_verify($form_password,$user_account_password)){
                    // If Password Matched With Database
                    $email_update = "UPDATE users SET email='$new_email' WHERE id=$id";
                    $email_result = mysqli_query($db_connect,$email_update);
                    if($email_result){
                        $email_update_success = "Hi! " . "<strong>" . $user_info_array['full_name'] . "</strong>" . " Successfully Update Your Email.";
                    }else{
                        $email_query_faild = "Update <strong>Faild!</strong>";
                    }
                }else{
                    $pass_err_email = "Password <strong>didn't match</strong>. Please try again.";
                }
            }
    }
    // Email Validation End------------------------------------------------------------------------------


################################## Phone Number Section Start ##########################################
if(isset($_POST['phone-submit'])){
    // Receiving Values From Form Input Phone Number Field
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $form_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['user-password']));
        $new_phone = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['n-phone']));
    }
    
    // Phone Number Validation Start
    if($new_phone == ''){
        $phone_err='Please enter your <strong>Phone Number</strong>.';
    }elseif(!is_numeric($new_phone)){
        $phone_err='Your phone number is <strong>not valid</strong>. Please enter a valid phone number.';
    }elseif(strlen($new_phone) > 11){
        $phone_err='Your can add maximum 11 characters phone number';
    }else{
        // Check User Account Password Match or Not
        if(password_verify($form_password,$user_account_password)){
            // If Password Matched With Database
            $phone_update = "UPDATE users SET phone_number='$new_phone' WHERE id=$id";
            $phone_result = mysqli_query($db_connect,$phone_update);
            if($phone_result){
                $phone_update_success = "Hi! " . "<strong>" . $user_info_array['full_name'] . "</strong>" . " Successfully Update Your Phone Number.";
            }else{
                $phone_query_faild = "Update <strong>Faild!</strong>";
            }
        }else{
            $pass_err_phone = "Password <strong>didn't match</strong>. Please try again.";
        }
    }
        
}
// Phone Number Validation End -----------------------------------------------------------------------------------



################################## location Section Start ##########################################
if(isset($_POST['location-submit'])){
    // Receiving Values From Form Input Location Field
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $form_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['user-password']));
        $new_location = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['n-location']));
    }
    
    // Location Validation Start
    if($new_location == ''){
        $location_err='Please enter your <strong>Location</strong>.';
    }elseif(strlen($new_location) > 150){
        $location_err='Location can contains <strong>maximum 150 characters</strong>.';
    }else{
        // Check User Account Password Match or Not
        if(password_verify($form_password,$user_account_password)){
            // If Password Matched With Database
            $location_update = "UPDATE users SET location='$new_location' WHERE id=$id";
            $location_result = mysqli_query($db_connect,$location_update);
            if($location_result){
                $location_update_success = "Hi! " . "<strong>" . $user_info_array['full_name'] . "</strong>" . " Successfully Update Your Location.";
            }else{
                $location_query_faild = "Update <strong>Faild!</strong>";
            }
        }else{
            $pass_err_location = "Password <strong>didn't match</strong>. Please try again.";
        }
    }
        
}
// Location Validation End -----------------------------------------------------------------------------------


################################## Bio Section Start ##########################################
if(isset($_POST['bio-submit'])){
    // Receiving Values From Form Input Location Field
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $form_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['user-password']));
        $new_bio = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['n-bio']));
    }
    
    // Bio Validation Start
    if($new_bio == ''){
        $bio_err='Please enter your <strong>Bio</strong>.';
    }elseif(strlen($new_bio) > 500){
        $bio_err='Bio can contains <strong>maximum 500 characters</strong>.';
    }else{
        // Check User Account Password Match or Not
        if(password_verify($form_password,$user_account_password)){
            // If Password Matched With Database
            $bio_update = "UPDATE users SET bio='$new_bio' WHERE id=$id";
            $bio_result = mysqli_query($db_connect,$bio_update);
            if($bio_result){
                $bio_update_success = "Hi! " . "<strong>" . $user_info_array['full_name'] . "</strong>" . " Successfully Update Your Bio.";
            }else{
                $bio_query_faild = "Update <strong>Faild!</strong>";
            }
        }else{
            $pass_err_bio = "Password <strong>didn't match</strong>. Please try again.";
        }
    }
        
}
// Bio Validation End -----------------------------------------------------------------------------------


################################## Designation Section Start ##########################################
if(isset($_POST['designatin_submit'])){
    // Receiving Values From Form Input Location Field
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $form_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['user-password']));
        $new_designation = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['n-designation']));
    }
    
    // Bio Validation Start
    if($new_designation == ''){
        $designation_err='Please enter your <strong>Designation</strong>.';
    }elseif(strlen($new_designation) > 50){
        $designation_err='Designation can contains <strong>maximum 50 characters</strong>.';
    }else{
        // Check User Account Password Match or Not
        if(password_verify($form_password,$user_account_password)){
            // If Password Matched With Database
            $designation_update = "UPDATE users SET designation='$new_designation' WHERE id=$id";
            $designation_result = mysqli_query($db_connect,$designation_update);
            if($designation_result){
                $designation_update_success = "Hi! " . "<strong>" . $user_info_array['full_name'] . "</strong>" . " Successfully Update Your Designation.";
            }else{
                $designation_query_faild = "Update <strong>Faild!</strong>";
            }
        }else{
            $pass_err_designation = "Password <strong>didn't match</strong>. Please try again.";
        }
    }
        
}
// Designation Validation End -----------------------------------------------------------------------------------



################################## Profile Image Section Start ##########################################
if(isset($_POST['image-submit'])){
    // Receiving Values From Form Input Email Field
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $form_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['user-password']));
    }
    // Image File Validation Start
    $image_file = $_FILES['n-image'];
    $image_name = basename($image_file['name']);
    $image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
    $image_size_MB = ($image_file['size'] / 1024) / 1024;
    $max_image_size_MB = 10;
    $image_tmp_name = $image_file['tmp_name'];
    $available_image_extension = ['jpeg','png','jpg','svg'];

    // Default Image Name
    $defult_image_name = "default.jpg";

    // Check if image file is a actual image or fake image
    if(!empty($image_name)){
        $check = getimagesize($_FILES["n-image"]["tmp_name"]);
        if($check !==false){
            if(in_array($image_type,$available_image_extension)){
                if($image_size_MB > $max_image_size_MB){
                    $image_err='Image size is <strong>too large</strong>.';
                }else{
                    // Check User Account Password Match or Not
                    if(password_verify($form_password,$user_account_password)){
                        $db_image_name = $user_info_array['profile_image'];
                        if($db_image_name != $defult_image_name){
                            unlink("../img/users_img/" . $db_image_name);
                        } 
                        // If Password Matched With Database
                        $now_user_name = $user_info_array['full_name'];
                        $user_name_modify = strtolower(preg_replace('/ /i','_',$now_user_name));
                        $new_image_name = $user_name_modify . "_" . $id . "." . $image_type;
                        // Image Update Query
                        $image_update = "UPDATE users SET profile_image='$new_image_name' WHERE id=$id";
                        $image_result = mysqli_query($db_connect,$image_update);
                        // Image Update Query
                        if($image_update){
                            $image_update_success = "Hi! " . "<strong>" . $user_info_array['full_name'] . "</strong>" . " Successfully Update Your Profile Image.";
                            move_uploaded_file($image_tmp_name, "../img/users_img/" . $new_image_name);
                        }else{
                            $image_query_faild = "Image Upload <strong>Unsuccessfull</strong>. Please Try Again.";
                        }
                        // -------------
                    }else{
                        $image_err = "Password <strong>didn't match</strong>. Please try again.";
                    }
                    // -----------
                }
            }else{
                $image_err='Allow only <strong>jpg</strong>, <strong>jpeg</strong>, <strong>png</strong>, <strong>svg</strong> type image.';
            }
            // ---------------
        }else{
            $image_err = "This file is <strong>not a image file</strong>. Please Select a valid image.";
        } 
        // -------------
    }else{
        $image_err = 'Please select your <strong>image</strong>';
    }
    // Image File Validation End
}
################################## Profile Image Section End ----------------------------------------------------


################################## Password Changing Section Start ##########################################
if(isset($_POST['password_submit'])){
    // Receiving Values From Form Input Email Field
    if($_SERVER['REQUEST_METHOD'] == "POST"){
     $old_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['old-password']));
     $new_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['n-password']));
     $c_new_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['c-n-password']));
 }
 // --------------
 // RegEx Password Validation with preg_match function
 $regex_password_validation_code = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$^";
 $valid_pass = preg_match($regex_password_validation_code,$new_password);

 if(password_verify($old_password,$user_account_password)){
     // If User password with database code to be executed
     // Password Validation Start
     if($new_password == ''){
         $new_pass_err='Please enter your <strong>password</strong>';
     }elseif(!$valid_pass){
         $new_pass_err='Password must contains <strong>1 uppercase</strong>, <strong>1 lowercase</strong>, <strong>1 number</strong> & <strong>1 speacial character</strong>. Minumum <strong>8 characters</strong> allow.';
     }else{
         // Confirm Password Validation Start
         if($c_new_password == ''){
             $new_pass_err='Please enter <strong>comfirm password</strong>.';
         }elseif($new_password != $c_new_password){
             $new_pass_err = 'Confirm Password <strong>did not match</strong>.';
         }else{
             $hash_new_password = password_hash($new_password,PASSWORD_DEFAULT);
             // Password Update Query
             $password_update = "UPDATE users SET password='$hash_new_password' WHERE id=$id";
             $password_result = mysqli_query($db_connect,$password_update);
             // Password Update Query
             if($password_update){
                 $pass_update_success = "Hi! " . "<strong>" . $user_info_array['full_name'] . "</strong>" . " Successfully Update Your New Password.";
             }else{
                 $pass_query_faild = "Password Update <strong>Unsuccessfull</strong>. Please Try Again.";
             }
         }
         // Confirm Password Validation End
     }
     // Password Validation End
 }else{
     $old_pass_err = "Old Password <strong>didn't match</strong>.";
 }

}
################################## Password Changing Section End -----------------------------------------



// Includes Header File
require '../includes/header.php';

################################## Role Changing Section START ##########################################
$login_user_password = $login_user_array['password'];

if(isset($_POST['role_submit'])){
    // Receiving Values From Form Input Email Field
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $new_role = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['change_role']));
        $form_password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['user-password']));

    }

    // --------------
    if(empty($new_role)){
        $role_err ="Please Select User Role";
    }else{
         // Check User Account Password Match or Not 
         if(password_verify($form_password,$login_user_password)){
            // If Password Matched With Database
            $role_update = "UPDATE users SET role='$new_role' WHERE id=$id";
            $role_result = mysqli_query($db_connect,$role_update);
            if($role_result){
                $role_update_success = "Hi! " . "<strong>" . $login_user_array['full_name'] . "</strong>" . " Successfully Update " . "<strong>" . $user_info_array['full_name'] . "</strong>" . " Role.";
            }else{
                $role_query_faild = "Update <strong>Faild!</strong>";
            }
        }else{
            $role_err = "Password <strong>didn't match</strong>. Please try again.";
        }
    }
}
################################## Role Changing Section End -------------------------------------------------------------------------

############################ Social Link Section Start ###########################
if(isset($_POST['social_submit'])){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $site_name = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['site_name']));
        $link = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['site_link']));
    }

    // Regex link Validation 
    $regex_link_validation_code = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
    $valid_link = preg_match($regex_link_validation_code,$link);

    // Validation
    if(empty($site_name)){
        $site_name_err = "Please Select a Social Site.";
    }

    if($link == ''){
        $link_err = "Please Enter Your Site Link.";
    }elseif(!$valid_link){
        $link_err = "This is not a valid link. Please enter valid link.";
    }


    // Check Selected Social Site link already add or not
    $check_site_result = mysqli_query($db_connect,"SELECT * FROM user_social_links WHERE user_id=$id AND site_name='$site_name'");

    if($site_name == "facebook"){
        $icon = "fab fa-facebook-f";
    }elseif($site_name == "twitter"){
        $icon = "fab fa-twitter";
    }elseif($site_name == "pinterest"){
        $icon = "fab fa-pinterest-p";
    }elseif($site_name == "linkedin"){
        $icon = "fab fa-linkedin-in";
    }

    if(!isset($site_name_err) && !isset($link_err)){
        if(mysqli_num_rows($check_site_result) == 0){
            // INSERT QUERY
            $social_insert_result = mysqli_query($db_connect,"INSERT INTO user_social_links(user_id, site_name, icon, link) VALUES ('$id','$site_name','$icon','$link')");

            if($social_insert_result){
                $success = "Successfully Added Social Information.";
            }else{
                $faild = "Faild! Please Try Again.";
            }
        }elseif(mysqli_num_rows($check_site_result) == 1){
            $site_row_array = mysqli_fetch_assoc($check_site_result);
            $old_row_id = $site_row_array['id'];
            // UPDATE QUERY
            $update_link = mysqli_query($db_connect,"UPDATE user_social_links SET user_id='$id',site_name='$site_name',icon='$icon',link='$link' WHERE id=$old_row_id ");

            if($update_link){
                $success = "Successfully Update Social Information.";
            }else{
                $faild = "Faild! Please Try Again.";
            }
        }
    }
    
}
############################ Social Link Section End -- --------------------------------------------------------



// Function for form input sanitize
function input_sanitizer($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

################# Get user information query START ##################
$user_query_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$id");
if($user_query_result){
    $user_info_array = mysqli_fetch_assoc($user_query_result);
}else{
    header("location: /sign-out");
}
################# Get user information query END ##################--------------------------------------------------------


// Check this is valid user or client or not
if($login_user_array['role'] == 5 || $login_user_array['role'] == 6){
    if($login_user_array['id'] != $id){
        header("location: /404-not-found");
    }
}

?>




<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Update Profile</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="/user-profile/<?=($recv_encoded_user_id)?>">Profile</a>
                <span class="breadcrumb-item active">Update Profile</span>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row bg-white pb-5">

            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5 edit_page_image mb-2" src="<?=($user_image_path.$user_info_array['profile_image'])?>" width="90"
                    style="width:150px;height:150px;object-fit:cover"><span class="font-weight-bold"><?=($user_info_array['full_name'])?></span><span class="text-black-50"><?=($user_info_array['email'])?></span>
                </div>
            </div>

            
            <div class="col-md-8">
                <!-- Acordion START -->
                <div class="accordion" style="margin-top:60px" id="accordion-default">
                    
                    <!-- Name Update Start  -->
                            <?php
                                //Errors Printing by Using PHP Start
                                if(isset($name_update_success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($name_update_success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($name_query_faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($name_query_faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <?php 
                                if(isset($name_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($name_err)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($pass_err_name)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($pass_err_name)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                                // Errors Printing by Using PHP End
                            ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseOneDefault">
                                    <span><strong>Edit Name</strong></span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOneDefault" class="collapse" data-parent="#accordion-default">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3 col-md-8">
                                        <label for="">New Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="n-name" value="<?=($new_name)?>">
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="">User Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="name-submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Name Update End --------------------------------------------- -->

                    <!-- Email Update Start  -->
                            
                            <?php
                                //<!-- Email Error Print By PHP Start-->
                                if(isset($email_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($email_err)?></span>
                                    </div>
                                </div>
                            <?php 
                                }

                                if(isset($pass_err_email)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($pass_err_email)?></span>
                                    </div>
                                </div>
                            <?php         
                                }
                                if(isset($email_update_success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($email_update_success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($email_query_faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($email_query_faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                //<!-- Email Error Print By PHP End-->
                            ?>
                            
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseTwoDefault">
                                    <span><strong>Edit Email</strong></span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwoDefault" class="collapse" data-parent="#accordion-default">
                            <div class="card-body">
                            <form action="" method="post">
                                <div class="mb-3 col-md-8">
                                    <label for="">New Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="n-email" value="<?=($new_email)?>">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="">User Password</label>
                                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user-password">
                                </div>
                                <button type="submit" class="btn btn-primary" name="email-submit">Save</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- Email Update End --------------------------------------------------------------------  -->

                    <!-- Phone Update Start  -->
                            <?php
                                //Errors Printing by Using PHP Start
                                if(isset($phone_update_success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($phone_update_success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($phone_query_faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($phone_query_faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <?php 
                                if(isset($phone_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($phone_err)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($pass_err_phone)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($pass_err_phone)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                                // Errors Printing by Using PHP End
                            ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseThreeDefault">
                                    <span><strong>Edit / Add Phone Number</strong></span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThreeDefault" class="collapse" data-parent="#accordion-default">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3 col-md-8">
                                        <label for="">New Phone Number</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="n-phone" value="<?=($new_phone)?>">
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="">User Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="phone-submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Phone Update End --------------------------------------------------  -->

                    <!-- Location Update Start  -->
                            <?php
                                //Errors Printing by Using PHP Start
                                if(isset($location_update_success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($location_update_success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($location_query_faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($location_query_faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <?php 
                                if(isset($location_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($location_err)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($pass_err_location)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($pass_err_location)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                                // Errors Printing by Using PHP End
                            ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseFourDefault">
                                    <span><strong>Edit / Add Location</strong></span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFourDefault" class="collapse" data-parent="#accordion-default">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3 col-md-8">
                                        <label for="">New Location</label>
                                        <textarea type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="n-location" value="<?=($new_location)?>"></textarea>
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="">User Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="location-submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Location Update End --------------------------------------------------  -->

                    <!-- Bio Update Start  -->
                            <?php
                                //Errors Printing by Using PHP Start
                                if(isset($bio_update_success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($bio_update_success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($bio_query_faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($bio_query_faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <?php 
                                if(isset($bio_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($bio_err)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($pass_err_bio)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($pass_err_bio)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                                // Errors Printing by Using PHP End
                            ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseFiveDefault">
                                    <span><strong>Edit / Add Bio</strong></span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFiveDefault" class="collapse" data-parent="#accordion-default">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3 col-md-8">
                                        <label for="">New Bio</label>
                                        <textarea type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="n-bio"><?=(isset($new_bio)?($new_bio):(''))?></textarea>
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="">User Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="bio-submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Bio Update End --------------------------------------------------  -->

                    <!-- Designation Update Start  -->
                    <?php
                                //Errors Printing by Using PHP Start
                                if(isset($designation_update_success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($designation_update_success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($designation_query_faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($designation_query_faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <?php 
                                if(isset($designation_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($designation_err)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($pass_err_designation)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($pass_err_designation)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                                // Errors Printing by Using PHP End
                            ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseTenDefault">
                                    <span><strong>Edit / Add Designation</strong></span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTenDefault" class="collapse" data-parent="#accordion-default">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3 col-md-8">
                                        <label for="">New Designation</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="n-designation" value="<?=(isset($new_designation)?($new_designation):(''))?>">
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="">User Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="designatin_submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Designation Update End --------------------------------------------------  -->

                    <!-- Profile Image Update Start  -->
                            <?php
                                //Errors Printing by Using PHP Start
                                if(isset($image_update_success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($image_update_success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($image_query_faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($image_query_faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <?php 
                                if(isset($image_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($image_err)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                // Errors Printing by Using PHP End
                            ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseSixDefault">
                                    <span><strong>Edit / Add Profile Image</strong></span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseSixDefault" class="collapse" data-parent="#accordion-default">
                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3 col-md-8">
                                        <label for="">New Profile Image</label>
                                        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="n-image" >
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="">User Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="image-submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Profile Image Update End --------------------------------------------------  -->


                    <!-- Password Update Start  -->
                            <?php
                                //Errors Printing by Using PHP Start
                                if(isset($pass_update_success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($pass_update_success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($pass_query_faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($pass_query_faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <?php 
                                if(isset($new_pass_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($new_pass_err)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($old_pass_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($old_pass_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                                // Errors Printing by Using PHP End
                            ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseSevenDefault">
                                    <span><strong>Edit Password</strong></span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseSevenDefault" class="collapse" data-parent="#accordion-default">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3 col-md-8">
                                        <label for="">Old Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="old-password">
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="">New Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="n-password">
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="">Confirm New Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="c-n-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="password_submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Password Update End --------------------------------------------------  -->


                    <!-- User Role Update Start  -->
                        <?php
                            // Check Login User is Super Admin or Not 
                            if($login_user_array['role'] == 1){
                        ?>
                            <?php
                                //Errors Printing by Using PHP Start
                                if(isset($role_update_success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($role_update_success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($role_query_faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($role_query_faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($role_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($role_err)?></span>
                                    </div>
                                </div>
                            <?php       
                                }
                                // Errors Printing by Using PHP End
                            ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseEightDefault">
                                        <span><strong>Update User Role</strong></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseEightDefault" class="collapse" data-parent="#accordion-default">
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="mb-3 col-md-8">
                                            <label for="">Change Role</label>
                                            <select name="change_role" id="" class="form-select form-control" aria-label="Default select example">
                                                <option value="" selected disabled>Choose One</option>
                                                <option value="1">Super Admin</option>
                                                <option value="2">Admin</option>
                                                <option value="3">Modarator</option>
                                                <option value="4">Editor</option>
                                                <option value="5">Client</option>
                                                <option value="6">User</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-8">
                                            <label for="">User Password</label>
                                            <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user-password">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="role_submit">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php        
                            }
                        ?>
                    <!-- User Role Update End --------------------------------------------------  -->



                    <!-- User Social Links ADD Start  -->
                            <?php
                                //Errors Printing by Using PHP Start
                                if(isset($success)){
                            ?>
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-check-o"></i>
                                        </span>
                                        <span><?=($success)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($faild)){
                            ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-close-o"></i>
                                        </span>
                                        <span><?=($faild)?></span>
                                    </div>
                                </div>
                            <?php
                                }
                                if(isset($link_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($link_err)?></span>
                                    </div>
                                </div>
                            <?php       
                                }
                                if(isset($site_name_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($site_name_err)?></span>
                                    </div>
                                </div>
                            <?php       
                                }
                                // Errors Printing by Using PHP End
                            ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseNineDefault">
                                        <span><strong>Add / Edit Social Links</strong></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseNineDefault" class="collapse" data-parent="#accordion-default">
                                <div class="card-body">

                                    <form action="" method="POST">
                                        <div class="mb-3 col-md-8">
                                            <label for="">Select Social Site</label>
                                            <select name="site_name" id="" class="form-select form-control" aria-label="Default select example">
                                                <option value="" selected disabled>Choose One</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="twitter">Twitter</option>
                                                <option value="pinterest">Pinterest</option>
                                                <option value="linkedin">Linkedin</option>
                                            </select>
                                        </div>
                                        <label for="basic-url">Link</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon3">https://</span>
                                            </div>
                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="site_link">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="social_submit">Save</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        
                    <!-- User Social Links ADD End --------------------------------------------------  -->



                </div>
            </div>
            <!-- Acordion END ---------------------------------------- -->
            

        </div>
        <!-- ############### Edit Page HTML END -->
    </div>
</div>











<?php 
    // Includes Footer File
    require '../includes/footer.php';
?>