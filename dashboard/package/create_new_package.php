
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;

    // INSET NEW PACKAGE INFORMATION WITH VALIDATON 
    if(isset($_POST['package_submit'])){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $package_name = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['package_name']));
            $package_price = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['package_price']));
        }else{
            header("location: /403-forbidden");
        }

        // Start Validation
        if($package_name == ''){
            $name_err = "Please Enter Package Name.";
        }elseif(strlen($package_name) > 30){
            $name_err = "Package Name Contains Maximum 30 Characters.";
        }

        if($package_price == ''){
            $price_err = "Please Enter Package Minimum Price.";
        }elseif(!is_numeric($package_price)){
            $price_err = "This is Not a Valid Price. Please Enter Valid Price.";
        }else{
            $package_price = "$ " . $package_price;
        }


        if(!isset($name_err) && !isset($price_err)){
            // INSERT NEW PACKAGE DATA
            $insert_result = mysqli_query($db_connect, "INSERT INTO packages(name, price, created_at) VALUES ('$package_name','$package_price','$date_time')");

            if($insert_result){
                $success = "Package Creation Success";
            }else{
                $faild = "Faild! Please Try Again.";
            }
        }


    }
// -------------------------------------------------------------

    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Add New Package</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Create Package</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <?php 
                        if(isset($success)){
                    ?>
                        <div class="alert alert-success">
                            <div class="d-flex align-items-center justify-content-start">
                                <span class="alert-icon">
                                    <i class="anticon anticon-check-o"></i>
                                </span>
                                <span><?=($success)?></span>
                            </div>
                        </div>
                    <?php        
                        }
                        if(isset($faild)){
                    ?>
                        <div class="alert alert-danger">
                            <div class="d-flex align-items-center justify-content-start">
                                <span class="alert-icon">
                                    <i class="anticon anticon-close-o"></i>
                                </span>
                                <span><?=($faild)?></span>
                            </div>
                        </div>
                    <?php        
                        }
                    ?>
            
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Package Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Your Package Name" name="package_name" value="<?=(isset($name_err) || isset($price_err)?($package_name):(''))?>">
                            <?php 
                                if(isset($name_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($name_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                        </div>

                        <div class="input-group mb-3">
                            <div class="w-100"><label for="">Package Price</label></div>
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="package_price" value="<?=(isset($name_err) || isset($price_err)?($package_price):(''))?>">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <?php 
                                if(isset($price_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($price_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>

                        <button type="submit" name="package_submit" class="btn btn-primary">Create Package</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper END -->



<?php 
    // Includes Footer File
    require '../includes/footer.php';

    if(isset($_SESSION['success'])){
?>
    <script>
        Swal.fire(
            'Success',
            '<?=($_SESSION['success'])?>',
            'success'
        )
    </script>
<?php

    }
    unset($_SESSION['success']);

    if(isset($_SESSION['faild'])){
?>
    <script>
        Swal.fire(
            'Faild!',
            '<?=($_SESSION['faild'])?>',
            'error'
        )
    </script>
<?php        
    }
    unset($_SESSION['faild']);
?>
