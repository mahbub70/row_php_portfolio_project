<?php
    session_start();
    // Databse Connection File
    require '../includes/db.php';

    // Error Messages Store
    $errors=[];


    ################################## Contact Information Section Start ##########################################
    // Contact Information Validation and editing Start
    if(isset($_POST['contact_info_save'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $phone_icon = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['phone_icon']));
            $phone_number = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['phone']));
            $email_icon = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['email_icon']));
            $email = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['email']));
        }

        // Phone icon Section Start
        if($phone_icon == ""){
            $phone_icon = "fas fa-mobile-alt";
        }elseif(strlen($phone_icon) > 100){
            $errors['phone_icon']="Phone Icon Contains Maximum 100 Characters.";
        }
        
        // Phone icon Section End

        // Phone Number Section Start
        if($phone_number == ''){
            $errors['phone']="Please Enter Your Phone Number.";
        }elseif(!is_numeric($phone_number)){
            $errors['phone']="This is not a valid phone number. Please enter valid number.";
        }elseif(strlen($phone_number) > 11){
            $errors['phone']="Phone Number Contains Maximum 11 Numbers.";
        }
        // Phone Number Section End

        // Email icon Section Start
        if($email_icon == ""){
            $email_icon = "far fa-envelope";
        }elseif(strlen($email_icon) > 100){
            $errors['email_icon']="Email Icon Contains Maximum 100 Characters. Please enter only icon class.";
        }
        
        // Email icon Section End

        // Email Section Start

        // RegEx Email Validation with preg_match function
        $regex_email_validation_code = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        $valid_email = preg_match($regex_email_validation_code,$email);
         // Email Validation Start
            if($email == ''){
                $errors['email']='Please enter your <strong>Email.</strong>';
            }elseif(!$valid_email){
                $errors['email']='Email address is <strong>not valid.</strong> Please enter a valid email.';
            }
        // Email Section End

        if(count($errors) == 0){
            // Make Date And Time
            date_default_timezone_set('asia/dhaka');
            $time = date('h:i:s A');
            $date = date('d-m-Y');
            $date_time = $time . ',' . $date;
            // Insert Query Start
            $insert_contact_info = "INSERT INTO top_header(contact_icon,contact_number,email_icon,contact_email,created_at) VALUES ('$phone_icon','$phone_number','$email_icon','$email','$date_time')";
            $insert_result = mysqli_query($db_connect,$insert_contact_info);
            // Insert Query End

            if($insert_result){
                $_SESSION['insert_success'] = "Information Insert Success";
                header('location: /add-contact-info');
            }else{
                $_SESSION['insert_faild'] = "Data Insert Faild!";
                header('location: /add-contact-info');
            }
        }else{
            $_SESSION['errors'] = $errors;
            header('location: /add-contact-info');
        }

    }
    // Contact Information Validation and editing End-------------------------------------------------------------------------------------


    ################################## Social Links Section Start ##########################################

    // Social Links Validation and editing Start
    if(isset($_POST['social_link_save'])){
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
            $errors['site_name']="Please Select Social Site.";
        }
        // Site Name End

        // Site Link Section Start
        if($site_link == ''){
            $errors['site_link']="Please Enter Social Site Link.";
        }elseif(!$valid_link){
            $errors['site_link']="This is not a valid Link. Please enter valid Link.";
        }
        // Site Link Section End

        // Site icon Section Start
        if(strlen($site_icon) > 100){
            $errors['site_icon']="Social Icon Contains Maximum 100 Characters. Please enter only icon class.";
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
        


        if(count($errors) == 0){
            // Make Date And Time
            date_default_timezone_set('asia/dhaka');
            $time = date('h:i:s A');
            $date = date('d-m-Y');
            $date_time = $time . ',' . $date;
            // Insert Query Start
            $insert_social_site = "INSERT INTO social_links(site_name, site_icon, site_link, created_at) VALUES ('$site_name','$site_icon','$site_link','$date_time')";
            $insert_result = mysqli_query($db_connect,$insert_social_site);
            // Insert Query End

            if($insert_result){
                $_SESSION['insert_success'] = "Information Insert Success";
                header('location: /add-contact-info');
            }else{
                $_SESSION['insert_faild'] = "Data Insert Faild!";
                header('location: /add-contact-info');
            }
        }else{
            $_SESSION['site_errors'] = $errors;
            header('location: /add-contact-info');
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