
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Service Image Path
    $counter_image_path = "/dashboard/img/counter_images/";

    ########################## Query For Collecting Information From Table on Database START #########################
    $counter_info_result = mysqli_query($db_connect,"SELECT * FROM counter_section");
    if(!$counter_info_result){
        header("location: /500-server-error");
    }
    $counter_information_array = mysqli_fetch_assoc($counter_info_result);
    ########################## Query For Collecting Information From Table on Database END #########################


    ###################### COUNTER QUERY START ######################################
    $counters_result = mysqli_query($db_connect,"SELECT * FROM counters");
    if(!$counters_result){
        header("location: /500-server-error");
    }
    $counters_row_array = mysqli_fetch_assoc($counters_result);
    ###################### COUNTER QUERY END ######################################

    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Counter Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Counter info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Service Header Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Counter Background Image Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(mysqli_num_rows($counter_info_result) != 0){
                                    foreach($counter_info_result as $key=>$counter_row_array){
                                            // Encoding Management Member User ID
                                            $counter_id = $counter_row_array['id'];
                                            $encript_formula = ceil((($counter_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_counter_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    
                                                    <td>
                                                        <?php 
                                                            if($counter_row_array['image'] != ""){
                                                        ?>
                                                            <img src="<?=($counter_image_path.$counter_row_array['image'])?>" alt="Image" style="max-width:300px">
                                                        <?php        
                                                            }else{
                                                                echo "Image Empty";
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/counter-edit/<?=($encoded_counter_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
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
                                    echo "You Don't Have Any Information.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Service Header Information Table END-->
        
        <!-- Service Header Information Table START-->
        <div class="card">
            <div class="card-header d-flex justify-content-between p-4">
                <h4 class="mt-2">Counter Information Table</h4>
                <?php 
                    if($login_user_array['role'] == 1){
                ?>
                    <a href="/count-edit" class="btn btn-primary"><i class="anticon anticon-edit"></i></a>
                <?php        
                    }
                ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <h2 class="m-b-0"><?=($counters_row_array['client'] == "")?("Original Info Show"):($counters_row_array['client'])?></h2>
                                        <p class="m-b-0 text-muted">Client</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                        <i class="far fa-star"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <h2 class="m-b-0"><?=($counters_row_array['rating'] == "")?("Original Info Show"):($counters_row_array['rating'])?></h2>
                                        <p class="m-b-0 text-muted">Rating</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-icon avatar-lg avatar-gold">
                                        <i class="fas fa-chess-pawn"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <h2 class="m-b-0"><?=($counters_row_array['award'] == "")?("Original Info Show"):($counters_row_array['award'])?></h2>
                                        <p class="m-b-0 text-muted">Won Award</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-icon avatar-lg avatar-purple">
                                        <i class="fas fa-flag-checkered"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <h2 class="m-b-0"><?=($counters_row_array['complete_project'] == "")?("Original Info Show"):($counters_row_array['complete_project'])?></h2>
                                        <p class="m-b-0 text-muted">Complete Project</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
?>
    


