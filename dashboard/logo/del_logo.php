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

    $select_logo_image = mysqli_query($db_connect,"SELECT * FROM logos WHERE id=$id");
    $select_logo_array = mysqli_fetch_assoc($select_logo_image);
    $image_name = $select_logo_array['logo'];

    if($select_logo_array['type'] == "Image"){
        unlink("../img/logos/$image_name");
    }

    ################# User Delete Query START #########################
    $logo_delete_result = mysqli_query($db_connect,"DELETE FROM logos WHERE id=$id");
    if($logo_delete_result){
        $_SESSION['success'] = "Delete Successfull";
        header("location: /logo-info");
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /logo-info");
    }

    ################# User Delete Query END #########################

?>