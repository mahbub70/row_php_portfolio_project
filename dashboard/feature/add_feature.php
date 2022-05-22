
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';



    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Add Feature Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add feature</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <form action="/check-feature/add" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Feature Title</label>
                            <p><small>Please Devide by Arrow (>) Sign for Different Design in Same Line ( Maximum 1 Arrow (>) ).</small></p>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Feature Title" name="title" value="<?=(isset($_SESSION['old_values']['title'])?($_SESSION['old_values']['title']):(''))?>">
                            <?php 
                                if(isset($_SESSION['errors']['title'])){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($_SESSION['errors']['title'])?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Feature Description</label>
                            <textarea type="text" class="form-control" id="formGroupExampleInput2" placeholder="Feature Description" name="desc"><?=(isset($_SESSION['old_values']['desc'])?($_SESSION['old_values']['desc']):(''))?></textarea>
                            <?php 
                                if(isset($_SESSION['errors']['desc'])){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($_SESSION['errors']['desc'])?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Feature Image</label>
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
                        <button type="submit" name="feature_submit" class="btn btn-primary">Add Feature</button>
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
