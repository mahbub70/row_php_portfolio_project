<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.themenate.net/enlink-bs/dist/sign-up-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Dec 2021 13:31:51 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signup - Probizz</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/dashboard/assets/images/logo/logo.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="/dashboard/assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid">
            <div class="d-flex full-height p-v-20 flex-column justify-content-between">
                <div class="d-none d-md-flex p-h-40">
                    <img src="/dashboard/assets/images/logo/logo.png" alt="Logo" style="max-width:50px;margin-top:10px">
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 d-none d-md-block">
                            <img class="img-fluid" src="/dashboard/assets/images/others/sign-up-2.png" alt="">
                        </div>
                        <div class="m-l-auto col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="m-t-20">Sign In</h2>
                                    <p class="m-b-30">Enter your credential to get access</p>
                                    <form id="singUpForm">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Full Name:</label>
                                            <input type="text" class="form-control" id="fullName" placeholder="Full Name">
                                            <div class="invalid-feedback" id="name_err"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Username:</label>
                                            <input type="text" class="form-control" id="userName" placeholder="Username">
                                            <div class="invalid-feedback" id="user_name_err"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email">
                                            <div class="invalid-feedback" id="email_err"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password">
                                            <div class="invalid-feedback" id="password_err"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                                            <div class="invalid-feedback" id="confirmPass_err"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between p-t-15">
                                                <div class="checkbox">
                                                    <input id="checkbox" type="checkbox">
                                                    <label for="checkbox"><span>I have read the <a href="#">agreement</a></span></label>
                                                    <div class="invalid-feedback" id="checkbox_err"></div>
                                                </div>
                                                <button class="btn btn-primary">Sign In</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    <!-- Sweet Alart CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom JS -->
    <script src="/dashboard/assets/js/script.js"></script>

    

</body>


<!-- Mirrored from www.themenate.net/enlink-bs/dist/sign-up-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Dec 2021 13:31:53 GMT -->
</html>