
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Information From Table on Database START #########################
    $consultant_header_result = mysqli_query($db_connect,"SELECT * FROM consultant_header");
    if(!$consultant_header_result){
        header("location: /500-server-error");
    }
    ########################## Query For Collecting Information From Table on Database END #########################

    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Consultant Header Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Header info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Service Header Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Consultant Header Information Table</h4>
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
                                if(mysqli_num_rows($consultant_header_result) != 0){
                                    foreach($consultant_header_result as $key=>$consultant_header_row_array){
                                            // Encoding Management Member User ID
                                            $consultant_header_id = $consultant_header_row_array['id'];
                                            $encript_formula = ceil((($consultant_header_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_consultant_header_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($consultant_header_row_array['small_title'])?>
                                                    </td>
                                                    <td style="max-width:250px">
                                                        <?php 
                                                            echo $consultant_header_row_array['big_title'];
                                                        ?>
                                                    </td>
                                                    <td style="max-width:250px">
                                                        <?php 
                                                            echo $consultant_header_row_array['description'];
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/edit-consultant-header/<?=($encoded_consultant_header_id)?>" class="btn btn-primary btn-tone">
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
                                    echo "You Don't Have Any Information About Consultant Header.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Service Header Information Table END-->

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
