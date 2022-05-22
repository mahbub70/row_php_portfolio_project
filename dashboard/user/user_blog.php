<?php 
    session_start();

    // Database Connection Start
    require '../includes/db.php';



    // Header File Includes 
    require "../includes/header.php";


    // Check Login User is User or not
    if($login_user_array['role'] != 6){
        header("location: /sign-out");
    }


    ###################### Query For Login User Blog START #########################
    $blog_query_result = mysqli_query($db_connect,"SELECT * FROM blogs WHERE created_user_id=$login_user_id");
    if(!$blog_query_result){
        header("location: /403-forbidden");
    }
    ###################### Query For Login User Blog START #########################

    // Blog Image Path
    $blog_image_path = "/dashboard/img/blog_images/";

?>



<!-- Content Wrapper START -->
<div class="main-content col-md-10 mt-4">
    <div class="page-header no-gutters">
        <div class="row align-items-md-center">
            <div class="col-md-6">
                <div class="media m-v-10">
                    <div class="avatar avatar-cyan avatar-icon avatar-square">
                        <i class="anticon anticon-star"></i>
                    </div>
                    <div class="media-body m-l-15">
                        <h6 class="mb-0">My Blogs (<?=(mysqli_num_rows($blog_query_result))?>)</h6>
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
                                            <th>SL NO</th>
                                            <th>Blog Image</th>
                                            <th>Blog Title</th>
                                            <th>Blog Description</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(mysqli_num_rows($blog_query_result) != 0){
                                                foreach($blog_query_result as $key=>$blog_row_array){
                                                    
                                                // Encoding Management Member User ID
                                                $blog_id = $blog_row_array['id'];
                                                $encript_formula = ceil((($blog_id * 123465789 * 98765) / 56789));
                                                $encoded_id = base64_encode($encript_formula);
                                                $encoded_blog_id = preg_replace('/=/i','',$encoded_id);


                                        ?>
                                        <tr>
                                            <td>
                                                <?=($key + 1)?>
                                            </td>
                                            
                                            <td>
                                                <?php 
                                                    if($blog_row_array['image'] != ""){
                                                ?>
                                                    <img src="<?=($blog_image_path.$blog_row_array['image'])?>" alt="Blog Image" style="max-width:65px">
                                                <?php        
                                                    }else{
                                                        echo "Image Not Available.";
                                                    }
                                                ?>
                                            </td>
                                            <td><?=($blog_row_array['title'])?></td>
                                            <td>
                                                <?php 
                                                    if(strlen($blog_row_array['description']) > 40){
                                                        echo substr($blog_row_array['description'],0,40) . "...";
                                                    }else{
                                                        echo $blog_row_array['description'];
                                                    }
                                                ?>
                                            </td>
                                            
                                            <td class="text-right">

                                                <a href="/single_blog/<?=($encoded_blog_id)?>" class="btn btn-primary btn-tone">
                                                    <i class="anticon anticon-idcard"></i>
                                                </a>
                                                <a id="/delete-blog/<?=($encoded_blog_id)?>/user-blog" class="btn btn-primary btn-tone blog_del_btn text-danger" style="cursor:pointer">
                                                    <i class="anticon anticon-delete"></i>
                                                </a>
                                            
                                            </td>
                                        </tr>
                                        <?php                
                                                    
                                                }
                                            }else{
                                                echo "You Don't Have Any Blogs.";
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
?> 