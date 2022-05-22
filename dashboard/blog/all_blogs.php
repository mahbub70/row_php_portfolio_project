
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';


    // Query For All Blogs START
    $all_blog_result = mysqli_query($db_connect,"SELECT * FROM blogs ");
    if(!$all_blog_result){
        header("location: /403-forbidden");
    }
    // Query For All Blogs END

    // Blog Image Path 
    $blog_image_path = "/dashboard/img/blog_images/";


    // Includes Header File
    require '../includes/header.php';
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Blog List</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Blog List</span>
            </nav>
        </div>
    </div>
    <div class="container">
        <?php 
            if(mysqli_num_rows($all_blog_result) !=0){
                foreach($all_blog_result as $blog_row_array){
                    // Encoding Blog ID
                    $blog_id = $blog_row_array['id'];
                    $encript_formula = ceil((($blog_id * 123465789 * 98765) / 56789));
                    $encoded_id = base64_encode($encript_formula);
                    $encoded_blog_id = preg_replace('/=/i','',$encoded_id);


                    // Blog Created user Id
                    $blog_created_user_id = $blog_row_array['created_user_id'];

                    // Query For Getting Created User Information
                    $created_user_info_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$blog_created_user_id");
                    if(!$created_user_info_result){
                        header("location: /403-forbidden");
                    }
                    if(mysqli_num_rows($created_user_info_result) != 0){
                        $created_user_array = mysqli_fetch_assoc($created_user_info_result);
                    }
                    
                    
        ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <?php 
                                if($blog_row_array['image'] != ""){
                            ?>
                                <div class="col-md-4">
                                    <img class="img-fluid" src="<?=($blog_image_path.$blog_row_array['image'])?>" alt="" style="max-height:170px;object-fit:cover; width:310px">
                                </div>
                            <?php        
                                }
                            ?>
                            
                            <div class="col-md-<?=($blog_row_array['image'] != "")?("8"):("12")?>">
                                <h4 class="m-b-10"><?=($blog_row_array['title'])?></h4>
                                <div class="d-flex align-items-center m-t-5 m-b-15">
                                    <div class="avatar avatar-image avatar-sm">
                                        <?php 
                                            if(mysqli_num_rows($created_user_info_result) != 0){
                                        ?>
                                            <img src="<?=($user_image_path.$created_user_array['profile_image'])?>" alt="">
                                        <?php        
                                            }
                                        ?>
                                        
                                    </div>
                                    <div class="m-l-10">
                                        <?php 
                                            if(mysqli_num_rows($created_user_info_result) != 0){
                                        ?>
                                            <span class="text-gray font-weight-semibold"><?=($created_user_array['full_name'])?></span>
                                        <?php        
                                            }else{
                                        ?>
                                            <span class="text-gray font-weight-semibold">Unknown</span>
                                        <?php        
                                            }
                                        ?>
                                        
                                        <span class="m-h-5 text-gray">|</span>
                                        <span class="text-gray"><?=($blog_row_array['created_at'])?></span>
                                    </div>
                                </div>
                                <p class="m-b-20"><?=($blog_row_array['description'])?></p>
                                <div class="text-right">
                                    <a class="btn btn-hover font-weight-semibold" href="/single_blog/<?=($encoded_blog_id)?>">
                                        <span>Read More</span>
                                    </a>
                                    <?php 
                                        if($login_user_id == 1){
                                    ?>
                                        <a id="/delete-blog/<?=($encoded_blog_id)?>/view-blogs" class="btn btn-danger blog_del_btn text-white" role="button" style="cursor:pointer">Delete</a>
                                    <?php        
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
                }        
            }else{
                echo "You don't have any blog.";
            }
        ?>
    </div>
    <!-- <div class="m-t-30">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div> -->
</div>
<!-- Content Wrapper END -->



<?php 
    // Includes Footer File
    require '../includes/footer.php';
    
    unset($_SESSION['errors']);
    unset($_SESSION['old_values']);

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
    $('.blog_del_btn').click(function(){
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