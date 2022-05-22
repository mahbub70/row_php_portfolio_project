<?php 
    session_start();

    // Database File Include
    require '../includes/db.php';

    // Storing Errors
    $errors = [];
    $old_values = [];

    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;

    // Receive Value From Add banner Page
    if(isset($_POST['banner_info_submit'])){
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
            $errors['title'] = "Please Enter Your <strong>Title</strong>.";
        }elseif(strlen($title) > 150){
            $errors['title'] = "Ttitle Contains <strong>Maximum 150 Characters</strong>.";
        }
        // Title Validation End

        // Description Validation Start
        if($desc == ''){
            $errors['desc'] = "Please Enter Your <strong>Description</strong>.";
        }elseif(strlen($desc) > 500){
            $errors['desc'] = "Description Contains <strong>Maximum 500 Characters</strong>.";
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
                        $errors['img-err']='Image size is <strong>too large</strong>';
                    }
                }else{
                    $errors['img-err']='Allow only <strong>jpg</strong>, <strong>jpeg</strong>, <strong>png</strong>, <strong>svg</strong> type image.';
                }
            }else{
                $errors['img-err'] = "This file is <strong>not a image file</strong>. Please Select a valid image.";
            } 
        }else{
            $errors['img-err'] = 'Please select your <strong>image</strong>';
        }
        // Image File Validation End

        if(count($errors)==0){
            $banner_insert_query_result = mysqli_query($db_connect,"INSERT INTO banners(created_at) VALUES ('$date_time')");

            $inserted_id = mysqli_insert_id($db_connect);
            $image_file_name = "banner_image_" . $inserted_id . "." . $image_type;

            $update_with_image_name = mysqli_query($db_connect,"UPDATE banners SET title='$title',description='$desc',image='$image_file_name',created_at='$date_time' WHERE id=$inserted_id");

            if(!$banner_insert_query_result || !$update_with_image_name){
                $_SESSION['faild'] = "Something Wrong! Please Try Again.";
                header("location: /banner-add");
            }
            if($banner_insert_query_result && $update_with_image_name){
                $_SESSION['success'] = "Banner Added Success.";
                header("location: /banner-info");

                move_uploaded_file($image_tmp_name, "../img/banners/$image_file_name");
            }
        }else{
            $old_values['title'] = $title;
            $old_values['desc'] = $desc;
            $_SESSION['old_values'] = $old_values;
            $_SESSION['errors'] = $errors;
            header("location: /banner-add");
        }

    }else{
        header("location: /403-forbidden");
    }



    ############## IF CLICKED BANNER BUTTON ADD #######################
    if(isset($_POST['banner_btn_submit'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $button_text = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['btn_text']));
            $button_link = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['btn_link']));
        }

        // Regex link Validation 
        $regex_link_validation_code = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        $valid_link = preg_match($regex_link_validation_code,$button_link);

        // Button Text Start
        if($button_text == ""){
            $errors['btn_text']="Please Enter Your Button Text.";
        }elseif(strlen($button_text) > 15){
            $errors['btn_text']="Button Text contains Maximum 15 Characters.";
        }
        // Button Text End

        // Site Link Section Start
        if($button_link == ''){
            $button_link = "";
        }elseif(!$valid_link){
            $errors['btn_link']="This is not a valid Link. Please enter valid Link.";
        }
        // Site Link Section End

        if(count($errors) == 0){
            // Make Date And Time
            date_default_timezone_set('asia/dhaka');
            $time = date('h:i:s A');
            $date = date('d-m-Y');
            $date_time = $time . ',' . $date;
            // Insert Query Start
            $insert_banner_btn = "INSERT INTO banner_buttons(button_name, button_link, created_at) VALUES ('$button_text','$button_link','$date_time')";
            $insert_result = mysqli_query($db_connect,$insert_banner_btn);
            // Insert Query End

            if($insert_result){
                $_SESSION['success'] = "Button Added Success";
                header('location: /banner-info');
            }else{
                $_SESSION['insert_faild'] = "Data Insert Faild!";
                header('location: /banner-add');
            }
        }else{
            $old_values['btn_text'] = $button_text;
            $_SESSION['old_values'] = $old_values;
            $_SESSION['link_errors'] = $errors;
            header('location: /banner-add');
        }
    }


    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>