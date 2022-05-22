
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Information From Table on Database START #########################
    $service_result = mysqli_query($db_connect,"SELECT * FROM services");
    if(!$service_result){
        header("location: /500-server-error");
    }
    $count_service_rows = mysqli_num_rows($service_result);
    ########################## Query For Collecting Information From Table on Database END #########################

    // Service Image Path
    $service_image_path = "/dashboard/img/service_images/";

    ########################## Query For Collecting Information From Table on Database START #########################
    $service_header_result = mysqli_query($db_connect,"SELECT * FROM service_header");
    if(!$service_header_result){
        header("location: /500-server-error");
    }
    $count_service_header_rows = mysqli_num_rows($service_header_result);
    ########################## Query For Collecting Information From Table on Database END #########################

    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Service Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Service info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Service Header Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Service Header Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Small Title</th>
                                <th>Big Title</th>
                                <th>Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_service_header_rows != 0){
                                    foreach($service_header_result as $key=>$service_header_row_array){
                                            // Encoding Management Member User ID
                                            $service_header_id = $service_header_row_array['id'];
                                            $encript_formula = ceil((($service_header_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_service_header_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($service_header_row_array['small_title'])?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if(strlen($service_header_row_array['big_title']) > 30){
                                                                echo substr($service_header_row_array['big_title'],0,40) . "...";
                                                            }else{
                                                                echo $service_header_row_array['big_title'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if(strlen($service_header_row_array['text']) > 40){
                                                                echo substr($service_header_row_array['text'],0,40) . "...";
                                                            }else{
                                                                echo $service_header_row_array['text'];
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/service-header-edit/<?=($encoded_service_header_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a href="/service-header-view/<?=($encoded_service_header_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-idcard"></i>
                                                            </a>
                                                        <?php        
                                                            }
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                            <?php                
                                        }
                                }else{
                                    echo "You Don't Have Any Information About Service Header.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Service Header Information Table END-->


        <!-- Service Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Service Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Service Title</th>
                                <th>Service Description</th>
                                <th>Service Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_service_rows != 0){
                                    foreach($service_result as $key=>$service_row_array){
                                            // Encoding Management Member User ID
                                            $service_id = $service_row_array['id'];
                                            $encript_formula = ceil((($service_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_service_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($service_row_array['title'])?>
                                                    </td>
            
                                                    <td>
                                                        <?php 
                                                            if(strlen($service_row_array['description']) > 40){
                                                                echo substr($service_row_array['description'],0,40) . "...";
                                                            }else{
                                                                echo $service_row_array['description'];
                                                            }
                                                        ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <img src="<?=($service_image_path . $service_row_array['image'])?>" alt="Service Image" style="width:60px">
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($service_row_array['status'] == 0){
                                                        ?>
                                                            <a href="/service-status-change/<?=($encoded_service_id)?>" class="btn btn-default m-r-5">Deactive</a>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <a href="/service-status-change/<?=($encoded_service_id)?>" class="btn btn-success m-r-5">Active</a>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/service-edit/<?=($encoded_service_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a href="/service-view/<?=($encoded_service_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-idcard"></i>
                                                            </a>
                                                            <a id="/service-delete/<?=($encoded_service_id)?>" class="btn btn-primary btn-tone text-danger service_del_btn" style="cursor:pointer">
                                                                <i class="anticon anticon-delete"></i>
                                                            </a>
                                                        <?php        
                                                            }
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                            <?php                
                                        }
                                }else{
                                    echo "You Don't Have Any Information About Service. Please Add Service First.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Service Information Table END-->

    </div>
</div>
<!-- Content Wrapper END -->




<?php 
    // Includes Footer File
    require '../includes/footer.php';

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

    if(isset($_SESSION['limit_err'])){
?> 
    <script>
        Swal.fire(
            'Warning!',
            '<?=($_SESSION['limit_err'])?>',
            'warning'
        )
    </script>
<?php
    }
    unset($_SESSION['limit_err']);
?>

<script>
    $('.service_del_btn').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = $(this).attr('id');
        }
        })
    });
</script>
