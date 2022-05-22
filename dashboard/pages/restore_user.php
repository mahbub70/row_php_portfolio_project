<?php 

    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Receive User Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive User Acual ID
    $id = $decript_formula;


    ################# User Status Change Query START #########################
    $status_update_result = mysqli_query($db_connect,"UPDATE users SET status=1 WHERE id=$id");
    if($status_update_result){
        $_SESSION['restore_success'] = "User Successfully Restored.";
        header("location: /trush-users");
    }else{
        $_SESSION['restore_faild'] = "Something Wrong!";
        header("location: /trush-users");
    }
    ################# User Status Change Query END #########################

?>