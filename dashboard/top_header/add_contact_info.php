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
        <h2 class="header-title">Add Contact Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add Contact info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-6 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <div class="accordion" id="accordion-default">
                        <!-- ---------------------------------------------- -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <a class="<?=(!isset($_SESSION['errors'])?('collapsed'):(''))?>" data-toggle="collapse" href="#collapseOneDefault">
                                        <span><strong>Add Contact Information</strong></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOneDefault" class="collapse <?=(isset($_SESSION['errors'])?('show'):(''))?>" data-parent="#accordion-default">
                                <div class="card-body">
                                    <form action="/contact-check-form" method="POST">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Phone Icon (optional)</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Phone icon" name="phone_icon">
                                            <?php 
                                                if(isset($_SESSION['errors']['phone_icon'])){
                                            ?>
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="alert-icon">
                                                            <i class="anticon anticon-exclamation-o"></i>
                                                        </span>
                                                        <span><?=($_SESSION['errors']['phone_icon'])?></span>
                                                    </div>
                                                </div>
                                            <?php        
                                                } 
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Phone Number</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Phone Number" name="phone">
                                            <?php 
                                                if(isset($_SESSION['errors']['phone'])){
                                            ?>
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="alert-icon">
                                                            <i class="anticon anticon-exclamation-o"></i>
                                                        </span>
                                                        <span><?=($_SESSION['errors']['phone'])?></span>
                                                    </div>
                                                </div>
                                            <?php        
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Email Icon (optional)</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Email icon" name="email_icon">
                                            <?php 
                                                if(isset($_SESSION['errors']['email_icon'])){
                                            ?>
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="alert-icon">
                                                            <i class="anticon anticon-exclamation-o"></i>
                                                        </span>
                                                        <span><?=($_SESSION['errors']['email_icon'])?></span>
                                                    </div>
                                                </div>
                                            <?php        
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Email Address</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Email Address" name="email">
                                            <?php 
                                                if(isset($_SESSION['errors']['email'])){
                                            ?>
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="alert-icon">
                                                            <i class="anticon anticon-exclamation-o"></i>
                                                        </span>
                                                        <span><?=($_SESSION['errors']['email'])?></span>
                                                    </div>
                                                </div>
                                            <?php        
                                                }
                                            ?>
                                        </div>
                                        <button type="submit" name="contact_info_save" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- --------------------------------- -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <a class="<?=(!isset($_SESSION['site_errors'])?('collapsed'):(''))?>" data-toggle="collapse" href="#collapseTwoDefault">
                                        <span><strong>Add Social Links</strong></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwoDefault" class="collapse <?=(isset($_SESSION['site_errors'])?('show'):(''))?>" data-parent="#accordion-default">
                                <div class="card-body">
                                    <form action="/contact-check-form" method="POST">
                                        <div class="form-group">
                                            <label for="">Select Social Site</label>
                                            <select name="social_site" id="" class="form-control" aria-label="Default select example">
                                                <option value="" selected disabled>Choose One</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="twitter">Twitter</option>
                                                <option value="pinterest">Pinterest</option>
                                                <option value="linkedin">Linkedin</option>
                                            </select>
                                            <?php 
                                                if(isset($_SESSION['site_errors']['site_name'])){
                                            ?>
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="alert-icon">
                                                            <i class="anticon anticon-exclamation-o"></i>
                                                        </span>
                                                        <span><?=($_SESSION['site_errors']['site_name'])?></span>
                                                    </div>
                                                </div>
                                            <?php        
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Icon</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Social Site Icon" name="icon">
                                            <?php 
                                                if(isset($_SESSION['site_errors']['site_icon'])){
                                            ?>
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="alert-icon">
                                                            <i class="anticon anticon-exclamation-o"></i>
                                                        </span>
                                                        <span><?=($_SESSION['site_errors']['site_icon'])?></span>
                                                    </div>
                                                </div>
                                            <?php        
                                                }
                                            ?>
                                        </div>
                                        
                                        <label for="basic-url">Link</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon3">https://</span>
                                            </div>
                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="link">
                                        </div>
                                            <?php 
                                                if(isset($_SESSION['site_errors']['site_link'])){
                                            ?>
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="alert-icon">
                                                            <i class="anticon anticon-exclamation-o"></i>
                                                        </span>
                                                        <span><?=($_SESSION['site_errors']['site_link'])?></span>
                                                    </div>
                                                </div>
                                            <?php        
                                                }
                                            ?>

                                        <button type="submit" name="social_link_save" class="btn btn-primary">Save</button>
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
    unset($_SESSION['site_errors']);


    if(isset($_SESSION['insert_success'])){
?>
    <script>
        Swal.fire(
            'Success',
            '<?=($_SESSION['insert_success'])?>',
            'success'
        )
    </script>
<?php

    }
    unset($_SESSION['insert_success']);

    if(isset($_SESSION['insert_faild'])){
?>
    <script>
        Swal.fire(
            'Faild!',
            '<?=($_SESSION['insert_faild'])?>',
            'error'
        )
    </script>
<?php        
    }
    unset($_SESSION['insert_faild']);
?>
