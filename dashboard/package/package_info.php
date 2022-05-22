<?php 

    session_start();

    // Include Database File
    require '../includes/db.php';

    // SET TIME ZONE
    date_default_timezone_set("asia/dhaka");

    ############## QUERY FOR GETTING Packages Header Information START #######################
    $packages_header_result = mysqli_query($db_connect,"SELECT * FROM package_header ");
    if(!$packages_header_result){
        header("location: /403-forbidden ");
    }
    ############## QUERY FOR GETTING Packages Header Information END #######################


    ############## QUERY FOR GETTING Package Information START #######################
    $packages_result = mysqli_query($db_connect,"SELECT * FROM packages ");
    if(!$packages_result){
        header("location: /403-forbidden ");
    }
    ############## QUERY FOR GETTING Package Information END #######################

    // Include Header Part
    require '../includes/header.php';

?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Packages Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Packages Info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
    <!-- Packages Header Information Table START-->
    <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Packages Header Information Table</h4>
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
                                if(mysqli_num_rows($packages_header_result) != 0){
                                    foreach($packages_header_result as $key=>$packages_header_row_array){
                                            // Encoding Management Member User ID
                                            $packages_header_id = $packages_header_row_array['id'];
                                            $encript_formula = ceil((($packages_header_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_packages_header_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($packages_header_row_array['small_title'])?>
                                                    </td>
                                                    <td style="max-width:200px">
                                                        <?php 
                                                            echo $packages_header_row_array['big_title'];
                                                        ?>
                                                    </td>
                                                    <td style="max-width:250px">
                                                        <?php 
                                                            echo $packages_header_row_array['description'];
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/packages-header-edit/<?=($encoded_packages_header_id)?>" class="btn btn-primary btn-tone">
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
        <!-- Packages Header Information Table END-->


    </div>

    <div class="row align-items-center" id="monthly-view">
    <?php 
        if(mysqli_num_rows($packages_result) != 0){
            foreach($packages_result as $package_row_array){
                // Encoding Management Member User ID
                $package_id = $package_row_array['id'];
                $encript_formula = ceil((($package_id * 123465789 * 98765) / 56789));
                $encoded_id = base64_encode($encript_formula);
                $encoded_package_id = preg_replace('/=/i','',$encoded_id);


                $package_id = $package_row_array['id'];
                // Query for getting matched packages service
                $service_result = mysqli_query($db_connect,"SELECT * FROM package_services WHERE package_id=$package_id");
    ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-b-20 border-bottom">
                            <div class="media align-items-center">
                                
                                <div class="m-l-15">
                                    <h2 class="font-weight-bold font-size-30 m-b-0">
                                        <?=($package_row_array['price'])?>
                                    </h2>
                                    <h4 class="m-b-0"><?=($package_row_array['name'])?></h4>
                                </div>
                            </div>
                        </div>
                        <ul class="list-unstyled m-v-30">

                        <?php  
                            if(mysqli_num_rows($service_result) != 0 ){
                                foreach($service_result as $service_row_array){
                                    // Encoding Management Member User ID
                                    $service_id = $service_row_array['id'];
                                    $encript_formula = ceil((($service_id * 123465789 * 98765) / 56789));
                                    $encoded_id = base64_encode($encript_formula);
                                    $encoded_service_id = preg_replace('/=/i','',$encoded_id);
                                
                        ?>
                            <li class="m-b-20">
                                <div class="d-flex justify-content-between">
                                    <span class="text-dark font-weight-semibold"><?=($service_row_array['service_text'])?></span>
                                    <div class="text-success font-size-16">
                                        <i class="anticon anticon-check"></i>
                                        <a href="/package-service-delete/<?=($encoded_service_id)?>" class="text-danger mx-2"><i class="anticon anticon-delete"></i></a>
                                    </div>
                                </div>
                            </li>
                        <?php
                            }       
                                }
                        ?>
                        </ul>
                        <div class="text-center">
                            <?php 
                                if($package_row_array['status'] == 1){
                            ?>
                                <a href="/package-status-change/<?=($encoded_package_id)?>" class="btn btn-primary">Active</a>
                            <?php        
                                }else{
                            ?>
                                <a href="/package-status-change/<?=($encoded_package_id)?>" class="btn btn-default">Deactive</a>
                            <?php
                                }
                            ?> 
                            <a id="/package-delete/<?=($encoded_package_id)?>" class="btn btn-danger text-white package_del_btn">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
    <?php
                    
        }        
            }
    ?>
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
    $('.package_del_btn').click(function(){
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