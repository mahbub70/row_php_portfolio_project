
<?php 

    session_start();
    
?>



<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.themenate.net/enlink-bs/dist/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Dec 2021 13:31:38 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Probizz</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/dashboard/assets/images/logo/logo.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="/dashboard/assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid">
            <div class="d-flex full-height p-v-15 flex-column justify-content-between">
                <div class="d-none d-md-flex p-h-40">
                    <img src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:50px;margin-top:10px">
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <?php 
                                        // Query error message start
                                        if(isset($_SESSION['login_err']['query_err'])){ ?>
                                            <div class="alert alert-danger">
                                                <div class="d-flex justify-content-start">
                                                    <span class="alert-icon m-r-20 font-size-30">
                                                        <i class="anticon anticon-exclamation-circle"></i>
                                                    </span>
                                                    <div>
                                                        <h5 class="alert-heading">Error</h5>
                                                        <p><?=($_SESSION['login_err']['query_err'])?></p>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php    
                                        }
                                        if(isset($_SESSION['login_err']['pending_user'])){
                                    ?> 
                                        <div class="alert alert-danger">
                                            <div class="d-flex justify-content-start">
                                                <span class="alert-icon m-r-20 font-size-30">
                                                    <i class="anticon anticon-exclamation-circle"></i>
                                                </span>
                                                <div>
                                                    <h5 class="alert-heading">Error</h5>
                                                    <p><?=($_SESSION['login_err']['pending_user'])?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php        
                                        }
                                        // Query error message end
                                    ?>
                                    <h2 class="m-t-20">Sign In</h2>
                                    <p class="m-b-30">Enter your credential to get access</p>
                                    <form method="POST" id="login_form" action="/user-varify">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Username:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="loginUserName" placeholder="Username" name="login_username" value="<?=(isset($_SESSION['old_values']['username_value']) ? ($_SESSION['old_values']['username_value']): (''))?>">
                                            </div>
                                            
                                            <?php 
                                                // user name error message start
                                                if(isset($_SESSION['login_err']['username_not_match'])){ ?>
                                                        <div class="alert alert-warning">
                                                            <div class="d-flex justify-content-start">
                                                                <span class="alert-icon m-r-20 font-size-30">
                                                                    <i class="anticon anticon-exclamation-circle"></i>
                                                                </span>
                                                                <div>
                                                                    <h5 class="alert-heading">Warning</h5>
                                                                    <p><?=($_SESSION['login_err']['username_not_match'])?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php    
                                                }
                                                // user name error message end
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <a class="float-right font-size-13 text-muted" href="#">Forget Password?</a>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" id="password" placeholder="Password" name="login_password">
                                            </div>
                                            <?php 
                                                // user name error message start
                                                if(isset($_SESSION['login_err']['password_not_match'])){ ?>
                                                        <div class="alert alert-warning">
                                                            <div class="d-flex justify-content-start">
                                                                <span class="alert-icon m-r-20 font-size-30">
                                                                    <i class="anticon anticon-exclamation-circle"></i>
                                                                </span>
                                                                <div>
                                                                    <h5 class="alert-heading">Warning</h5>
                                                                    <p><?=($_SESSION['login_err']['password_not_match'])?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php    
                                                }
                                                // user name error message end
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                    Don't have an account? 
                                                    <a class="small" href="/sign-up"> Signup</a>
                                                </span>
                                                <button type="submit" class="btn btn-primary" name="login_submit">Sign In</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="offset-md-1 col-md-6 d-none d-md-block">
                            <img class="img-fluid" src="/dashboard/assets/images/others/login-2.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex  p-h-40 justify-content-between">
                    <span class="">© <?=(date("Y"))?> Probizz</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="#">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="#">Privacy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Core Vendors JS -->
    <script src="/dashboard/assets/js/vendors.min.js"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="/dashboard/assets/js/app.min.js"></script>


    <script>
        // ------------------------------------- LOGIN PAGE JAVASCRIPT START ----------------------------------------------

        var loginUserName = document.getElementById("loginUserName");
        loginUserName.addEventListener("keyup",function(){
            return loginUsernameCheck(loginUserName,"Please Enter Your User Name","User Name is Not Vlaid. Alow Only Characters & Number","User Name Cotains Maximum 20 Characters.","");

            // console.log("working");
        });
        loginUserName.addEventListener("paste",function(){
            return loginUsernameCheck(loginUserName,"Please Enter Your User Name","User Name is Not Vlaid. Alow Only Characters & Number","User Name Cotains Maximum 20 Characters.","");

            // console.log("working");
        });

        // Login User Name Check Function Start #################
        /*// 
            loginUsernameCheck(
                Form Input Field User Name, 
                User Name Empty Message, 
                User Name Non Valid Error Message, 
                User Name Characters Limit Error, 
                Databse User Name Valid Message, 
                Error Output HTML Element
            )
        */
        function loginUsernameCheck(username,emptyErr,validErr,maxUserNameErr,validUsernameDB){
            var userNameValue = username.value;
            if(userNameValue == ''){
                username.classList.add('is-invalid');
            }else if(userNameValue.length > 0){
                var xhr = new XMLHttpRequest();
                xhr.open("POST","/username-check",true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("user_name=" + userNameValue);

                xhr.onload = function(){
                    if(this.status == 200){
                        if(this.responseText == 1){
                            username.classList.remove('is-invalid');
                            username.classList.add('is-valid');
                        }else{
                            if(checkNumChar(userNameValue) != null){
                                username.classList.add('is-invalid');
                            }else if(userNameValue.length > 20){
                                username.classList.add('is-invalid');
                            }
                            else{
                                username.classList.add('is-invalid');
                                // console.log(validUsername);
                            } 
                        }
                    }else if(this.status == 404){
                        location.href = "/404-not-found";
                    }else if(this.status == 403){
                        location.href="/403-forbidden";
                    }
                }
            }

        }
        // Login User Name Check Function End ################# -----------------------------------------------------------

        // Function For Making Username Characters Validation
        function checkNumChar(username){
            let re = /[!@#$%^&*()_ +-]/;
            return username.match(re);
        }

        
        // ------------------------------------- LOGIN PAGE JAVASCRIPT END ----------------------------------------------
    </script>

</body>


<!-- Mirrored from www.themenate.net/enlink-bs/dist/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Dec 2021 13:31:39 GMT -->
</html>


<?php 
    // unset session
    unset($_SESSION['login_err']);
    unset($_SESSION['old_values']);
?>