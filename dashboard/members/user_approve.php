<?php 
    session_start();

    // Include Database connection File
    require "../includes/db.php";

    // Receive User Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive User Acual ID
    $id = $decript_formula;

    // Update Status Make Pending User to Normal User 
    $make_user_result = mysqli_query($db_connect,"UPDATE users SET role=6 WHERE id=$id");

    if($make_user_result){
        $_SESSION['success'] = "Successfully Make User.";
        header("location: /pending-users");
    }else{
        $_SESSION['faild'] = "Faild! Please Try Again.";
        header("location: /pending-users");
    }
?>