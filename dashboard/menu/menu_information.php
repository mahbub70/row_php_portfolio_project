
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Information From Table on Database START #########################
    $menus_result = mysqli_query($db_connect,"SELECT * FROM menu");
    if(!$menus_result){
        header("location: /500-server-error");
    }
    ########################## Query For Collecting Information From Table on Database END #########################



    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Menus Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Menu info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Menu Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Menu List Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Name</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(mysqli_num_rows($menus_result) != 0){
                                    foreach($menus_result as $key=>$menu_row_array){
                                            // Encoding Management Member User ID
                                            $menu_id = $menu_row_array['id'];
                                            $encript_formula = ceil((($menu_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_menu_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($menu_row_array['name'])?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if($menu_row_array['link'] != ""){
                                                                if(strlen($menu_row_array['link']) > 40){
                                                                    echo substr($menu_row_array['link'],0,40) . "...";
                                                                }else{
                                                                    echo $menu_row_array['link'];
                                                                }
                                                            }else{
                                                                echo "#";
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($menu_row_array['status'] == 1){
                                                        ?>
                                                            <a href="/menu-status-change/<?=($encoded_menu_id)?>" class="btn btn-success ">Active</a>
                                                        <?php        
                                                            }else{
                                                        ?>
                                                            <a href="/menu-status-change/<?=($encoded_menu_id)?>" class="btn btn-default">Deactive</a>
                                                        <?php        
                                                            }
                                                        ?>
                                                    </td>        
                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/menu-edit/<?=($encoded_menu_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a id="/menu-delete/<?=($encoded_menu_id)?>" class="btn btn-primary btn-tone menu_del_btn">
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
                                    echo "You don't have any data.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Menu Information Table END-->

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
    $('.menu_del_btn').click(function(){
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
