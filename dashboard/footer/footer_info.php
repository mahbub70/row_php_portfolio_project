
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Information From Table on Database START #########################
    $links_result = mysqli_query($db_connect,"SELECT * FROM important_links");
    if(!$links_result){
        header("location: /500-server-error");
    }
    ########################## Query For Collecting Information From Table on Database END #########################



    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Footer Important Links Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Footer Link info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Menu Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Important Link Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(mysqli_num_rows($links_result) != 0){
                                    foreach($links_result as $key=>$link_row_array){
                                            // Encoding Management Member User ID
                                            $link_id = $link_row_array['id'];
                                            $encript_formula = ceil((($link_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_link_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($link_row_array['title'])?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if($link_row_array['link'] != ""){
                                                                if(strlen($link_row_array['link']) > 40){
                                                                    echo substr($link_row_array['link'],0,40) . "...";
                                                                }else{
                                                                    echo $link_row_array['link'];
                                                                }
                                                            }else{
                                                                echo "#";
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                            
                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a id="/delete-important-link/<?=($encoded_link_id)?>" class="btn btn-primary btn-tone menu_del_btn">
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
