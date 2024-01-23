@extends('Web.Layout.Layout')
@section('content')
    <main class="main page-404">
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">

                        <p class="mb-20"><img style="height: 200px !important; width: 200px !important;  "
                                src="https://i.ibb.co/64ZL9fk/meteor-rain.gif" alt="" class="hover-up" />

                        </p>
                        <h1 class="display-2 mb-30">Your ad published</h1>
                        <p class="font-lg text-grey-700 mb-30">
                            Approved
                        </p>

                        <a href="{{ route('web.dashboardIndex') }}"
                            class="btn btn-default submit-auto-width font-xs hover-up mt-30"><i
                                class="fi-rs-home mr-5"></i> My ads</a>
                                  <a href="{{ route('web.dashboard.create_ad') }}" style="background:#ffc107 !important;"
                            class="btn btn-default submit-auto-width font-xs hover-up mt-30"><i class="fa fa-plus" aria-hidden="true"></i>Publish Ad</a>
                            
                            <table class="table mt-2">
                              <tbody>
                                <tr>
                                  <td>Package expire date</td>
                                  <td>{{ \Carbon\Carbon::parse($data->package_expire_date)->diffForHumans() }}</td>
                                </tr>
                                  <tr>
                                  <td>Available ad count</td>
                                  <td>{{ $data->available_ad_count }}</td>
                                </tr>
                                  <tr>
                                  <td>Available topad count</td>
                                  <td>{{ $data->available_top_count }}</td>
                                </tr>
                           
                              </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
