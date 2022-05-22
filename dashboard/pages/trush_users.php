<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    ###################### Query For All Management Members START #########################
    $trush_query_result = mysqli_query($db_connect,"SELECT * FROM users WHERE status=0");
    ###################### Query For All Management Members END #########################

    // Count Management Members
    $trush_user_count = mysqli_num_rows($trush_query_result);

    // Includes Header Part
    require '../includes/header.php';
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
                        <h6 class="mb-0">Trush Members (<?=($trush_user_count)?>)</h6>
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
                                                <th>Designation</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if($trush_user_count != 0){
                                                    foreach($trush_query_result as $trush_row_array){
                                                            // Encoding Management Member User ID
                                                            $user_id = $trush_row_array['id'];
                                                            $encript_formula = ceil((($user_id * 123465789 * 98765) / 56789));
                                                            $encoded_id = base64_encode($encript_formula);
                                                            $encoded_management_user_id = preg_replace('/=/i','',$encoded_id);
                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="media align-items-center">
                                                                            <div class="avatar avatar-image">
                                                                                <img src="<?=($user_image_path.$trush_row_array['profile_image'])?>" alt="Profile Image">
                                                                            </div>
                                                                            <div class="media-body m-l-15">
                                                                                <h6 class="mb-0"><?=($trush_row_array['full_name'])?></h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td><?=($trush_row_array['email'])?></td>
                                                                    <td>
                                                                    <span class="badge badge-pill badge-blue"><?=($manage_designation[$trush_row_array['role']])?></span>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <?php 
                                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                                        ?>
                                                                            <a id="/restore-user/<?=($encoded_management_user_id)?>" class="btn btn-primary btn-tone restore_btn" style="cursor:pointer">
                                                                            <i class="anticon anticon-undo"></i>
                                                                            </a>
                                                                            <a id="/permanent-del-user/<?=($encoded_management_user_id)?>" class="btn btn-primary btn-tone delete_btn" style="cursor:pointer">
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
                                                    echo "You Don't Have Any Trush Member.";
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
    // Include Footer Part
    require '../includes/footer.php';
?>

<script>
    $('.restore_btn').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "to restore user",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Restore it!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = $(this).attr('id');
        }
        })
    });
</script>

<script>
    $('.delete_btn').click(function(){
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
    if(isset($_SESSION['restore_success'])){
?>
    <script>
        Swal.fire(
            'Success',
            '<?=($_SESSION['restore_success'])?>',
            'success'
        )
    </script>
<?php
    }
    unset($_SESSION['restore_success']);

    if(isset($_SESSION['restore_faild'])){
?>
    <script>
        Swal.fire(
            'Faild!',
            '<?=($_SESSION['restore_faild'])?>',
            'error'
        )
    </script>
<?php        
    }
    unset($_SESSION['restore_faild']);

    if(isset($_SESSION['delete_success'])){
?>
    <script>
        Swal.fire(
            'Success',
            '<?=($_SESSION['delete_success'])?>',
            'success'
        )
    </script>
<?php        
    }
    unset($_SESSION['delete_success']);
    
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
?>