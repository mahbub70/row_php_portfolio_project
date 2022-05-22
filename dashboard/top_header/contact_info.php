<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';


    ########################## Query For Collecting Contact Informations From top_header Table on Database START #########################
    $contact_info_result = mysqli_query($db_connect,"SELECT * FROM top_header");
    if(!$contact_info_result){
        header("location: /404-not-found");
    }
    $count_contact_info_rows = mysqli_num_rows($contact_info_result);
    ########################## Query For Collecting Contact Informations From top_header Table on Database END #########################

    ########################## Query For Collecting Contact Informations From top_header Table on Database START #########################
    $social_links_result = mysqli_query($db_connect,"SELECT * FROM social_links ");
    if(!$social_links_result){
        header("location: /404-not-found");
    }
    $count_social_links_rows = mysqli_num_rows($social_links_result);
    ########################## Query For Collecting Contact Informations From top_header Table on Database END #########################


    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Contact Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Contact info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Contact Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Contact Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Phone Icon</th>
                                <th>Phone Number</th>
                                <th>Email Icon</th>
                                <th>Email Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_contact_info_rows != 0){
                                    foreach($contact_info_result as $key=>$contact_info_array){
                                            // Encoding Management Member User ID
                                            $contact_info_id = $contact_info_array['id'];
                                            $encript_formula = ceil((($contact_info_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_contact_info_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <i class="<?=($contact_info_array['contact_icon'])?>"></i>
                                                    </td>
                                                    <td>
                                                        <?=($contact_info_array['contact_number'])?>
                                                    </td>
                                                    <td>
                                                        <i class="<?=($contact_info_array['email_icon'])?>"></i>
                                                    </td>
                                                    <td>
                                                        <?=($contact_info_array['contact_email'])?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($contact_info_array['status'] == 0){
                                                        ?>
                                                            <a href="/change-status/<?=($encoded_contact_info_id)?>" class="btn btn-default m-r-5">Deactive</a>
                                                        <?php        
                                                            }else{
                                                        ?>
                                                            <a href="/change-status/<?=($encoded_contact_info_id)?>" class="btn btn-success m-r-5">Active</a>
                                                        <?php        
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/edit-contact-info/<?=($encoded_contact_info_id)?>" class="btn btn-primary btn-tone ">
                                                            <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            
                                                            <a id="/delete-contact-info/<?=($encoded_contact_info_id)?>" class="btn btn-primary btn-tone text-danger contact_del_btn" style="cursor:pointer">
                                                                <i class="anticon anticon-delete"></i>
                                                            </a>
                                                        <?php        
                                                            }elseif($login_user_array['role'] == 2){ // Admin Access
                                                        ?>
                                                                <a href="/edit-contact-info/<?=($encoded_contact_info_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                                </a>
                                                                
                                                                <a id="/delete-contact-info/<?=($encoded_contact_info_id)?>" class="btn btn-primary btn-tone contact_del_btn">
                                                                <i class="anticon anticon-delete"></i>
                                                                </a>
                                                        <?php
                                                            }elseif($login_user_array['role'] == 3){ // Modarator Access
                                                        ?>
                                                                <a href="/edit-contact-info/<?=($encoded_contact_info_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                                </a>
                                                                
                                                        <?php
                                                            }elseif($login_user_array['role'] == 4){ // Editor Access
                                                        ?>
                                                                <a href="/edit-contact-info/<?=($encoded_contact_info_id)?>" class="btn btn-primary btn-tone">
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
                                    echo "You Don't Have Any Data About Contact Information. Please Add Data First.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Contact Information Table END-->

        <!-- Social Links Table START -->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Social Links Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Social Site Name</th>
                                <th>Social Site Icon</th>
                                <th>Social Site Link</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_social_links_rows != 0){
                                    foreach($social_links_result as $key=>$social_info_array){
                                            // Encoding Management Member User ID
                                            $social_info_id = $social_info_array['id'];
                                            $encript_formula = ceil((($social_info_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_social_info_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($social_info_array['site_name'])?>
                                                    </td>
                                                    <td>
                                                        <i class="<?=($social_info_array['site_icon'])?>"></i>
                                                    </td>
                                                    <td>
                                                        <?=($social_info_array['site_link'])?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($social_info_array['status'] == 0){
                                                        ?>
                                                            <a href="/change-social-status/<?=($encoded_social_info_id)?>" class="btn btn-default m-r-5">Deactive</a>
                                                        <?php        
                                                            }else{
                                                        ?>
                                                            <a href="/change-social-status/<?=($encoded_social_info_id)?>" class="btn btn-success m-r-5">Active</a>
                                                        <?php        
                                                            }
                                                        ?>
                                                        
                                                    </td>
                                                    <td class="text-right">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/social-link-edit/<?=($encoded_social_info_id)?>" class="btn btn-primary btn-tone">
                                                            <i class="anticon anticon-edit"></i>
                                                            </a>
                    
                                                            <a id="/social-link-delete/<?=($encoded_social_info_id)?>" class="btn btn-primary btn-tone social_link_del_btn text-danger" style="cursor:pointer">
                                                                <i class="anticon anticon-delete"></i>
                                                            </a>
                                                        <?php        
                                                            }elseif($login_user_array['role'] == 2){ // Admin Access
                                                        ?>
                                                                <a href="/social-link-edit/<?=($encoded_social_info_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                                </a>
                                                                
                                                                <a id="/social-link-delete/<?=($encoded_social_info_id)?>" class="btn btn-primary btn-tone social_link_del_btn">
                                                                <i class="anticon anticon-delete"></i>
                                                                </a>
                                                        <?php
                                                            }elseif($login_user_array['role'] == 3){ // Modarator Access
                                                        ?>
                                                                <a href="/social-link-edit/<?=($encoded_social_info_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                                </a>
                                                                
                                                        <?php
                                                            }elseif($login_user_array['role'] == 4){ // Editor Access
                                                        ?>
                                                                <a href="/social-link-edit/<?=($encoded_social_info_id)?>" class="btn btn-primary btn-tone">
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
                                    echo "You Don't Have Any Data About Social Links. Please Add Social Information First.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Social Links Table END -->
    </div>
</div>
<!-- Content Wrapper END -->


<?php 
    // Includes Footer File
    require '../includes/footer.php';
?>

<?php 
    if(isset($_SESSION['query_faild'])){
?>
    <script>
        Swal.fire(
            '<?=($_SESSION['query_faild'])?>',
            'Query Faild!',
            'error'
        )
    </script>
<?php        
    }
    unset($_SESSION['query_faild']);

    if(isset($_SESSION['insert_success'])){
?>
    <script>
        Swal.fire(
            'Success!',
            '<?=($_SESSION['insert_success'])?>',
            'success'
        )
    </script>
<?php        
    }
    unset($_SESSION['insert_success']);

    if(isset($_SESSION['contact_info_delete_success'])){
?>
    <script>
        Swal.fire(
            'Success!',
            '<?=($_SESSION['contact_info_delete_success'])?>',
            'success'
        )
    </script>
<?php        
    }
    unset($_SESSION['contact_info_delete_success']);

    if(isset($_SESSION['delete_faild'])){
?>
    <script>
        Swal.fire(
            'Faild!',
            '<?=($_SESSION['delete_faild'])?>',
            'error'
        )
    </script>
<?php        
    }
    unset($_SESSION['delete_faild']);
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
    $('.contact_del_btn').click(function(){
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

<script>
    $('.social_link_del_btn').click(function(){
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