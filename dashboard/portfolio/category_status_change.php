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


    ################# Status Check Query START #########################
    $status_check_query_result = mysqli_query($db_connect,"SELECT status FROM portfolio_categores WHERE id=$id");
    if(!$status_check_query_result){
        $_SESSION['faild'] = "Something Worng!";
        header("location: /portfolio-info");
    }
    ################# Status Check Query END #########################
    $status_array = mysqli_fetch_assoc($status_check_query_result);


    ########### COUNT ACTIVE ROWS START #################
    $count_qurey_result = mysqli_query($db_connect, "SELECT * FROM portfolio_categores WHERE status=1");
    ########### COUNT ACTIVE ROWS END #################

    if($status_array['status']==0){
        
        if(mysqli_num_rows($count_qurey_result) < 5){
            $status_update_result = mysqli_query($db_connect,"UPDATE portfolio_categores SET status=1 WHERE id=$id");
            if($status_update_result){
                $_SESSION['success'] = "Active Success";
                header("location: /portfolio-info");
            }else{
                $_SESSION['faild'] = "Something Wrong!";
                header("location: /portfolio-info");
            }
        }else{
            $_SESSION['limit_err'] = "You Can Active Maximum 5 Category.";
            header("location: /portfolio-info");
        }
    }else{
        $status_update_result = mysqli_query($db_connect,"UPDATE portfolio_categores SET status=0 WHERE id=$id");

        if($status_update_result){
            $_SESSION['success'] = "Deactive Success";
            header("location: /portfolio-info");
        }else{
            $_SESSION['faild'] = "Something Wrong!";
            header("location: /portfolio-info");
        }
    }



?>