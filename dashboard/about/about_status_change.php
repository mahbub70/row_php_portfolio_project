<?php 

    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Receive Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive User Acual ID
    $id = $decript_formula;


    ################# Status Check Query START #########################
    $status_check_query_result = mysqli_query($db_connect,"SELECT status FROM abouts WHERE id=$id");
    if(!$status_check_query_result){
        $_SESSION['faild'] = "Something Worng!";
        header("location: /about-info");
    }
    ################# Status Check Query END #########################
    $status_array = mysqli_fetch_assoc($status_check_query_result);


    ########### COUNT ACTIVE ROWS START #################
    $count_qurey_result = mysqli_query($db_connect, "SELECT * FROM abouts WHERE status=1");
    ########### COUNT ACTIVE ROWS END #################

    if($status_array['status']==0){
        $deactive_all_query_result = mysqli_query($db_connect,"UPDATE abouts SET status=0");

        $status_update_result = mysqli_query($db_connect,"UPDATE abouts SET status=1 WHERE id=$id");
        if($deactive_all_query_result&&$status_update_result){
            $_SESSION['success'] = "Active Success";
            header("location: /about-info");
        }else{
            $_SESSION['faild'] = "Something Wrong!";
            header("location: /about-info");
        }
    }else{
        $status_update_result = mysqli_query($db_connect,"UPDATE abouts SET status=0 WHERE id=$id");

        if($status_update_result){
            $_SESSION['success'] = "Deactive Success";
            header("location: /about-info");
        }else{
            $_SESSION['faild'] = "Something Wrong!";
            header("location: /about-info");
        }
    }



?>