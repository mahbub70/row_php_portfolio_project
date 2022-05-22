<?php 
    // Database Connection File
    require '../includes/db.php';

    $user_name = $_POST['user_name'];

    // UserName Match Query Start 
    $username_match_query_result = mysqli_query($db_connect,"SELECT * FROM users WHERE user_name = '$user_name' ");

    $row_count = mysqli_num_rows($username_match_query_result);

    echo $row_count;

?>