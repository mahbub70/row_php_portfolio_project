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

    $select_feature_image = mysqli_query($db_connect,"SELECT * FROM features WHERE id=$id");
    $select_feature_array = mysqli_fetch_assoc($select_feature_image);
    $image_name = $select_feature_array['image'];

    

    ################# Feature Delete Query START #########################
    $feature_delete_result = mysqli_query($db_connect,"DELETE FROM features WHERE id=$id");
    if($feature_delete_result){
        unlink("../img/features_img/$image_name");
        $_SESSION['success'] = "Delete Successfull";
        header("location: /feature-info");
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /feature-info");
    }

    ################# Feature Delete Query END #########################

?>