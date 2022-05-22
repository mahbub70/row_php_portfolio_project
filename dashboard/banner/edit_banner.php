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


    ############### Query For Getting Banner Information START #########################
    $banner_info_query_result = mysqli_query($db_connect,"SELECT * FROM banners WHERE id=$id");
    if(!$banner_info_query_result){
        $_SESSION['faild'] = "Something Worng! Please Try Again.";
        header("location: /banner-info"); 
    }
    $banner_info_array = mysqli_fetch_assoc($banner_info_query_result);
    ############### Query For Getting Banner Information END #########################


    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;

    // Receive Value From Update Form 
    if(isset($_POST['banner_update_submit'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $title = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['title']));
            $desc = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['desc']));
            $image_file = $_FILES['image'];
        }else{
            header("location: /403-forbidden");
        }

        // Title Validation Start
        if($title == ''){
            $error_title = "Please Enter Your <strong>Title</strong>.";
        }elseif(strlen($title) > 150){
            $error_title = "Ttitle Contains <strong>Maximum 150 Characters</strong>.";
        }else{
            $valid_title = $title;
        }
        // Title Validation End

        // Description Validation Start
        if($desc == ''){
            $error_desc = "Please Enter Your <strong>Description</strong>.";
        }elseif(strlen($desc) > 500){
            $error_desc = "Description Contains <strong>Maximum 500 Characters</strong>.";
        }else{
            $valid_desc = $desc;
        }
        // Description Validation End

        $image_name = basename($image_file['name']);
        $image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
        $image_size_MB = ($image_file['size'] / 1024) / 1024;
        $max_image_size_MB = 10;
        $image_tmp_name = $image_file['tmp_name'];
        $available_image_extension = ['jpeg','png','jpg','svg'];

        // Check if image file is a actual image or fake image
        if(!empty($image_name)){
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !==false){
                if(in_array($image_type,$available_image_extension)){
                    if($image_size_MB > $max_image_size_MB){
                        $error_img='Image size is <strong>too large</strong>';
                    }else{
                        $valid_image = "";
                    }
                }else{
                    $error_img ='Allow only <strong>jpg</strong>, <strong>jpeg</strong>, <strong>png</strong>, <strong>svg</strong> type image.';
                }
            }else{
                $error_img = "This file is <strong>not a image file</strong>. Please Select a valid image.";
            } 
        }else{
            $error_img = 'Please select your <strong>image</strong>';
        }
        // Image File Validation End

        


        // If Image is not given
        if(isset($valid_title,$valid_desc)){
            if(empty($_FILES['image']['name'])){
                // Update Information With out Image
                $update_query_result = mysqli_query($db_connect,"UPDATE banners SET title='$valid_title',description='$valid_desc',created_at='$date_time' WHERE id=$id");
                if($update_query_result){
                    $_SESSION['success'] = "Update Banner Without Image.";
                    header("location: /banner-info");
                }else{
                    $faild = "Update Faild! Please Try Again.";
                }
            }elseif($_FILES['image']['name'] != ""){
                if(isset($valid_title,$valid_desc,$valid_image)){
                    $past_image_name = $banner_info_array['image'];
                    $image_file_name = "banner_image_" . $id . "." . $image_type;
                    $update_with_image_name = mysqli_query($db_connect,"UPDATE banners SET title='$title',description='$desc',image='$image_file_name',created_at='$date_time' WHERE id=$id");
                    if(!$update_with_image_name){
                        $faild = "Something Wrong! Please Try Again.";
                    }
                    if($update_with_image_name){
                        unlink("../img/banners/$past_image_name");
                        $_SESSION['success'] = "Banner Update Success.";
                        move_uploaded_file($image_tmp_name, "../img/banners/$image_file_name");
                        header("location: /banner-info");
                    }
                }
            }
        }
    }

    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Edit Banner Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Edit banner</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="formGroupExampleInput">Update Title</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Banner Title" name="title" value="<?=(isset($error_title)?($title):($banner_info_array['title']))?>">
                            <?php 
                                if(isset($error_title)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($error_title)?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Update Description</label>
                            <textarea type="text" class="form-control" id="formGroupExampleInput2" placeholder="Banner Description" name="desc"><?=(isset($error_desc)?($desc):($banner_info_array['description']))?></textarea>
                            <?php 
                                if(isset($error_desc)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($error_desc)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Update Image</label>
                            <input type="file" class="form-control" id="formGroupExampleInput2" name="image">
                            <?php 
                                if(isset($error_img)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($error_img)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <button type="submit" name="banner_update_submit" class="btn btn-primary">Update Banner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper END -->


<?php 
    // Includes Footer File
    require '../includes/footer.php';

    if(isset($faild)){
?>
    <script>
        Swal.fire(
            'Faild!',
            '<?=($faild)?>',
            'error'
        )
    </script>
<?php        
    }
?>