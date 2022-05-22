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

    // Delete With Social Links
    $social_link_delete_result = mysqli_query($db_connect,"DELETE FROM user_social_links WHERE user_id=($id)");

    if($social_link_delete_result){
        ################# User Delete Query START #########################
        $user_delete_result = mysqli_query($db_connect,"DELETE FROM users WHERE id=$id");
        if($user_delete_result){
            $_SESSION['delete_success'] = "Permanent Delete Success";
            header("location: /trush-users");
        }else{
            $_SESSION['delete_faild'] = "Something Wrong!";
            header("location: /trush-users");
        }
        ################# User Delete Query END #########################
    }else{
        header("location: /403-forbidden");
    }


    

?>