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
    $social_link_query_result = mysqli_query($db_connect,"SELECT * FROM social_links WHERE id=$id");
    if(!$social_link_query_result){
        $_SESSION['query_faild'] = "Something Worng!";
        header("location: /contact-info");
    }
    $social_info_array = mysqli_fetch_assoc($social_link_query_result);
    ################### Query for getting all information END #############################

    // If Id is not Valid
    if($rows = mysqli_num_rows($social_link_query_result) == 0){
        header("location: /403-forbidden");
    }

    // Include Header File
    require '../includes/header.php';


    ################################## Social Links Section Start ##########################################
    // Social Links Validation and editing Start
    if(isset($_POST['social_link_update'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $site_name = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['social_site']));
            $site_icon = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['icon']));
            $site_link = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['link']));
        }

        // Regex link Validation 
        $regex_link_validation_code = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        $valid_link = preg_match($regex_link_validation_code,$site_link);

        // Site Name Start
        if($site_name == ""){
            $site_name_err="Please Select Social Site.";
        }else{
            $valild_site_name = "";
        }
        // Site Name End

        // Site Link Section Start
        if($site_link == ''){
            $site_link_err="Please Enter Social Site Link.";
        }elseif(!$valid_link){
            $site_link_err="This is not a valid Link. Please enter valid Link.";
        }else{
            $valid_site_link = "";
        }
        // Site Link Section End

        // Site icon Section Start
        if(strlen($site_icon) > 100){
            $site_icon_err="Social Icon Contains Maximum 100 Characters. Please enter only icon class.";
        }else{
            $valid_site_icon = "";
        }
        // Site icon Section End

        // Set Default Site Icon
        if($site_icon == ""){
            if($site_name == 'facebook'){
                $site_icon = "fab fa-facebook";
            }elseif($site_name == 'twitter'){
                $site_icon = "fab fa-twitter";
            }elseif($site_name == 'pinterest'){
                $site_icon = "fab fa-pinterest-square";
            }elseif($site_name == 'linkedin'){
                $site_icon = "fab fa-linkedin";
            }
        }


        if(isset($valild_site_name,$valid_site_icon,$valid_site_link)){
            // Make Date And Time
            date_default_timezone_set('asia/dhaka');
            $time = date('h:i:s A');
            $date = date('d-m-Y');
            $date_time = $time . ',' . $date;
            // Update Query Start
            $update_social_site = "UPDATE social_links SET site_name='$site_name',site_icon='$site_icon',site_link='$site_link',created_at='$date_time' WHERE id=$id";
            $update_result = mysqli_query($db_connect,$update_social_site);
            // Update Query End

            if($update_result){
                $_SESSION['insert_success'] = "Information Update Success";
                header('location: /contact-info');
            }else{
                $_SESSION['insert_faild'] = "Data Insert Faild!";
                header('location: /social-link-edit/' . $recv_encoded_user_id);
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


?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Social Link Edit</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Edit Social Link</span>
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
                            <label for="">Select Social Site</label>
                            <select name="social_site" id="" class="form-control" aria-label="Default select example">
                                <option value="" selected disabled>Choose One</option>
                                <option value="facebook">Facebook</option>
                                <option value="twitter">Twitter</option>
                                <option value="pinterest">Pinterest</option>
                                <option value="linkedin">Linkedin</option>
                            </select>
                            <?php 
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
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Icon</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Social Site Icon" name="icon" value="<?=(isset($site_icon_err) || isset($site_name_err) || isset($site_link_err)?($site_icon):($social_info_array['site_icon']))?>">
                            <?php 
                                if(isset($site_icon_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($site_icon_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        
                        <label for="basic-url">Link</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="link" value="<?=(isset($site_link_err)?($site_link):($social_info_array['site_link']))?>">
                        </div>
                            <?php 
                                if(isset($site_link_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($site_link_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>

                        <button type="submit" name="social_link_update" class="btn btn-primary">Update</button>
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