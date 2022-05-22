
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $time = date('h:i:s A');
    $date = date('d-m-Y');
    $date_time = $time . ',' . $date;

    // INSET PACKAGE SERVICE INFORMATION WITH VALIDATON 
    if(isset($_POST['package_service_submit'])){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $package_id = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['package']));
            $service_text= mysqli_real_escape_string($db_connect,input_sanitizer($_POST['service_text']));
        }else{
            header("location: /403-forbidden");
        }

        // Start Validation
        if(empty($package_id)){
            $package_err = "Please Select a Package.";
        }

        if($service_text == ''){
            $service_err = "Please Enter Package Package Service Deatils";
        }elseif(strlen($service_text) > 25){
            $service_err = "Service Text Contains Maximum 25 Characters.";
        }


        if(!isset($package_err) && !isset($service_err)){
            // INSERT PACKAGE Service DATA
            $service_insert_result = mysqli_query($db_connect, "INSERT INTO package_services(package_id, service_text) VALUES ('$package_id','$service_text')");

            if($service_insert_result){
                $success = "Service Added Success";
                $service_added_success = "";
            }else{
                $faild = "Faild! Please Try Again.";
                $service_faild = "";
            }
        }

    }



    ############## QUERY FOR PACKAGES NAME #########################
    $packages_result = mysqli_query($db_connect , "SELECT * FROM packages ");
    if(!$packages_result){
        header("location: /403-forbidden");
    }
    ############## QUERY FOR PACKAGES NAME #########################

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
        <h2 class="header-title">Add Package Service</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add service</span>
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
        
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Add Package Services</label>
                            <select name="package" id="" class="form-control">
                                <option value="" selected disabled>Choose One</option>
                                <?php 
                                    foreach($packages_result as $package_array){
                                ?>
                                    <option value="<?=($package_array['id'])?>"><?=($package_array['name'])?></option>
                                <?php        
                                    }
                                ?>
                            </select>
                            <?php 
                                if(isset($package_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($package_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput">Package Service Details</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Service Text" name="service_text" value="<?=(isset($service_err) || isset($package_err)?($service_text):(''))?>">
                            <?php 
                                if(isset($service_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($service_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                        </div>

                        <button type="submit" name="package_service_submit" class="btn btn-primary">Add Package Service</button>
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
