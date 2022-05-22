<?php 
    session_start();

    // Database File Include
    require '../includes/db.php';

    $uri = $_SERVER['REQUEST_URI'];
    $explode_uri = explode("/",$uri);
    $get_last_uri = end($explode_uri);
    // Receive Page Nishana
    $nishana = $explode_uri[2];

    // Receive User Url Code That encode using base64encode() function
    $recv_encoded_user_id = $get_last_uri;
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive User Acual ID
    $edit_id = $decript_formula;

    ############### Query For Getting Edit Feature Information START #########################
    $feature_info_query_result = mysqli_query($db_connect,"SELECT * FROM features WHERE id=$edit_id");
    if(!$feature_info_query_result){
        $_SESSION['faild'] = "Something Worng! Please Try Again.";
        header("location: /feature-info"); 
    }
    $features_info_array = mysqli_fetch_assoc($feature_info_query_result);
    ############### Query For Getting Edit Feature Information END #########################


    ############### Query For Getting Edit Service Information START #########################
    $service_info_query_result = mysqli_query($db_connect,"SELECT * FROM services WHERE id=$edit_id");
    if(!$service_info_query_result){
        $_SESSION['faild'] = "Something Worng! Please Try Again.";
        header("location: /services-info"); 
    }
    $service_info_array = mysqli_fetch_assoc($service_info_query_result);
    ############### Query For Getting Edit Service Information END #########################

    // Collect Login User ID
    if(isset($_SESSION['login_user_id'])){
        $login_user_id = $_SESSION['login_user_id'];
    }else{
        header("location: /sign-out");
    }
    // LOGIN USER INFROMATION FROM DATABASE
    $login_user_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$login_user_id");
    if(!$login_user_result){
        header("location: /403-forbidden");
    }
    $login_user_array = mysqli_fetch_assoc($login_user_result);


    // Dsignation Role Name
    $manage_designation = [1=>"Super Admin","Admin","Modarator","Editor","Client","User","Pending"];
    // Login User Role Name 
    $blog_creater_role = $manage_designation[$login_user_array['role']];


    // Storing Errors
    $errors = [];
    $old_values = [];

    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;

    // Receive Value From Add banner Page
    if(isset($_POST['feature_submit']) || isset($_POST['service_submit']) || isset($_POST['blog_submit'])){
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
        }elseif(strlen($title) > 30){
            $errors['title'] = "Ttitle Contains <strong>Maximum 30 Characters</strong>.";
        }
        // Title Validation End

        // Description Validation Start
        if($desc == ''){
            $errors['desc'] = "Please Enter Your <strong>Description</strong>.";
        }else{
            if($nishana == "add-blog"){
                if(strlen($desc) > 1000){
                    $errors['desc'] = "Description Contains <strong>Maximum 1000 Characters</strong>.";
                }
            }else{
                if(strlen($desc) > 150){
                    $errors['desc'] = "Description Contains <strong>Maximum 150 Characters</strong>.";
                }
            }
        }
        
        // Description Validation End

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
                    $update_info_without_image = mysqli_query($db_connect,"UPDATE features SET title='$title',description='$desc',created_at='$date_time' WHERE id=$edit_id");
                    if($update_info_without_image){
                        $_SESSION['success'] = "Update Success!";
                        header("location: /feature-info");
                    }else{
                        $old_values['title'] = $title;
                        $old_values['desc'] = $desc;
                        $_SESSION['old_values'] = $old_values;
                        header("location: /feature-edit/$recv_encoded_user_id");
                    }
                }else{
                    $old_values['title'] = $title;
                    $old_values['desc'] = $desc;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /feature-edit/$recv_encoded_user_id");
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
                    $past_image_name = $features_info_array['image'];
                    $new_image_name = "feature_image_" . $edit_id . "." . $image_type;
                    // Update Query With Image
                    $update_info_with_image = mysqli_query($db_connect,"UPDATE features SET title='$title',description='$desc', image='$new_image_name',created_at='$date_time' WHERE id=$edit_id");
                    if($update_info_with_image){
                        unlink("../img/features_img/$past_image_name");
                        $_SESSION['success'] = "Update Success!";
                        move_uploaded_file($image_tmp_name,"../img/features_img/$new_image_name");
                        header("location: /feature-info");
                    }else{
                        $old_values['title'] = $title;
                        $old_values['desc'] = $desc;
                        $_SESSION['old_values'] = $old_values;
                        header("location: /feature-edit/$recv_encoded_user_id");
                    }
                }else{
                    $old_values['title'] = $title;
                    $old_values['desc'] = $desc;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /feature-edit/$recv_encoded_user_id");
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
            
                $feature_insert_query_result = mysqli_query($db_connect,"INSERT INTO features(created_at) VALUES ('$date_time')");
    
                $inserted_id = mysqli_insert_id($db_connect);
                $image_file_name = "feature_image_" . $inserted_id . "." . $image_type;
    
                $update_with_image_name = mysqli_query($db_connect,"UPDATE features SET title='$title',description='$desc',image='$image_file_name',created_at='$date_time' WHERE id=$inserted_id");
    
                if(!$feature_insert_query_result || !$update_with_image_name){
                    $_SESSION['faild'] = "Something Wrong! Please Try Again.";
                    header("location: /feature-add");
                }
                if($feature_insert_query_result && $update_with_image_name){
                    $_SESSION['success'] = "Banner Added Success.";
                    header("location: /feature-info");
    
                    move_uploaded_file($image_tmp_name, "../img/features_img/$image_file_name");
                }
    
            }else{
                $old_values['title'] = $title;
                $old_values['desc'] = $desc;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /feature-add");
            }

        }elseif($nishana == "add-service"){
            ################# Add Service Section Start
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
            
                $service_insert_query_result = mysqli_query($db_connect,"INSERT INTO services(created_at) VALUES ('$date_time')");
    
                $inserted_id = mysqli_insert_id($db_connect);
                $image_file_name = "service_image_" . $inserted_id . "." . $image_type;
    
                $update_with_image_name = mysqli_query($db_connect,"UPDATE services SET title='$title',description='$desc',image='$image_file_name',created_at='$date_time' WHERE id=$inserted_id");
    
                if(!$service_insert_query_result || !$update_with_image_name){
                    $_SESSION['faild'] = "Something Wrong! Please Try Again.";
                    header("location: /service-add");
                }
                if($service_insert_query_result && $update_with_image_name){
                    $_SESSION['success'] = "Service Added Success.";
                    header("location: /service-info");
    
                    move_uploaded_file($image_tmp_name, "../img/service_images/$image_file_name");
                }
    
            }else{
                $old_values['title'] = $title;
                $old_values['desc'] = $desc;
                $_SESSION['old_values'] = $old_values;
                $_SESSION['errors'] = $errors;
                header("location: /service-add");
            }
        }elseif($nishana == "edit-service"){
            if(empty($image_name)){
                if(count($errors) == 0){
                    // Update Query Without Image
                    $update_info_without_image = mysqli_query($db_connect,"UPDATE services SET title='$title',description='$desc',created_at='$date_time' WHERE id=$edit_id");
                    if($update_info_without_image){
                        $_SESSION['success'] = "Update Success!";
                        header("location: /service-info");
                    }else{
                        $old_values['title'] = $title;
                        $old_values['desc'] = $desc;
                        $_SESSION['old_values'] = $old_values;
                        header("location: /service-edit/$recv_encoded_user_id");
                    }
                }else{
                    $old_values['title'] = $title;
                    $old_values['desc'] = $desc;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /service-edit/$recv_encoded_user_id");
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
                    $past_image_name = $service_info_array['image'];
                    $new_image_name = "service_image_" . $edit_id . "." . $image_type;
                    // Update Query With Image
                    $update_info_with_image = mysqli_query($db_connect,"UPDATE services SET title='$title',description='$desc', image='$new_image_name',created_at='$date_time' WHERE id=$edit_id");
                    if($update_info_with_image){
                        unlink("../img/service_images/$past_image_name");
                        $_SESSION['success'] = "Update Success!";
                        move_uploaded_file($image_tmp_name,"../img/service_images/$new_image_name");
                        header("location: /service-info");
                    }else{
                        $old_values['title'] = $title;
                        $old_values['desc'] = $desc;
                        $_SESSION['old_values'] = $old_values;
                        header("location: /service-edit/$recv_encoded_user_id");
                    }
                }else{
                    $old_values['title'] = $title;
                    $old_values['desc'] = $desc;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /service-edit/$recv_encoded_user_id");
                }
            }
        }elseif($nishana == "add-blog"){

            $blog_date = date('M d, Y');

            if(empty($image_name)){
                if(count($errors) == 0){
                    // Insret Query Without Image
                    $insert_info_without_image = mysqli_query($db_connect,"INSERT INTO blogs(created_user_id,title, description,creater_role,created_at) VALUES ('$login_user_id','$title','$desc','$blog_creater_role','$blog_date')");
                    if($insert_info_without_image){
                        $_SESSION['success'] = "Blog Added Success!";
                        header("location: /view-blogs");
                    }else{
                        $old_values['title'] = $title;
                        $old_values['desc'] = $desc;
                        $_SESSION['old_values'] = $old_values;
                        header("location: /add-blog");
                    }
                }else{
                    $old_values['title'] = $title;
                    $old_values['desc'] = $desc;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /add-blog");
                }
            }elseif(!empty($image_name)){
                $blog_date = date('M d, Y');
                ############ Insert WITH IMAGE
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
                    // Insert Fisrt for getting Unice ID
                    $insert_date_time = mysqli_query($db_connect,"INSERT INTO blogs(created_at) VALUES ('$blog_date')");
                    if(!$insert_date_time){
                        header("location: /403-forbidden");
                    }
                    $blog_inserted_id = mysqli_insert_id($db_connect);

                    $new_image_name = "blog_image_" . $blog_inserted_id . "." . $image_type;
                    // Update Query With Image
                    $update_info_with_image = mysqli_query($db_connect,"UPDATE blogs SET created_user_id='$login_user_id', title='$title',description='$desc',image='$new_image_name', creater_role='$blog_creater_role',created_at='$blog_date' WHERE id=$blog_inserted_id");
                    if($update_info_with_image){
                        $_SESSION['success'] = "Blog Added Success!";
                        move_uploaded_file($image_tmp_name,"../img/blog_images/$new_image_name");
                        header("location: /view-blogs");
                    }else{
                        $old_values['title'] = $title;
                        $old_values['desc'] = $desc;
                        $_SESSION['old_values'] = $old_values;
                        header("location: /add-blog");
                    }
                }else{
                    $old_values['title'] = $title;
                    $old_values['desc'] = $desc;
                    $_SESSION['old_values'] = $old_values;
                    $_SESSION['errors'] = $errors;
                    header("location: /add-blog");
                }
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