<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ###################### Query For Users START #########################
    $users_query_result = mysqli_query($db_connect,"SELECT * FROM users WHERE status=1");
    ###################### Query Users END #########################

    // Count Users
    $users_count = 0;
    foreach($users_query_result as $users_row_array){
        if($users_row_array['role'] == 5 || $users_row_array['role'] == 6){
            $users_count++;
        }
    }


    // Header File Includes
    require "../includes/header.php";
?>
           

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header no-gutters">
        <div class="row align-items-md-center">
            <div class="col-md-6">
                <div class="media m-v-10">
                    <div class="avatar avatar-cyan avatar-icon avatar-square">
                        <i class="anticon anticon-star"></i>
                    </div>
                    <div class="media-body m-l-15">
                        <h6 class="mb-0">All Users & Client (<?=($users_count)?>)</h6>
                        <span class="text-gray font-size-13">Dev Team</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-md-right m-v-10">
                    <div class="btn-group">
                        <button id="list-view-btn" type="button" class="btn btn-default btn-icon active">
                            <i class="anticon anticon-ordered-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <div class="row" id="list-view">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($users_count != 0){
                                                foreach($users_query_result as $user_row_array){
                                                    if($user_row_array['role'] == 5 || $user_row_array['role'] == 6){
                                                        // Encoding Management Member User ID
                                                        $user_id = $user_row_array['id'];
                                                        $encript_formula = ceil((($user_id * 123465789 * 98765) / 56789));
                                                        $encoded_id = base64_encode($encript_formula);
                                                        $encoded_user_id = preg_replace('/=/i','',$encoded_id);
                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="media align-items-center">
                                                                        <div class="avatar avatar-image">
                                                                            <img src="<?=($user_image_path.$user_row_array['profile_image'])?>" alt="Profile Image">
                                                                        </div>
                                                                        <div class="media-body m-l-15">
                                                                            <h6 class="mb-0"><?=($user_row_array['full_name'])?></h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><?=($user_row_array['email'])?></td>
                                                                <td>
                                                                <span class="badge badge-pill badge-blue"><?=($manage_designation[$user_row_array['role']])?></span>
                                                                </td>
                                                                <td class="text-right">
                                                                <?php 
                                                                        if($login_user_array['role'] == 1){ // Super Admin Access
                                                                    ?>
                                                                        <a href="/user-profile-update/<?=($encoded_user_id)?>" class="btn btn-primary btn-tone">
                                                                        <i class="anticon anticon-edit"></i>
                                                                        </a>
                                                                        <a href="/user-profile/<?=($encoded_user_id)?>" class="btn btn-primary btn-tone">
                                                                            <i class="anticon anticon-idcard"></i>
                                                                        </a>
                                                                        <a id="/user-soft-delete/<?=($encoded_user_id)?>/user" class="btn btn-primary btn-tone soft_del_btn text-danger" style="cursor:pointer">
                                                                            <i class="anticon anticon-delete"></i>
                                                                        </a>
                                                                    <?php        
                                                                        }elseif($login_user_array['role'] == 2){ // Admin Access
                                                                            if($member_row_array['role'] >= $login_user_array['role']){
                                                                    ?>
                                                                            <a href="/user-profile-update/<?=($encoded_user_id)?>" class="btn btn-primary btn-tone">
                                                                            <i class="anticon anticon-edit"></i>
                                                                            </a>
                                                                            <a href="/user-profile/<?=($encoded_user_id)?>" class="btn btn-primary btn-tone">
                                                                                <i class="anticon anticon-idcard"></i>
                                                                            </a>
                                                                            <a id="/user-soft-delete/<?=($encoded_user_id)?>/user" class="btn btn-primary btn-tone soft_del_btn">
                                                                            <i class="anticon anticon-delete"></i>
                                                                            </a>
                                                                    <?php            
                                                                            }
                                                                        }elseif($login_user_array['role'] == 3){ // Modarator Access
                                                                            if($member_row_array['role'] >= $login_user_array['role']){
                                                                    ?>
                                                                            <a href="/user-profile-update/<?=($encoded_user_id)?>" class="btn btn-primary btn-tone">
                                                                            <i class="anticon anticon-edit"></i>
                                                                            </a>
                                                                            <a href="/user-profile/<?=($encoded_user_id)?>" class="btn btn-primary btn-tone">
                                                                                <i class="anticon anticon-idcard"></i>
                                                                            </a>
                                                                    <?php        
                                                                            }
                                                                        }elseif($login_user_array['role'] == 4){ // Editor Access
                                                                            if($member_row_array['role'] >= $login_user_array['role']){
                                                                    ?>
                                                                            <a href="/user-profile-update/<?=($encoded_user_id)?>" class="btn btn-primary btn-tone">
                                                                            <i class="anticon anticon-edit"></i>
                                                                            </a>
                                                                            <a href="/user-profile/<?=($encoded_user_id)?>" class="btn btn-primary btn-tone">
                                                                                <i class="anticon anticon-idcard"></i>
                                                                            </a>
                                                                    <?php      
                                                                            }
                                                                        }
                                                                        
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                <?php                
                                                            }
                                                        }
                                                    }else{
                                                        echo "You Don't Have Any Users.";
                                                    }
                                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- Content Wrapper END -->

    
<?php 
    // Footer File Includes
    require "../includes/footer.php";
?>

<script>
    $('.soft_del_btn').click(function(){
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

<?php 
    if(isset($_SESSION['soft_del_success'])){
?>
    <script>
        Swal.fire(
            'Deleted',
            '<?=($_SESSION['soft_del_success'])?>',
            'success'
        )
    </script>
<?php        
    }
    unset($_SESSION['soft_del_success']);

    if(isset($_SESSION['soft_del_faild'])){
?>
    <script>
            Swal.fire(
                'Deleted',
                '<?=($_SESSION['soft_del_faild'])?>',
                'error'
            )
        </script>
<?php        
    }
    unset($_SESSION['soft_del_faild']);
?>

<?php

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