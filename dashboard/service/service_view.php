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
    $service_view_result = mysqli_query($db_connect,"SELECT * FROM services WHERE id = $id");
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
        <h2 class="header-title">Service View</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="/service-info">Service Info</a>
                <span class="breadcrumb-item active">Single Service</span>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="card p-10">
                <div class="p-10 m-auto" style="width:500px;height:300px">
                    <img src="<?=($service_image_path . $service_info_array['image'])?>" alt="" style="width:100%;height:100%;object-fit:cover">
                </div>
                <hr>
                <h4><strong>Title:</strong> <?=($service_info_array['title'])?></h4>
                <hr>
                <p><strong>Description:</strong> <?=($service_info_array['description'])?></p>
            </div>
        </div>
        
    </div>
</div>    




<?php 
    // Footer File Include
    require "../includes/footer.php";
?>