<?php 
    session_start();

    // Include Database Part
    require "../includes/db.php";

    // Receive Url Code That encode using base64encode() function
    $recv_encoded_user_id = $_GET['id'];
    $decode_encoded_user_id = base64_decode($recv_encoded_user_id);
    $make_int_encoded_user_id = intval($decode_encoded_user_id);
    $decript_formula = floor(((($make_int_encoded_user_id * 56789)/98765)/123465789));

    // Receive Acual ID
    $id = $decript_formula;


    // Get Single Message Information
    $single_message_result = mysqli_query($db_connect,"SELECT * FROM messages WHERE id=$id");
    if($single_message_result){
        // Message Status Update
        $update_message_status = mysqli_query($db_connect,"UPDATE messages SET status=1 WHERE id=$id");
        if(!$update_message_status){
            header("location: /403-forbidden");
        }
    }else{
        header("location: /403-forbidden");
    }
    $single_message_array = mysqli_fetch_assoc($single_message_result);

    // Include Header Part
    require "../includes/header.php";

?>

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Messages View</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Single Message</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">

        <!-- Service Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">View Message</h4>
            </div>
            <div class="card-body">
                <p><?=($single_message_array['message'])?></p>
                <hr>
                <h4>Sender Information</h4>
                <p><strong>Name: </strong><?=($single_message_array['name'])?></p>
                <p><strong>Email: </strong><?=($single_message_array['email'])?></p>
                <p><strong>Subject: </strong><?=($single_message_array['subject'])?></p>
            </div>
        </div>
        <!-- Service Information Table END-->

    </div>
</div>
<!-- Content Wrapper END -->





<?php 
    // inlcude footer part
    require "../includes/footer.php";
?>