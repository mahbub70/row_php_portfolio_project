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

    // Blog Image Path

    // Get Blog Image For unlink from folder
    $blog_info_result = mysqli_query($db_connect,"SELECT * FROM blogs WHERE id=$id");
    if(!$blog_info_result){
        header("location: /403-forbidden");
    }
    $blog_info_array = mysqli_fetch_assoc($blog_info_result);

    // Get Blog Image name
    $blog_image_name = $blog_info_array['image'];

    // Delete Blog Comment
    $blog_comment_del_result = mysqli_query($db_connect,"DELETE FROM blog_comments WHERE blog_id=($id)");
    if($blog_comment_del_result){
        ################# Blog Delete Query START #########################
        $blog_delete_result = mysqli_query($db_connect,"DELETE FROM blogs WHERE id=$id");
        if($blog_delete_result){
            if($blog_image_name != ""){
                unlink("../img/blog_images/$blog_image_name");
            }
            $_SESSION['success'] = "Delete Successfull";
            if($page == "view-blogs"){
                header("location: /view-blogs");
            }elseif($page == "my-blogs"){
                header("location: /my-blogs");
            }elseif($page == "user-blog"){
                header("location: /user-blog");
            }
        }else{
            $_SESSION['faild'] = "Something Wrong!";
            if($page == "view-blogs"){
                header("location: /view-blogs");
            }elseif($page == "my-blogs"){
                header("location: /my-blogs");
            }elseif($page == "user-blog"){
                header("location: /user-blog");
            }
        }
        ################# Blog Delete Query END #########################
    }else{
        header("location: /403-forbidden");
    }


?>