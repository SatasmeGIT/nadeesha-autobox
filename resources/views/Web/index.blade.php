@extends('Web.Layout.Layout')
@section('content')
    <style>
        ::placeholder {
            color: rgb(0, 0, 0) !important;
        }

        .select2-container {
            min-width: 100% !important;
        }

        .select2-web-container {
            width: 100% !important;
            margin: 4px !important;
            padding: 4px !important;
        }

        .js-example-basic-single+.select2-container .select2-selection {
            border-radius: 10px !important;
            height: 58px !important;
            text-align: center !important;
        }

        .product-cart-wrap .product-img-action-wrap {
            max-height: none !important;
        }

        .category_image {
            width: 15%;
            height: auto;
        }

        .product-cart-wrap .product-img-action-wrap {
            background-color: #d9e0d9 !important;
        }

        .product-cart-wrap .product-img-action-wrap {
            padding: 4px !important;
        }

        .product-info {
            background-color: rgba(255, 255, 255, 0.5) !important;
            /* Adjust the opacity value (0 to 1) to make it more or less transparent */
            border-radius: 10px !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            padding: 20 !important;
            border-radius: 0 !important;
        }

        .product-info p.category {
            font-size: 14px !important;
            color: #333 !important;
        }

        .product-info h5.title {
            font-size: 20px !important;
            color: #333 !important;
            margin-top: 10px !important;
        }

        .product-info h3.price {
            font-size: 24px !important;
            color: #333 !important;
            margin-top: 10px !important;
            font-weight: bold !important;
        }
        .text-color-white{
            color:#fff !important;
        }
        .mobile-social-icon a img{
            max-width: 25px !important;
        }
        
        /* Custom CSS to set object-fit to contain for the background image */
        .bg-contain {
            background-size: cover !important;
            background-repeat: no-repeat !important;
            background-position: center center !important;
        }
        .section-padding{
            padding: 18px 0 !important;
        }

       
        @media (min-width: 1025px) and (max-width: 1200px) {
            .web_filter_div {
                margin-top: 100px !important;
               
            }
        }
    </style>

    <main class="main">
        <section  class="home-slider position-relative">
            <div  class="home-slide-cover">
                <div  class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                    @foreach ($slider as $item)
                        <div class="single-hero-slider rectangle single-animation-wrap" style="position: relative;">
                            <div class="slider-content">
                                <p class=" mb-10 text-color-white">Best way of the delivering</p>
                                <h1 class="display-2 mb-10">
                                    <span style="color: white !important;">Your Journey <br>
                                        With</span>
                                    <span style="color: #FCCC21;">AutoBox</span>
                                </h1>
                                <p style="margin-left:20px !important;" class="text-color-white ">Upgrade Your Ride, Unleash Peak Performance</p>

                            </div>
                            <div
                                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: url('{{ asset('assets/myCustomThings/slider/' . $item->image) }}'); background-size: cover; background-position: center; filter: blur(1px); z-index: -1;">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        </section>

        <div class="d-none d-lg-block web_filter_div"
            style="padding-top: 13px !important; background-color: #00A791 !important; border: 2px solid #41d49cce; ">
            <form method="POST" action="{{ route('web.main.filter') }}">
                @csrf
                <div
                    style=" background-color: #00A791; display: flex; align-items: center; justify-content: center;  padding: 0px; ">
                    <div class="select2-web-container">
                        <select   name="district" class="js-example-basic-single"
                            style="background-color: white; margin-right: 4px; height: 55px !important;">
                            <option value="">Any Location </option>
                            @foreach ($districts as $district)
                                <option value="{{ $district }}">{{ $district }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select2-web-container">
                        <select name="type" class="js-example-basic-single" onchange="handleTypeChange(this.value)"
                            style="background-color: white; margin-right: 4px; height: 55px !important;">
                            <option value="">Any Type *</option>
                            @foreach ($vehicle_types as $id => $vehicle_type)
                                <option value="{{ $id }}">{{ $vehicle_type }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="select2-web-container">
                        <select id="brands_display" onchange="handleBrandsChange(this)" name="brand"
                            class="js-example-basic-single"
                            style="background-color: white; margin-right: 4px; height: 55px !important;">
                            <option value="">Any Make </option>
                        </select>

                    </div>
                    <div class="select2-web-container">
                        <select id="models_display" name="model" class="js-example-basic-single"
                            style="background-color: white; margin-right: 4px; height: 55px !important;">
                            <option value="">Any Model </option>

                        </select>
                    </div>
                    <div class="select2-web-container">
                        <input name="title" placeholder="search by title"
                            style="height: 55px !important; background-color:#d9e0d9 !important;" type="text">
                    </div>
                    <button style="height: 57px !important; color:#673500; border-radius: 25px; background-color: #FFC800;"
                        class="btn ">Search</button>
                </div>
            </form>
        </div>

        <div class="d-block d-lg-none" style="padding: 1px !important; background-color: rgb(255, 255, 255);">
            <form method="POST" action="{{ route('web.main.filter') }}">
                @csrf
                <div
                    style="background-color: rgb(0, 0, 0); display: flex; flex-direction: column; align-items: center; justify-content: center; border: 2px solid green; border-radius: 50px; padding: 20px;">
                    <div class="select2-container" style="width: 100%; margin:4px !important;">
                        <select
                            style="background-color: white !important; height: 55px !important; margin-bottom: 10px !important; width: 100% !important;"
                            class="js-example-basic-single"name="district">
                            <option value="">Choose District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district }}">{{ $district }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="select2-container" style="width: 100%; margin:4px !important;">
                        <select onchange="handleTypeChange(this.value)"
                            style="background-color: white !important; height: 55px !important; margin-bottom: 10px !important; width: 100% !important;  "
                            class="js-example-basic-single" name="type">
                            <option value="">Choose Type *</option>
                            @foreach ($vehicle_types as $id => $vehicle_type)
                                <option value="{{ $id }}">{{ $vehicle_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="select2-container" style="width: 100%; margin:4px !important;">
                        <select id="brands_display_mobile" onchange="handleBrandsChange(this)"
                            style="background-color: white !important; height: 55px !important; margin-bottom: 10px !important; width: 100% !important;"
                            class="js-example-basic-single" name="brand">
                            <option value="">Choose Make *</option>
                        </select>
                    </div>

                    <div class="select2-container" style="width: 100%; margin:4px !important;">
                        <select id="first_web_select"
                            style="background-color: white !important; height: 55px !important; margin-bottom: 10px !important; width: 100% !important;"
                            class="js-example-basic-single models_display_mobile" name="model">
                            <option value="">Choose Model *</option>

                        </select>
                    </div>

                    <div class="select2-container" style="width: 100%; margin:4px !important;">
                        <input class="text-center" type="text" placeholder="search by title" name="title"
                            style="background-color: white !important;">
                    </div>
                    <button class="btn"
                        style="height: 57px !important; border-radius: 25px; background-color: #37B093; border: none; color: white; width: 100%; margin:4px !important;">Search</button>
                </div>
            </form>
        </div>

        <section class="bg-grey-1 section-padding  pb-10  wow animate__animated animate__fadeIn">
            <div style="padding: 15px; background-color: #d9e0d9 !important;" class="container-fluid card">
                <h1 class="mb-20 text-center "
                    style="font-size: 2.5rem !important; color: #000000ce !important; font-weight: bold !important; text-transform: uppercase !important; font-family: Tahoma, sans-serif !important;">
                    RECENT <span style="color: #FFC800 !important;">AUTOPARTS</span></h1>
                <h3 style="color: rgb(0, 0, 0) !important; font-size:15px !important; font-weight:400 !important;"
                    class="mb-20 text-center">Choose
                    From Top Brands Including
                    Toyota, Nissan, Honda, and Suzuki</h3>

                <div class="row product-grid">
                    @if (count($latest_ads) > 0)
                    @else
                        <h6 class="text-center">There is no records</h6>
                    @endif
                    @foreach ($latest_ads as $item)
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div style="margin: 13px;" class="product-card"
                                style="border: 1px solid #37B093; margin-bottom: 0 !important; border-radius: 8px;">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('web.detailed_ad', ['id' => $item->id]) }}"
                                            style="position: relative; display: inline-block; width: 100%;">
                                            <img style="height: 300px; width: 100%; object-fit: cover !important;"
                                                src="{{ asset('assets/myCustomThings/vehicleTypes/' . $item->name) }}"
                                                alt="{{ $item->ad_title }}" />
                                            @if ($item->is_top_id == 1)
                                                <i style="position: absolute; top: 10px; right: 10px; font-size: 20px; color: #ff0000;"
                                                    class="fa-solid fa-medal"></i>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div style="padding: 13px !important; @if ($item->is_top_id == 1) border:#37B093 2px solid !important; @endif background-color:#00A791 !important; height:270px !important;"
                                    class="product-info">
                                    <p style="color:white !important; margin-bottom:0px !important;" class="category">
                                        {{ $item->vt_name }}</p>
                                    <p style="color:white !important; margin-bottom:0px !important;" class="category">Ad
                                        number :
                                        {{ $item->ad_number }}</p>
                                    <p style="color:white !important; margin-bottom:0px !important;" class="title">
                                      {{ Illuminate\Support\Str::limit($item->ad_title, 50) }}

                                    </p>
                                    <div style="text-align: center !important; margin-top:4px !important;">
                                        <hr
                                            style="margin: 0 auto; color: #d9e0d9 !important; width: 100% !important; height: 4px !important;">
                                    </div>

                                    <h4 style="color:white !important;" class="price">
                                     @if (!empty($item->ad_price))
                                        Rs.{{ number_format($item->ad_price, 2, '.', '') }}
                                    @else
                                        Negotiable
                                    @endif </h4>
                                    <p style="margin-top: 3px !important; color:white !important;" class="price"><i
                                            style="font-size:20px; margin:10px;" class="fa">&#xf041;</i>
                                        {{ $item->ad_district }} {{ $item->ad_city }}</p>
                                    <p style="color: white !important;" class="category">  {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                     <p style="color: white !important;" class="category"> <i class="fa-sharp fa-solid fa-eye fa-beat-fade p-1" style="color: #000;"></i> {{ $item->ad_view_count }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach


                        </div>
                        <div class="text-center">
                            <a href="{{ route('web.allads.view') }}"
                                style="border-radius: 20px !important; background-color:#37B093 !important; margin-top:20px !important;"
                                class="btn btn-success">View All</a>
                        </div>
                    </div>
                </section>
        
        
                 <div class="mb-3" style="background-image: url('https://i.ibb.co/7z5NG7G/Ad.png');"  >
                    <div class="row">
                        <div class="col-lg-12">
                            <div >
                                <div class=" text-center">
                              
                                    <a style="background-color: #FFC800 !important; color: #673500 !important;" class="btn  btn-lg m-5"
                                       href="{{ route('web.garage.findMyGarage') }}" >
                                        Find My
                                        Garage <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                    
                                    <h4 class="mb-4 text-uppercase text-color-white">
                                        Explore Our Garage List 
                                    </h4>
                                    
                                </div>
                                 <p style="text-align:center !important;" class="mb-4 text-color-white mx-auto w-75">
                                     Discover the perfect garage for your vehicle needs with Find My Garage. Our user-friendly platform connects you to trusted auto service centers, ensuring quality repairs and maintenance. Locate nearby garages effortlessly and experience expert care for your vehicle. Drive with confidence, knowing your car is in capable hands.
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
    
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="home-slide-cover">
                        <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                            @foreach ($banner as $item)
                            <div class="single-hero-slider single-animation-wrap bg-contain" style="background-image: url({{ asset('assets/myCustomThings/mainBanner/' . $item->image) }})">
                            </div>  
                            @endforeach
                        </div>
                        <div class="slider-arrow hero-slider-1-arrow"></div>
                    </div>
                </div>
            </div>
        </div>

        <div style="background-color: #d9e0d9; ">
            <div style="margin: 15px 0 15px 0 !important;">
                <div class="row ">
                    <h2
                        style="color: #032234; text-align:center;  font-family: Tahoma, sans-serif !important; margin:15px !important;">
                        AUTO PARTS
                        <span style="color:#FFC800">CATEGORIES</span>
                    </h2>
                    <p class="text-center">Revitalize Your Ride: Explore Top-Quality Auto Parts in Our Comprehensive and Convenient Categorization Hub Today!</p>
                    <div class="col-2"></div>
                    <div class="col-8 row " style="margin-top: 10px;">

                        <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height ">
                            <a href="{{ route('web.allads.vehicleType', ['id' => 4]) }}">
                                <div style="border-radius: 20px !important; background-color:#ffffff !important;"
                                    class="card mb-3">
                                    <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                      <div style="display: flex; justify-content: center; align-items: center;">
                                            <img style="width:100% !important; height:80px !important;" class="category_image  m-2"
                                                src="https://i.ibb.co/DCmKNvx/icon-1.png"
                                                alt="">
                                        </div>
                                        <p class="text-center">MOTOR BIKES</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height ">
                            <a href="{{ route('web.allads.vehicleType', ['id' => 5]) }}">
                                <div style="border-radius: 20px !important; background-color:#ffffff !important;"
                                    class="card mb-3">
                                  <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                      <div style="display: flex; justify-content: center; align-items: center;">
                                            <img style="width:100% !important; height:80px !important;" class="category_image  m-2"
                                                src="https://i.ibb.co/F6js9FN/icon-2.png"
                                              
                                                alt="">
                                        </div>

                                        <p class="text-center"> CAR-SUV-CABs</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                      <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height">
                            <a href="{{ route('web.allads.vehicleType', ['id' => 6]) }}">
                                <div style="border-radius: 20px !important; background-color: #ffffff !important;"
                                    class="card mb-3">
                                    <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                        <div style="display: flex; justify-content: center; align-items: center;">
                                            <img style="width: 100% !important; height:80px !important;" class="category_image  m-2"
                                                src="https://i.ibb.co/685DJSp/icon-4.png"
                                                alt="">
                                        </div>
                                        <p class="text-center">THREE WHEELERS</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height ">
                            <a href="{{ route('web.allads.vehicleType', ['id' => 7]) }}">
                                <div style="border-radius: 20px !important; background-color:#ffffff !important;"
                                    class="card mb-3">
                                    <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                      <div style="display: flex; justify-content: center; align-items: center;"> 
                                       <img style="width:100% !important; height:80px !important;" class="category_image m-2"
                                            src="https://i.ibb.co/yNjMXcT/icon-15.png"
                                            alt="">
                                            </div>
                                       
                                        <p class="text-center">BICYCLES</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height ">
                            <a href="{{ route('web.allads.vehicleType', ['id' => 8]) }}">
                                <div style="border-radius: 20px !important; background-color:#ffffff !important;"
                                    class="card mb-3">
                                   <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                      <div style="display: flex; justify-content: center; align-items: center;">
                                            <img style="width:100% !important; height:80px !important;" class="category_image  m-2"
                                                src="https://i.ibb.co/0cqfn7w/icon-3.png"
                                              
                                                alt="">
                                        </div>

                                        <p class="text-center">LORRIES AND TRUCKS</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height ">
                            <a href="{{ route('web.allads.vehicleType', ['id' => 9]) }}">
                                <div style="border-radius: 20px !important; background-color:#ffffff !important;"
                                    class="card mb-3">
                                    <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                        <div  style="display: flex; justify-content: center; align-items: center;" >  <img style="width:100% !important; height:80px !important;" class="category_image m-2"
                                            src="https://i.ibb.co/x2Yv1vG/icon-17.png"
                                            alt="">
                                            </div>
                                      
                                        <p class="text-center">VANS</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                       <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height">
                        <a href="{{ route('web.allads.vehicleType', ['id' => 10]) }}">
                            <div style="border-radius: 20px !important; background-color: #ffffff !important;"
                                class="card mb-3">
                                <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <img style="width: 100% !important; height:80px !important; " class="category_image m-2"
                                            src="https://i.postimg.cc/hvRWdZPh/icon-21.png"
                                            alt="">
                                    </div>
                                    <p class="text-center">TRACTORS</p>
                                </div>
                            </div>
                        </a>
                     </div>


                        <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height ">
                            <a href="{{ route('web.allads.vehicleType', ['id' => 11]) }}">
                                <div style="border-radius: 20px !important; background-color:#ffffff !important;"
                                    class="card mb-3">
                                    <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                        <div style="display: flex; justify-content: center; align-items: center;">  
                                        <img  style="width:100% !important; height:80px !important;" class="category_image m-2"
                                            src="https://i.ibb.co/Qkhdpf8/icon-19.png"
                                            alt="">
                                        </div>
                                        <p class="text-center">HEAVY DUTY</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height ">
                            <a href="{{ route('web.allads.vehicleType', ['id' => 12]) }}">
                                <div style="border-radius: 20px !important; background-color:#ffffff !important;"
                                    class="card mb-3">
                                    <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                        <div style="display: flex; justify-content: center; align-items: center;">  
                                        <img style="width:100% !important; height:80px !important;" class="category_image m-2"
                                            src="https://i.ibb.co/WzgKWHh/icon-16.png" alt="">
                                            
                                        </div>    
                                        <p class="text-center">BUSES</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 vehicle_type_check_height ">
                            <a href="{{ route('web.allads.vehicleType', ['id' => 13]) }}">
                                <div style="border-radius: 20px !important; background-color:#ffffff !important;"
                                    class="card mb-3">
                                    <div class="p-3 d-flex flex-column align-items-center justify-content-center">
                                        <div  style="display: flex; justify-content: center; align-items: center;">  
                                        <img style="width:100% !important; height:80px !important;" class="category_image m-2"
                                            src="https://i.postimg.cc/zBqmMjxb/icon-18.png"
                                            alt="">
                                        </div>
                                        <p class="text-center">BOATS AND WATER TRANSPORT</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>

    </main>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();


        });

         function handleTypeChange(selectedValue) {
         var models_appends = '';
         models_appends += '<option value="" selected >Any Model</option>';
         
         var brand_appends = '';
         brand_appends += '<option value="" selected >Any Maker</option>';
         
         $("#models_display").html(models_appends);
         $(".models_display_mobile").html(models_appends);
         
          $("#brands_display").html(brand_appends);
         $("#brands_display_mobile").html(brand_appends);
         
         
         //disable select 
          $("#brands_display").prop("disabled", true);
          $("#brands_display_mobile").prop("disabled", true);
          
          $("#models_display").prop("disabled", true);
          $(".models_display_mobile").prop("disabled", true);
              
            // Make AJAX request
            $.ajax({
                url: '{{ url('Web/Brand') }}' + '/' + selectedValue + '/Get',
                method: 'GET',
                success: function (data) {
               
                var brands_append = '';
                brands_append += '<option value="" selected >Any Maker</option>';
                $.each(data, function (index, row) {
                    if (row.brand_name) { // Check if the name_en property is not empty
                        brands_append += '<option value="' + row.id +
                            '" data-custom-attribute="' +
                            row.id + '">' +
                            row.brand_name + '</option>';
                    }
                });
                    
         $("#brands_display").html(brands_append);
         $("#brands_display_mobile").html(brands_append);
                    
           //disable select 
          $("#brands_display").prop("disabled", false);
          $("#brands_display_mobile").prop("disabled", false);
          
           $("#models_display").prop("disabled", false);
          $(".models_display_mobile").prop("disabled", false);
                },
                error: function (error) {
                               //disable select 
          $("#brands_display").prop("disabled", false);
          $("#brands_display_mobile").prop("disabled", false);
          
           $("#models_display").prop("disabled", false);
          $(".models_display_mobile").prop("disabled", false);
                   
                }
            });
    }


      function handleBrandsChange(selectElement) {
    // Get the selected option
    var selectedOption = selectElement.options[selectElement.selectedIndex];

    // Retrieve the special attribute value
    var specialAttributeValue = selectedOption.getAttribute('data-custom-attribute');
    
    //disable select 
          $("#brands_display").prop("disabled", true);
          $("#brands_display_mobile").prop("disabled", true);
          
          $("#models_display").prop("disabled", true);
          $(".models_display_mobile").prop("disabled", true);

        // Make AJAX request
        $.ajax({
            url: '{{ url('Web/Models') }}' + '/' + specialAttributeValue + '/Get',
            method: 'GET',
            success: function (data) {
    
                var models_appends = '';
                models_appends += '<option value="" selected >Any Model</option>';
                $.each(data, function (index, row) {
                    if (row.model_name) { // Check if the model_name property is not empty
                        models_appends += '<option value="' + row.id +
                            '" data-custom-attribute="' +
                            row.id + '">' +
                            row.model_name + '</option>';
                    }
                });
                $("#models_display").html(models_appends);
                $(".models_display_mobile").html(models_appends);
                
                //disable select 
          $("#brands_display").prop("disabled", false);
          $("#brands_display_mobile").prop("disabled", false);
          
          $("#models_display").prop("disabled", false);
          $(".models_display_mobile").prop("disabled", false);
            },
            error: function (error) {
                
                //disable select 
          $("#brands_display").prop("disabled", false);
          $("#brands_display_mobile").prop("disabled", false);
          
          $("#models_display").prop("disabled", false);
          $(".models_display_mobile").prop("disabled", false);
    
            }
        });
}

    </script>
@endsection
