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
        <h2 class="header-title">Add Logo</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add logo</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-6 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                            <?php 
                                if(isset($_SESSION['errors']['require_err'])){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($_SESSION['errors']['require_err'])?></span>
                                    </div>
                                </div>
                            <?php        
                                } 
                            ?>
                    <form action="/check_logo" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Add Logo Image</label>
                            <input type="file" class="form-control" id="formGroupExampleInput" name="logo_image">
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

                        <h3 class="text-center my-2"><span class="badge badge-primary lh-1">OR</span></h3>

                        <div class="form-group">
                            <label for="formGroupExampleInput2">Add Logo Text</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Logo Text" name="logo_text">
                            <?php 
                                if(isset($_SESSION['errors']['text_img_err'])){
                            ?>
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <span class="alert-icon">
                                            <i class="anticon anticon-exclamation-o"></i>
                                        </span>
                                        <span><?=($_SESSION['errors']['text_img_err'])?></span>
                                    </div>
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                        
                        <button type="submit" name="logo_submit" class="btn btn-primary">Add Logo</button>
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
    unset($_SESSION['site_errors']);

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
