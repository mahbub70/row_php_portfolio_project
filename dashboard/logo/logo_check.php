<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Store Error Value
    $errors = [];

    // Logo Validation and editing Start
    if(isset($_POST['logo_submit'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $logo_text = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['logo_text']));
            $image_file = $_FILES['logo_image'];
        }

        // Make Date And Time
        date_default_timezone_set('asia/dhaka');
        $time = date('h:i:s A');
        $date = date('d-m-Y');
        $date_time = $time . ',' . $date;

        // Receiving Image File Information
        $image_name = basename($image_file['name']);
        $image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
        $image_size_MB = ($image_file['size'] / 1024) / 1024;
        $max_image_size_MB = 10;
        $image_tmp_name = $image_file['tmp_name'];
        $available_image_extension = ['jpeg','png','jpg','svg'];

        if(empty($image_name) && $logo_text == ''){
            $errors['require_err'] = "Minumum One Field is Require.";
        }elseif(!empty($image_name)){
            // Image Section Start
            $check = getimagesize($_FILES["logo_image"]["tmp_name"]);
            if($check !==false){
                if(in_array($image_type,$available_image_extension)){
                    if($image_size_MB > $max_image_size_MB){
                        $errors['img-err']='Image size is <strong>too large</strong>';
                    }else{
                        if(count($errors) == 0){
                            // Update Query Start
                            ########### INSERT QUERY FOR LOGO START #####################
                            $logo_insert_query_result = mysqli_query($db_connect,"INSERT INTO logos(created_at) VALUES ('$date_time')");

                            $inserted_id = mysqli_insert_id($db_connect);
                            $image_file_name = "logo_image_" . $inserted_id . "." . $image_type;

                            $logo_type = "Image";

                            $update_with_image_name = mysqli_query($db_connect,"UPDATE logos SET logo='$image_file_name', type='$logo_type', created_at='$date_time' WHERE id=$inserted_id");

                            if(!$logo_insert_query_result || !$update_with_image_name){
                                $_SESSION['faild'] = "Something Wrong! Please Try Again.";
                                header("location: /logo-add");
                            }
                            if($logo_insert_query_result && $update_with_image_name){
                                $_SESSION['success'] = "Successfully Added Logo.";
                                header("location: /logo-info");

                                move_uploaded_file($image_tmp_name, "../img/logos/$image_file_name");
                            }
                            ########### INSERT QUERY FOR LOGO END #######################
                        }else{
                            $_SESSION['errors'] = $errors;
                            header("location: /logo_add");
                        } 
                    }
                }else{
                    $errors['img-err']='Allow only <strong>jpg</strong>, <strong>jpeg</strong>, <strong>png</strong>, <strong>svg</strong> type image.';
                }
            }else{
                $errors['img-err'] = "This file is <strong>not a image file</strong>. Please Select a valid image.";
            }
            // Image Section End
        }elseif($logo_text != ''){
            // Text Section Start
            if(strlen($logo_text) > 15){
                $errors['text_img_err'] = "Text Image Contains Maximum 15 Characters.";
            }else{
                if(count($errors) == 0){
                    $logo_type = "Text";
                    ############### Query For Insert Text Logo START ###########################
                    $insert_text_logo_result = mysqli_query($db_connect,"INSERT INTO logos(logo, type, created_at) VALUES ('$logo_text','$logo_type','$date_time')");
                    ############### Query For Insert Text Logo END ###########################
                    if($insert_text_logo_result){
                        $_SESSION['success'] = "Successfully Added Logo.";
                        header("location: /logo-info");
                    }else{
                        $_SESSION['faild'] = "Something Wrong! Please Try Again.";
                        header("location: /logo-add");
                    }
                }else{
                    $_SESSION['errors'] = $errors;
                    header("location: /logo_add");
                }
            }
            // Text Section END
        }

    }else{
        header("location: /403-forbidden");
    }
    // Contact Information Validation and editing End-------------------------------------------------------------------------------------

    if(count($errors) != 0){
        $_SESSION['errors'] = $errors;
        header("location: /logo_add");
    }


    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>