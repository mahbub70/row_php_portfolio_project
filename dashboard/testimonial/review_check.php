<?php

    // Include Database Connection File 
    require "../includes/db.php";

    $client_id = mysqli_real_escape_string($db_connect, input_sanitizer($_POST['client_id']));
    $rating = mysqli_real_escape_string($db_connect, input_sanitizer($_POST['rating']));
    $review = mysqli_real_escape_string($db_connect, input_sanitizer($_POST['review']));

    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;


    // Insert Review To Database
    $insert_review = mysqli_query($db_connect,"INSERT INTO reviews(client_id, rating, review, created_at) VALUES ('$client_id','$rating','$review','$date_time')");

    if($insert_review){
        echo 1;
    }else{
        echo 0;
    }



    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>










