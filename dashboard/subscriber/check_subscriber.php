<?php 
    // Inclide Database File
    require '../includes/db.php';


    $email = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['email']));


    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;


    // EMAIL INSERT QUERY START
    $insert_email = mysqli_query($db_connect,"INSERT INTO subscribers(email, created_at) VALUES ('$email','$date_time')");
    if($insert_email){
        echo "success";
    }else{
        echo "faild";
    }
    // EMAIL INSERT QUERY END

    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>