<?php 
    // print_r($_POST);

    // Database Connection File
    require '../includes/db.php';

    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;

    // Receive Value
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['name']));
        $email = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['email']));
        $subject = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['subject']));
        $message = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['message']));

        // Insert Message to Database
        $insert_message_result = mysqli_query($db_connect,"INSERT INTO messages(name, email, subject, message, created_at) VALUES ('$name','$email','$subject','$message','$date_time')");
        if($insert_message_result){
            echo "success";
        }else{
            echo "faild";
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