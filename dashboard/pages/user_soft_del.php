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


    ################# User Status Change Query START #########################
    $status_update_result = mysqli_query($db_connect,"UPDATE users SET status=0 WHERE id=$id");
    if($status_update_result){
        $_SESSION['soft_del_success'] = "Soft Delete Success";
        if($_GET['page'] == "user"){
            header("location: /users-info");
        }elseif($_GET['page'] == "management"){
            header("location: /management");
        }else{
            header("location: /404-not-found");
        }
        
    }else{
        $_SESSION['soft_del_faild'] = "Something Wrong!";
        if($_GET['page'] == "user"){
            header("location: /users-info");
        }elseif($_GET['page'] == "management"){
            header("location: /management");
        }else{
            header("location: /404-not-found");
        }
    }
    ################# User Status Change Query END #########################

?>