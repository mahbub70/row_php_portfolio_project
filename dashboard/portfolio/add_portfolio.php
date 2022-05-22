
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';


    ################ Query For Getting All Portfolio Category START #################
    $all_category_result = mysqli_query($db_connect,"SELECT * FROM portfolio_categores");
    if(!$all_category_result){
        header("location: /500-server-error");
    }
    ################ Query For Getting All Portfolio Category END ################# 



    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Add Portfolio</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add portfolio</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <form action="/check-portfolio" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Select Catagory</label>
                            <select name="category" id="" class="form-control">
                                <option value="" selected disabled>Choose One</option>
                                <?php 
                                    foreach($all_category_result as $category_row_array){
                                        $category_name_lower_case = strtolower(preg_replace('/ /i','-',$category_row_array['category_name']));
                                ?>
                                    <option value="<?=($category_name_lower_case)?>"><?=($category_row_array['category_name'])?></option>
                                <?php        
                                    }
                                ?>
                            </select>
                            <?php 
                                if(isset($_SESSION['errors']['category'])){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($_SESSION['errors']['category'])?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Portfolio Image</label>
                            <input type="file" class="form-control" id="formGroupExampleInput2" name="image">
                            <?php 
                                if(isset($_SESSION['errors']['img-err'])){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($_SESSION['errors']['img-err'])?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <button type="submit" name="portfolio_submit" class="btn btn-primary">Add Portfolio</button>
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
