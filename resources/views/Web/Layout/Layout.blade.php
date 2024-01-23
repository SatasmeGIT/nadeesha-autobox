<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <title>Autobox | The largest auto parts marketplace in Sri Lanka</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="We are the largest auto spare parts marketplace in Sri Lanka. If you need the best auto parts for your vehicle.You can search the most suitable & affordable spare parts from various suppliers across the country." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="https://i.ibb.co/VCRbLL6/android-chrome-192x192.png">
    <link rel="icon" type="image/png" href="https://i.ibb.co/VCRbLL6/android-chrome-192x192.png">
    <link rel="stylesheet" href="{{ asset('web/assets/css/plugins/slider-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css?v=5.3') }}" />
    <link rel="stylesheet" href="{{ asset('web/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />

    <!-- Vendor JS-->
    <script src="{{ asset('web/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/slider-range.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css"
        integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
     <meta name="google-site-verification" content="LiRhpROjvFz3LCsKCfqOEZDY8mMATUQHRjjZ0O8lHXQ" />    
     

</head>
<body>
    <style>
        .footer-list li a {
            color: rgb(223, 213, 213) !important;
        }

        .hero-slider-1 .single-hero-slider.rectangle .slider-content {
            left: 35% !important;
        }

        .header-style-1.header-style-5 .header-bottom-bg-color {
            background-color: white !important;
             padding: 0px !important; 

        }

        div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark {
            display: none !important;
        }

        @media (max-width: 992px) {
            .mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-top {
                padding: 40px !important;
            }

            .sticky-bar.stick {
                padding: 40px 0 40px 0 !important;
            }
        }

        @media (min-width: 1200px) {
            .header-style-1.header-height-2 {
                background-color: #FFFFFF !important;
                /* display: none; */
            }
        }
        @media (max-width: 1240px) {
            .hide_hot_line {
               display:none !important;
            }
        }

        /* hide wired sweet alert css  */
        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=left] {
            display: none !important;
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-circular-line-right {
            display: none !important;
        }

        div:where(.swal2-icon).swal2-success .swal2-success-fix {
            display: none !important;
        }

        div:where(.swal2-icon).swal2-success .swal2-success-ring {
            display: none !important;
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-tip {
            display: none !important;
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-long {
            display: none !important;
        }
        .header-style-1 .header-middle-ptb-1{
            padding: 5px 0 !important;
        }
        @media (min-width: 1220px) {
            .col_adjust_justify {
                display: flex !important;
                justify-content: center !important;
            }
        }
        .fixed_header{
           /*position: fixed !important;*/
           /* top: 0 !important;*/
           /* left: 0 !important;*/
           /*  z-index: 1000 !important;*/
            
        }
        .remove_white_background{
            
            background-color: #edf0f0  !important;
        }
         .mobile-social-icon{
             justify-content: flex-start !important;
         }
    </style>

    <header class="header-area header-style-1 header-style-5 header-height-2 custom_height_">
        <div class="header-middle header-middle-ptb-1 d-none d-xl-block">
            <div class="container fixed_header">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ route('web.home') }}"><img src="{{ asset('assets/imgs/theme/logo-color.png') }}"
                                alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div style=" text-align: left !important;" class="search-style-2">

                            <nav>
                                <a style="font-size: 15px ;  font-style: bold; margin-left:4%; font-weight:900 !important; color:rgb(0, 0, 0) !important; "
                                    href="{{ route('web.home') }}">HOME</a>
                                <a style="font-size: 15px ;  font-style: bold; margin-left:4%; font-weight:900 !important; color:rgb(0, 0, 0) !important; "
                                    href="{{ route('web.about') }}">ABOUT</a>
                                <a style="font-size: 15px ;  font-style: bold; margin-left:4%; font-weight:900 !important; color:rgb(0, 0, 0) !important; "
                                    href="{{ route('web.allads.view') }}">ALL ADS</a>
                                    
                                <a style="font-size: 15px ;  font-style: bold; margin-left:4%; font-weight:900 !important; color:rgb(0, 0, 0) !important; "
                              @if(session('vendor_data'))  href="{{ route('web.inqueryAds') }}" @else href="{{ route('web.inquery_for_visitors') }}"   @endif>VIEW INQUIRIES ({{ $count->count() }})</a>
                             
                               <a class="hide_hot_line" style="font-size: 15px ;  font-style: bold; margin-left:4%; font-weight:500 !important; color:rgb(0, 0, 0) !important; "
                                    href="tel: 0706585100"><i style="margin-right:4px !important; color: #09c85c;" class="fa-solid fa-phone fa-bounce " ></i> 070 65 85 100</a>
                            </nav>
                        
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                               
                                <div class="header-action-icon-2">
                                       <a @if(session('vendor_data')) href="{{ route('web.ads_inquery') }}"  @else href="{{ route('web.vendor.login', ['id' => 'my_inquiry']) }}" @endif  class="btn"
                                        style=" border-radius: 15px !important; background-color: #FFF !important; border-color: #00A791  !important; color:#00A791 !important; font-size:14px; padding:15px !important;">
                                        <i class="fa-solid fa-car"></i> Send Inquery </a>
                                </div>
                                <div class="header-action-icon-2">
                                    @if (session('vendor_data'))
                                        @if (session('vendor_data')->phone)
                                            <button
                                                onclick="window.location.href = '{{ route('web.dashboard.create_ad') }}';"
                                                style="background-color: #FFC800 !important; color: #673500; border-radius: 15px !important;"
                                                class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST YOUR
                                                AD</button>
                                        @else
                                            <button onclick="alert('Please update your account');"
                                                style="background-color: #FFC800 !important; color: #673500 ;  border-radius: 15px !important;"
                                                class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST YOUR
                                                AD</button>
                                        @endif
                                    @else
                                        <button onclick="window.location.href = '{{ route('web.vendor.login') }}';"
                                            style="background-color: #FFC800 !important; color: #673500;  border-radius: 15px !important;"
                                            class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST YOUR
                                            AD</button>
                                    @endif
                                </div>

                                <div class="header-action-icon-2">
                                    <a href="#">
                                        {{-- <img class="svgInject"
                                            src="{{ asset('web/assets/imgs/theme/icons/icon-user.svg') }}" /> --}}
                                        <i class="fa-solid fa-user" style="color: #000;"></i>
                                    </a>
                                    <a><span class="lable ml-0"></span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            @if (session('vendor_data'))
                                                <li>
                                                    <a href="{{ route('web.dashboardIndex') }}"> <i
                                                            class="fa fa-user-circle mr-10" aria-hidden="true"></i>
                                                        Dashboard</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('web.vendor.login') }}"><i
                                                            class="fi fi-rs-user mr-10"></i>Login</a>
                                                </li>
                                            @endif
                                            <li>
                                                @if (session('vendor_data'))
                                                    <a href="{{ route('web.vendor.logout') }}"><i
                                                            class="fi fi-rs-sign-out mr-10"></i>Sign
                                                        out</a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="header-bottom header-bottom-bg-color sticky-bar custom_height_">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                      <div class="hide_logo d-xl-none" > <a href="{{ route('web.home') }}">  <img style="width:80px !important; height:80px !important; object-fit:contain !important;" src="{{ asset('assets/imgs/theme/logo-color.png') }}"> 
                         </a></div>
                    <div class="logo logo-width-1 d-block d-xl-none">
                        <div style="display: inline !important;">
                            {{-- post ad buttons for different purpose   --}}
                            @if (session('vendor_data'))
                                @if (session('vendor_data')->phone)
                                    <button onclick="window.location.href = '{{ route('web.dashboard.create_ad') }}';"
                                        style="background-color: #37B093 !important; color:rgb(255, 255, 255) ; font-size:9px !important; padding:5px !important; margin:5px 0 5px 0 !important;"
                                        class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST
                                        AD</button>
                                @else
                                    <button onclick="alert('Please update your account');"
                                        style="background-color: #37B093 !important; color:rgb(255, 255, 255) ; font-size:9px !important; padding:5px !important; margin:5px 0 5px 0 !important;"
                                        class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST
                                        AD</button>
                                @endif
                            @else
                                <button onclick="window.location.href = '{{ route('web.vendor.login') }}';"
                                    style="background-color: #37B093 !important; color:rgb(255, 255, 255) ; font-size:9px !important; padding:5px !important; margin:5px 0 5px 0 !important;"
                                    class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST
                                    AD</button>
                            @endif

                        </div>
                        <div style="display: inline !important;"> <button
                        @if(session('vendor_data')) onclick="window.location.href = '{{ route('web.ads_inquery') }}';"   @else onclick="window.location.href = '{{ route('web.vendor.login', ['id' => 'my_inquiry']) }}';"  @endif 
                                style="background-color: #37B093 !important; color:rgb(255, 255, 255) ; font-size:10px !important; padding:5px !important; margin:5px 0 5px 0 !important;"
                                class="btn btn-warning">Send Inquery</button>
                        </div>

                        {{-- next chnage  --}}

                    </div>
                    
                         <div style="display: none !important;" class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categories-button-active" href="#">
                                <span class="fi-rs-apps"></span> <span class="et">Trending</span> Categories
                                <i class="fi-rs-angle-down"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-1.svg') }}"
                                                    alt="" />Milks and Dairies</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-2.svg') }}"
                                                    alt="" />Clothing & beauty</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-3.svg') }}"
                                                    alt="" />Pet Foods & Toy</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-4.svg') }}"
                                                    alt="" />Baking material</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-5.svg') }}"
                                                    alt="" />Fresh Fruit</a>
                                        </li>
                                    </ul>
                                    <ul class="end">
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-6.svg') }}"
                                                    alt="" />Wines & Drinks</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-7.svg') }}"
                                                    alt="" />Fresh Seafood</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-8.svg') }}"
                                                    alt="" />Fast food</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-9.svg') }}"
                                                    alt="" />Vegetables</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-10.svg') }}"
                                                    alt="" />Bread and Juice</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="more_slide_open" style="display: none">
                                    <div class="d-flex categori-dropdown-inner">
                                        <ul>
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ asset('web/assets/imgs/theme/icons/icon-1.svg') }}"
                                                        alt="" />Milks and Dairies</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ asset('web/assets/imgs/theme/icons/icon-2.svg') }}"
                                                        alt="" />Clothing & beauty</a>
                                            </li>
                                        </ul>
                                        <ul class="end">
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ asset('web/assets/imgs/theme/icons/icon-3.svg') }}"
                                                        alt="" />Wines & Drinks</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ asset('web/assets/imgs/theme/icons/icon-4.svg') }}"
                                                        alt="" />Fresh Seafood</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="more_categories"><span class="icon"></span> <span
                                        class="heading-sm-1">Show more...</span></div>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <li class="hot-deals"><img
                                            src="{{ asset('web/assets/imgs/theme/icons/icon-hot-white.svg') }}"
                                            alt="hot deals" /><a href="shop-grid-right.html">Deals</a></li>
                                    <li>
                                        <a class="active" href="index.html">Home <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">Home 1</a></li>
                                            <li><a href="index-2.html">Home 2</a></li>
                                            <li><a href="index-3.html">Home 3</a></li>
                                            <li><a href="index-4.html">Home 4</a></li>
                                            <li><a href="index-5.html">Home 5</a></li>
                                            <li><a href="index-6.html">Home 6</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="page-about.html">About</a>
                                    </li>
                                    <li>
                                        <a href="shop-grid-right.html">Shop <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                            <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                            <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                            <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                            <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                            <li>
                                                <a href="#">Single Product <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="shop-product-right.html">Product – Right Sidebar</a>
                                                    </li>
                                                    <li><a href="shop-product-left.html">Product – Left Sidebar</a>
                                                    </li>
                                                    <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                                    <li><a href="shop-product-vendor.html">Product – Vendor Info</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="shop-filter.html">Shop – Filter</a></li>
                                            <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                            <li><a href="shop-cart.html">Shop – Cart</a></li>
                                            <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                            <li><a href="shop-compare.html">Shop – Compare</a></li>
                                            <li>
                                                <a href="#">Shop Invoice<i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                                    <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                                    <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                                    <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                                    <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                                    <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Vendors <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="vendors-grid.html">Vendors Grid</a></li>
                                            <li><a href="vendors-list.html">Vendors List</a></li>
                                            <li><a href="vendor-details-1.html">Vendor Details 01</a></li>
                                            <li><a href="vendor-details-2.html">Vendor Details 02</a></li>
                                            <li><a href="vendor-dashboard.html">Vendor Dashboard</a></li>
                                            <li><a href="vendor-guide.html">Vendor Guide</a></li>
                                        </ul>
                                    </li>
                                    <li class="position-static">
                                        <a href="#">Mega menu <i class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu">
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Fruit & Vegetables</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Meat & Poultry</a></li>
                                                    <li><a href="shop-product-right.html">Fresh Vegetables</a></li>
                                                    <li><a href="shop-product-right.html">Herbs & Seasonings</a></li>
                                                    <li><a href="shop-product-right.html">Cuts & Sprouts</a></li>
                                                    <li><a href="shop-product-right.html">Exotic Fruits & Veggies</a>
                                                    </li>
                                                    <li><a href="shop-product-right.html">Packaged Produce</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Breakfast & Dairy</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Milk & Flavoured Milk</a>
                                                    </li>
                                                    <li><a href="shop-product-right.html">Butter and Margarine</a></li>
                                                    <li><a href="shop-product-right.html">Eggs Substitutes</a></li>
                                                    <li><a href="shop-product-right.html">Marmalades</a></li>
                                                    <li><a href="shop-product-right.html">Sour Cream</a></li>
                                                    <li><a href="shop-product-right.html">Cheese</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Meat & Seafood</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Breakfast Sausage</a></li>
                                                    <li><a href="shop-product-right.html">Dinner Sausage</a></li>
                                                    <li><a href="shop-product-right.html">Chicken</a></li>
                                                    <li><a href="shop-product-right.html">Sliced Deli Meat</a></li>
                                                    <li><a href="shop-product-right.html">Wild Caught Fillets</a></li>
                                                    <li><a href="shop-product-right.html">Crab and Shellfish</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-34">
                                                <div class="menu-banner-wrap">
                                                    <a href="shop-product-right.html"><img
                                                            src=""
                                                            alt="Nest" /></a>
                                                    <div class="menu-banner-content">
                                                        <h4>Hot deals</h4>
                                                        <h3>
                                                            Don't miss<br />
                                                            Trending
                                                        </h3>
                                                        <div class="menu-banner-price">
                                                            <span class="new-price text-success">Save to 50%</span>
                                                        </div>
                                                        <div class="menu-banner-btn">
                                                            <a href="shop-product-right.html">Shop now</a>
                                                        </div>
                                                    </div>
                                                    <div class="menu-banner-discount">
                                                        <h3>
                                                            <span>25%</span>
                                                            off
                                                        </h3>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="blog-category-grid.html">Blog <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                            <li><a href="blog-category-list.html">Blog Category List</a></li>
                                            <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                            <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                            <li>
                                                <a href="#">Single Post <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu level-menu-modify">
                                                    <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                                    <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                                    <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Pages <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="page-about.html">About Us</a></li>
                                            <li><a href="page-contact.html">Contact</a></li>
                                            <li><a href="page-account.html">My Account</a></li>
                                            <li><a href="page-login.html">Login</a></li>
                                            <li><a href="page-register.html">Register</a></li>
                                            <li><a href="page-forgot-password.html">Forgot password</a></li>
                                            <li><a href="page-reset-password.html">Reset password</a></li>
                                            <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                            <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                            <li><a href="page-terms.html">Terms of Service</a></li>
                                            <li><a href="page-404.html">404 Page</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="page-contact.html">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div style="display: none !important;" class="hotline d-none d-lg-flex">
                       
                    </div>
                    <div class="header-action-icon-2 d-block d-xl-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        
        
    </header>

    <div class="mobile-header-active mobile-header-wrapper-style">

        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{ asset('assets/imgs/theme/logo-color.png') }}"
                            alt="logo" /></a>
                </div>

                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">

                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <div class="mobile-header-info-wrap">

                                <div class="single-mobile-header-info">
                                    @if (session('vendor_data'))
                                        <li>
                                            <a href="{{ route('web.dashboardIndex') }}"> <i
                                                    class="fa fa-user-circle mr-10" aria-hidden="true"></i>
                                                Dashboard</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('web.vendor.login') }}"><i
                                                    class="fi fi-rs-user mr-10"></i>Login</a>
                                        </li>
                                    @endif
                                    <li>
                                        @if (session('vendor_data'))
                                            <a href="{{ route('web.vendor.logout') }}"><i
                                                    class="fi fi-rs-sign-out mr-10"></i>Sign
                                                out</a>
                                        @endif

                                </div>

                            </div>

                            <li class="menu-item-has-children">
                                <a href="{{ route('web.home') }}">Home</a>

                            </li>
                            <li class="menu-item-has-children">
                                <a @if(session('vendor_data'))  href="{{ route('web.inqueryAds') }}" @else href="{{ route('web.inquery_for_visitors') }}"   @endif >View Inquery ({{ $count->count() }})</a>

                            </li>
                          
                            <li class="menu-item-has-children">
                                <a href="{{ route('web.home') }}">About</a>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('web.home') }}">All Ads</a>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('web.home') }}">Contact</a>

                            </li>

                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>

                <div class="mobile-social-icon mb-50">
                    <p class="mb-15">Follow Us</p>
                    <a target=”_blank” href="https://www.facebook.com/people/Autoboxlk/100089362809118/"><img src="{{ asset('web/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                            alt="" /></a>
                  
                    <a target=”_blank” href="https://www.youtube.com/channel/UC-A5eIT2UqbSJ19AANjtgWA"><img src="{{ asset('web/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                            alt="" /></a>
                </div>

            </div>
        </div>
    </div>
    <!--End header-->

    @yield('content')

    <footer style="background-color: #032234; " class="main">
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div style="justify-content: center !important;  display: flex !important;" class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 col_adjust_justify">
                        <div  class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0">
                            <div class="logo mb-30">
                                <a href="{{ route('web.home') }}" class="mb-15"><img
                                        src="{{ asset('assets/imgs/theme/logo-color.png') }}" alt="logo" /></a>
                            </div>
                            <h2 style="font-size:14px !important; font-weight:400 !important;" class="text-white">We are the largest auto spare parts marketplace in Sri Lanka. If you need the best auto parts for your vehicle.You can search the most suitable & affordable spare parts from various suppliers across the country.</h2>
                          
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col_adjust_justify">  
                    <div  class="footer-link-widget ">
                        <h4 style="color: white !important;" class="widget-title">Links</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="{{ route('web.about') }}">About Us</a></li>
                            <li><a href="{{ route('web.refund') }}">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="{{ route('web.contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-12 col-sm-12 col_adjust_justify">  
                    <div   class="footer-link-widget ">
                        <h4 style="color: white !important;" class="widget-title">Address</h4>
                           <ul style="color: white !important;" class="contact-infor">
                                <li><strong>Address: </strong> <span>197 Kaldemulla Road, moratuwa</span></li>
                                <li><strong>Call
                                        Us:</strong><span> <br> <a href="tel:0112607042">0112607042 </a>  <br> <a href="tel:0706585101">0706585101</a>  <br><a href="tel:0706585100">0706585100</a> </span></li>
                                <li><strong>Email:</strong><span>sale@autobox.com</span></li>
                                </li>
                            </ul>
                    </div>
                    </div>
                    
                   <div class="col-lg-3 col-md-12 col-sm-12 col_adjust_justify">
                    <div    class="footer-link-widget widget-install-app ">
                        <h4 style="color: white !important;" class="widget-title">Install App</h4>
                        <p style="color: white !important;" class="wow fadeIn animated">From App Store or Google Play
                        </p>
                        <div class="download-app">
                            <a href="#" class="hover-up mb-sm-2 mb-lg-0"><img style="height:60px !important; object-fit:cover !important; width:60px !important;"
                                    class="active" src="https://i.ibb.co/QkCVtB2/app-store.png" alt="" /></a>

                            <a href="#" class="hover-up mb-sm-2"><img style="height:60px !important; object-fit:cover !important; width:60px !important;"
                                    src="https://i.ibb.co/z2xLY7s/playstore.png" alt="" /></a>
                        </div>
                        
                          <div class="mobile-social-icon">
                            <h6 style="color: white">Follow Us</h6>
                            <a style="background-color: transparent ;" target="_blank" href="https://www.facebook.com/profile.php?id=100089362809118"><img
                                    style="background-color: none !important; object-fit:contain !important; "
                                    src="https://i.ibb.co/5GSSkXL/facebook.png" alt="facebook"> </a>
                        
            
                            <a style="background-color: transparent ; " target="_blank" href="https://www.youtube.com/channel/UC-A5eIT2UqbSJ19AANjtgWA"><img
                                    style="background-color: none !important; object-fit:contain !important;"
                                    src="https://i.ibb.co/vHmMMNr/youtube.png" alt="" /></a>
                           </div>
                    
                    </div>
                    </div>
                    
                    
                </div>
            </div>
        </section>
        <div style="background-color: #001923 !important;" class="container-fluid pb-30">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                 <p style="font-size:14px !important;">© All Rights Reserved Autobox pvt ltd | Web Design by SATASME</p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                <!--<div class="mobile-social-icon">-->
                <!--<h6 style="color: white">Follow Us</h6>-->
                <!--<a style="background-color: transparent ;" target="_blank" href="https://www.facebook.com/profile.php?id=100089362809118"><img-->
                <!--        style="background-color: none !important; object-fit:contain !important; "-->
                <!--        src="https://i.ibb.co/5GSSkXL/facebook.png" alt="facebook"> </a>-->
            

                <!--<a style="background-color: transparent ; " target="_blank" href="https://www.youtube.com/channel/UC-A5eIT2UqbSJ19AANjtgWA"><img-->
                <!--        style="background-color: none !important; object-fit:contain !important;"-->
                <!--        src="https://i.ibb.co/vHmMMNr/youtube.png" alt="" /></a>-->
                <!--    </div>-->

                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end ">
                  

                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('web/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('web/assets/js/shop.js?v=5.3') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>

</body>

</html>
