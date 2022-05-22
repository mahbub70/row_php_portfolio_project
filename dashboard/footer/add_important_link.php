<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';


    // Menu Section Start
    if(isset($_POST['link_submit'])){
        // Check Method is POST or Not
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $menu_name = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['name']));
            $menu_link = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['link']));
        }else{
            header("location: /403-forbidden");
        }

        // Menu Name Validation
        if($menu_name == ""){
            $name_err = "Please Enter Your Title.";
        }elseif(strlen($menu_name) > 40){
            $name_err = "Title Contains Maximum 40 Characters.";
        }

        // Link Validation
        // Regex link Validation 
        $regex_link_validation_code = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        $valid_link = preg_match($regex_link_validation_code,$menu_link);
        if($menu_link != ""){
            if(!$valid_link){
                $link_err = "This is not valid link. Please Enter Valid Link.";
            }
        }


        // Check Validation Complete OR not
        if(!isset($name_err) && !isset($link_err)){

            
            $link_insert_result = mysqli_query($db_connect,"INSERT INTO important_links(title, link) VALUES ('$menu_name','$menu_link')");
            if($link_insert_result){
                $success = "Successfully Added New Menu.";
            }else{
                $faild = "Faild! Please Try Again.";
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
        <h2 class="header-title">Add New Important Link</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add link</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-6 m-auto">
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
                    ?>
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
                            <label for="formGroupExampleInput">Title</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter your new menu name" name="name">
                        </div>
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
                        
                        <label for="basic-url">Link (Optional)</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="link">
                        </div>
                            <?php 
                            if(isset($link_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($link_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>

                        <button type="submit" name="link_submit" class="btn btn-primary">Add</button>
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

