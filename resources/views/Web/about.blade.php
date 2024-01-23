@extends('Web.Layout.Layout')
@section('content')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> About us
                </div>
            </div>
        </div>
        
        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="row align-items-center mb-50">
                            <div class="col-lg-6" style=" align-items: center !important;">
                                <img style="object-fit: cover !important;"
                                    src="{{ asset('assets/imgs/statics/pexels-pixabay-162553.jpg') }}" alt=""
                                    class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4" />

                            </div>

                          <div class="col-lg-6 ">
                            <div class="pl-25">
                                <h2 class="mb-30">Welcome to AutoBox</h2>
                                <p style="text-align: justify !important;" class="mb-25">We are the largest auto spare parts marketplace in Sri Lanka. If you need the best auto parts for your vehicle, login to <a href="http://www.autobox.lk">www.autobox.lk</a>. You can search the most suitable & affordable spare parts from various suppliers across the country.</p>
                                <p style="text-align: justify !important;" class="mb-25">Also, we are providing a list of garages near to your location & you can simply contact them very easily. If you are willing to sell your vehicle spare parts through our website, it is the easiest & budgeted way to sell them momentarily. Having a broadly spread client base like us is the best decision for your marketing purposes.</p>
                                <p style="text-align: justify !important;" class="mb-50">We, <a href="http://www.autobox.lk">www.autobox.lk</a>, give value for money. From that, our customers can select many various top-quality items with brands for competitive prices.</p>
                                <p style="text-align: justify !important;" class="mb-50">So, how lucky you are joining with us. Don’t waste your time. Visit us for your vehicle spare parts need.</p>
                            </div>
                        </div>

                        </section>
                        <section class="text-center mb-50">
                            <h2 class="title style-3 mb-40">OUR ADVANTAGES </h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-24">
                                    <div class="featured-card">
                                      
                                        <h4>Are you looking to buy spare parts?</h4>
                                        <p>You can easily come to our website <a href=" www.autobox.lk"> www.autobox.lk</a>
                                            & type the vehicle par you need
                                            in search bar.
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-24">
                                    <div class="featured-card">
                                      
                                        <h4>Are you looking to sell spare parts</h4>
                                        <p>You can go with easy simple path to advertise your advertisement.</p>

                                    </div>
                                </div>

                            </div>
                        </section>

                    </div>
                </div>
            </div>
            <section class="container mb-50 d-none d-md-block">
                <div class="row about-count">
                    <div class="col-lg-1-5 col-md-6 text-center mb-lg-0 mb-md-5">
                        <h1 class="heading-1"><span class="count">12</span>+</h1>
                        <h4>Glorious years</h4>
                    </div>
                    <div class="col-lg-1-5 col-md-6 text-center">
                        <h1 class="heading-1"><span class="count">36</span>+</h1>
                        <h4>Happy clients</h4>
                    </div>

                    <div class="col-lg-1-5 text-center d-none d-lg-block">
                        <h1 class="heading-1"><span class="count">26</span>+</h1>
                        <h4>Ads</h4>
                    </div>
                </div>
            </section>

            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            <h2 class="title style-3 mb-120 text-center">Our Team</h2>
                            <div class="row">

                                <div class="col-lg-12 mb-lg-0 mb-md-5 mb-sm-5">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="team-card">
                                               
                                                <div class="content text-center">
                                                    <h4 class="mb-5">A.A.M.L.SAMPATH</h4>
                                                    <span>Director</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="team-card">
                                              
                                                <div class="content text-center">
                                                    <h4 class="mb-5">A.A.M.L.SAMPATH</h4>
                                                    <span>Director</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="team-card">
                                              
                                                <div class="content text-center">
                                                    <h4 class="mb-5">M.H.H.I.THISERA</h4>
                                                    <span>Marketing Executive</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="team-card">
                                               
                                                <div class="content text-center">
                                                    <h4 class="mb-5">A.A.C.L.DEVINDA</h4>
                                                    <span>Marketing Executive</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="team-card">
                                              
                                                <div class="content text-center">
                                                    <h4 class="mb-5">S.C.SUMANASEKARA</h4>
                                                    <span>Assistant Manager Operation</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="team-card">
                                               
                                                <div class="content text-center">
                                                    <h4 class="mb-5">L.B.S.KALPANI</h4>
                                                    <span>Assistant Manager Operation</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
