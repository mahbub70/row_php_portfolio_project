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


    ################# User Delete Query START #########################
    $status_check_query_result = mysqli_query($db_connect,"SELECT status FROM banner_buttons WHERE id=$id");
    if(!$status_check_query_result){
        $_SESSION['faild'] = "Something Worng!";
        header("location: /logo-info");
    }
    $status_array = mysqli_fetch_assoc($status_check_query_result);
    ################# User Delete Query END #########################
    


    ##################### Count Status 1 Available Rows START ###############################
    $count_query_result = mysqli_query($db_connect,"SELECT * FROM banner_buttons WHERE status=1");
    if(!$count_query_result){
        $_SESSION['faild'] = "Something Worng!";
        header("location: /banner-info");
    }
    $count_active_status_rows = mysqli_num_rows($count_query_result);
    ##################### Count Status 1 Available Rows END ##################################

    if($status_array['status']==0){
        if($count_active_status_rows < 4){
            $status_update_result = mysqli_query($db_connect,"UPDATE banner_buttons SET status=1 WHERE id=$id");
            if($status_update_result){
                $_SESSION['success'] = "Active Success";
                header("location: /banner-info");
            }else{
                $_SESSION['faild'] = "Something Wrong!";
                header("location: /banner-info");
            }
        }else{
            $_SESSION['limit_err'] = "You Can Active Maximum 4 Buttons.";
            header("location: /banner-info");
        }
        
    }else{
        $status_update_result = mysqli_query($db_connect,"UPDATE banner_buttons SET status=0 WHERE id=$id");

        if($status_update_result){
            $_SESSION['success'] = "Deactive Success";
            header("location: /banner-info");
        }else{
            $_SESSION['faild'] = "Something Wrong!";
            header("location: /banner-info");
        }
    }



?>