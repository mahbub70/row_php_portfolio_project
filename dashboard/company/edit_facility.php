
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

    ############### Query For Getting Company Facility Information START #########################
    $company_facility_query_result = mysqli_query($db_connect,"SELECT * FROM facilitys WHERE id=$id");
    if(!$company_facility_query_result){
        $_SESSION['faild'] = "Something Worng! Please Try Again.";
        header("location: /company-info");
    }
    $company_facility_info_array = mysqli_fetch_assoc($company_facility_query_result);
    ############### Query For Getting Company Facility Information END #########################

    if($company_facility_info_array['id'] == ''){
        header("location: /403-forbidden");
    }elseif(mysqli_num_rows($company_facility_query_result) <= 0){
        header("location: /403-forbidden");
    }

    // INSERT FACILITY
    if(isset($_POST['edit_facility'])){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $facility = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['facility']));
            $icon = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['icon']));
        }else{
            header("location: /403-forbidden");
        }

        // Validate Facility
        if($facility == ''){
            $err = "Please enter <strong>new facility</strong>";
        }elseif(strlen($facility) > 30){
            $err = "Facility Contains <strong>Maximum 30 Characters</strong>.";
        }

        // Validate Icon
        if($icon == ''){
            $icon_err = "Please Enter Icon Class Name";
        }elseif(strlen($icon) > 30){
            $icon_err = "Maximum Contains 30 Characters.";
        }

        if(!isset($err) && !isset($icon_err)){
            // Insert Facility to Database
            $update_facility_result = mysqli_query($db_connect,"UPDATE facilitys SET facility='$facility',icon='$icon' WHERE id=$id");
            if($update_facility_result){
                $_SESSION['success'] = "Facility Update Success.";
                header("location: /company-info");
            }else{
                $faild = "Update Faild! Please Try Again.";
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
        <h2 class="header-title">Edit Facility</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Edit facility</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <?php        
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
                            <label for="formGroupExampleInput">Facility Icon</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Icon Class Name" name="icon" value="<?=(isset($icon_err))?($icon):($company_facility_info_array['icon'])?>">
                            <?php 
                                if(isset($icon_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($icon_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Facility Text</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Enter Big Title" name="facility" value="<?=(isset($err)?($facility):($company_facility_info_array['facility']))?>">
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
        
                        <button type="submit" name="edit_facility" class="btn btn-primary">Update Facility</button>
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
?>
