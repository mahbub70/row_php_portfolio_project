<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Logos From logos Table on Database START #########################
    $logo_result = mysqli_query($db_connect,"SELECT * FROM logos");
    if(!$logo_result){
        header("location: /404-not-found");
    }
    $count_logos_rows = mysqli_num_rows($logo_result);
    ########################## Query For Collecting Logos From logos Table on Database END #########################

    // Includes Header File
    require '../includes/header.php';

    // Logo Image Folder
    $logo_image_path = "/dashboard/img/logos/";
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Logo Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Logo info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Contact Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Logo Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Logo</th>
                                <th>Logo Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_logos_rows != 0){
                                    foreach($logo_result as $key=>$logo_row_array){
                                            // Encoding Management Member User ID
                                            $logo_id = $logo_row_array['id'];
                                            $encript_formula = ceil((($logo_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_logo_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($logo_row_array['type']=="Image"){
                                                        ?>
                                                            <img src="<?=($logo_image_path . $logo_row_array['logo'])?>" alt="" style="width:70px">
                                                        <?php        
                                                            }else{
                                                        ?> 
                                                            <?=($logo_row_array['logo'])?>
                                                        <?php        
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?=($logo_row_array['type'])?>
                                                    </td>
                                                    
                                                    <td>
                                                        <?php 
                                                            if($logo_row_array['status'] == 0){
                                                        ?>
                                                            <a href="/logo-status-change/<?=($encoded_logo_id)?>" class="btn btn-default m-r-5">Deactive</a>
                                                        <?php        
                                                            }else{
                                                        ?>
                                                            <a href="/logo-status-change/<?=($encoded_logo_id)?>" class="btn btn-success m-r-5">Active</a>
                                                        <?php        
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a id="/logo-delete/<?=($encoded_logo_id)?>" class="btn btn-primary btn-tone text-danger logo_del_btn" style="cursor:pointer">
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
                                    echo "You Don't Have Any Data About Website Logo. Please Add Logo First.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Contact Information Table END-->
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
?>

<script>
    $('.logo_del_btn').click(function(){
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
