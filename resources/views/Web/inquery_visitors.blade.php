@extends('Web.Layout.Layout')
@section('content')
    <!-- start filter  -->
    <main class="main remove_white_background">
        <div class="page-header breadcrumb-wrap  mb-10">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="#"> inquery ads</a>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="card p-3">
            To view auto parts inquiry ads (ස්වයංක්‍රීය අමතර කොටස් විමසීම් දැන්වීම් නැරඹීම සඳහා) : 
            <ol>
                <li>1. You must be logged in to the website.(ඔබ වෙබ් අඩවියට ලොග් වී සිටිය යුතුය.)</li>
                <li>2. You must purchase our ad package. (ඔබ අපගේ දැන්වීම් පැකේජය මිලදී ගත යුතුය.)<li>
            </ol>
            </div>
            
            <div style="margin:auto !important;" class="card p-3 text-center">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('web.dashboard.adsPackages') }}" style="width:200px !important;" type="button" class="btn btn-primary mb-2">Buy Packages</a>
                </div>
                <div class="d-flex justify-content-center">
                    @if(session('vendor_data')) 
                    
                    @else
                    <a href="{{ route('web.vendor.login',['id'=>'inquery']) }}" style="width:200px !important;" type="button" class="btn btn-primary">Login</a>

                    @endif
                </div>
            </div>

            
        </div>
    </main>

@endsection