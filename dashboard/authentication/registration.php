<?php
    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Define Empty Variable
    $name = $user_name = $email = $password = "";

    // If Data Comes With Post Method
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $name = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['name']));
        $user_name = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['username']));
        $email = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['email']));
        $password = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['password']));
    }else{
        header("location: /login");
    }

    // Making Hash Password to Upload Database
    $hash_password = password_hash($password,PASSWORD_DEFAULT);

    // Make Time 
    date_default_timezone_set("asia/dhaka");
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;


    $user_insert_query = "INSERT INTO users(full_name, user_name, email, password, created_at) VALUES ('$name','$user_name','$email','$hash_password','$date_time')";
    $user_insert_result = mysqli_query($db_connect,$user_insert_query);

    if($user_insert_result){
        echo "success";
    }else{
        echo "error";
    }

    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>


<!-- <?php 
    if($data_array['pdatet'] != "") {
        $date_time = $data_array['pdatet'];
        $explode_date_time = explode(' - ', $date_time);
        $pickupTime = date('Y-m-d\TH:i:s', strtotime($explode_date_time[0]));
        $deliveryTime = date('Y-m-d\TH:i:s', strtotime($explode_date_time[1]));
    }
?> -->