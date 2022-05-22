
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Information From Table on Database START #########################
    $message_result = mysqli_query($db_connect,"SELECT * FROM messages ORDER BY status=0 DESC,status=1 ASC,id DESC");
    if(!$message_result){
        header("location: /500-server-error");
    }
    ########################## Query For Collecting Information From Table on Database END #########################

    

    // Includes Header File
    require '../includes/header.php';

?>

<style>
    .unseen_row{
        background:#ddd;
    }
    table tbody tr{
        cursor: pointer;
    }
</style>

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Messages Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Message info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">

        <!-- Service Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2"> All Messages Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Time</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(mysqli_num_rows($message_result) != 0){
                                    foreach($message_result as $key=>$message_row_array){
                                            // Encoding Message Member User ID
                                            $message_id = $message_row_array['id'];
                                            $encript_formula = ceil((($message_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_message_id = preg_replace('/=/i','',$encoded_id);

                                            // Prepare For ago Time
                                            $db_time = $message_row_array['created_at'];
                                            $clean_time = preg_replace('/,/i',' ',$db_time);
                                            $time_second = strtotime($clean_time);
                            ?>
                                                <tr class="<?=($message_row_array['status'] == 0)?("unseen_row"):("")?>">
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($message_row_array['name'])?>
                                                    </td>
                                                    <td><?=($message_row_array['subject'])?></td>
                                                    <td>
                                                        <?php 
                                                            if(strlen($message_row_array['message']) > 40){
                                                                echo substr($message_row_array['message'],0,40) . "...";
                                                            }else{
                                                                echo $message_row_array['message'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?=(ago($time_second))?></td>
                                                    <td>
                                                        <?php 
                                                            if($message_row_array['status'] == 1){
                                                        ?>
                                                            <span class="badge badge-pill badge-info">Seen</span>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <span class="badge badge-pill badge-red">Unseen</span>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/message-view/<?=($encoded_message_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-idcard"></i>
                                                            </a>
                                                            <a id="/delete-message/<?=($encoded_message_id)?>" class="btn btn-primary btn-tone text-danger message_del_btn" style="cursor:pointer">
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
                                    echo "You Don't Have Any Message.";
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
    $('.message_del_btn').click(function(){
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
