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
    $banner_button_query_result = mysqli_query($db_connect,"SELECT * FROM banner_buttons WHERE id=$id");
    if(!$banner_button_query_result){
        $_SESSION['query_faild'] = "Something Worng!";
        header("location: /banner-info");
    }
    $banner_button_info_array = mysqli_fetch_assoc($banner_button_query_result);
    ################### Query for getting all information END #############################

    // If Id is not Valid
    if($rows = mysqli_num_rows($banner_button_query_result) <= 0){
        header("location: /403-forbidden");
    }


    ################################## Social Links Section Start ##########################################
    // Social Links Validation and editing Start
    if(isset($_POST['banner_button_update'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $btn_text = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['btn_text']));
            $btn_link = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['btn_link']));
        }

        // Regex link Validation 
        $regex_link_validation_code = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        $valid_link = preg_match($regex_link_validation_code,$btn_link);

        // Button Text Start
        if($btn_text == ""){
            $errors_btn="Please Enter Your Button Text.";
        }elseif(strlen($btn_text) > 15){
            $errors_btn="Button Text contains Maximum 15 Characters.";
        }
        // Button Text End

        // Site Link Section Start
        if($btn_link == ''){
            $btn_link = "";
        }elseif(!$valid_link){
            $errors_link="This is not a valid Link. Please enter valid Link.";
        }
        // Site Link Section End


        if(!isset($errors_btn) || !isset($errors_link)){
            // Make Date And Time
            date_default_timezone_set('asia/dhaka');
            $time = date('h:i:s A');
            $date = date('d-m-Y');
            $date_time = $time . ',' . $date;
            // Update Query Start
            $update_banner_button = "UPDATE banner_buttons SET button_name='$btn_text',button_link='$btn_link',created_at='$date_time' WHERE id=$id";
            $update_result = mysqli_query($db_connect,$update_banner_button);
            // Update Query End

            if($update_result){
                $_SESSION['success'] = "Information Update Success";
                header('location: /banner-info');
            }else{
                // $_SESSION['faild'] = "Data Insert Faild!";
                // header('location: /banner-button-edit/' . $recv_encoded_user_id);
                $update_faild = "Information Update Faild! Please Try Again.";
            }
        }

    }
    // Social Validation and editing End-------------------------------------------------------------------------------------

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
        <h2 class="header-title">Banner Button Edit</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Edit banner button</span>
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
                            <label for="formGroupExampleInput">Button Text</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Social Site Icon" name="btn_text" value="<?=(isset($errors_btn)?($btn_text):($banner_button_info_array['button_name']))?>">
                            <?php 
                                if(isset($errors_btn)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($errors_btn)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        
                        <label for="basic-url">Button Link</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="btn_link" value="<?=(isset($errors_link)?($btn_link):($banner_button_info_array['button_link']))?>">
                        </div>
                            <?php 
                                if(isset($errors_link)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($errors_link)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        <button type="submit" name="banner_button_update" class="btn btn-primary">Update</button>
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
            'Faild!',
            '<?=($update_faild)?>',
            'error'
        )
    </script>
<?php        
    }
?>