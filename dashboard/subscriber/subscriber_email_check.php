<?php 
    // Database Connection File
    require '../includes/db.php';

    $email = $_POST['email'];

    // UserName Match Query Start 
    $email_match_query_result = mysqli_query($db_connect,"SELECT * FROM subscribers WHERE email = '$email' ");

    $row_count = mysqli_num_rows($email_match_query_result);

    echo $row_count;

?>