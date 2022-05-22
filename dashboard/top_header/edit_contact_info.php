<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';


    // Receive User Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive User Acual ID
    $id = $decript_formula;


    ################### Query for getting all information START #############################
    $contact_info_query_result = mysqli_query($db_connect,"SELECT * FROM top_header WHERE id=$id");
    if(!$contact_info_query_result){
        $_SESSION['query_faild'] = "Something Worng!";
        header("location: /contact-info");
    }
    $contact_info_array = mysqli_fetch_assoc($contact_info_query_result);
    ################### Query for getting all information END #############################

    // If Id is not Valid
    if($rows = mysqli_num_rows($contact_info_query_result) == 0){
        header("location: /403-forbidden");
    }


    ################################## Contact Information Section Start ##########################################
    // Contact Information Validation and editing Start
    if(isset($_POST['contact_info_update'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $phone_icon = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['phone_icon']));
            $phone_number = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['phone']));
            $email_icon = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['email_icon']));
            $email = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['email']));
        }

        // Phone icon Section Start
        if($phone_icon == ""){
            $phone_icon = "fas fa-mobile-alt";
        }elseif(strlen($phone_icon) > 100){
            $error_phone_icon="Phone Icon Contains Maximum 100 Characters.";
        }else{
            $valid_phone_icon = "";
        }
        
        // Phone icon Section End

        // Phone Number Section Start
        if($phone_number == ''){
            $error_phone="Please Enter Your Phone Number.";
        }elseif(!is_numeric($phone_number)){
            $error_phone="This is not a valid phone number. Please enter valid number.";
        }elseif(strlen($phone_number) > 11){
            $error_phone="Phone Number Contains Maximum 11 Numbers.";
        }else{
            $valid_phone = "";
        }
        // Phone Number Section End

        // Email icon Section Start
        if($email_icon == ""){
            $email_icon = "far fa-envelope";
        }elseif(strlen($email_icon) > 100){
            $error_email_icon="Email Icon Contains Maximum 100 Characters. Please enter only icon class.";
        }else{
            $valid_email_icon = "";
        }
        
        // Email icon Section End

        // Email Section Start

        // RegEx Email Validation with preg_match function
        $regex_email_validation_code = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        $valid_email = preg_match($regex_email_validation_code,$email);
         // Email Validation Start
            if($email == ''){
                $error_email='Please enter your <strong>Email.</strong>';
            }elseif(!$valid_email){
                $error_email='Email address is <strong>not valid.</strong> Please enter a valid email.';
            }else{
                $valid_email="";
            }
        // Email Section End

        if(isset($valid_phone_icon,$valid_phone,$valid_email_icon,$valid_email)){
            // Make Date And Time
            date_default_timezone_set('asia/dhaka');
            $time = date('h:i:s A');
            $date = date('d-m-Y');
            $date_time = $time . ',' . $date;
            // Update Query Start
            $update_contact_info = "UPDATE top_header SET contact_icon='$phone_icon',contact_number='$phone_number',email_icon='$email_icon',contact_email='$email',created_at='$date_time' WHERE id=$id";
            $update_result = mysqli_query($db_connect,$update_contact_info);
            // Update Query End

            if($update_result){
                $_SESSION['insert_success'] = "Information Update Success";
                header('location: /contact-info');
            }else{
                $update_faild = "Update Faild! Please Try Again.";
            }
        }

    }
    // Contact Information Validation and editing End-------------------------------------------------------------------------------------

    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    // Include Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Contact Information Edit</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Edit Contact Information</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-6 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Phone Icon (optional)</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Phone icon" name="phone_icon" value="<?=(isset($error_phone_icon)?($phone_icon):($contact_info_array['contact_icon']))?>">
                            <?php 
                                if(isset($error_phone_icon)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($error_phone_icon)?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Phone Number</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Phone Number" name="phone" value="<?=(isset($error_phone)?($phone_number):($contact_info_array['contact_number']))?>">
                            <?php 
                                if(isset($error_phone)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($error_phone)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Email Icon (optional)</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Email icon" name="email_icon" value="<?=(isset($error_email_icon)?($email_icon):($contact_info_array['email_icon']))?>">
                            <?php 
                                if(isset($error_email_icon)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($error_email_icon)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Email Address</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Email Address" name="email" value="<?=(isset($error_email)?($email):($contact_info_array['contact_email']))?>">
                            <?php 
                                if(isset($error_email)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($error_email)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <button type="submit" name="contact_info_update" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    <div>
</div>
<!-- Content Wrapper END -->



<?php 
    // Include Footer File
    require '../includes/footer.php';


    if(isset($update_faild)){
?>
    <script>
        Swal.fire(
            'Update Faild!',
            '<?=($insert_faild)?>',
            'error'
        )
    </script>
<?php        
    }
?>