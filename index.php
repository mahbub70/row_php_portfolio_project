<?php 

    // Database Connection File
    require './dashboard/includes/db.php';


    ############## TOP HEADER or CONTACT INFO QUERY START ###############################
    $contact_info_query_result = mysqli_query($db_connect,"SELECT * FROM top_header WHERE status=1");
    if(!$contact_info_query_result){
        header("location: /403-forbidden");
    }
    $contact_info_array = mysqli_fetch_assoc($contact_info_query_result);

    // Query For Social Links START
    $social_icon_result = mysqli_query($db_connect,"SELECT * FROM social_links WHERE status=1");
    if(!$social_icon_result){
        header("location: /403-forbidden");
    }
    // Query For Social Links END
    ############## TOP HEADER or CONTACT INFO QUERY END #################################

    ############## LOGO QUERY START #################################
    $logo_result = mysqli_query($db_connect,"SELECT * FROM logos WHERE status=1");
    if(!$logo_result){
        header("location: /403-forbidden");
    }
    $logo_array = mysqli_fetch_assoc($logo_result);

    // Logo Image Path
    $logo_path = "./dashboard/img/logos/";
    ############## LOGO QUERY END #################################



    ############## BANNER INFO QUERY START ###############################
    $banner_info_query_result = mysqli_query($db_connect,"SELECT * FROM banners WHERE status=1");
    if(!$banner_info_query_result){
        header("location: /403-forbidden");
    }
    if(mysqli_num_rows($banner_info_query_result) != 0){
        $banner_info_array = mysqli_fetch_assoc($banner_info_query_result);
    }
    // Query For Social Links START
    $banner_btn_result = mysqli_query($db_connect,"SELECT * FROM banner_buttons WHERE status=1");
    if(!$banner_btn_result){
        header("location: /403-forbidden");
    }
    // Query For Social Links END
    ############## BANNER INFO QUERY END #################################

    // Banner Image Path 
    $banner_image_path = "./dashboard/img/banners/";


    ############## FEATURE QUERY START ###############################
    $feature_query_result = mysqli_query($db_connect,"SELECT * FROM features WHERE status=1");
    if(!$feature_query_result){
        header("location: /403-forbidden");
    }
    ############## FEATURE QUERY END #################################

    // Feature Image Path 
    $feature_image_path = "./dashboard/img/features_img/";


    ############## ABOUT QUERY START ###############################
    $about_query_result = mysqli_query($db_connect,"SELECT * FROM abouts WHERE status=1");
    if(!$about_query_result){
        header("location: /403-forbidden");
    }else{
        $about_info_array = mysqli_fetch_assoc($about_query_result);
    }
    ############## ABOUT QUERY END #################################

    // Feature Image Path 
    $about_image_path = "./dashboard/img/about_images/";

    ############## SERVICE QUERY START ###############################
    $service_query_result = mysqli_query($db_connect,"SELECT * FROM services WHERE status=1");
    if(!$service_query_result){
        header("location: /403-forbidden");
    }
    ############## SERVICE QUERY END #################################

    // Service Image Path 
    $service_image_path = "./dashboard/img/service_images/";


    ############## SERVICE HEADER QUERY START ###############################
    $service_header_query_result = mysqli_query($db_connect,"SELECT * FROM service_header");
    if(!$service_header_query_result){
        header("location: /403-forbidden");
    }
    $service_header_info_array = mysqli_fetch_assoc($service_header_query_result);
    ############## SERVICE HEADER QUERY END #################################


    ############## PORTFOLIO CATEGORY QUERY START ###############################
    $portfolio_category_query_result = mysqli_query($db_connect,"SELECT * FROM portfolio_categores WHERE status=1");
    if(!$portfolio_category_query_result){
        header("location: /403-forbidden");
    }
    ############## PORTFOLIO CATEGORY QUERY END #################################

    ############## PORTFOLIO QUERY START ###############################
    $portfolio_query_result = mysqli_query($db_connect,"SELECT * FROM portfolios");
    if(!$portfolio_query_result){
        header("location: /403-forbidden");
    }
    ############## PORTFOLIO QUERY END #################################

    // Portfolio Image Path 
    $portfolio_image_path = "./dashboard/img/portfolio_images/";

    ############## PORTFOLIO HEADER QUERY START ###############################
    $portfolio_header_query_result = mysqli_query($db_connect,"SELECT * FROM portfolio_header");
    if(!$portfolio_header_query_result){
        header("location: /403-forbidden");
    }
    $portfolio_header_array = mysqli_fetch_assoc($portfolio_header_query_result);
    ############## PORTFOLIO HEADER QUERY END #################################


    ############## BUSINESS QUERY START ###############################
    $business_query_result = mysqli_query($db_connect,"SELECT * FROM business");
    if(!$business_query_result){
        header("location: /403-forbidden");
    }
    $business_info_array = mysqli_fetch_assoc($business_query_result);
    ############## BUSINESS QUERY END #################################

    // Business Image Path 
    $business_image_path = "./dashboard/img/business_images/";


    ############## COMPANY HEADER QUERY START ###############################
    $company_header_query_result = mysqli_query($db_connect,"SELECT * FROM company_header");
    if(!$company_header_query_result){
        header("location: /403-forbidden");
    }
    $company_header_info_array = mysqli_fetch_assoc($company_header_query_result);
    ############## COMPANY HEADER QUERY END #################################

    // Company Image Path 
    $company_image_path = "./dashboard/img/company_images/";


    ############## COMPANY FACILITY QUERY START ###############################
    $company_facility_query_result = mysqli_query($db_connect,"SELECT * FROM facilitys");
    if(!$company_facility_query_result){
        header("location: /403-forbidden");
    }
    ############## COMPANY FACILITY QUERY END #################################


    ############## SUBSCRIBER HEADER QUERY START ###############################
    $subscriber_header_query_result = mysqli_query($db_connect,"SELECT * FROM subscriber_header");
    if(!$subscriber_header_query_result){
        header("location: /403-forbidden");
    }
    $subscriber_header_array = mysqli_fetch_assoc($subscriber_header_query_result);
    ############## SUBSCRIBER HEADER QUERY END #################################


    ############## PACKAGES HEADER QUERY START ###############################
    $packages_header_query_result = mysqli_query($db_connect,"SELECT * FROM package_header");
    if(!$packages_header_query_result){
        header("location: /403-forbidden");
    }
    $packages_header_array = mysqli_fetch_assoc($packages_header_query_result);
    ############## PACKAGES HEADER QUERY END #################################


    ########## PACKAGE QUERY START #############################
    $package_result = mysqli_query($db_connect,"SELECT * FROM packages WHERE status=1");
    if(!$package_result){
        header("location: /403-forbidden");
    }
    ########## PACKAGE QUERY END #############################


    ########## OUR TEEM QUERY START #############################
    $meet_team_result = mysqli_query($db_connect,"SELECT * FROM users WHERE client_site_status=1");
    if(!$meet_team_result){
        header("location: /403-forbidden");
    }
    ########## OUR TEEM QUERY END #############################
    // User Image Path
    $user_image_path = "./dashboard/img/users_img/";


    ########## CONSULTANT HEADER QUERY START #############################
    $consultant_header_result = mysqli_query($db_connect,"SELECT * FROM consultant_header ");
    if(!$consultant_header_result){
        header("location: /403-forbidden");
    }
    $consultant_header_info_array = mysqli_fetch_assoc($consultant_header_result);
    ########## CONSULTANT HEADER QUERY END #############################

    ########## TESTIMONIAL HEADER QUERY START #############################
    $testimonial_header_result = mysqli_query($db_connect,"SELECT * FROM testimonial_header ");
    if(!$testimonial_header_result){
        header("location: /403-forbidden");
    }
    $testimonial_header_info_array = mysqli_fetch_assoc($testimonial_header_result);
    ########## TESTIMONIAL HEADER QUERY END #############################


    ########## REVIEW QUERY START #############################
    $review_query_result = mysqli_query($db_connect,"SELECT * FROM reviews WHERE status=1 ORDER BY id DESC LIMIT 4 ");
    if(!$testimonial_header_result){
        header("location: /403-forbidden");
    }
    ########## REVIEW QUERY END #############################


    ########## BLOG HEADER QUERY START #############################
    $blog_header_result = mysqli_query($db_connect,"SELECT * FROM blog_header ");
    if(!$blog_header_result){
        header("location: /403-forbidden");
    }
    $blog_header_info_array = mysqli_fetch_assoc($blog_header_result);
    ########## BLOG HEADER QUERY END #############################



    ########## BLOG QUERY START #############################
    $blog_result = mysqli_query($db_connect,"SELECT * FROM blogs ORDER BY id DESC");
    if(!$blog_header_result){
        header("location: /403-forbidden");
    }
    ########## BLOG QUERY END #############################
    // Blog Image Path
    $blog_image_path = "./dashboard/img/blog_images/";



    ########## CONTACT US HEADER QUERY START #############################
    $contact_header_result = mysqli_query($db_connect,"SELECT * FROM contact_header ");
    if(!$contact_header_result){
        header("location: /403-forbidden");
    }
    $contact_header_info_array = mysqli_fetch_assoc($contact_header_result);
    ########## CONTACT US HEADER QUERY END #############################


    ############ Contact US Query START #############################
    $contact_us_result = mysqli_query($db_connect,"SELECT * FROM contact_us");
    if(!$contact_us_result){
        header("location: /403-forbidden");
    }
    $contact_us_info_array = mysqli_fetch_assoc($contact_us_result);
    ############ Contact US Query END #############################


    ########### COUNTER SECTION START  #########################
    $counter_result = mysqli_query($db_connect,"SELECT * FROM counter_section");
    if(!$counter_result){
        header("location: /403-forbidden");
    }
    $counter_info_array = mysqli_fetch_assoc($counter_result);
    ########### COUNTER SECTION END  #########################
    // Counter Image Path
    $counter_image_path = "./dashboard/img/counter_images/";


    ############ TOTAL CLIENT RESULT START ######################
    $total_client_result = mysqli_query($db_connect,"SELECT * FROM users WHERE role=5");
    if(!$total_client_result){
        header("location: /403-forbidden");
    }
    $count_client = mysqli_num_rows($total_client_result);

    // Count Total 5 Start Review
    $five_star_review_result = mysqli_query($db_connect,"SELECT * FROM reviews WHERE rating=5");
    if(!$five_star_review_result){
        header("location: /403-forbidden");
    }
    $count_five_star_review = mysqli_num_rows($five_star_review_result);
    ############ TOTAL CLIENT RESULT END ######################


    ################### COUNTS QUERY SATRT ##################################
    $counts_result = mysqli_query($db_connect,"SELECT * FROM counters WHERE id=1");
    if(!$counts_result){
        header("location: /403-forbidden");
    }
    $counts_row_array = mysqli_fetch_assoc($counts_result);
    ################### COUNTS QUERY END ##################################


    ###################### MENUS QUERY START ##########################
    $menus_result = mysqli_query($db_connect,"SELECT * FROM menu WHERE status=1");
    if(!$menus_result){
        header("location: /403-forbidden");
    }
    ###################### MENUS QUERY END ############################


    ###################### FOOTER IMPORTANT LINK QUERY START ##########################
    $important_link_result = mysqli_query($db_connect,"SELECT * FROM important_links ");
    if(!$important_link_result){
        header("location: /403-forbidden");
    }
    ###################### FOOTER IMPORTANT LINK QUERY END ############################


?>



<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from codeglamour.com/html/18/probizz/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Dec 2021 04:38:51 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>ProBizz - Multipurpose Business Landing Page</title>

    <!-- Dashboard Icon Link -->
    <link rel="stylesheet" type="text/css" href="dashboard/assets/css/app.min.css">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!--Owl Carousel CSS-->
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <!--Slick CSS-->
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <!--Font Awesome CSS-->
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <!--Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--Responsive CSS-->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">


    <style>
        .why-us-features > div{
            min-width:100%;
        }
        .why-us-features > div > ul{
            width: 100%;
            display:flex;
            flex-flow: row wrap;
        }
        .why-us-features > div > ul > li{
            min-width:calc(50% - 15px);
            margin-right:15px;
        }
        @media only screen and (max-width: 768px) {
            .why-us-features > div > ul > li{
            min-width:100%;
            }
        }
        .meet_team_image{
            width:100%;
            height: 300px;
            object-fit:cover;
        }
        .slider .star-icon .fa-star{
            color: #53535f;
        }
        .slider .star-icon .fa-star.checked{
            color:#f1b922;
        }
        .blog-post-single img{
            width:270px;
            height: 210px;
            object-fit:cover;
        }
        .footer-latest-news img{
            width:77px;
            max-height:51px;
            object-fit:cover;
        }
        .custom_height{
            height:300px;
        } 
        .feature-single {
            height: 100%;
            width: 100%;
            overflow:hidden;
        }
        
    </style>
    
</head>

<body>

    <div id="preloader">
        <div class="spinner">
           <div class="rect1"></div>
           <div class="rect2"></div>
           <div class="rect3"></div>
           <div class="rect4"></div>
           <div class="rect5"></div>
        </div>
    </div>

    <!--Start Body Wrap-->
    <div id="body-wrapper">
        <!--Start Header-->
        <header id="header">
            <!--Start Header Top-->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-9 col-md-7">
                            <div class="header-contact-info">
                                <ul>
                                    <li><i class="<?=($contact_info_array['contact_icon'])?>"></i> <?=($contact_info_array['contact_number'])?></li>
                                    <li><i class="<?=($contact_info_array['email_icon'])?>"></i> <?=($contact_info_array['contact_email'])?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-5">
                            <div class="header-social text-right">
                                <ul>
                                    <li><a href="#"><span>Follow Us : </span></a></li>
                                    <?php 
                                        foreach($social_icon_result as $link_row_array){
                                    ?>
                                        <li><a href="<?=($link_row_array['site_link'])?>"><i class="<?=($link_row_array['site_icon'])?>"></i></a></li>
                                    <?php        
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Top-->

            <!--Start Main Menu-->
            <div class="main_navbar">   
            <!-- MAIN NAVBAR -->
                <nav class="navbar navbar-expand-lg  navbar-dark">
                    <div class="container">
                        <a class="navbar-brand logo-sticky font-600" href="index.html">
                            <?php 
                                if($logo_array['type']=="Image"){
                            ?>
                                <img src="<?=($logo_path . $logo_array['logo'])?>" alt="" style="width:50px">
                            <?php        
                                }else{
                                    echo $logo_array['logo'];
                                }
                            ?>
                        </a>
                        <button class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbarNav" aria-expanded="false"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ml-auto" id="nav">
                                <?php 
                                    if(mysqli_num_rows($menus_result) != 0){
                                        foreach($menus_result as $menu_row_array){
                                ?>
                                        <li class="nav-item">
                                            <a class="nav-link js-scroll-trigger" href="<?=($menu_row_array['link'] != "")?($menu_row_array['link']):("#")?>"><?=($menu_row_array['name'])?></a>
                                        </li>
                                <?php            
                                        }
                                    }
                                ?>
                                
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <!--End Main Menu-->

        </header>
        <!--End Header-->

        <!--Start Banner Section-->
        <section id="main-banner" class="bg-cover position-relative full-height text-center" style="background-image: url(<?=(mysqli_num_rows($banner_info_query_result) != 0)?(($banner_image_path . $banner_info_array['image'])):('')?>);">
            <div class="overlay"></div>
            <div class="caption-content dp-table">
                <div class="tbl-cell position-relative">
                    <h1 class="color-white"><?=(mysqli_num_rows($banner_info_query_result) != 0)?(($banner_info_array['title'])):('')?></h1>
                    <p class="color-white mt-3"><?=(mysqli_num_rows($banner_info_query_result) != 0)?(($banner_info_array['description'])):('')?>
                    </p>
                    <div class="large-btn animated slideInUp">
                        <?php
                            if(mysqli_num_rows($banner_btn_result) !=0){ 
                                foreach($banner_btn_result as $banner_row_array){
                        ?>
                            <a class="btn btn-light mt-5 mr-4" href="<?=($banner_row_array['button_link'] != "")?($banner_row_array['button_link']):("#")?>"><?=($banner_row_array['button_name'])?></a>
                        <?php        
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>
        </section>
        <!--End Banner Section-->

         <!--Start Features Section-->
        <section id="features">
            <!--Start Container-->
            <div class="container">
                <!--Start Features Row-->
                <div class="row">
                    <?php 
                        if(mysqli_num_rows($feature_query_result) != 0){
                            foreach($feature_query_result as $feature_row_array){                             
                    ?>
                            <!--Start Feature Single-->
                            <div class="col-12 col-lg-4 col-md-4 custom_height">
                                <div class="feature-single text-center">
                                    <img src="<?=($feature_image_path . $feature_row_array['image'])?>" alt="icon" style="max-width:82px">
                                    <h4>
                                    <?php
                                        $explode_feature_big_text_array = explode("&gt;",$feature_row_array['title']);
                                    ?>
                                        <span class="p-color1"><?=(count($explode_feature_big_text_array) > 1)?($explode_feature_big_text_array[1]):('')?> </span><?=($explode_feature_big_text_array[0])?>

                                    <p><?=($feature_row_array['description'])?></p>
                                </div>
                            </div>
                            <!--End Feature Single-->
                    <?php        
                            }
                        }
                    ?>
                    
                </div>
                <!--End Features Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Features Section-->

        <!--Start About Section-->
        <section id="about"  class="bg-gray">
            <!--Start Container-->
            <div class="container">
                <!--Start Row-->
                <div class="row">
                    <!--Start About Image-->
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="<?=($about_image_path . $about_info_array['image'])?>" class="img-fluid" alt="Image">
                        </div>
                    </div>
                    <!--End About Image-->

                    <!--Start About Content-->
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h4 class="color-gray"><?=($about_info_array['small_title'])?></h4>
                            <h2>
                                <?php
                                    $explode_big_text_array = explode("&gt;",$about_info_array['big_title']);
                                ?>
                                    <?=($explode_big_text_array[0])?><span class="p-color"><?=(count($explode_big_text_array) > 1)?($explode_big_text_array[1]):('')?></span>
                            </h2>
                            <p><?=(preg_replace('/\r\n/i','</br>',$about_info_array['about_text']))?></p>
                        </div>
                    </div>
                    <!--End About Content-->
                </div>
                <!--End Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End About Section-->

        <!--Start Services Section-->
        <section id="services">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading-->
                <div class="row">
                    <div class="col-12"> 
                        <div class="heading text-center">
                            <?php
                                if(mysqli_num_rows($service_header_query_result) != 0){
                                    $explode_service_header_big_title = explode("&gt;",$service_header_info_array['big_title']);
                            ?>
                                <h4 class="color-gray"><?=($service_header_info_array['small_title'])?></h4>
                                <h2><?=($explode_service_header_big_title[0])?> <span class="p-color"><?=(count($explode_service_header_big_title) > 1)?($explode_service_header_big_title[1]):('')?></span></h2>
                                <p><?=($service_header_info_array['text'])?></p>
                            <?php        
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!--End Heading-->

                <!--Start Services Row-->
                <div class="row">
                    <?php 
                        if(mysqli_num_rows($service_query_result) != 0){
                            foreach($service_query_result as $service_row_array){
                    ?>
                            <!--Start Service Single-->
                            <div class="col-lg-4 col-md-6">
                                <div class="service-single text-center custom_height">
                                    <img src="<?=($service_image_path . $service_row_array['image'])?>" alt="icon" style="max-width:82px">
                                    <h4 class="p-color1"><?=($service_row_array['title'])?></h4>
                                    <p><?=($service_row_array['description'])?></p>
                                </div>
                            </div>
                            <!--End Service Single-->
                    <?php            
                            }
                        }
                    ?>
                    
                </div>
                <!--End Services Row-->


            </div>
            <!--End Container-->
        </section>
        <!--End Services Section-->

            <!-- Portfolio Section -->
        <section id="portfolios" class="bg-gray default-padding">
          <!-- Container Starts -->
          <div class="container">
                <!--Start Heading-->
                <div class="row">
                    <div class="col-12">
                        <div class="heading text-center">
                            <h4 class="color-gray"><?=($portfolio_header_array['small_title'])?></h4>
                            <h2>
                                    <?php
                                        $explode_portflio_big_text_array = explode("&gt;",$portfolio_header_array['big_title']);
                                    ?>
                                    <?=($explode_portflio_big_text_array[0])?><span class="p-color"><?=(count($explode_portflio_big_text_array) > 1)?($explode_portflio_big_text_array[1]):('')?></span>
                            </h2>
                            <p><?=($portfolio_header_array['text'])?></p>
                        </div>
                    </div>
                </div>
                <!--End Heading-->
                <?php 
                    if(mysqli_num_rows($portfolio_category_query_result) != 0){
                ?>
                    <div class="row">         
                        <div class="col-lg-12">
                            <!-- Portfolio Controller/Buttons -->
                            <div class="controls text-center">
                                <a class="control mixitup-control-active btn btn-primary" data-filter="all">
                                    All 
                                </a>
                                <?php
                                    foreach($portfolio_category_query_result as $category_row_array){
                                        $category = strtolower(preg_replace('/ /i','-',$category_row_array['category_name']));
                                ?>
                                    <a class="control btn btn-outline-primary" data-filter=".<?=($category)?>">
                                        <?=($category_row_array['category_name'])?>
                                    </a>
                                <?php        
                                }
                                ?>
                            </div>
                            <!-- Portfolio Controller/Buttons Ends-->          
                                
                            <!-- Portfolio Recent Projects -->
                            <div id="portfolio" class="row wow fadeInUp" data-wow-delay="0.8s">
                                <?php 
                                    foreach($portfolio_category_query_result as $category_row_array){
                                        $category = strtolower(preg_replace('/ /i','-',$category_row_array['category_name']));
                                        foreach($portfolio_query_result as $portfolio_row_array){
                                            if($category == $portfolio_row_array['category']){
                                ?>
                                            <div class="col-md-6 col-lg-4 col-lg-4 col-xl-4 mix <?=($category)?>">
                                                <div class="portfolio-item">
                                                <div class="shot-item">
                                                    <a class="overlay lightbox" href="<?=($portfolio_image_path . $portfolio_row_array['portfolio_image'])?>">
                                                    <img src="<?=($portfolio_image_path . $portfolio_row_array['portfolio_image'])?>" alt="" />  
                                                    <i class="fa fa-eye item-icon"></i>
                                                    </a>
                                                </div>               
                                                </div>
                                            </div>
                                <?php                
                                            }
                                        }
                                    }
                                ?>
 
                            </div>
                            
                        </div>
                    </div>
                <?php        
                    }
                ?>
          </div>
          <!-- Container Ends -->
        </section>
        <!-- Portfolio Section Ends --> 

        <!--Start Call To Action-->
        <section id="contact-now" class="bg-cover position-relative" style="background-image: url(<?=($business_image_path.$business_info_array['image'])?>);">
            <div class="overlay"></div>
            <!--Start Container-->
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="contact-now-content">
                            <h2 class="color-white">
                                <?php 
                                    $explode_business_text = explode("&gt;",$business_info_array['business_text']);
                                ?>
                                <?=($explode_business_text[0])?> <br>
                                <span class="p-color"><?=(count($explode_business_text) > 1)?($explode_business_text[1]):('')?></span>
                            </h2>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="contact-now-button">
                            <a href="<?=($business_info_array['btn_link'] == '')?('#contact'):($business_info_array['btn_link'])?>"><?=($business_info_array['btn_text'])?></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Container-->
        </section>
        <!--End Call To Action-->

        <!--Start Why Choose Us-->
        <section id="why-us" class="bg-gray">
            <!--Start Container-->
            <div class="container">
                <!--Start Row-->
                <div class="row">
                    <!--Start Why Choose Content-->
                    <div class="col-lg-6">
                        <div class="why-us-content">
                            <h4 class="color-gray"><?=($company_header_info_array['small_title'])?></h4>
                            <h2 class="p-color1">
                                <?php
                                    $explode_company_big_text_array = explode("&gt;",$company_header_info_array['big_title']);
                                ?> 
                                <?=($explode_company_big_text_array[0])?><span class="p-color"> <?=(count($explode_company_big_text_array) > 1)?($explode_company_big_text_array[1]):('')?></span>
                            </h2>
                            <p><?=(preg_replace('/\r\n/i','</br>',$company_header_info_array['description']))?></p>
                            <div class="why-us-features row">
                                <div class="col-md-6 ">
                                    <ul>
                                        <?php 
                                            if(mysqli_num_rows($company_facility_query_result) != 0){
                                                foreach($company_facility_query_result as $facility_row_array){
                                        ?> 
                                            <li><i class="<?=($facility_row_array['icon'])?>"></i> <?=($facility_row_array['facility'])?></li>
                                        <?php            
                                                }
                                            }
                                        ?>
                                        
                                        
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!--End Why Choose Content-->

                    <!--Start Why Choose Image-->
                    <div class="col-lg-6">
                        <div class="why-us-img">
                            <img src="<?=($company_image_path . $company_header_info_array['image'])?>" class="img-fluid" alt="Image">
                        </div>
                    </div>
                    <!--End Why Choose Image-->
                </div>
                <!--End Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Why Choose Us-->

        <!--Start Newsletter Section-->
        <section id="newsletter" class="default-padding">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading-->
                <?php  
                    if(mysqli_num_rows($subscriber_header_query_result) != 0){
                ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="heading text-center">
                                <h4 class="color-gray"><?=($subscriber_header_array['small_title'])?></h4>
                                <h2 class="p-color1">
                                    <?php 
                                        $explode_subscriber_header_big_text = explode("&gt;",$subscriber_header_array['big_title']);
                                    ?>
                                    <?=($explode_subscriber_header_big_text[0])?> <span class="p-color"><?=(count($explode_subscriber_header_big_text) > 1)?($explode_subscriber_header_big_text[1]):('')?></span>
                                </h2>
                                <p><?=($subscriber_header_array['description'])?></p>
                            </div>
                        </div>
                    </div>
                <?php        
                    }
                ?>
                <!--End Heading-->

                <!--Start Newsletter Form-->
                <form method="POST" id="emailSubmit">
                    <div class="row justify-content-center no-gutters">
                        <div class="col-lg-4 col-md-6">
                            <div class="newsletter-form">
                                
                                <input type="text" class="form-control" placeholder="Write Your Email" id="email">
                                <div class="invalid-feedback" id="email_err"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="newsletter-btn">
                                <button type="submit">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--End Newsletter Form-->
            </div>
            <!--End Container-->
        </section>
        <!--End Newsletter Section-->

        <!--Start Pricing Section-->
        <section id="pricing" class="bg-gray default-padding">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading-->
                <?php 
                    if(mysqli_num_rows($packages_header_query_result) != 0){
                ?>
                    <div class="row">
                    <div class="col-12">
                        <div class="heading text-center">
                            <h4 class="color-gray"><?=($packages_header_array['small_title'])?></h4>
                            <h2 class="p-color1">
                                <?php 
                                    $explode_packages_header_big_text = explode("&gt;",$packages_header_array['big_title']);
                                ?>
                                <?=($explode_packages_header_big_text[0])?><span class="p-color"> <?=(count($explode_packages_header_big_text) > 1)?($explode_packages_header_big_text[1]):('')?> </span>
                            </h2>
                            <p><?=($packages_header_array['description'])?></p>
                        </div>
                    </div>
                    </div>
                <?php        
                    }
                ?>
                <!--End Heading-->

                <!--Start Pricing Table Row-->
                <div class="row">

                    <!--Start Pricing Table Single-->
                    <?php  
                        if(mysqli_num_rows($package_result) != 0){
                            foreach($package_result as $package_row_array){
                                $package_id = $package_row_array['id'];
                                // Query For Matching Package Service
                                $package_service_result = mysqli_query($db_connect,"SELECT * FROM package_services WHERE package_id=$package_id");
                    ?>
                            <div class="col-md-4">
                                <div class="pricing-table-single fix text-center">
                                    <div class="table-title">
                                        <h2 class="p-color"><?=($package_row_array['name'])?></h2>
                                    </div>
                                    <div class="price-amount">
                                        <h2 class="color-white"><?=($package_row_array['price'])?></h2>
                                    </div>
                                    <div class="table-details">
                                        <ul>
                                            <?php 
                                                if(mysqli_num_rows($package_service_result) != 0){
                                                    foreach($package_service_result as $package_service_row_array){
                                            ?>
                                                    <li><?=($package_service_row_array['service_text'])?></li>
                                            <?php            
                                                    }
                                                }
                                            ?>
                                            
                                            
                                        </ul>
                                    </div>
                                    <div class="table-btn">
                                        <a href="#"><?=($package_row_array['button_text'])?></a>
                                    </div>
                                </div>
                            </div>
                    <?php            
                            }        
                        }
                    ?>
                    
                    <!--End Pricing Table Single-->

                </div>
                <!--End Pricing Table Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Pricing Section-->

        <!--Start Counter Section-->
        <section id="counter" class="bg-cover position-relative" style="background-image: url(<?=($counter_info_array['image'] != "")?($counter_image_path . $counter_info_array['image']):("../img/counter-bg.jpg")?>);">
            <div class="overlay"></div>
            <!--Start Container-->
            <div class="container">
                <!--Start Counter Row-->
                <div class="row">
                    <!--Start Counter Single-->
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-single text-center">
                            <i class="fas fa-users"></i>
                            <h2 class="color-white"><?=($counts_row_array['client'] == "")?($count_client):($counts_row_array['client'])?></h2>
                            <h6 class="">Total Client</h6>
                        </div>
                    </div>
                    <!--End Counter Single-->

                    <!--Start Counter Single-->
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-single text-center">
                            <i class="far fa-star"></i>
                            <h2 class="color-white"><?=($counts_row_array['rating'] == "")?($count_five_star_review):($counts_row_array['rating'])?></h2>
                            <h6 class="">5 Star Rating</h6>
                        </div>
                    </div>
                    <!--End Counter Single-->

                    <!--Start Counter Single-->
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-single text-center">
                            <i class="fas fa-chess-pawn"></i>
                            <h2 class="color-white"><?=($counts_row_array['award'] == "")?("0"):($counts_row_array['award'])?></h2>
                            <h6 class="">Won Award</h6>
                        </div>
                    </div>
                    <!--End Counter Single-->

                    <!--Start Counter Single-->
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-single text-center">
                            <i class="fas fa-flag-checkered"></i>
                            <h2 class="color-white"><?=($counts_row_array['complete_project'] == "")?("0"):($counts_row_array['complete_project'])?></h2>
                            <h6 class="">Complete Project</h6>
                        </div>
                    </div>
                    <!--End Counter Single-->
                </div>
                <!--End Counter Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Counter Section-->

        <!--Start Team Section-->
        <section id="team" class="bg-gray">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading-->
                <div class="row">
                    <?php 
                        if(mysqli_num_rows($consultant_header_result) != 0){
                    ?>
                        <div class="col-12">
                            <div class="heading text-center">
                                <h4 class="color-gray"><?=($consultant_header_info_array['small_title'])?></h4>
                                <h2 class="p-color1">
                                    <?php 
                                        $explode_consultant_header_big_text = explode("&gt;",$consultant_header_info_array['big_title']);
                                    ?>
                                    <?=($explode_consultant_header_big_text[0])?> <span class="p-color"><?=(count($explode_consultant_header_big_text) > 1)?($explode_consultant_header_big_text[1]):('')?></span>
                                </h2>
                                <p><?=($consultant_header_info_array['description'])?></p>
                            </div>
                        </div>
                    <?php        
                        }
                    ?>
                    
                </div>
                <!--End Heading-->

                <!--Start Team Members Row-->
                <div class="row">
                    <?php 
                        if(mysqli_num_rows($meet_team_result) != 0){
                            foreach($meet_team_result as $meet_row_array){
                                $meet_user_id = $meet_row_array['id'];
                                // Query For Getting Social Information
                                $social_links_result = mysqli_query($db_connect,"SELECT * FROM user_social_links WHERE user_id=$meet_user_id");
                    ?>
                            <!--Start Team Member Single-->
                            <div class="col-lg-3 col-md-6">
                                <div class="team-member-single fix position-relative text-center">
                                    <img src="<?=($user_image_path . $meet_row_array['profile_image'])?>" class="img-fluid meet_team_image" alt="Image">
                                    <?php 
                                        if(mysqli_num_rows($social_links_result) != 0){
                                    ?>
                                        <div class="member-social-icons">
                                            <ul>
                                                <?php 
                                                    foreach($social_links_result as $social_row_array){
                                                ?>
                                                <li><a href="<?=($social_row_array['link'])?>" target="_blank"><i class="<?=($social_row_array['icon'])?>"></i></a></li>
                                                <?php 
                                                    }
                                                ?>

                                            </ul>
                                        </div>
                                    <?php            
                                        }
                                    ?>
                                    <div class="member-details position-relative">
                                        <h4 class="font-600 color-white"><?=($meet_row_array['full_name'])?></h4>
                                        <p class="color-white"><?=($meet_row_array['designation'])?></p>
                                    </div>
                                </div>
                            </div>
                            <!--End Team Member Single-->
                    <?php            
                            }
                        }
                    ?>

                </div>
                <!--End Team Members Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Team Section-->

        <!-- testimonial Section Start -->
      <section class="clients_testimonial_area default-padding" id="testimonial">
          <div class="container">
            <!--Start Heading-->
            <div class="row">
                <?php 
                    if(mysqli_num_rows($testimonial_header_result) != 0){
                ?>
                    <div class="col-12">
                        <div class="heading text-center">
                            <h4 class="color-gray"><?=($testimonial_header_info_array['small_title'])?></h4>
                            <h2 class="p-color1">
                                <?php
                                    $explode_testimonial_header_big_text = explode("&gt;",$testimonial_header_info_array['big_title']);
                                ?>
                                <?=($explode_testimonial_header_big_text[0])?> <span class="p-color"><?=(count($explode_testimonial_header_big_text) > 1)?($explode_testimonial_header_big_text[1]):('')?></span>
                            </h2>
                        </div>
                    </div>
                <?php        
                    }
                ?>
            </div>
            <!--End Heading-->

            <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <div class="slider slider-for">

                            <!-- Client testimonial Text  -->
                                <?php 
                                    if(mysqli_num_rows($review_query_result) != 0){
                                        foreach($review_query_result as $review_row_array){

                                            $client_id = $review_row_array['client_id'];
                                            // Query For Getting Client Information
                                            $client_info_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$client_id");

                                            if(mysqli_num_rows($client_info_result) != 0){
                                                $client_info_array = mysqli_fetch_assoc($client_info_result);
                                            }else{
                                                header("location: /403-forbidden");
                                            }
                                ?>
                                    <div class="client-testimonial-text text-center">
                                        <div class="client">
                                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                                        </div>
                                        <div class="client-description text-center">
                                            <p>“ <?=($review_row_array['review'])?> ”</p>
                                        </div>
                                        <div class="star-icon text-center">
                                            <?php 
                                                for($i = 1; $i <= 5; $i++){
                                            ?>
                                                <i class="fa fa-star <?=($i <= $review_row_array['rating'])?("checked"):("")?>"></i>
                                            <?php        
                                                }
                                            ?>
                                        </div>
                                        <div class="client-name text-center">
                                            <h5><?=($client_info_array['full_name'])?></h5>
                                            <p><?=($client_info_array['designation'])?></p>
                                        </div>
                                    </div>
                                <?php
                                        }
                                    }
                                ?>
                            <!-- Client testimonial Text  -->

                        </div>
                    </div>
                    <!-- Client Thumbnail Area -->
                    <div class="col-12 col-lg-6">
                        <div class="slider slider-nav">
                                <?php 
                                    if(mysqli_num_rows($review_query_result) != 0){
                                        foreach($review_query_result as $review_row_array){

                                            $client_id = $review_row_array['client_id'];
                                            // Query For Getting Client Information
                                            $client_info_result = mysqli_query($db_connect,"SELECT * FROM users WHERE id=$client_id");

                                            if(mysqli_num_rows($client_info_result) != 0){
                                                $client_info_array = mysqli_fetch_assoc($client_info_result);
                                            }else{
                                                header("location: /403-forbidden");
                                            }
                                ?>
                                            <div class="client-thumbnail">
                                                <img src="<?=($user_image_path . $client_info_array['profile_image'])?>" alt="Image">
                                            </div>
                                <?php
                                        }
                                    }
                                ?>
                        </div>
                    </div>
              </div>
          </div>
      </section>
    
    <!-- testimonial Section Start -->

        <!--Start Latest Blog Section-->
        <section id="latest-blog" class="bg-gray default-padding">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading-->
                <div class="row">
                    <?php 
                        if(mysqli_num_rows($blog_header_result) != 0){
                    ?>
                        <div class="col-12">
                            <div class="heading text-center">
                                <h4 class="color-gray"><?=($blog_header_info_array['small_title'])?></h4>
                                <h2 class="p-color1">
                                    <?php
                                        $explode_blog_header_big_text = explode("&gt;",$blog_header_info_array['big_title']);
                                    ?>
                                    <?=($explode_blog_header_big_text[0])?> <span class="p-color"><?=(count($explode_blog_header_big_text) > 1)?($explode_blog_header_big_text[1]):('')?></span> 
                                </h2>
                                <p><?=($blog_header_info_array['description'])?></p>
                            </div>
                        </div>
                    <?php        
                        }
                    ?>
                    
                </div>
                <!--End Heading-->

                <!--Start Blog Post Row-->
                <div class="row">
                    <!--Start Latest Post Single-->
                    <?php 
                        if(mysqli_num_rows($blog_result) != 0){
                            foreach($blog_result as $key=>$blog_row_array){
                                if($blog_row_array['image'] != ""){

                                $blog_id = $blog_row_array['id'];
                                // Query For Count Comment
                                $count_comment_result = mysqli_query($db_connect,"SELECT * FROM blog_comments WHERE blog_id=$blog_id");
                                if(!$count_comment_result){
                                    header("location: /403-forbidden");
                                } 
                    ?>
                            <div class="col-lg-6">
                                <div class="blog-post-single latest row fix">
                                    <div class="col-md-6 p-0">
                                        <div class="post-media position-relative">
                                            <a href="#"><img src="<?=($blog_image_path.$blog_row_array['image'])?>" class="img-fluid" alt="Image"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="post-details">
                                            <div class="post-title">
                                                <h2><a href="#"><?=($blog_row_array['title'])?></a></h2>
                                            </div>
                                            <div class="post-fact">
                                                <p><a href="#"><i class="icofont icofont-user"></i> <?=($blog_row_array['creater_role'])?></a><a href="#"><i class="icofont icofont-comment"></i> <?=(mysqli_num_rows($count_comment_result))?> Comments</a><a href="#"><i class="icofont icofont-like"></i> <?=($blog_row_array['total_like'])?> Like</a></p>
                                            </div>
                                            <div class="post-content">
                                                <p>
                                                    <?php 
                                                        if(strlen($blog_row_array['description']) > 90){
                                                            echo substr($blog_row_array['description'],0,90) . "...";
                                                        }else{
                                                            echo $blog_row_array['description'];
                                                        }
                                                    ?>
                                                </p>
                                                <p><span><a class="font-500 p-color" href="#"><i class="icofont icofont-arrow-right p-color"></i> Read More</a></span><span class="float-right"><a class="font-500 p-color" href="#"><i class="icofont icofont-user p-color"></i> <?=($blog_row_array['created_at'])?></a></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                                                              
                                }            
                            if($key == 4){
                                break;
                            }
                            }        
                        }
                    ?>
                    <!--End Latest Post Single-->

                    <!--Start Button-->
                    <div class="col-lg-12">
                        <div class="blog-btn text-center">
                            <a href="blog.html">Browse More</a>
                        </div>
                    </div>
                    <!--End Button-->
                </div>
                <!--End Blog Post Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Latest Blog Section-->

        <!--Start Contact Section-->
        <section id="contact" class="default-padding">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading-->
                <div class="row">
                    <?php 
                        if(mysqli_num_rows($contact_header_result) != 0){
                    ?>
                        <div class="col-12">
                            <div class="heading text-center">
                                <h4 class=" color-gray"><?=($contact_header_info_array['small_title'])?></h4>
                                <h2 class="p-color1">
                                    <?php 
                                        $explode_contact_header_big_text = explode("&gt;",$contact_header_info_array['big_title']);
                                    ?>
                                    <?=($explode_contact_header_big_text[0])?> <span class="p-color"><?=(count($explode_contact_header_big_text) > 1)?($explode_contact_header_big_text[1]):('')?></span>
                                </h2>
                                <p><?=($contact_header_info_array['description'])?></p>
                            </div>
                        </div>
                    <?php        
                        }
                    ?>
                </div>
                <!--End Heading-->

                <!--Start Contact Row-->
                <div class="row">
                    <!--Start Contact Info-->
                    <div class="col-lg-6">
                        <div class="contact-info">
                            <!--Start Contact Info Single-->
                            <div class="row">
                                <?php 
                                    if($contact_us_info_array['address'] != ""){
                                ?>
                                    <div class="col-lg-6 col-sm-6">
                                            <div class="contact-info-single text-center">
                                                <i class="fas fa-location-arrow"></i>
                                                <p class="font-500">
                                                    <?=($contact_us_info_array['address'])?>
                                                </p>
                                            </div>
                                        <!--End Contact Info Single-->
                                    </div>
                                <?php        
                                    } 
                                ?>

                                <div class="col-lg-6 col-sm-6">
                                    <!--Start Contact Info Single-->
                                    <div class="contact-info-single text-center">
                                        <i class="far fa-envelope"></i>
                                        <p class="font-500"><?=($contact_info_array['contact_email'])?></p>
                                    </div>
                                    <!--End Contact Info Single-->
                                </div>

                                <?php 
                                    if($contact_us_info_array['telephone'] != ""){
                                ?>
                                    <div class="col-lg-6 col-sm-6">
                                        <!--Start Contact Info Single-->
                                        <div class="contact-info-single text-center">
                                            <i class="fas fa-mobile-alt"></i>
                                            <p class="font-500"><?=($contact_us_info_array['telephone'])?></p>
                                        </div>
                                        <!--End Contact Info Single-->
                                    </div>
                                <?php        
                                    }
                                ?>
                                
                                <div class="col-lg-6 col-sm-6">
                                     <!--Start Contact Info Single-->
                                    <div class="contact-info-single text-center">
                                        <i class="fas fa-phone"></i>
                                        <p class="font-500"><?=($contact_info_array['contact_number'])?></p>
                                    </div>
                                    <!--End Contact Info Single-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Contact Info-->

                    <!--Start Contact Form-->
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <form id="messageForm">
                                <div class="form-group">
                                    <input type="text" class="form-control input" placeholder="Name*" id="name" name="name">
                                    <div class="invalid-feedback" id="name_err"></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control input" placeholder="Email*" id="msg_email" name="email">
                                    <div class="invalid-feedback" id="msg_email_err"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input" placeholder="Subject" id="subject" name="subject">
                                    <div class="invalid-feedback" id="subject_err"></div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control input" rows="10" placeholder="Write Your Message" id="message" name="message"></textarea>
                                    <div class="invalid-feedback" id="message_err"></div>
                                </div>
                                <div class="contact-btn text-center">
                                    <button type="submit">Submit</button>
                                </div>
                            </form>
                            <div id="form-messages"></div>
                        </div>
                    </div>
                    <!--End Contact Form-->
                </div>
                <!--End Contact Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Contact Section-->

        <!--Start Footer-->
        <footer id="footer">
            <!--Start Footer Top-->
            <div class="footer-top">
                <!--Start Container-->
                <div class="container">
                    <!--Start Row-->
                    <div class="row">
                        <!--Start Footer About-->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="footer-about">
                                <h3 class="color-white">About Us</h3>
                                <p>
                                    <?=(substr(preg_replace('/\r\n/i','</br>',$about_info_array['about_text']),0,150) . " ...")?>
                                </p>
                            </div>
                            <div class="footer-newsletter">
                                <h4 class="color-white">Subscribe Now</h4>
                                <form method="POST" id="FooterEmailSubmit">
                                    <input type="email" name="email" id="footerEmail"><input type="submit" value="Subscribe">
                                </form>
                                
                            </div>
                        </div>
                        <!--End Footer About-->

                        <!--Start Footer Links-->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="footer-links">
                                <h3 class="color-white">Important Links</h3>
                                <ul>
                                    <?php 
                                        if(mysqli_num_rows($important_link_result) != 0){
                                            foreach($important_link_result as $importtant_link_row_array){
                                    ?>
                                        <li><a href="<?=($importtant_link_row_array['link'])?>"><i class="fas fa-angle-right"></i> <?=($importtant_link_row_array['title'])?></a></li>
                                    <?php            
                                            }        
                                        }
                                    ?>
                                    
                                    
                                </ul>
                            </div>
                        </div>
                        <!--End Footer Links-->

                        <!--Start Footer Latest News-->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="footer-latest-news">
                                <h3 class="color-white">Latest News</h3>
                                
                                    <?php 
                                        if(mysqli_num_rows($blog_result) != 0){
                                            foreach($blog_result as $key=>$single_blog_row){
                                                if($single_blog_row['image'] != ""){
                                    ?>
                                            <!--Start Recent Post Single-->
                                            <div class="recent-post-single fix">
                                                <div class="post-img float-left">
                                                    <a href="#"><img src="<?=($blog_image_path.$single_blog_row['image'])?>" class="img-fluid" alt="Image"></a>
                                                </div>
                                                <div class="post-cont float-right">
                                                    <h5><a class="color-white" href="#"><?=($single_blog_row['title'])?></a></h5>
                                                    <p><span><?=($single_blog_row['created_at'])?></span></p>
                                                </div>
                                            </div>
                                            <!--End Recent Post Single-->
                                    <?php  
                                                }

                                                if($key == 3){
                                                    break;
                                                }          
                                            }      
                                        }
                                    ?>

                            </div>
                        </div>
                        <!--End Footer Latest News-->

                        <!--Start Footer Instagram-->
                        <div class="col-lg-3 col-md-6 mb-3">
                           <div class="footer-social-area">
                                <h3 class="color-white">Follow Us</h3>
                                <p class="mb-3">We are happy to see you here.</p>
                                <ul>
                                    <?php 
                                        if(mysqli_num_rows($social_icon_result) != 0){
                                            foreach($social_icon_result as $social_row_array){
                                    ?>
                                            <li><a href="<?=($social_row_array['site_link'])?>"><i class="<?=($social_row_array['site_icon'])?>"></i></a></li>
                                    <?php            
                                            }        
                                        }
                                    ?> 
                                </ul>
                            </div>
                        </div>
                        <!--End Footer Instagram-->

                    </div>
                    <!--End Row-->
                </div>
                <!--End Container-->
            </div>
            <!--End Footer Top-->

            <!--Start Footer Bottom-->
            <div class="footer-bottom">
                <p class="color-white text-center"> &copy; Copy 
                    <?=(date("Y"))?>. All Rights Reserved By <a class="p-color" href="https://themeforest.net/user/codeglamour">CodeGlamour.</a></p>
            </div>
            <!--End Footer Bottom-->

            <!--Start Click To Top-->
            <div class="click-to-top">
                <a href="#body-wrapper" class="js-scroll-trigger"><i class="fas fa-angle-double-up"></i></a>
            </div>
            <!--End Click To Top-->
        </footer>
        <!--End Footer-->
    </div>
    <!--End Body Wrap-->

    <!--jQuery JS-->
    <script src="js/jquery-min.js"></script>
    <!--Custom Google Map JS-->
    <script src="js/map-scripts.js"></script>
    <!--Slick Js-->
    <script src="js/slick.min.js"></script>
    <!--Counter JS-->
    <script src="js/waypoints.js"></script>
    <script src="js/counterup.min.js"></script>
    <!--Bootstrap JS-->
    <script src="js/bootstrap.min.js"></script>
    <!--Magnic PopUp JS-->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <!--Owl Carousel JS-->
    <script src="js/owl.carousel.min.js"></script>
    <!--Jquery Easing Js -->
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <!--Scrolly JS-->
    <script src="js/scrolly.js"></script>
    <!--Ajax Contact JS-->
    <script src="js/ajax-contact-form.js"></script>
    <!--Main JS-->
    <script src="js/custom.js"></script>

    <!-- Sweet Alart CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--CUSTOM JS-->
    <script src="js/script.js"></script>

    <!-- Message JS  -->
    <script src="js/message.js"></script>
</body>


<!-- Mirrored from codeglamour.com/html/18/probizz/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Dec 2021 04:40:42 GMT -->
</html>


<style>
    .bg-gray {
        background-color: #f9f9ff !important;
    }
</style>