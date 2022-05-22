
<?php
    session_start();

    // Database Connection File
    require './includes/db.php';

    ############ TOTAL CLIENT RESULT START ######################
    $total_client_result = mysqli_query($db_connect,"SELECT * FROM users WHERE role=5");
    if(!$total_client_result){
        header("location: /403-forbidden");
    }
    $count_client = mysqli_num_rows($total_client_result);

    // Five Start Rating Count
    $five_star_review_result = mysqli_query($db_connect,"SELECT * FROM reviews WHERE rating=5");
    if(!$five_star_review_result){
        header("location: /403-forbidden");
    }
    $count_five_star_review = mysqli_num_rows($five_star_review_result);


    // Total Award 
    $counter_result = mysqli_query($db_connect,"SELECT * FROM counters WHERE id=1");
    if(!$counter_result){
        header("location: /403-forbidden");
    }
    $counter_array = mysqli_fetch_assoc($counter_result);


    // Count Active Menus
    $active_menus_result = mysqli_query($db_connect,"SELECT * FROM menu WHERE status=1");
    if(!$active_menus_result){
        header("location: /403-forbidden");
    }
    $count_menus = mysqli_num_rows($active_menus_result);

    // Count Active Features
    $active_features_result = mysqli_query($db_connect,"SELECT * FROM features WHERE status=1");
    if(!$active_features_result){
        header("location: /403-forbidden");
    }
    $count_features = mysqli_num_rows($active_features_result);


    // Count Active Features
    $active_services_result = mysqli_query($db_connect,"SELECT * FROM services WHERE status=1");
    if(!$active_services_result){
        header("location: /403-forbidden");
    }
    $count_services = mysqli_num_rows($active_services_result);

    // Count Active Packages
    $active_package_result = mysqli_query($db_connect,"SELECT * FROM packages WHERE status=1");
    if(!$active_package_result){
        header("location: /403-forbidden");
    }
    $count_packages = mysqli_num_rows($active_package_result);

    // Count All Subscriber
    $all_subscriber_result = mysqli_query($db_connect,"SELECT * FROM subscribers ");
    if(!$all_subscriber_result){
        header("location: /403-forbidden");
    }
    $count_subscribers = mysqli_num_rows($all_subscriber_result);

    // Count All Messages
    $all_message_result = mysqli_query($db_connect,"SELECT * FROM messages ");
    if(!$all_message_result){
        header("location: /403-forbidden");
    }
    $count_messages = mysqli_num_rows($all_message_result);

    // Count All Users
    $all_user_result = mysqli_query($db_connect,"SELECT * FROM users WHERE role=6 ");
    if(!$all_user_result){
        header("location: /403-forbidden");
    }
    $count_users = mysqli_num_rows($all_user_result);

    // Count All Blogs
    $all_blog_result = mysqli_query($db_connect,"SELECT * FROM blogs ");
    if(!$all_blog_result){
        header("location: /403-forbidden");
    }
    $count_blogs = mysqli_num_rows($all_blog_result);

    // Header File Includes
    require "./includes/header.php";
?>

<!-- Content Wrapper START -->
<div class="main-content">
        <div class="row">
            <h4 class="ml-4"><?=($manage_designation[$login_user_array['role']])?></h4>
        </div>

    <?php 
        if($login_user_array['role'] != 6){ ?> <!--Management Access-->

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($count_client)?></h2>
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
                            <h2 class="m-b-0"><?=($count_five_star_review)?></h2>
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
                            <h2 class="m-b-0"><?=($counter_array['award'])?></h2>
                            <p class="m-b-0 text-muted">Award</p>
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
                            <i class="anticon anticon-user"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($counter_array['complete_project'])?></h2>
                            <p class="m-b-0 text-muted">Complete Project</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                            <i class="anticon anticon-appstore"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($count_menus)?></h2>
                            <p class="m-b-0 text-muted">Active Menus</p>
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
                            <i class="fab fa-microsoft"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($count_features)?></h2>
                            <p class="m-b-0 text-muted">Active Features</p>
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
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($count_services)?></h2>
                            <p class="m-b-0 text-muted">Active Services</p>
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
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($count_packages)?></h2>
                            <p class="m-b-0 text-muted">Active Packages</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                            <i class="fab fa-google-play"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($count_subscribers)?></h2>
                            <p class="m-b-0 text-muted">All Subscribers</p>
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
                            <i class="fab fa-facebook-messenger"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($count_messages)?></h2>
                            <p class="m-b-0 text-muted">All Messages</p>
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
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($count_users)?></h2>
                            <p class="m-b-0 text-muted">All Users</p>
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
                            <i class="far fa-edit"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0"><?=($count_blogs)?></h2>
                            <p class="m-b-0 text-muted">All Blogs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>

</div>
<!-- Content Wrapper END -->


<?php 
    // Footer File Includes
    require "./includes/footer.php";
?>

<?php 
    if(isset($_SESSION['login_sweet_alart'])){
?>
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: 'Signed in successfully'
        })
    </script>
<?php        
    }
    unset($_SESSION['login_sweet_alart']);
?>

    
    