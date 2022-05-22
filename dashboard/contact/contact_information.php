
<?php 
    session_start();

    // Database Connection File
    require '../includes/db.php';


    ########################## Query For Collecting Information From Table on Database START #########################
    $contact_header_result = mysqli_query($db_connect,"SELECT * FROM contact_header");
    if(!$contact_header_result){
        header("location: /500-server-error");
    }
    ########################## Query For Collecting Information From Table on Database END #########################

    // Adddress Section START
    if(isset($_POST['address_submit'])){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $address = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['address']));
        }else{
            header("location: /403-forbidden");
        }

        // Address Validation
        if(strlen($address) > 100){
            $address_err = "Address Contain Maximum 100 Characters.";
        }

        if(!isset($address_err)){
            // Address Update Query
            $address_update_rasult = mysqli_query($db_connect,"UPDATE contact_us SET address='$address' WHERE id=1");
            if($address_update_rasult){
                $success = "Address Update Success";
            }else{
                $faild = "Faild! Please Try Again.";
            }
        }
    }
    // Adddress Section END


    // Telephone Section START
    if(isset($_POST['tele_submit'])){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $telephone = mysqli_real_escape_string($db_connect,input_sanitizer($_POST['telephone']));
        }else{
            header("location: /403-forbidden");
        }

        // Address Validation
        if($telephone != ""){
            if(!is_numeric($telephone)){
                $tele_err = "This is Not a Valid Telephone Number.";
            }
        }elseif(strlen($telephone) > 50){
            $tele_err = "Telephone Number is too large plese keep it short.";
        }
        

        if(!isset($tele_err)){
            // Telephone Update Query
            $telephone_update_rasult = mysqli_query($db_connect,"UPDATE contact_us SET telephone='$telephone' WHERE id=1");
            if($telephone_update_rasult){
                $success = "Telephone Update Success";
            }else{
                $faild = "Faild! Please Try Again.";
            }
        }
    }
    // Telephone Section END


    // Includes Header File
    require '../includes/header.php';

    // Function for form input sanitize
    function input_sanitizer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    // Query For Getting Address and Telephone
    $contact_us_query_result = mysqli_query($db_connect,"SELECT * FROM contact_us");
    if(!$contact_us_query_result){
        header("location: /403-forbidden");
    }
    $contact_us_info_array = mysqli_fetch_assoc($contact_us_query_result);
?>

<style>
    .addressForm{
        display: none;
    }
    .addressForm.active{
        display:block;
    }
    .address.remove{
        display:none;
    }
    .address{
        display:block;
    }
    .telephoneForm{
        display: none;
    }
    .telephoneForm.active{
        display:block;
    }
    .telephone.remove{
        display:none;
    }
    .telephone{
        display:block;
    }
</style>

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Contact Information</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="/admin-dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active">Contact info</span>
            </nav>
        </div>
    </div>
    <!-- Container START -->
    <div class="container">

        <!-- Contact Header Information Table START-->
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Contact Header Information Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Small Title</th>
                                <th>Big Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(mysqli_num_rows($contact_header_result) != 0){
                                    foreach($contact_header_result as $key=>$contact_header_row_array){
                                            // Encoding Management Member User ID
                                            $contact_header_id = $contact_header_row_array['id'];
                                            $encript_formula = ceil((($contact_header_id * 123465789 * 98765) / 56789));
                                            $encoded_id = base64_encode($encript_formula);
                                            $encoded_contact_header_id = preg_replace('/=/i','',$encoded_id);
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=($key+1)?>
                                                    </td>
                                                    <td>
                                                        <?=($contact_header_row_array['small_title'])?>
                                                    </td>
                                                    <td style="max-width:200px">
                                                        <?php 
                                                            echo $contact_header_row_array['big_title'];
                                                        ?>
                                                    </td>
                                                    <td style="max-width:200px">
                                                        <?php 
                                                            echo $contact_header_row_array['description'];
                                                        ?>
                                                    </td>

                                                    <td class="">
                                                        <?php 
                                                            if($login_user_array['role'] == 1){ // Super Admin Access
                                                        ?>
                                                            <a href="/contact-header-edit/<?=($encoded_contact_header_id)?>" class="btn btn-primary btn-tone">
                                                                <i class="anticon anticon-edit"></i>
                                                            </a>
                                                        <?php        
                                                            } 
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                            <?php                
                                        }
                                }else{
                                    echo "You Don't Have Any Information About Contact.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Contact Header Information Table END-->
        
        <!-- Address & Telephone -->
        <?php 
            if(isset($success)){
        ?>
            <div class="alert alert-success">
                <div class="d-flex align-items-center justify-content-start">
                    <span class="alert-icon">
                        <i class="anticon anticon-check-o"></i>
                    </span>
                    <span><?=($success)?></span>
                </div>
            </div>
        <?php        
            }
            if(isset($faild)){
        ?>
            <div class="alert alert-danger">
                <div class="d-flex align-items-center justify-content-start">
                    <span class="alert-icon">
                        <i class="anticon anticon-close-o"></i>
                    </span>
                    <span><?=($faild)?></span>
                </div>
            </div>
        <?php        
            }
        ?>
        <div class="col-md-12 d-flex justify-content-between mb-5">
            
            <div class="card" style="min-width:40%">
                <div class="card-header d-flex justify-content-between p-4">
                    <h4>Address</h4>
                    <?php 
                        if($login_user_array['role'] == 1){
                    ?>
                        <button class="btn btn-primary address_edit_btn"><i class="anticon anticon-edit"></i></button>
                    <?php        
                        }
                    ?>
                    
                </div>
                <div class="card-body">
                    <?php 
                        if(isset($address_err)){
                    ?>
                        <div class="alert alert-warning">
                            <div class="d-flex align-items-center justify-content-start">
                                <span class="alert-icon">
                                    <i class="anticon anticon-exclamation-o"></i>
                                </span>
                                <span><?=($address_err)?></span>
                            </div>
                        </div>
                    <?php        
                        }
                    ?>
                    <div class="address">
                        <?=($contact_us_info_array['address'])?>
                    </div>

                    <?php 
                        if($login_user_array['role'] == 1){
                    ?>
                        <form action="" class="addressForm" method="POST">
                            <textarea name="address" id="" cols="25" rows="4" class="d-block mb-2 form-control"><?=(isset($address)?($address):($contact_us_info_array['address']))?></textarea>
                            <button type="submit" class="btn btn-primary" name="address_submit">Save</button>
                        </form>
                    <?php        
                        }
                    ?>
                    
                </div>
            </div>

            <div class="card" style="min-width:40%">
                <div class="card-header d-flex justify-content-between p-4">
                    <h4>Telephone</h4>
                    <?php 
                        if($login_user_array['role'] == 1){
                    ?>
                        <button class="btn btn-primary telephone_edit_btn"><i class="anticon anticon-edit"></i></button>
                    <?php        
                        }
                    ?>
                    
                </div>
                <div class="card-body">
                    <?php 
                        if(isset($tele_err)){
                    ?>
                        <div class="alert alert-warning">
                            <div class="d-flex align-items-center justify-content-start">
                                <span class="alert-icon">
                                    <i class="anticon anticon-exclamation-o"></i>
                                </span>
                                <span><?=($tele_err)?></span>
                            </div>
                        </div>
                    <?php        
                        }
                    ?>
                    <div class="telephone">
                        <?=($contact_us_info_array['telephone'])?>
                    </div>
                    <?php 
                        if($login_user_array['role'] == 1){
                    ?>
                        <form action="" class="telephoneForm" method="POST">
                            <input type="text" value="<?=(isset($tele_err)?($telephone):($contact_us_info_array['telephone']))?>" class="form-control" name="telephone">
                            <button type="submit" class="btn btn-primary mt-2" name="tele_submit">Save</button>
                        </form>
                    <?php        
                        }
                    ?>
                    
                </div>
            </div>
        </div>
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
    $('.service_del_btn').click(function(){
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
    var addressEditBtn = document.querySelector(".address_edit_btn");
    var addressForm = document.querySelector(".addressForm");
    var address = document.querySelector(".address");
    addressEditBtn.addEventListener("click",function(){
        addressForm.classList.toggle("active");
        address.classList.toggle("remove");
    })

    var teleEditBtn = document.querySelector(".telephone_edit_btn");
    var teleForm = document.querySelector(".telephoneForm");
    var tele = document.querySelector(".telephone");
    teleEditBtn.addEventListener("click",function(){
        teleForm.classList.toggle("active");
        tele.classList.toggle("remove");
    })
</script>