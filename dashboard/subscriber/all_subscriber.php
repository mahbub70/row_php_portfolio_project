<?php 

    session_start();

    // Include Database File
    require '../includes/db.php';

    // SET TIME ZONE
    date_default_timezone_set("asia/dhaka");


    ############## QUERY FOR GETTING ALL SUBSCRIBER START #######################
    $all_subscriber_result = mysqli_query($db_connect,"SELECT * FROM subscribers ORDER BY id DESC");
    if(!$all_subscriber_result){
        header("location: /403-forbidden ");
    }
    ############## QUERY FOR GETTING ALL SUBSCRIBER END #######################

    ############## QUERY FOR GETTING Subscriber Header Information START #######################
    $subscriber_header_result = mysqli_query($db_connect,"SELECT * FROM subscriber_header ");
    if(!$subscriber_header_result){
        header("location: /403-forbidden ");
    }
    ############## QUERY FOR GETTING Subscriber Header Information END #######################

    // Include Header Part
    require '../includes/header.php';

?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Subcriber Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Subscriber Info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">

    <!-- Subscriber Header Information Table START-->
    <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Subscriber Header Information Table</h4>
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
                                if(mysqli_num_rows($subscriber_header_result) != 0){
                                    foreach($subscriber_header_result as $key=>$subscriber_header_row_array){
                                            // Encoding Management Member User ID
                                            $subscriber_header_id = $subscriber_header_row_array['id'];
                                            $encript_formula = ceil((($subscriber_header_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_subscriber_header_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($subscriber_header_row_array['small_title'])?>
                                                    </td>
                                                    <td style="max-width:250px">
                                                        <?php 
                                                            echo $subscriber_header_row_array['big_title'];
                                                        ?>
                                                    </td>
                                                    <td style="max-width:250px">
                                                        <?php 
                                                            echo $subscriber_header_row_array['description'];
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/subscriber-header-edit/<?=($encoded_subscriber_header_id)?>" class="btn btn-primary btn-tone">
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
                                    echo "You Don't Have Any Information About Subscriber Header.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Subscriber Header Information Table END-->

        <!-- Subscriber Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">All Subscribers</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Email</th>
                                <th>Time</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(mysqli_num_rows($all_subscriber_result) != 0){
                                    foreach($all_subscriber_result as $key=>$subscriber_row_array){
                                            // Encoding Management Member User ID
                                            $subscriber_id = $subscriber_row_array['id'];
                                            $encript_formula = ceil((($subscriber_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_subscriber_id = preg_replace('/=/i','',$encoded_id);

                                            // Prepare For ago Time
                                            $db_time = $subscriber_row_array['created_at'];
                                            $clean_time = preg_replace('/,/i',' ',$db_time);
                                            $time_second = strtotime($clean_time);

                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($subscriber_row_array['email'])?>
                                                    </td>
                                                    <td>
                                                        <?=(ago($time_second))?>
                                                    </td>
                                                    
                                                    <td class="text-right">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a id="/subscriber-delete/<?=($encoded_subscriber_id)?>" class="btn btn-primary btn-tone text-danger subscriber_del_btn" style="cursor:pointer">
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
                                    echo "You Don't Have Any Data.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Subscriber Information Table END-->


    </div>
</div>
<!-- Content Wrapper END -->







<?php 

    // Include Footer Part
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
    $('.subscriber_del_btn').click(function(){
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
