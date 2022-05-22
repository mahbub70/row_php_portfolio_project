
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
        <h2 class="header-title">Add Banner Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add banner</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <div class="accordion" id="accordion-default">
                        <!-- ---------------------------------------------- -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <a class="<?=(!isset($_SESSION['errors'])?('collapsed'):(''))?>" data-toggle="collapse" href="#collapseOneDefault">
                                        <span><strong>Add Banner Information</strong></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOneDefault" class="collapse <?=(isset($_SESSION['errors'])?('show'):(''))?>" data-parent="#accordion-default">
                                <div class="card-body">
                                    <form action="/check-banner" method="POST" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Banner Title</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Banner Title" name="title" value="<?=(isset($_SESSION['old_values']['title'])?($_SESSION['old_values']['title']):(''))?>">
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
                                            <label for="formGroupExampleInput2">Banner Description</label>
                                            <textarea type="text" class="form-control" id="formGroupExampleInput2" placeholder="Banner Description" name="desc"><?=(isset($_SESSION['old_values']['desc'])?($_SESSION['old_values']['desc']):(''))?></textarea>
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
                                            <label for="formGroupExampleInput2">Banner Image</label>
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
                                        <button type="submit" name="banner_info_submit" class="btn btn-primary">Add Banner</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- --------------------------------- -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <a class="<?=(!isset($_SESSION['link_errors'])?('collapsed'):(''))?>" data-toggle="collapse" href="#collapseTwoDefault">
                                        <span><strong>Add banner Button</strong></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwoDefault" class="collapse <?=(isset($_SESSION['link_errors'])?('show'):(''))?>" data-parent="#accordion-default">
                                <div class="card-body">
                                    <form action="/check-banner" method="POST">
                                    
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Button Text</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Social Site Icon" name="btn_text" value="<?=(isset($_SESSION['old_values']['btn_text'])?($_SESSION['old_values']['btn_text']):(''))?>">
                                            <?php 
                                                if(isset($_SESSION['link_errors']['btn_text'])){
                                            ?>
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="alert-icon">
                                                            <i class="anticon anticon-exclamation-o"></i>
                                                        </span>
                                                        <span><?=($_SESSION['link_errors']['btn_text'])?></span>
                                                    </div>
                                                </div>
                                            <?php        
                                                }
                                            ?>
                                        </div>
                                        
                                        <label for="basic-url">Button Link (Optional)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon3">https://</span>
                                            </div>
                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="btn_link">
                                        </div>
                                            <?php 
                                                if(isset($_SESSION['link_errors']['btn_link'])){
                                            ?>
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="alert-icon">
                                                            <i class="anticon anticon-exclamation-o"></i>
                                                        </span>
                                                        <span><?=($_SESSION['link_errors']['btn_link'])?></span>
                                                    </div>
                                                </div>
                                            <?php        
                                                }
                                            ?>

                                        <button type="submit" name="banner_btn_submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ------------------------------------------ -->
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
