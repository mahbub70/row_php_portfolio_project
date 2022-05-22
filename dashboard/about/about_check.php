<?php 
    session_start();

    // Database File Include
    require '../includes/db.php';

    // Receive URI For Checking Information Came From Edit Page Or Add Page START
    $uri = $_SERVER['REQUEST_URI'];
    $explode_uri = explode("/",$uri);
    $get_last_uri = end($explode_uri);
    // Receive Page Nishana
    $nishana = $explode_uri[2];
    // Receive URI For Checking Information Came From Edit Page Or Add Page END

    // Receive Url Code That encode using base64encode() function
    $recv_encoded_user_id = $get_last_uri;
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive Acual ID
    $edit_id = $decript_formula;

    ############### Query For Getting Edit About Information START #########################
    $about_info_query_result = mysqli_query($db_connect,"SELECT * FROM abouts WHERE id=$edit_id");
    if(!$about_info_query_result){
        $_SESSION['faild'] = "Something Worng! Please Try Again.";
        header("location: /about-info"); 
    }
    $about_info_array = mysqli_fetch_assoc($about_info_query_result);
    ############### Query For Getting Edit About Information END #########################

    ############### Query For Getting Company Information START #########################
    $company_header_query_result = mysqli_query($db_connect,"SELECT * FROM company_header WHERE id=$edit_id");
    if(!$company_header_query_result){
        $_SESSION['faild'] = "Something Worng! Please Try Again.";
        header("location: /company-info"); 
    }
    $company_header_info_array = mysqli_fetch_assoc($company_header_query_result);
    ############### Query For Getting Company Information END #########################



    // Storing Errors
    $errors = [];
    $old_values = [];

    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;

    // Receive Value From Add banner Page
    if(isset($_POST['about_submit']) || isset($_POST['service_header_submit']) || isset($_POST['portfolio_header_submit']) || isset($_POST['subscriber_header_submit']) || isset($_POST['package_header_submit']) || isset($_POST['consultant_header_submit']) || isset($_POST['testimonial_header_submit']) || isset($_POST['blog_header_submit']) || isset($_POST['contact_header_submit'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $small_title = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['small_title']));
            $big_title = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['big_title']));
            if(isset($_POST['about_text'])){
                $about_text = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['about_text']));
            }
            if(isset($_POST['desc'])){
                $text = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['desc']));
            }
            $image_file = $_FILES['image'];
        }else{
            header("location: /403-forbidden");
        }

        // Small Title Validation Start
        if($small_title == ''){
            $errors['small_title'] = "Please Enter Your <strong>Small Title</strong>.";
        }elseif(strlen($small_title) > 50){
            $errors['small_title'] = "Small Title Contains <strong>Maximum 50 Characters</strong>.";
        }
        // Small Title Validation End

        // Big Title Validation Start
        if($big_title == ''){
            $errors['big_title'] = "Please Enter Your <strong>Big Title</strong>.";
        }elseif(strlen($big_title) > 100){
            $errors['big_title'] = "Big Title Contains <strong>Maximum 100 Characters</strong>.";
        }
        // Big Title Validation End

        // About Text Validation Start
        if(isset($about_text)){
            if($about_text == ''){
                $errors['about_text'] = "Please Enter Your <strong>About Text</strong>.";
            }elseif(strlen($about_text) > 1000){
                $errors['about_text'] = "Description Contains <strong>Maximum 1000 Characters</strong>.";
            }
        }elseif(isset($text)){
            if($text == ''){
                $errors['desc'] = "Please Enter Your <strong>Header Description Text</strong>.";
            }elseif(strlen($text) > 1000){
                $errors['desc'] = "Description Contains <strong>Maximum 1000 Characters</strong>.";
            }
        }
        // About Text Validation End

        $image_name = basename($image_file['name']);
        $image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
        $image_size_MB = ($image_file['size'] / 1024) / 1024;
        $max_image_size_MB = 10;
        $image_tmp_name = $image_file['tmp_name'];
        $available_image_extension = ['jpeg','png','jpg','svg'];

        if($nishana == "edit"){
            if(empty($image_name)){
                if(count($errors) == 0){
                    // Update Query Without Image
                    $update_info_without_image = mysqli_query($db_connect,"UPDATE abouts SET small_title='$small_title',big_title='$big_title',about_text='$about_text',created_at='$date_time' WHERE id=$edit_id");
                    if($update_info_without_image){
                        $_SESSION['success'] = "Update Success!";
                        header("location: /about-info");
                    }else{
                        $old_values['small_title'] = $small_title;
                        $old_values['big_title'] = $big_title;
                        $old_values['about_text'] = $about_text;
                        $_SESSION['old_values'] = $old_values;
                        $_SESSION['faild'] = "Something Worng! Please Try Again.";
                        header("location: /about-edit/$recv_encoded_user_id");
                    }
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['about_text'] = $about_text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /about-edit/$recv_encoded_user_id");
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
                    $past_image_name = $about_info_array['image'];
                    $new_image_name = "about_image_" . $edit_id . "." . $image_type;
                    // Update Query With Image
                    $update_info_with_image = mysqli_query($db_connect,"UPDATE abouts SET small_title='$small_title',big_title='$big_title',about_text='$about_text', image='$new_image_name',created_at='$date_time' WHERE id=$edit_id");
                    if($update_info_with_image){
                        unlink("../img/about_images/$past_image_name");
                        $_SESSION['success'] = "Update Success!";
                        move_uploaded_file($image_tmp_name,"../img/about_images/$new_image_name");
                        header("location: /about-info");
                    }else{
                        $old_values['small_title'] = $small_title;
                        $old_values['big_title'] = $big_title;
                        $old_values['about_text'] = $about_text;
                        $_SESSION['old_values'] = $old_values;
                        $_SESSION['faild'] = "Something Worng! Please Try Again.";
                        header("location: /about-edit/$recv_encoded_user_id");
                    }
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['about_text'] = $about_text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /about-edit/$recv_encoded_user_id");
                }
            }
        }elseif($nishana == "add"){
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
            
                $about_insert_query_result = mysqli_query($db_connect,"INSERT INTO abouts(created_at) VALUES ('$date_time')");
    
                $inserted_id = mysqli_insert_id($db_connect);
                $image_file_name = "about_image_" . $inserted_id . "." . $image_type;
    
                $update_with_image_name = mysqli_query($db_connect,"UPDATE abouts SET small_title='$small_title',big_title='$big_title',about_text='$about_text',image='$image_file_name',created_at='$date_time' WHERE id=$inserted_id");
    
                if(!$about_insert_query_result || !$update_with_image_name){
                    $_SESSION['faild'] = "Something Wrong! Please Try Again.";
                    header("location: /about-add");
                }
                if($about_insert_query_result && $update_with_image_name){
                    $_SESSION['success'] = "About Information Added Success.";
                    header("location: /about-info");

                    move_uploaded_file($image_tmp_name, "../img/about_images/$image_file_name");
                }
    
            }else{
                $old_values['small_title'] = $small_title;
                $old_values['big_title'] = $big_title;
                $old_values['about_text'] = $about_text;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /about-add");
            }
        }elseif($nishana == "edit-service-header"){

            if(count($errors) == 0){
                // Update Service Header Information
                $update_service_header_info= mysqli_query($db_connect,"UPDATE service_header SET small_title='$small_title',big_title='$big_title',text='$text',created_at='$date_time' WHERE id=$edit_id");
                if($update_service_header_info){
                    $_SESSION['success'] = "Update Success!";
                    header("location: /service-info");
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['desc'] = $text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /service-header-edit/$recv_encoded_user_id");
                }
            }else{
                $old_values['small_title'] = $small_title;
                $old_values['big_title'] = $big_title;
                $old_values['desc'] = $text;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /service-header-edit/$recv_encoded_user_id");
            }
    
        }elseif($nishana == "edit-portfolio-header"){
            if(count($errors) == 0){
                // Update Service Header Information
                $update_portfolio_header_info= mysqli_query($db_connect,"UPDATE portfolio_header SET small_title='$small_title',big_title='$big_title',text='$text',created_at='$date_time' WHERE id=$edit_id");
                if($update_portfolio_header_info){
                    $_SESSION['success'] = "Update Success!";
                    header("location: /portfolio-info");
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['desc'] = $text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /portfolio-header-edit/$recv_encoded_user_id");
                }
            }else{
                $old_values['small_title'] = $small_title;
                $old_values['big_title'] = $big_title;
                $old_values['desc'] = $text;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /portfolio-header-edit/$recv_encoded_user_id");
            }
        }elseif($nishana == "edit-company"){
            if(empty($image_name)){
                if(count($errors) == 0){
                    // Update Query Without Image
                    $update_info_without_image = mysqli_query($db_connect,"UPDATE company_header SET small_title='$small_title',big_title='$big_title',description='$text',created_at='$date_time' WHERE id=$edit_id");
                    if($update_info_without_image){
                        $_SESSION['success'] = "Update Success!";
                        header("location: /company-info");
                    }else{
                        $old_values['small_title'] = $small_title;
                        $old_values['big_title'] = $big_title;
                        $old_values['desc'] = $text;
                        $_SESSION['old_values'] = $old_values;
                        $_SESSION['faild'] = "Something Worng! Please Try Again.";
                        header("location: /company-edit/$recv_encoded_user_id");
                    }
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['desc'] = $text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /company-edit/$recv_encoded_user_id");
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
                    $past_image_name = $company_header_info_array['image'];
                    $new_image_name = "company_image_" . $edit_id . "." . $image_type;
                    // Update Query With Image
                    $update_info_with_image = mysqli_query($db_connect,"UPDATE company_header SET small_title='$small_title',big_title='$big_title',description='$text', image='$new_image_name',created_at='$date_time' WHERE id=$edit_id");
                    if($update_info_with_image){
                        unlink("../img/company_images/$past_image_name");
                        $_SESSION['success'] = "Update Success!";
                        move_uploaded_file($image_tmp_name,"../img/company_images/$new_image_name");
                        header("location: /company-info");
                    }else{
                        $old_values['small_title'] = $small_title;
                        $old_values['big_title'] = $big_title;
                        $old_values['desc'] = $text;
                        $_SESSION['old_values'] = $old_values;
                        $_SESSION['faild'] = "Something Worng! Please Try Again.";
                        header("location: /company-edit/$recv_encoded_user_id");
                    }
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['desc'] = $text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /company-edit/$recv_encoded_user_id");
                }
            }
        }elseif($nishana == "edit-subscriber-header"){
            if(count($errors) == 0){
                // Update Service Header Information
                $update_subscriber_header_info= mysqli_query($db_connect,"UPDATE subscriber_header SET small_title='$small_title',big_title='$big_title',description='$text' WHERE id=$edit_id");
                if($update_subscriber_header_info){
                    $_SESSION['success'] = "Update Success!";
                    header("location: /subscribers");
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['desc'] = $text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /subscriber-header-edit/$recv_encoded_user_id");
                }
            }else{
                $old_values['small_title'] = $small_title;
                $old_values['big_title'] = $big_title;
                $old_values['desc'] = $text;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /subscriber-header-edit/$recv_encoded_user_id");
            }
        }elseif($nishana == "edit-package-header"){
            if(count($errors) == 0){
                // Update Service Header Information
                $update_package_header_info= mysqli_query($db_connect,"UPDATE package_header SET small_title='$small_title',big_title='$big_title',description='$text' WHERE id=$edit_id");
                if($update_package_header_info){
                    $_SESSION['success'] = "Update Success!";
                    header("location: /packages-info");
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['desc'] = $text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /packages-header-edit/$recv_encoded_user_id");
                }
            }else{
                $old_values['small_title'] = $small_title;
                $old_values['big_title'] = $big_title;
                $old_values['desc'] = $text;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /packages-header-edit/$recv_encoded_user_id");
            }
        }elseif($nishana == "edit-consultant-header"){
            if(count($errors) == 0){
                // Update Service Header Information
                $update_consultant_header_info= mysqli_query($db_connect,"UPDATE consultant_header SET small_title='$small_title',big_title='$big_title',description='$text' WHERE id=$edit_id");
                if($update_consultant_header_info){
                    $_SESSION['success'] = "Update Success!";
                    header("location: /consultant-header");
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['desc'] = $text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /edit-consultant-header/$recv_encoded_user_id");
                }
            }else{
                $old_values['small_title'] = $small_title;
                $old_values['big_title'] = $big_title;
                $old_values['desc'] = $text;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /edit-consultant-header/$recv_encoded_user_id");
            }
        }elseif($nishana == "edit-testimonial-header"){
            if(count($errors) == 0){
                // Update Testimonial Header Information
                $update_testimonial_header_info= mysqli_query($db_connect,"UPDATE testimonial_header SET small_title='$small_title',big_title='$big_title' WHERE id=$edit_id");
                if($update_testimonial_header_info){
                    $_SESSION['success'] = "Update Success!";
                    header("location: /testimonial-info");
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /edit-testimonial-header/$recv_encoded_user_id");
                }
            }else{
                $old_values['small_title'] = $small_title;
                $old_values['big_title'] = $big_title;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /edit-testimonial-header/$recv_encoded_user_id");
            }
        }elseif($nishana == "edit-blog-header"){
            if(count($errors) == 0){
                // Update Testimonial Header Information
                $update_blog_header_info= mysqli_query($db_connect,"UPDATE blog_header SET small_title='$small_title',big_title='$big_title',description='$text' WHERE id=$edit_id");
                if($update_blog_header_info){
                    $_SESSION['success'] = "Update Success!";
                    header("location: /blog-info");
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['desc'] = $text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /blog-header-edit/$recv_encoded_user_id");
                }
            }else{
                $old_values['small_title'] = $small_title;
                $old_values['big_title'] = $big_title;
                $_SESSION['old_values'] = $old_values;
                $old_values['desc'] = $text;
                $_SESSION['errors'] = $errors;
                header("location: /blog-header-edit/$recv_encoded_user_id");
            }
        }elseif($nishana == "edit-contact-header"){
            if(count($errors) == 0){
                // Update Contact US Header Information
                $update_contact_header_info= mysqli_query($db_connect,"UPDATE contact_header SET small_title='$small_title',big_title='$big_title',description='$text' WHERE id=$edit_id");
                if($update_contact_header_info){
                    $_SESSION['success'] = "Update Success!";
                    header("location: /contact-us");
                }else{
                    $old_values['small_title'] = $small_title;
                    $old_values['big_title'] = $big_title;
                    $old_values['desc'] = $text;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['faild'] = "Something Worng! Please Try Again.";
                    header("location: /contact-header-edit/$recv_encoded_user_id");
                }
            }else{
                $old_values['small_title'] = $small_title;
                $old_values['big_title'] = $big_title;
                $old_values['desc'] = $text;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /contact-header-edit/$recv_encoded_user_id");
            }
        }else{
            header("location: /403-forbidden");
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