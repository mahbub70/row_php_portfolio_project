<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Information From Table on Database START #########################
    $about_result = mysqli_query($db_connect,"SELECT * FROM abouts");
    if(!$about_result){
        header("location: /500-server-error");
    }
    $count_about_rows = mysqli_num_rows($about_result);
    ########################## Query For Collecting Information From Table on Database END #########################

    // About Image Path
    $about_image_path = "/dashboard/img/about_images/";

    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">About Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">About info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Banner Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">About Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Small Title</th>
                                <th>Big Title</th>
                                <th>About Text</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_about_rows != 0){
                                    foreach($about_result as $key=>$about_row_array){
                                            // Encoding Management Member User ID
                                            $about_id = $about_row_array['id'];
                                            $encript_formula = ceil((($about_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_about_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td style="max-width:50px">
                                                        <?=($about_row_array['small_title'])?>
                                                    </td>
                                                    <td style="max-width:60px;min-width:150px">
                                                        <?=($about_row_array['big_title'])?>
                                                    </td>
                                                    <td style="max-width:200px">
                                                        <?php 
                                                            if(strlen($about_row_array['about_text']) > 40){
                                                                echo substr($about_row_array['about_text'],0,40) . "...";
                                                            }else{
                                                                echo $about_row_array['about_text'];
                                                            }
                                                        ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <img src="<?=($about_image_path . $about_row_array['image'])?>" alt="About Image" style="width:60px">
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($about_row_array['status'] == 0){
                                                        ?>
                                                            <a href="/about-status-change/<?=($encoded_about_id)?>" class="btn btn-default m-r-5">Deactive</a>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <a href="/about-status-change/<?=($encoded_about_id)?>" class="btn btn-success m-r-5">Active</a>
                                                        <?php        
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/about-edit/<?=($encoded_about_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a href="/about-view/<?=($encoded_about_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-idcard"></i>
                                                            </a>
                                                            <a id="/about-delete/<?=($encoded_about_id)?>" class="btn btn-primary btn-tone text-danger about_del_btn" style="cursor:pointer">
                                                                <i class="anticon anticon-delete"></i>
                                                            </a>
                                                        <?php        
                                                            }else{
                                                                header('location: /403-forbidden');
                                                            } 
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                            <?php                
                                        }
                                }else{
                                    echo "You Don't Have Any Data About Information. Please Add About First.";
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
    $('.about_del_btn').click(function(){
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
