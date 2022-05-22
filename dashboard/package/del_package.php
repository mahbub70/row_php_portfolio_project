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

    // Delete Package Services
    $delete_package_services = mysqli_query($db_connect,"DELETE FROM package_services WHERE package_id=($id)");

    if($delete_package_services){
        $package_delete_result = mysqli_query($db_connect,"DELETE FROM packages WHERE id=$id");
        if($package_delete_result){
            $_SESSION['success'] = "Package Deleted Successfully";
            header("location: /packages-info");
        }else{
            $_SESSION['faild'] = "Something Wrong!";
            header("location: /packages-info");
        }
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /packages-info");
    }

?>