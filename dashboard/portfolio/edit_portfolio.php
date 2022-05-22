
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

    ############### Query For Getting About Information START #########################
    $service_info_query_result = mysqli_query($db_connect,"SELECT * FROM services WHERE id=$id");
    if(!$service_info_query_result){
        $_SESSION['faild'] = "Something Worng! Please Try Again.";
        header("location: /service-info");
    }
    $service_info_array = mysqli_fetch_assoc($service_info_query_result);
    ############### Query For Getting About Information END #########################

    if($service_info_array['id'] == ''){
        header("location: /403-forbidden");
    }elseif(mysqli_num_rows($service_info_query_result) <= 0){
        header("location: /403-forbidden");
    }

    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Edit Service</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Edit service</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <form action="/check-feature/edit-service/<?=($recv_encoded_user_id)?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Service Title</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Service Title" name="title" value="<?=(isset($_SESSION['old_values']['title'])?($_SESSION['old_values']['title']):($service_info_array['title']))?>">
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
                            <label for="formGroupExampleInput2">Service Description</label>
                            <textarea type="text" class="form-control" id="formGroupExampleInput2" placeholder="Service Description" name="desc"><?=(isset($_SESSION['old_values']['desc'])?($_SESSION['old_values']['desc']):($service_info_array['description']))?></textarea>
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
                            <label for="formGroupExampleInput2">Service Image</label>
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
                        <button type="submit" name="service_submit" class="btn btn-primary">Update Service</button>
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
