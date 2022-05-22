<?php

    session_start();

    // Database Connection File
    require '../includes/db.php';



    // Storing Errors
    $errors = [];

    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;

    // Receive Value From Add banner Page
    if(isset($_POST['portfolio_submit'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $category = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['category']));
            $image_file = $_FILES['image'];
        }else{
            header("location: /403-forbidden");
        }

        $image_name = basename($image_file['name']);
        $image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
        $image_size_MB = ($image_file['size'] / 1024) / 1024;
        $max_image_size_MB = 10;
        $image_tmp_name = $image_file['tmp_name'];
        $available_image_extension = ['jpeg','png','jpg','svg'];

        // Validation Information

        if(empty($category)){
            $errors['category'] = "Please Select a <strong>Category</strong>.";
        }

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
            // Ready for Insert Data
            $portfolio_insert_result = mysqli_query($db_connect,"INSERT INTO portfolios(created_at) VALUES ('$date_time')");
    
            $inserted_id = mysqli_insert_id($db_connect);
            $image_file_name = "portfolio_image_" . $inserted_id . "." . $image_type;

            $update_with_image_name = mysqli_query($db_connect,"UPDATE portfolios SET category='$category',portfolio_image='$image_file_name',created_at='$date_time' WHERE id=$inserted_id");

            if(!$portfolio_insert_result || !$update_with_image_name){
                $_SESSION['faild'] = "Something Wrong! Please Try Again.";
                header("location: /portfolio-add");
            }
            if($portfolio_insert_result && $update_with_image_name){
                $_SESSION['success'] = "Portfolio Added Success.";
                header("location: /portfolio-add");

                move_uploaded_file($image_tmp_name, "../img/portfolio_images/$image_file_name");
            }
        }else{
            $_SESSION['errors'] = $errors;
            header("location: /portfolio-add");
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