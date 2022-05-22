<?php 
    session_start();

    // Include Database File
    require '../includes/db.php';


    // Include Header File
    require '../includes/header.php';
?>

<style>
    .fa-star.checked{
        color:#FF9529;
    }
    .review_box{
        position:relative;
    }
    .review_box .count_box{
        position:absolute;
        right:0;
        top:5px;
        font-size: 12px;
    }
    .rating span{
        font-size: 18px;
        cursor: pointer;
    }
</style>

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Add Review</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Add review</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <div class="col-md-8 m-auto">
            <div class="card" style="border:1px solid #ddd">
                <div class="card-body">
                    <form id="ratingForm">
                        
                        <div class="form-group">
                            <label for="">Select Client</label>
                            <select name="client" id="select_client" class="form-control">
                                <option value="" selected disabled>Choose One</option>
                                <option value="1">Mahbub</option>
                            </select>
                            <div class="invalid-feedback" id="select_err"></div>
                        </div>

                        <div class="form-group rating">
                            <label for="">Give Rating</label><br>
                            <span class="fa fa-star" data-count="1"></span>
                            <span class="fa fa-star" data-count="2"></span>
                            <span class="fa fa-star" data-count="3"></span>
                            <span class="fa fa-star" data-count="4"></span>
                            <span class="fa fa-star" data-count="5"></span>
                            <div><small id="rating_err" style="color:red"></small></div>
                        </div>
                        <div class="form-group review_box">
                            <label for="formGroupExampleInput2">Give Review</label>
                            <textarea type="text" class="form-control review_input" id="formGroupExampleInput2" placeholder="Enter Your Review" name="desc"></textarea>
                            <div class="count_box"><span id="type_count">0</span>/<span>500</span></div>
                            <div class="invalid-feedback" id="review_err"></div>
                        </div>

                        <button type="submit" name="review_submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper END -->



<?php 
    // Includes Footer File
    require '../includes/footer.php';
    
?>

<script src="/dashboard/assets/js/rating.js"></script>