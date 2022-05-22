
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';


    ################################## Catagory Section Start ##########################################
    // Catagory Validation and editing Start
    if(isset($_POST['add_catagory_submit'])){
        // Receiving Values From Form Input
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $category_name = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['category_name']));
        }

        // Catagory Validate Start
        $max_category_name = 30;
        if($category_name == ''){
            $name_err='Please Enter <strong>Catagory Name.</strong>';
        }elseif(strlen($category_name) > $max_category_name){
            $name_err='Category Contains Maximum 30 Characters.';
        }else{  
            $category_insert_result = mysqli_query($db_connect,"INSERT INTO portfolio_categores(category_name) VALUES ('$category_name')");
            if($category_insert_result){
                $success = "Category Create Success!";
            }else{
                $faild = "<strong>Faild! Please Try Again.</strong>";
            }
        }
        // Catagory Validate End
    }
   // Catagory Validation and editing End-------------------------------------------------------------------------------------

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
        <h2 class="header-title">Create New Category</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Create Category</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3 col-md-8">
                            <label for="">Create New Category</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="category_name" placeholder="Enter Category Name">

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
                        <div class="mb-3 col-md-8">
                            <button type="submit" class="btn btn-primary" name="add_catagory_submit">Create Catagory</button>
                        </div>
                        
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

    if(isset($success)){
?>
    <script>
        Swal.fire(
            'Success',
            '<?=($success)?>',
            'success'
        )
    </script>
<?php

    }

    if(isset($faild)){
?>
    <script>
        Swal.fire(
            'Faild!',
            '<?=($faild)?>',
            'error'
        )
    </script>
<?php        
    }
?>
