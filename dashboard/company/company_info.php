<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ########################## Query For Collecting Information From Table on Database START #########################
    $company_result = mysqli_query($db_connect,"SELECT * FROM company_header ");
    if(!$company_result){
        header("location: /500-server-error");
    }
    $count_company_rows = mysqli_num_rows($company_result);
    ########################## Query For Collecting Information From Table on Database END #########################

    // Company Image Path
    $company_image_path = "/dashboard/img/company_images/";

    ########################## Query For Collecting Information From Table on Database START #########################
    $company_facility_result = mysqli_query($db_connect,"SELECT * FROM facilitys ");
    if(!$company_facility_result){
        header("location: /500-server-error");
    }
    $count_company_facility_rows = mysqli_num_rows($company_facility_result);
    ########################## Query For Collecting Information From Table on Database END #########################

    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Company Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Company info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Company Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Company Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Small Title</th>
                                <th>Big Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_company_rows != 0){
                                    foreach($company_result as $key=>$company_row_array){
                                            // Encoding Management Member User ID
                                            $comapny_id = $company_row_array['id'];
                                            $encript_formula = ceil((($comapny_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_company_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td style="max-width:200px">
                                                        <?=($company_row_array['small_title'])?>
                                                    </td>
                                                    <td style="max-width:200px">
                                                        <?=($company_row_array['big_title'])?>
                                                    </td>
                                                    <td style="max-width:200px">
                                                        <?php 
                                                            if(strlen($company_row_array['description']) > 40){
                                                                echo substr($company_row_array['description'],0,40) . "...";
                                                            }else{
                                                                echo $company_row_array['description'];
                                                            }
                                                        ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <img src="<?=($company_image_path . $company_row_array['image'])?>" alt="Image" style="width:60px">
                                                    </td>
                                                    
                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/company-edit/<?=($encoded_company_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a href="/company-view/<?=($encoded_company_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-idcard"></i>
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
        <!-- Company Information Table END-->

        <!-- Company Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">All Facilitys</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Icon</th>
                                <th>Facility</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_company_facility_rows != 0){
                                    foreach($company_facility_result as $key=>$company_facility_row_array){
                                            // Encoding Management Member User ID
                                            $comapny_facility_id = $company_facility_row_array['id'];
                                            $encript_formula = ceil((($comapny_facility_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_company_facility_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <i class="<?=($company_facility_row_array['icon'])?>"></i>
                                                    </td>
                                                    <td>
                                                        <?=($company_facility_row_array['facility'])?>
                                                    </td>
                                                    
                                                    <td class="text-right">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/company-facility-edit/<?=($encoded_company_facility_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a id="/company-facility-delete/<?=($encoded_company_facility_id)?>" class="btn btn-primary btn-tone text-danger facility_del_btn" style="cursor:pointer">
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
                                    echo "You Don't Have Any Data.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Company Information Table END-->



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
    $('.facility_del_btn').click(function(){
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
