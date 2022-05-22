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

    // Receive Category Name for Delete This Category Item
    $category_name_result = mysqli_query($db_connect, "SELECT category_name FROM portfolio_categores WHERE id=$id");
    if(!$category_name_result){
        $_SESSION['faild'] = "Something Wrong!";
        header("location: /portfolio-info");
    }
    $category_name_array = mysqli_fetch_assoc($category_name_result);
    $category_name = strtolower(preg_replace('/ /i','-',$category_name_array['category_name']));

    // Select This Category Item From portfolios Table On Database
    $select_portfolio_result = mysqli_query($db_connect,"SELECT * FROM portfolios WHERE category='$category_name'");
    if(!$select_portfolio_result){
        $faild = "";
        $_SESSION['faild'] = "Something Wrong! query";
        header("location: /portfolio-info");
    }

    if(mysqli_num_rows($select_portfolio_result) != 0){
        
        foreach($select_portfolio_result as $single_portfolio_array){
            $get_id = $single_portfolio_array['id'];
            $portfolio_image = $single_portfolio_array['portfolio_image'];
            echo $get_id;
            // DELETE QUERY
            $delete_portfolio_result = mysqli_query($db_connect,"DELETE FROM portfolios WHERE id=$get_id ");

            if($delete_portfolio_result){
                $_SESSION['success'] = "Delete Successfull";
                unlink("../img/portfolio_images/$portfolio_image");
            }else{
                $faild = "";
                $_SESSION['faild'] = "Something Wrong! loop";
                header("location: /portfolio-info");
                
            }

        }
        
    }

    if(!isset($faild)){
        ################# Category Delete Query START #########################
        $category_delete_result = mysqli_query($db_connect,"DELETE FROM portfolio_categores WHERE id=$id");
        if($category_delete_result){
            $_SESSION['success'] = "Delete Successfull";
            header("location: /portfolio-info");
        }else{
            $_SESSION['faild'] = "Something Wrong! category";
            header("location: /portfolio-info");
        }
        ################# Category Delete Query END #########################
    }

?>