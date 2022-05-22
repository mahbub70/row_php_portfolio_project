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

    $select_portfolio_image = mysqli_query($db_connect,"SELECT * FROM portfolios WHERE id=$id");
    $select_portfolio_array = mysqli_fetch_assoc($select_portfolio_image);
    $image_name = $select_portfolio_array['portfolio_image'];

    $category = $select_portfolio_array['category'];

    

    ################# Portfolio Delete Query START #########################
    $portfolio_delete_result = mysqli_query($db_connect,"DELETE FROM portfolios WHERE id=$id");
    if($portfolio_delete_result){
        unlink("../img/portfolio_images/$image_name");
        $_SESSION['success'] = "Delete Successfull";
        header("location: /portfolio-info/$category");
    }else{
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /portfolio-info/all");
    }

    ################# Portfolio Delete Query END #########################

?>