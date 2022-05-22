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

    // Query For Getting Image Name
    $image_result = mysqli_query($db_connect,"SELECT * FROM counter_section WHERE id=$id");
    if(!$image_result){
        header("location: /403-forbidden");
    }
    $image_info_array = mysqli_fetch_assoc($image_result);
    // -----------------

    if(isset($_POST['counter_submit'])){
        if($_SERVER['REQUEST_METHOD'] =="POST"){
            $image_file = $_FILES['image'];
        }

        $image_name = basename($image_file['name']);
        $image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
        $image_size_MB = ($image_file['size'] / 1024) / 1024;
        $max_image_size_MB = 10;
        $image_tmp_name = $image_file['tmp_name'];
        $available_image_extension = ['jpeg','png','jpg','svg'];

        if(empty($image_name)){
            $img_err = "Please Select A Image.";
        }else{
            ############ UPDATE WITH IMAGE
            // Check if image file is a actual image or fake image
            if(!empty($image_name)){
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !==false){
                    if(in_array($image_type,$available_image_extension)){
                        if($image_size_MB > $max_image_size_MB){
                            $img_err='Image size is <strong>too large</strong>';
                        }
                    }else{
                        $img_err='Allow only <strong>jpg</strong>, <strong>jpeg</strong>, <strong>png</strong>, <strong>svg</strong> type image.';
                    }
                }else{
                    $img_err = "This file is <strong>not a image file</strong>. Please Select a valid image.";
                } 
            }else{
                $img_err = 'Please select your <strong>image</strong>';
            }
            // Image File Validation End

            // Make Image File
            $old_image = $image_info_array['image'];
            $new_image = "cunter_image_". $id . "." . $image_type;

            if(!isset($img_err)){
                // Update Image Query
                $update_counter_image = mysqli_query($db_connect,"UPDATE counter_section SET image='$new_image' WHERE id=$id");
                if($update_counter_image){
                    unlink("../img/counter_images/$old_image");
                    $_SESSION['success'] = "Successfully Update!";
                    move_uploaded_file($image_tmp_name,"../img/counter_images/$new_image");
                    header("location: /counter-info");
                }else{
                    $_SESSION['faild'] = "Update Faild! Please Try Again.";
                }
            }

        }
    }


    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Add Counter Background Image</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add Image</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-6 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Add Image</label>
                            <input type="file" class="form-control" id="formGroupExampleInput" name="image">
                            <?php 
                                if(isset($img_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($img_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                        </div>
                        
                        <button type="submit" name="counter_submit" class="btn btn-primary">Add Image</button>
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
?>
<?php
    if(isset($_SESSION['faild'])){
?>
    <script>
        Swal.fire(
            'Faild!',
            '<?=($_SESSION['faild'])?>',
            'error'
        )
    </script>
<?php        
    }
    unset($_SESSION['faild']);
?>
