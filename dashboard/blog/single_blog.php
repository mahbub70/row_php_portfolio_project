
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    // Receive Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive Acual ID
    $id = $decript_formula;


    // Make Date And Time
    date_default_timezone_set('asia/dhaka');
    $comment_date = date('M d, Y');


    // Query For Single Blogs START
    $single_blog_result = mysqli_query($db_connect,"SELECT * FROM blogs WHERE id=$id");
    if(!$single_blog_result){
        header("location: /403-forbidden");
    }
    // Query For Single Blogs END
    $single_blog_array = mysqli_fetch_assoc($single_blog_result);

    // Blog Created User ID
    $created_user_id = $single_blog_array['created_user_id'];

    // Query For Blog Created User
    $blog_created_user_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$created_user_id");
    if(!$blog_created_user_result){
        header("location: /403-forbidden");
    }
    $blog_created_info = mysqli_fetch_assoc($blog_created_user_result);
    // Query For Blog Created User


    // Blog Image Path 
    $blog_image_path = "/dashboard/img/blog_images/";


    // Get Likers ID
    $likers_id = $single_blog_array['likers_id'];
    
    // Make likers ID Array
    $likers_id_array = explode(",",$likers_id);


    // Includes Header File
    require '../includes/header.php';

    if(in_array($login_user_id,$likers_id_array)){
        $liked = "";
    }


    // Get Login User Social Links
    $login_user_social_link_result = mysqli_query($db_connect,"SELECT * FROM user_social_links WHERE user_id=$login_user_id");
    if(!$login_user_social_link_result){
        header("location: /403-forbidden");
    }



    // Like Submit Query
    if(isset($_POST['like_submit'])){
        if(!isset($liked)){

            array_push($likers_id_array,$login_user_id);

            // Implode Array for ready to Update Database Likers Id
            $make_likers_id_string = implode(",",$likers_id_array);

            // Get Old total Like
            $old_total_like = $single_blog_array['total_like'];

            $update_total_like = $old_total_like + 1;

            // Update Total Like And Likers String
            $update_like_result = mysqli_query($db_connect,"UPDATE blogs SET total_like='$update_total_like',likers_id='$make_likers_id_string' WHERE id=$id");

        }
    }


    // _______________________________________ AGAIN DEFINE FOR UPDATE WITH REFRASH __________________________________________

    // Query For Single Blogs START
    $single_blog_result = mysqli_query($db_connect,"SELECT * FROM blogs WHERE id=$id");
    if(!$single_blog_result){
        header("location: /403-forbidden");
    }
    // Query For Single Blogs END
    $single_blog_array = mysqli_fetch_assoc($single_blog_result);

    // Get Likers ID
    $likers_id = $single_blog_array['likers_id'];
    
    // Make likers ID Array
    $likers_id_array = explode(",",$likers_id);

    if(in_array($login_user_id,$likers_id_array)){
        $liked = "";
    }


    // Comment Section Start
    if(isset($_POST['comment_submit'])){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $comment = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['comment']));
        }

        if($comment == ""){
            $comment_err = "Please Enter Your Commnet.";
        }elseif(strlen($comment) > 500){
            $comment_err = "Comment Can Contains Maximum 500 Characters.";
        }

        if(!isset($comment_err)){
            // Comment Insert Query
            $insert_comment_result = mysqli_query($db_connect,"INSERT INTO blog_comments(blog_id, commenter_id, comment,created_at) VALUES ('$id','$login_user_id','$comment','$comment_date')");

            if($insert_comment_result){
                $success = "Comment Success";
            }else{
                $faild = "Faild! Please Try Again.";
            }
        }
    }

    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }





    // Single Blog Comment Query Start
    $blog_comment_result = mysqli_query($db_connect,"SELECT * FROM blog_comments WHERE blog_id=$id");
    if(!$blog_comment_result){
        header("location: /403-forbidden");
    }
    // Single Blog Comment Query End

?>
<style>
    .comment_box{
        height:0;
        opacity:0;
        visibility: hidden;
        transition: 0.3s;
    }
    .comment_box.active{
        height:150px;
        opacity:1;
        visibility: visible;
    }
    .outline-none{
        outline:none;
        border:none;
    }
    .comment-btn.active{
        background-color:#3f87f5;
    }
</style>
<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Blog Post</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="/view-blogs">All Blogs</a>
                <span class="breadcrumb-item active">Single Blog</span>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h2 class="font-weight-normal m-b-10"><?=($single_blog_array['title'])?></h2>
                <div class="d-flex m-b-30">
                    <div class="avatar avatar-cyan avatar-img">
                        <img src="<?=($user_image_path.$blog_created_info['profile_image'])?>" alt="">
                    </div>
                    <div class="m-l-15">
                        <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold"><?=($blog_created_info['full_name'])?></a>
                        <p class="m-b-0 text-muted font-size-13"><?=($single_blog_array['created_at'])?></p>
                    </div>
                </div>
                <?php
                    if($single_blog_array['image'] != ''){
                ?>
                    <img alt="" class="img-fluid w-100" src="<?=($blog_image_path.$single_blog_array['image'])?>" style="height:540px;object-fit:cover">
                <?php        
                    }
                ?>
                <div class="m-t-30">
                    <p><?=($single_blog_array['description'])?></p>
                </div>

                <div class="d-flex m-t-40 align-items-center">
                    <?php 
                        if(mysqli_num_rows($login_user_social_link_result) != 0){
                    ?>
                        <span class="m-r-15">Share this post: </span>
                    
                            <ul class="list-inline m-b-0">
                                <?php        
                                    foreach($login_user_social_link_result as $login_user_social_row_array){
                                ?>
                                    <li class="list-inline-item">
                                        <a href="<?=($login_user_social_row_array['link'])?>" class="font-size-16 btn btn-hover btn-icon btn-rounded">
                                            <i class="<?=($login_user_social_row_array['icon'])?>"></i>
                                        </a>
                                    </li>
                                <?php 
                                    }
                                ?>
                            </ul>
                    <?php                    
                        }
                    ?>
                    <button class="btn btn-default ml-5 btn-outline-dark comment-btn outline-none">Comment</button>
                    <form action="" method="POST" id="likeForm" class="<?=(isset($liked)?("liked"):(""))?>">
                        <button class="btn btn-<?=(isset($liked)?('primary'):('default'))?> ml-5 btn-outline-dark outline-none" type="submit" name="like_submit"><i class="far fa-thumbs-up"></i> <span>(<?=($single_blog_array['total_like'])?>)</span></button>
                    </form>
                    
                </div>
                <!-- Commect Box Start -->
                <?php 
                    if(isset($comment_err)){
                ?>
                    <div class="alert alert-warning">
                        <div class="d-flex justify-content-start">
                            <span class="alert-icon m-r-20 font-size-30">
                                <i class="anticon anticon-exclamation-circle"></i>
                            </span>
                            <div>
                                <h5 class="alert-heading">Warning</h5>
                                <p><?=($comment_err)?></p>
                            </div>
                        </div>
                    </div>
                <?php        
                    }
                ?>
                <div class="comment_box mt-2" style="width:60%">
                    <form action="" style="height:100%" method="POST">
                        <div class="form-group d-flex" style="height:100%" >
                            <textarea type="text" name="comment" id="" style="height:100%" class="form-control" placeholder="Write Your Comment"></textarea>
                            <button type="submit" name="comment_submit" class="btn btn-primary ml-3" >Send</button>
                        </div>
                    </form>
                </div>
                <!-- Commect Box End -->
                <hr>
                <?php 
                    if(mysqli_num_rows($blog_comment_result) != 0){
                ?>
                    <h5>Comments (<?=(mysqli_num_rows($blog_comment_result))?>)</h5>
                    <div class="m-t-20">
                        <ul class="list-group list-group-flush">
                            <?php
                                foreach($blog_comment_result as $comment_row_array){
                                    // Commenter Id
                                    $commenter_id = $comment_row_array['commenter_id'];

                                    // Get Commenter Information 
                                    $commenter_info_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$commenter_id");
                                    if(!$commenter_info_result){
                                        header("location: /403-forbidden");
                                    }
                                    $commenter_info_array = mysqli_fetch_assoc($commenter_info_result);
                            ?>
                                <li class="list-group-item p-h-0">
                                    <div class="media m-b-15">
                                        <div class="avatar avatar-image">
                                            <img src="<?=($user_image_path.$commenter_info_array['profile_image'])?>" alt="">
                                        </div>
                                        <div class="media-body m-l-20">
                                            <h6 class="m-b-0">
                                                <a href="#" class="text-dark"><?=($commenter_info_array['full_name'])?></a>
                                            </h6>
                                            <span class="font-size-13 text-gray"><?=($comment_row_array['created_at'])?></span>
                                        </div>
                                    </div>
                                    <span><?=($comment_row_array['comment'])?></span>
                                </li>
                            <?php        
                                }
                            ?>
                            
                        </ul> 
                    </div> 
                    <!-- <div class="m-t-30">
                        <nav>
                            <ul class="pagination justify-content-end">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>  -->
                <?php
                    }else{
                        echo "Don't have any comment.";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper END -->


<?php 
    // Includes Footer File
    require '../includes/footer.php';
    
?>


<script>
    var likeForm = document.getElementById("likeForm");

    if(likeForm.classList.contains('liked')){
        likeForm.addEventListener("submit",function(e){
            e.preventDefault();

            Swal.fire(
                'Warning!',
                'Already Liked!',
                'warning'
            )

        })
    }

    var commentBtn = document.querySelector(".comment-btn");
    var commentBox = document.querySelector(".comment_box");
    commentBtn.addEventListener("click",function(){
        commentBox.classList.toggle("active");
        commentBtn.classList.toggle("active");
    })
</script>

<?php 
    if(isset($success)){
?>
    <script>
        Swal.fire(
                'Success!',
                '<?=($success)?>',
                'success'
            )
    </script>
<?php        
    }
?>
<?php 
    if(isset($faild)){
?>
    <script>
        Swal.fire(
                'Faild!',
                '<?=($faild)?>',
                'error'
            )
    </script>
<?php        
    }
?>