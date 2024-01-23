@extends('Web.Layout.Layout')
@section('content')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Payment Success
                </div>
            </div>
        </div>


        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="d-flex flex-column text-center">
                      <div class="p-2 success-message font-weight-bold" style="font-size:20px; "> Payment Successful</div>
                      <div class="p-2"> <img style="height:300px !important; width:300px !important;" src="{{ asset('payment-credit-card-svgrepo-com.svg') }}" alt="SVG Image"></div>
                      <div class="p-2">  <a href="{{ route('web.dashboardIndex') }}" class="btn btn-link" style="color: black;  backgroud-color:#34eb9e !important;">Back to DashBoard</a></div>
                    </div>
               
                </div>
            </div>
        

        </div>
    </main>
@endsection
