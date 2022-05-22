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

    $select_service_image = mysqli_query($db_connect,"SELECT * FROM services WHERE id=$id");
    $select_service_array = mysqli_fetch_assoc($select_service_image);
    $image_name = $select_service_array['image'];

    

    ################# Service Delete Query START #########################
    $service_delete_result = mysqli_query($db_connect,"DELETE FROM services WHERE id=$id");
    if($service_delete_result){
        unlink("../img/service_images/$image_name");
        $_SESSION['success'] = "Delete Successfull";
        header("location: /service-info");
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /service-info");
    }

    ################# Service Delete Query END #########################

?>