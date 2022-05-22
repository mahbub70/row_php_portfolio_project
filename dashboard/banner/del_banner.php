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

    $select_banner_image = mysqli_query($db_connect,"SELECT * FROM banners WHERE id=$id");
    $select_banner_array = mysqli_fetch_assoc($select_banner_image);
    $image_name = $select_banner_array['image'];

    ################# Banner Delete Query START #########################
    $banner_delete_result = mysqli_query($db_connect,"DELETE FROM banners WHERE id=$id");
    if($banner_delete_result){
        unlink("../img/banners/$image_name");
        $_SESSION['success'] = "Delete Successfull";
        header("location: /banner-info");
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /banner-info");
    }

    ################# Banner Delete Query END #########################

?>