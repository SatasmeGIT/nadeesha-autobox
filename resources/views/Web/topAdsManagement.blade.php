@extends('Web.Layout.Layout')
@section('content')
    <style>
        .content-container {
            position: relative;
            background-color: rgba(255, 255, 255, 0.8);
            /* Add a background color to the content container if needed */
            padding: 20px;
        }

        .hover_green_color:hover {
            border: 1px green solid;
            border-radius: 5px;

        }
    </style>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="{{ route('web.dashboardIndex') }}">Dashboard</a> <span></span> <a
                        href="#">Buy Top Ads </a>
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5>Top Ads Packages @if(empty($checkPackage)) <p>(You need to buy ad package first)</p> @endif</h5>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            @foreach ($data as $single)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card m-2 hover_green_color">

                                        <div style="background-color: rgba(255, 255, 255, 0.8);"
                                            class="card card_trans p-2">
                                            <table>
                                                <tr>
                                                    <td>Package Name</td>
                                                    <td>{{ $single->package_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Package Price</td>
                                                    <td>Rs. {{ $single->package_price }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Top Ads</td>
                                                    <td>{{ $single->count }}</td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td><a @if(empty($checkPackage)) style="pointer-events: none; background-color: gray; cursor: not-allowed; position: relative;" @endif class="btn btn-sucess"
                                                                onclick="payedActivateTopAdsPackages({{ $single->id }})">Buy
                                                                Now</a></td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    
      <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script>
        function payedActivateTopAdsPackages(id){
         //need to create ajax

         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); //ajax setup
        
         $.ajax({
            url: '{{ url('Web/Vendor/createHashPayhereTopads') }}/' + id,

                method: 'GET',
                success: function(data) {
                // alert(data)
                var decodedData = JSON.parse(data)    

                    // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID:" + orderId);
                console.log("Decoded Data:", decodedData['package_id']); // Log decodedData
                // Note: validate the payment and show success or failure page to the customer
        
                // add topads package to user start
    
              $.ajax({
              url: '{{ url('Web/Vendor/ActivateTopAdsPackage') }}' + '/' + id ,
              method: 'GET',
              success: function(response) {
          
              },
              error: function(error) {
              // Handle error if necessary
              }
              });
        
        // add package to user end
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };

    // Put the payment variables here
    var payment = {
        "sandbox": true,
        "merchant_id": "1224415",    // Replace your Merchant ID
        "return_url": "https://satasmephp.shop/freePackageSuccessMessage",     // Important
        "cancel_url": "https://satasmephp.shop/freePackageSuccessMessage",     // Important
        "notify_url": "https://satasmephp.shop/Web/Vendor/topAds",
        "order_id": decodedData['order_id'],
        "items": decodedData['items'],
        "amount": decodedData['amount'],
        "currency": decodedData['currency'],
        "hash":  decodedData['hash'], // *Replace with generated hash retrieved from backend
        "first_name": decodedData['first_name'],
        "last_name": decodedData['last_name'],
        "email": decodedData['email'],
        "phone": decodedData['phone'],
        "address": decodedData['address'],
        "city": decodedData['city'],
        "country": decodedData['country'],
        "delivery_address": decodedData['delivery_address'],
        "delivery_city": decodedData['delivery_city'],
        "delivery_country": decodedData['delivery_country'],
        "custom_1": "",
        "custom_2": ""
  
    };

    payhere.startPayment(payment);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
