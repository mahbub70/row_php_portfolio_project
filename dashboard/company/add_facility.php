
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    // INSERT FACILITY
    if(isset($_POST['add_facility'])){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $facility = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['facility']));
        }else{
            header("location: /403-forbidden");
        }

        // Validate Facility
        if($facility == ''){
            $err = "Please enter <strong>new facility</strong>";
        }elseif(strlen($facility) > 30){
            $err = "Facility Contains <strong>Maximum 30 Characters</strong>.";
        }

        if(!isset($err)){
            // Insert Facility to Database
            $insert_facility_result = mysqli_query($db_connect,"INSERT INTO facilitys(facility) VALUES ('$facility')");
            if($insert_facility_result){
                $success = "Facility Addedd Success.";
            }else{
                $faild = "Added Faild! Please Try Again.";
            }
        }
    }  

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
        <h2 class="header-title">Add Facility</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add facility</span>
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
                        }elseif(isset($faild)){
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
                            <label for="formGroupExampleInput">Add Facility</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Add New Facility" name="facility" value="<?=(isset($err)?($facility):(''))?>">
                            <?php 
                                if(isset($err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($err)?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                        </div>
                        <button type="submit" name="add_facility" class="btn btn-primary">Add Facility</button>
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
    
    unset($_SESSION['errors']);
    unset($_SESSION['link_errors']);
    unset($_SESSION['old_values']);

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
