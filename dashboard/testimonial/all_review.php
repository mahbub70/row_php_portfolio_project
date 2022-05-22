<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ###################### Query For All Review START #########################
    $review_query_result = mysqli_query($db_connect,"SELECT * FROM reviews WHERE status=1");
    if(!$review_query_result){
        header("location: /403-forbidden");
    }
    ###################### Query Users All Review START #########################



    // Header File Includes
    require "../includes/header.php";
?>
        
        <style>
            .fa-star.checked{
                color:#FF9529;
            }
        </style>

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
                        <h6 class="mb-0">Total Review (<?=(mysqli_num_rows($review_query_result))?>)</h6>
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
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(mysqli_num_rows($review_query_result) != 0){
                                                foreach($review_query_result as $review_row_array){
                                                    
                                                        // Encoding Management Member User ID
                                                        $review_id = $review_row_array['id'];
                                                        $encript_formula = ceil((($review_id * 123465789 * 98765) / 56789));
                                                        $encoded_id = base64_encode($encript_formula);
                                                        $encoded_review_id = preg_replace('/=/i','',$encoded_id);

                                                        $client_id = $review_row_array['client_id'];

                                                        // Query For Getting Client Information
                                                        $client_info_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$client_id");

                                                        if(!$client_info_result){
                                                            header("location: /403-forbidden");
                                                        }

                                                        $client_info_array = mysqli_fetch_assoc($client_info_result);

                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="media align-items-center">
                                                                        <div class="avatar avatar-image">
                                                                            <img src="<?=($user_image_path.$client_info_array['profile_image'])?>" alt="Profile Image">
                                                                        </div>
                                                                        <div class="media-body m-l-15">
                                                                            <h6 class="mb-0"><?=($client_info_array['full_name'])?></h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                
                                                                <td>
                                                                    <?php 
                                                                        for($i = 1; $i <= 5; $i++){
                                                                    ?>
                                                                        <span class="fa fa-star <?=($i <= $review_row_array['rating'])?("checked"):("")?>"></span>
                                                                    <?php        
                                                                        }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                    <?php 
                                                                        if(strlen($review_row_array['review']) > 40){
                                                                            echo substr($review_row_array['review'],0,40) . "...";
                                                                        }else{
                                                                            echo $review_row_array['review'];
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td class="text-right">
                                                                <?php 
                                                                        if($login_user_array['role'] == 1){ // Super Admin Access
                                                                    ?>
                                                                        <a href="/user-profile/<?=($encoded_review_id)?>" class="btn btn-primary btn-tone">
                                                                            <i class="anticon anticon-idcard"></i>
                                                                        </a>
                                                                        <a id="/delete-review/<?=($encoded_review_id)?>/publish" class="btn btn-primary btn-tone review_del_btn text-danger" style="cursor:pointer">
                                                                            <i class="anticon anticon-delete"></i>
                                                                        </a>
                                                                    <?php        
                                                                        }elseif($login_user_array['role'] == 2){ // Admin Access
                                                                            if($member_row_array['role'] >= $login_user_array['role']){
                                                                    ?>
                                                                            <a href="/user-profile/<?=($encoded_review_id)?>" class="btn btn-primary btn-tone">
                                                                                <i class="anticon anticon-idcard"></i>
                                                                            </a>
                                                                            <a id="/delete-review/<?=($encoded_review_id)?>/publish" class="btn btn-primary btn-tone review_del_btn">
                                                                            <i class="anticon anticon-delete"></i>
                                                                            </a>
                                                                    <?php            
                                                                            }
                                                                        }elseif($login_user_array['role'] == 3){ // Modarator Access
                                                                            if($member_row_array['role'] >= $login_user_array['role']){
                                                                    ?>
                                                                            <a href="/user-profile/<?=($encoded_review_id)?>" class="btn btn-primary btn-tone">
                                                                                <i class="anticon anticon-idcard"></i>
                                                                            </a>
                                                                    <?php        
                                                                            }
                                                                        }elseif($login_user_array['role'] == 4){ // Editor Access
                                                                            if($member_row_array['role'] >= $login_user_array['role']){
                                                                    ?>
                                                                            <a href="/user-profile/<?=($encoded_review_id)?>" class="btn btn-primary btn-tone">
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
    $('.review_del_btn').click(function(){
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