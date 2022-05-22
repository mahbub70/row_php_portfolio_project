<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Banners From Banners Table on Database START #########################
    $banner_result = mysqli_query($db_connect,"SELECT * FROM banners");
    if(!$banner_result){
        header("location: /404-not-found");
    }
    $count_banner_rows = mysqli_num_rows($banner_result);
    ########################## Query For Collecting Banners From Banners Table on Database END #########################

    ########################## Query For Collecting Banner Buttons From banner_buttons Table on Database START #########################
    $banner_buttons_result = mysqli_query($db_connect,"SELECT * FROM banner_buttons");
    if(!$banner_buttons_result){
        header("location: /404-not-found");
    }
    $count_banner_buttons_rows = mysqli_num_rows($banner_buttons_result);
    ########################## Query For Collecting Banner Buttons From banner_buttons Table on Database END #########################

    // Banner Image Path
    $banner_image_path = "/dashboard/img/banners/";

    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Banner Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Banner info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Banner Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Banner Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_banner_rows != 0){
                                    foreach($banner_result as $key=>$banner_row_array){
                                            // Encoding Management Member User ID
                                            $banner_id = $banner_row_array['id'];
                                            $encript_formula = ceil((($banner_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_banner_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if(strlen($banner_row_array['title']) > 20){
                                                                echo substr($banner_row_array['title'],0,20) . "...";
                                                            }else{
                                                                echo $banner_row_array['title'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <td style="max-width: 250px">
                                                        <?php 
                                                            if(strlen($banner_row_array['description']) > 40){
                                                                echo substr($banner_row_array['description'],0,40) . "...";
                                                            }else{
                                                                echo $banner_row_array['description'];
                                                            }
                                                        ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <img src="<?=($banner_image_path . $banner_row_array['image'])?>" alt="" style="width:60px">
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($banner_row_array['status'] == 0){
                                                        ?>
                                                            <a href="/banner-status-change/<?=($encoded_banner_id)?>" class="btn btn-default m-r-5">Deactive</a>
                                                        <?php        
                                                            }else{
                                                        ?>
                                                            <a href="/banner-status-change/<?=($encoded_banner_id)?>" class="btn btn-success m-r-5">Active</a>
                                                        <?php        
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/banner-edit/<?=($encoded_banner_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a href="/banner-view/<?=($encoded_banner_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-idcard"></i>
                                                            </a>
                                                            <a id="/banner-delete/<?=($encoded_banner_id)?>" class="btn btn-primary btn-tone text-danger banner_del_btn" style="cursor:pointer">
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
                                    echo "You Don't Have Any Data About Banner. Please Add Banner First.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Banner Information Table END-->

        <!-- Banner Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Banner Button Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Button Text</th>
                                <th>Button Link</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_banner_buttons_rows != 0){
                                    foreach($banner_buttons_result as $key=>$banner_button_row_array){
                                            // Encoding Management Member User ID
                                            $banner_button_id = $banner_button_row_array['id'];
                                            $encript_formula = ceil((($banner_button_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_banner_button_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($banner_button_row_array['button_name'])?>
                                                    </td>
                                                    <td>
                                                        <?=($banner_button_row_array['button_link'] !="")?($banner_button_row_array['button_link']):("#")?>
                                                    </td>
                                                    
                                                    <td>
                                                        <?php 
                                                            if($banner_button_row_array['status'] == 0){
                                                        ?>
                                                            <a href="/banner-button-status-change/<?=($encoded_banner_button_id)?>" class="btn btn-default m-r-5">Deactive</a>
                                                        <?php        
                                                            }else{
                                                        ?>
                                                            <a href="/banner-button-status-change/<?=($encoded_banner_button_id)?>" class="btn btn-success m-r-5">Active</a>
                                                        <?php        
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/banner-button-edit/<?=($encoded_banner_button_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a id="/banner-button-delete/<?=($encoded_banner_button_id)?>" class="btn btn-primary btn-tone text-danger banner_btn_del_btn" style="cursor:pointer">
                                                                <i class="anticon anticon-delete"></i>
                                                            </a>
                                                            
                                                        <?php        
                                                            }elseif($login_user_array['role'] == 2 || $login_user_array['role'] == 3 || $login_user_array['role'] == 4){
                                                        ?>
                                                            <a href="/banner-button-edit/<?=($encoded_banner_button_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                        <?php        
                                                            }   
                                                        ?>
                                                        
                                                    </td>
                                                    
                                                </tr>
                            <?php                
                                        }
                                }else{
                                    echo "You Don't Have Any Data About Banner Batton. Please Add Banner Button First.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Banner Information Table END-->

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
    $('.banner_btn_del_btn').click(function(){
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

<script>
    $('.banner_del_btn').click(function(){
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
