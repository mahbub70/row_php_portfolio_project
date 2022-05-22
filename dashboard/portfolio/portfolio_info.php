

<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';

    $page_uri = $_SERVER['REQUEST_URI'];
    $select_category_from_uri = basename($page_uri);

    // Modify Uri 
    $make_category_name = preg_replace('/-/i',' ',$select_category_from_uri);


    ########################## Query For Collecting Information From Table on Database START #########################
    $portfolio_header_result = mysqli_query($db_connect,"SELECT * FROM portfolio_header");
    if(!$portfolio_header_result){
        header("location: /500-server-error");
    }
    $count_portfolio_header_rows = mysqli_num_rows($portfolio_header_result);
    ########################## Query For Collecting Information From Table on Database END #########################

    ########################## Query For Collecting Portfolio Categores List From Table on Database START #########################
    $portfolio_category_list_result = mysqli_query($db_connect,"SELECT * FROM portfolio_categores");
    if(!$portfolio_category_list_result){
        header("location: /500-server-error");
    }
    $count_portfolio_category_rows = mysqli_num_rows($portfolio_category_list_result);
    ########################## Query For Collecting Portfolio Categores List From Table on Database END #########################




    ############# QUERY FOR DYNAMIC CATEGORY START ########################
    if($select_category_from_uri == "all"){
        $category_query_result = mysqli_query($db_connect,"SELECT * FROM portfolios ");
        if(!$category_query_result){
            header("location: /500-server-error");
        }
    }else{
        $category_query_result = mysqli_query($db_connect,"SELECT * FROM portfolios WHERE category='$select_category_from_uri'");
        if(!$category_query_result){
            header("location: /500-server-error");
        }
    }
    ############# QUERY FOR DYNAMIC CATEGORY END ########################

    // Portfolio Image Path
    $portfolio_image_path = "/dashboard/img/portfolio_images/";

    // Includes Header File
    require '../includes/header.php';

    
?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Portfolio Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Portfolio info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">
        <!-- Service Header Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Portfolio Header Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Small Title</th>
                                <th>Big Title</th>
                                <th>Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($count_portfolio_header_rows != 0){
                                    foreach($portfolio_header_result as $key=>$portfolio_header_row_array){
                                            // Encoding Management Member User ID
                                            $portfolio_header_id = $portfolio_header_row_array['id'];
                                            $encript_formula = ceil((($portfolio_header_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_portfolio_header_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($portfolio_header_row_array['small_title'])?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if(strlen($portfolio_header_row_array['big_title']) > 30){
                                                                echo substr($portfolio_header_row_array['big_title'],0,40) . "...";
                                                            }else{
                                                                echo $portfolio_header_row_array['big_title'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if(strlen($portfolio_header_row_array['text']) > 40){
                                                                echo substr($portfolio_header_row_array['text'],0,40) . "...";
                                                            }else{
                                                                echo $portfolio_header_row_array['text'];
                                                            }
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/portfolio-header-edit/<?=($encoded_portfolio_header_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                            <a href="/portfolio-header-view/<?=($encoded_portfolio_header_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-idcard"></i>
                                                            </a>
                                                        <?php        
                                                            }
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                            <?php                
                                        }
                                }else{
                                    echo "You Don't Have Any Information About Portfolio Header.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Service Header Information Table END-->

        <!-- Category Buttons START -->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">All Category List</h4>
            </div>
            <div class="card-body">
                <?php 
                    if(mysqli_num_rows($portfolio_category_list_result) !=0 ){
                ?>
                    
                    <div class="table-responsive" style="border:1px solid #ddd">
                        <div class="m-3">
                            <a href="/portfolio-info/all" class="btn btn-<?=($select_category_from_uri == "all")?("primary"):("default")?>"> All</a>
                        </div>
                        <table class="table table-hover">
                            
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                
                    <?php 
                        
                            foreach($portfolio_category_list_result as $category_list_array){
                                // Encoding Management Member User ID
                                $category_list_id = $category_list_array['id'];
                                $encript_formula = ceil((($category_list_id * 123465789 * 98765) / 56789));
                                $encoded_id = base64_encode($encript_formula);
                                $encoded_category_id = preg_replace('/=/i','',$encoded_id);

                                $category_name_lower_case = strtolower(preg_replace('/ /i','-',$category_list_array['category_name']));
                    ?>
        
                        <tr>
                            <td><a href="/portfolio-info/<?=($category_name_lower_case)?>" class="btn btn-<?=($select_category_from_uri == $category_name_lower_case)?("primary"):("default")?> mr-2" role="button" id="portfolio_category_btn"><?=($category_list_array['category_name'])?></a></td>

                            <td>
                                
                                <?php
                                    if($category_name_lower_case != "all"){
                                        if($category_list_array['status'] == 0){
                                ?>
                                        <a href="/category-status-change/<?=($encoded_category_id)?>" class="btn btn-default m-r-5">Deactive</a>
                                <?php
                                        }else{
                                ?>
                                        <a href="/category-status-change/<?=($encoded_category_id)?>" class="btn btn-success m-r-5">Active</a>
                                <?php
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($category_name_lower_case != "all"){
                                ?>
                                    <a id="/category-delete/<?=($encoded_category_id)?>" class="btn btn-danger m-r-5 category_del_btn text-white">Delete</a>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                              
                    <?php            
                            }
                        
                    ?>
                            </tbody>
                        </table>
                    </div>
                <?php 
                    }else{
                        echo "Don't Have Any Portfolio Category.";
                    }
                ?>
            </div>
        </div>
        <!-- Category Buttons END -->


        <!-- Portfolio Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Portfolio Table</h4>
            </div>
            <div class="card-body">
                <?php
                    if(mysqli_num_rows($category_query_result) != 0){
                ?>
                <h3 class="btn btn-primary text-capitalize"><?=($make_category_name)?></h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Category</th>
                                <th>Portfolio Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                
                                    foreach($category_query_result as $key=>$portfolio_info_row_array){
                                            // Encoding Management Member User ID
                                            $portfolio_id = $portfolio_info_row_array['id'];
                                            $encript_formula = ceil((($portfolio_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_portfolio_id = preg_replace('/=/i','',$encoded_id);

                                            $portfolio_category = preg_replace('/-/i',' ',$portfolio_info_row_array['category']);

                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td class="text-capitalize">
                                                        <?=($portfolio_category)?>
                                                    </td>
                                                    
                                                    <td>
                                                        <img src="<?=($portfolio_image_path . $portfolio_info_row_array['portfolio_image'])?>" alt="Portfolio Image" style="width:60px">
                                                    </td>
                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a id="/portfolio-delete/<?=($encoded_portfolio_id)?>" class="btn btn-primary btn-tone text-danger portfolio_del_btn " style="cursor:pointer" role="button">
                                                                <i class="anticon anticon-delete"></i>
                                                            </a>
                                                        <?php        
                                                            }else{
                                                                header('location: /403-forbidden');
                                                            } 
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                            <?php                
                                        }
                                
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php 
                    }else{
                        echo "You don't have any portfolio this category.";
                    }
                ?>
            </div>
        </div>
        <!-- Portfolio Table END-->

    </div>
</div>
<!-- Content Wrapper END -->




<?php 
    // Includes Footer File
    require '../includes/footer.php';

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

<script>
    $('.portfolio_del_btn').click(function(){
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

<script>
    $('.category_del_btn').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "If you delete a category, the category item will be deleted.",
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
