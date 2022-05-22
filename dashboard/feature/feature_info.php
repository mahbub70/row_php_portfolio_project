<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Feature From Feature Table on Database START #########################
    $feature_result = mysqli_query($db_connect,"SELECT * FROM features");
    if(!$feature_result){
        header("location: /404-not-found");
    }
    $count_feature_rows = mysqli_num_rows($feature_result);
    ########################## Query For Collecting Feature From Feature Table on Database END #########################

    // Banner Image Path
    $feature_image_path = "/dashboard/img/features_img/";

    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Feature Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Feature info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Banner Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Feature Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Feature Title</th>
                                <th>Feature Description</th>
                                <th>Feature Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_feature_rows != 0){
                                    foreach($feature_result as $key=>$feature_row_array){
                                            // Encoding Management Member User ID
                                            $feature_id = $feature_row_array['id'];
                                            $encript_formula = ceil((($feature_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_feature_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($feature_row_array['title'])?>
                                                    </td>
                                                    <td style="max-width:250px">
                                                        <?php 
                                                            if(strlen($feature_row_array['description']) > 40){
                                                                echo substr($feature_row_array['description'],0,40) . "...";
                                                            }else{
                                                                echo $feature_row_array['description'];
                                                            }
                                                        ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <img src="<?=($feature_image_path . $feature_row_array['image'])?>" alt="Feature Image" style="width:60px">
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($feature_row_array['status'] == 0){
                                                        ?>
                                                            <a href="/feature-status-change/<?=($encoded_feature_id)?>" class="btn btn-default m-r-5">Deactive</a>
                                                        <?php        
                                                            }else{
                                                        ?>
                                                            <a href="/feature-status-change/<?=($encoded_feature_id)?>" class="btn btn-success m-r-5">Active</a>
                                                        <?php        
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/feature-edit/<?=($encoded_feature_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a href="/feature-view/<?=($encoded_feature_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-idcard"></i>
                                                            </a>
                                                            <a id="/feature-delete/<?=($encoded_feature_id)?>" class="btn btn-primary btn-tone text-danger feature_del_btn" style="cursor:pointer">
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
                                    echo "You Don't Have Any Data About Feature Information. Please Add Feature First.";
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
    $('.feature_del_btn').click(function(){
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
