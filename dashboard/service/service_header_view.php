<?php 
    session_start();

    // Database Connection Start
    require "../includes/db.php";

    // Receive User Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive User Acual ID
    $id = $decript_formula;

    // Service View Result
    $service_view_result = mysqli_query($db_connect,"SELECT * FROM service_header WHERE id = $id");
    if(!$service_view_result){
        header("location: /403-forbidden");
    }
    $service_info_array = mysqli_fetch_assoc($service_view_result);

    // Service Image Path
    $service_image_path = "/dashboard/img/service_images/";



    // Header File Include
    require "../includes/header.php";
?>



<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Service Header View</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="/service-info">Service Header</a>
                <span class="breadcrumb-item active">Service Header</span>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="card p-10">
                <hr>
                <h5><strong>Small Title:</strong> <?=($service_info_array['small_title'])?></h5>
                <h3><strong>Big Title:</strong> <?=($service_info_array['big_title'])?></h3>
                <hr>
                <p><strong>Description:</strong> <?=($service_info_array['text'])?></p>
            </div>
        </div>
        
    </div>
</div>    




<?php 
    // Footer File Include
    require "../includes/footer.php";
?>