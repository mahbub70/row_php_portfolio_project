<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';


    // GET All Count Faild Value From Database 
    $counts_result = mysqli_query($db_connect,"SELECT * FROM counters WHERE id=1");
    if(!$counts_result){
        header("location: /403-forbidden");
    }
    $counts_row_array = mysqli_fetch_assoc($counts_result);

    // Receive Value
    if(isset($_POST['count_submit'])){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $client = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['client']));
            $rating = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['rating']));
            $award = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['award']));
            $complete_project = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['complete_project']));
            
        }else{
            header("location: /403-forbidden");
        }

        // Client Validation
        if($client != ""){
            if(!is_numeric($client)){
                $client_err = "Please Enter Valid Number.";
            }
        }
        

        // Rating Validation
        if($rating != ""){
            if(!is_numeric($rating)){
                $rating_err = "Please Enter Valid Number.";
            }
        }
        

        // Award Validation
        if($award != ""){
            if(!is_numeric($award)){
                $award_err = "Please Enter Valid Number.";
            }
        }
        

        // Complete Project Validation Start
        if($complete_project != ""){
            if(!is_numeric($complete_project)){
                $complete_project_err = "Please Enter Valid Number.";
            }
        } 
        

        if(!isset($client_err) && !isset($rating_err) && !isset($award_err) && !isset($complete_project_err)){
            // Update Information to Database
            $update_counters = mysqli_query($db_connect,"UPDATE counters SET client='$client',rating='$rating',award='$award',complete_project='$complete_project' WHERE id=1");

            if($update_counters){
                $_SESSION['success'] = "Updated Success!";
                header("location: /counter-info");
            }else{
                $_SESSION['faild'] = "Faild! Please Try Again.";
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
        <h2 class="header-title">Edit Count</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Edit Count</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card-body" style="border:1px solid #ddd">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Client</label>
                            <input type="number" class="form-control" id="formGroupExampleInput" placeholder="Client" name="client" value="<?=(isset($client_err)?($client):($counts_row_array['client']))?>">
                            <?php 
                                if(isset($client_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($client_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Five Star Rating</label>
                            <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Rating" name="rating" value="<?=(isset($rating_err)?($rating):($counts_row_array['rating']))?>">
                            <?php 
                                if(isset($rating_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($rating_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Award</label>
                            <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Award" name="award" value="<?=(isset($award_err)?($award):($counts_row_array['award']))?>">
                            <?php 
                                if(isset($award_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($award_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Complete Project</label>
                            <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Complete Project" name="complete_project" value="<?=(isset($complete_project_err)?($complete_project):($counts_row_array['complete_project']))?>">
                            <?php 
                                if(isset($complete_project_err)){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($complete_project_err)?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <button type="submit" name="count_submit" class="btn btn-primary">Save</button>
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
   
<?php


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
