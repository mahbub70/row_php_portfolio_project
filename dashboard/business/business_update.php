<?php 
    session_start();

    // Database File Include
    require '../includes/db.php';

    // Receive Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive Acual ID
    $edit_id = $decript_formula;

    ############### Query For Getting Business Information Start #################
    $business_result = mysqli_query($db_connect,"SELECT * FROM business WHERE id=$edit_id");
    if(!$business_result){
        $_SESSION['faild'] = "Faild to update information. Please try again.";
        header("location: /business-edit/$recv_encoded_user_id");
    }
    $business_info_array = mysqli_fetch_assoc($business_result);
    ############### Query For Getting Business Information End #################
    // Storing Errors
    $errors = [];
    $old_values = [];

    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;

    // Receive Value From Edit Business Page
    if(isset($_POST['business_submit'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $business_text = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['text']));
            $button_text = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['btn_text']));
            $button_link = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['btn_link']));
            $image_file = $_FILES['image'];
        }else{
            header("location: /403-forbidden");
        }

        // Business Text Validation Start
        if($business_text == ''){
            $errors['text'] = "Please Enter Your <strong>Business Text</strong>.";
        }elseif(strlen($business_text) > 500){
            $errors['text'] = "Business Text Contains <strong>Maximum 500 Characters</strong>.";
        }
        // Business Text Validation End

        // Business Button Validation Start
        if($button_text == ''){
            $errors['btn_text'] = "Please Enter Your <strong>Button Text</strong>.";
        }elseif(strlen($button_text) > 30){
            $errors['btn_text'] = "Button Text Contains <strong>Maximum 30 Characters</strong>.";
        }
        // Business Button Validation End

        $image_name = basename($image_file['name']);
        $image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
        $image_size_MB = ($image_file['size'] / 1024) / 1024;
        $max_image_size_MB = 10;
        $image_tmp_name = $image_file['tmp_name'];
        $available_image_extension = ['jpeg','png','jpg','svg'];


        if(empty($image_name)){
            if(count($errors) == 0){
                // Update Query Without Image
                $update_info_without_image = mysqli_query($db_connect,"UPDATE business SET business_text='$business_text',btn_text='$button_text',btn_link='$button_link',created_at='$date_time' WHERE id=$edit_id");
                if($update_info_without_image){
                    $_SESSION['success'] = "Update Success!";
                    header("location: /business-info");
                }else{
                    $old_values['text'] = $button_text;
                    $old_values['btn_text'] = $button_text;
                    $old_values['btn_link'] = $button_link;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /business-edit/$recv_encoded_user_id");
                }
            }else{
                $old_values['text'] = $button_text;
                $old_values['btn_text'] = $button_text;
                $old_values['btn_link'] = $button_link;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /business-edit/$recv_encoded_user_id");
            }
        }elseif(!empty($image_name)){
            ############ UPDATE WITH IMAGE
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

            if(count($errors) == 0){
                $past_image_name = $$business_info_array['image'];
                $new_image_name = "business_image_" . $edit_id . "." . $image_type;
                // Update Query With Image
                $update_info_with_image = mysqli_query($db_connect,"UPDATE business SET business_text='$business_text',btn_text='$button_text',btn_link='$button_link',image='$new_image_name',created_at='$date_time' WHERE id=$edit_id");
                if($update_info_with_image){
                    unlink("../img/business_images/$past_image_name");
                    $_SESSION['success'] = "Update Success!";
                    move_uploaded_file($image_tmp_name,"../img/business_images/$new_image_name");
                    header("location: /business-info");
                }else{
                    $old_values['text'] = $button_text;
                    $old_values['btn_text'] = $button_text;
                    $old_values['btn_link'] = $button_link;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /business-edit/$recv_encoded_user_id");
                }
            }else{
                $old_values['text'] = $button_text;
                $old_values['btn_text'] = $button_text;
                $old_values['btn_link'] = $button_link;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /business-edit/$recv_encoded_user_id");
            }
        }  

    }else{
        header("location: /403-forbidden");
    }


    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
?>