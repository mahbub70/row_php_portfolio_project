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


    ################# Facility Delete Query START #########################
    $subscriber_delete_result = mysqli_query($db_connect,"DELETE FROM subscribers WHERE id=$id");
    if($subscriber_delete_result){
        $_SESSION['success'] = "Delete Successfull";
        header("location: /subscribers");
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /subscribers");
    }
    ################# Facility Delete Query END #########################

?>