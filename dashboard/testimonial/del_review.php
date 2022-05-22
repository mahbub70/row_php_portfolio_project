<?php 

    session_start();

    $page = $_GET['page'];

    // Database Connection File
    require '../includes/db.php';

    // Receive Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive Acual ID
    $id = $decript_formula;

    ################# Review Delete Query START #########################
    $review_delete_result = mysqli_query($db_connect,"DELETE FROM reviews WHERE id=$id");
    if($review_delete_result){
        $_SESSION['success'] = "Delete Successfull";
        if($page == "pending"){
            header("location: /pending-review");
        }elseif($page == "publish"){
            header("location: /all-review");
        }elseif($page == "client-dashboard"){
            header("location: /my-reviews");
        }
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        if($page == "pending"){
            header("location: /pending-review");
        }elseif($page == "publish"){
            header("location: /all-review");
        }elseif($page == "client-dashboard"){
            header("location: /my-reviews");
        }
    }

    ################# Portfolio Delete Query END #########################

?>