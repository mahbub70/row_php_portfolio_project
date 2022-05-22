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

    $select_about_image = mysqli_query($db_connect,"SELECT * FROM abouts WHERE id=$id");
    $select_about_array = mysqli_fetch_assoc($select_about_image);
    $image_name = $select_about_array['image'];

    

    ################# About Delete Query START #########################
    $about_delete_result = mysqli_query($db_connect,"DELETE FROM abouts WHERE id=$id");
    if($about_delete_result){
        unlink("../img/about_images/$image_name");
        $_SESSION['success'] = "Delete Successfull";
        header("location: /about-info");
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /about-info");
    }

    ################# About Delete Query END #########################

?>