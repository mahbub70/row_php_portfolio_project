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


    ################# Social Link Delete Query START #########################
    $social_link_delete_result = mysqli_query($db_connect,"DELETE FROM social_links WHERE id=$id");
    if($social_link_delete_result){
        $_SESSION['contact_info_delete_success'] = "Delete Successfull";
        header("location: /contact-info");
    }else{
        $_SESSION['delete_faild'] = "Something Wrong!";
        header("location: /contact-info");
    }
    ################# User Delete Query END #########################

?>