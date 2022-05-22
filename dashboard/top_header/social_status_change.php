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
    $social_status_check_query_result = mysqli_query($db_connect,"SELECT status FROM social_links WHERE id=$id");
    if(!$social_status_check_query_result){
        $_SESSION['query_faild'] = "Something Worng!";
        header("location: /contact-info");
    }
    ################# User Delete Query END #########################

    $social_status_array = mysqli_fetch_assoc($social_status_check_query_result);

    ##################### Count Status 1 Available Rows START ###############################
    $count_query_result = mysqli_query($db_connect,"SELECT * FROM social_links WHERE status=1");
    if(!$count_query_result){
        $_SESSION['query_faild'] = "Something Worng!";
        header("location: /contact-info");
    }
    ##################### Count Status 1 Available Rows END ##################################

    $count_active_status_rows = mysqli_num_rows($count_query_result);


    if($social_status_array['status']==0){
        if($count_active_status_rows < 4){
            $social_status_update_result = mysqli_query($db_connect,"UPDATE social_links SET status=1 WHERE id=$id");
            if($social_status_update_result){
                $_SESSION['insert_success'] = "Active Success";
                header("location: /contact-info");
            }else{
                $_SESSION['query_faild'] = "Something Wrong!";
                header("location: /contact-info");
            }
        }else{
            $_SESSION['limit_err'] = "You Can Active Maximum 4 Links.";
            header("location: /contact-info");
        }

    }else{
        $social_status_update_result = mysqli_query($db_connect,"UPDATE social_links SET status=0 WHERE id=$id");

        if($social_status_update_result){
            $_SESSION['insert_success'] = "Deactive Success";
            header("location: /contact-info");
        }
    }

?>