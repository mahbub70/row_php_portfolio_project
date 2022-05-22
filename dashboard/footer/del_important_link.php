<?php 

    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Receive Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive Acual ID
    $id = $decript_formula;

    ################# Important Link Delete Query START #########################
    $link_delete_result = mysqli_query($db_connect,"DELETE FROM important_links WHERE id=$id");
    if($link_delete_result){
        $_SESSION['success'] = "Delete Successfull";
        header("location: /footer-info");
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /footer-info");
    }

    ################# Important Link Delete Query END #########################

?>