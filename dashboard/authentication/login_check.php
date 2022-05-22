<?php 
    
    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Receive Login Form Value
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    // Error Message Store
    $login_err = [];
    $old_values = [];


    // UserName Match Query
    $username_match_result = mysqli_query($db_connect,"SELECT * FROM users WHERE user_name='$username'");
    $user_info_array = mysqli_fetch_assoc($username_match_result);
    $username_match_row = mysqli_num_rows($username_match_result);

    // Check Username Query is COmplete or Not
    if($username_match_result != true){
        $login_err['query_err'] = "Something Worng! Please Try Again.";
    }

    // Condition For Chacking UserName Match or Not
    if($username_match_row == 1){
        // Query For geting this matched username hash password
        $user_db_password = $user_info_array['password'];
        if(password_verify($password,$user_db_password)){
            // IF USERNAME & PASSWORD MATCHED
            if($user_info_array['role'] >= 7){
                $login_err['pending_user'] = "Your Account Status is Pending. Please Contact With Admin.";
            }elseif($user_info_array['role'] <= 6){
                $_SESSION['login_user_id'] = $user_info_array['id'];
                $_SESSION['login_success'] = "";
                $_SESSION['login_sweet_alart'] = "";
                header("location: /admin-dashboard");
            }else{
                header("location: /403-forbidden");
            }
            
        }else{
            $login_err['password_not_match'] = "Password Not Match.";
            $old_values['username_value'] = $username;
        }  
    }else{
        $login_err['username_not_match'] = "Username Not Match.";
        $old_values['username_value'] = $username;
    }

    // Have Any Error 
    if(count($login_err) > 0){
        $_SESSION['login_err'] = $login_err;
        $_SESSION['old_values'] = $old_values;
        // Redirecting Login Page
        header("location: /login");
    }
?>