@extends('Admin.Layout.layout')
@section('section')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dashboard</h2>
            <p>Whole data about your business here</p>
        </div>
        <div>
            <!--<a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a>-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-primary-light"><i class="fa fa-usd text-success" aria-hidden="true"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Revenue</h6>
                        <span>Rs. {{ number_format($package_total + $topup_total, 2) }}</span>
                        <span class="text-sm"> Total </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="fa fa-address-card text-success"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Active ads</h6>
                        <span>{{ $ads_count }}</span>
                        <span class="text-sm"> number of ads </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="fa fa-user text-success"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Active Users</h6>
                        <span>{{ $users_count }}</span>
                        <span class="text-sm"> number of users </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-info-light"><i class="fa fa-pie-chart text-success"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Monthly Earning</h6>
                        <span>Rs. {{ number_format($currentMonthRevenueTopups + $currentMonthRevenuePackage, 2) }}</span>
                        <span class="text-sm">from packages and topup ads </span>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card mb-4">
                <article class="card-body">
                    <h5 class="card-title">Revanue Statics</h5>
                    <canvas id="myChart" height="120px"></canvas>
                </article>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">New Members</h5>
                            <div class="new-member-list">
                              @foreach($users_latest as $item)
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img  @if($item->Profile_Image) src="{{ asset('assets/myCustomThings/vehicleTypes/' . $item->Profile_Image) }}"
                                        @else src="https://i.ibb.co/0FrgLRb/profile.png"  @endif     alt="" class="avatar" />
                                        <div>
                                           <h6>
                                                @if($item->First_Name)
                                                    {{ $item->First_Name }}
                                                @else
                                                    User has not filled the data
                                                @endif
                                                {{ $item->Last_Name }}
                                            </h6>
                                            <h5> {{ $item->email  }}</h5>
                                        </div>
                                    </div>
                                    
                                </div>
                                @endforeach
                                
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-8">
                      <div class="card mb-4">
                        <header class="card-header">
                            <h4 class="card-title">Package Activation List</h4>
                          
                        </header>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                   <table id="packageRevanue" class="table align-middle table-nowrap mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="align-middle" scope="col">ID</th>
                                                            <th class="align-middle" scope="col">User Name</th>
                                                            <th class="align-middle" scope="col">Package</th>
                                                            <th class="align-middle" scope="col">Price</th>
                                                            <th class="align-middle" scope="col">Created_at</th>
                                                        </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                                 </table>
                                </div>
                            </div>
                            <!-- table-responsive end// -->
                        </div>
                    </div>
                    <!--<div class="card mb-4">-->
                    <!--    <article class="card-body">-->
                    <!--        <h5 class="card-title">Recent activities</h5>-->
                    <!--        <ul class="verti-timeline list-unstyled font-sm">-->
                    <!--            <li class="event-list">-->
                    <!--                <div class="event-timeline-dot">-->
                    <!--                    <i class="material-icons md-play_circle_outline font-xxl"></i>-->
                    <!--                </div>-->
                    <!--                <div class="media">-->
                    <!--                    <div class="me-3">-->
                    <!--                        <h6><span>Today</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>-->
                    <!--                    </div>-->
                    <!--                    <div class="media-body">-->
                    <!--                        <div>Lorem ipsum dolor sit amet consectetur</div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--            <li class="event-list active">-->
                    <!--                <div class="event-timeline-dot">-->
                    <!--                    <i class="material-icons md-play_circle_outline font-xxl animation-fade-right"></i>-->
                    <!--                </div>-->
                    <!--                <div class="media">-->
                    <!--                    <div class="me-3">-->
                    <!--                        <h6><span>17 May</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>-->
                    <!--                    </div>-->
                    <!--                    <div class="media-body">-->
                    <!--                        <div>Debitis nesciunt voluptatum dicta reprehenderit</div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--            <li class="event-list">-->
                    <!--                <div class="event-timeline-dot">-->
                    <!--                    <i class="material-icons md-play_circle_outline font-xxl"></i>-->
                    <!--                </div>-->
                    <!--                <div class="media">-->
                    <!--                    <div class="me-3">-->
                    <!--                        <h6><span>13 May</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>-->
                    <!--                    </div>-->
                    <!--                    <div class="media-body">-->
                    <!--                        <div>Accusamus voluptatibus voluptas.</div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--            <li class="event-list">-->
                    <!--                <div class="event-timeline-dot">-->
                    <!--                    <i class="material-icons md-play_circle_outline font-xxl"></i>-->
                    <!--                </div>-->
                    <!--                <div class="media">-->
                    <!--                    <div class="me-3">-->
                    <!--                        <h6><span>05 April</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>-->
                    <!--                    </div>-->
                    <!--                    <div class="media-body">-->
                    <!--                        <div>At vero eos et accusamus et iusto odio dignissi</div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--            <li class="event-list">-->
                    <!--                <div class="event-timeline-dot">-->
                    <!--                    <i class="material-icons md-play_circle_outline font-xxl"></i>-->
                    <!--                </div>-->
                    <!--                <div class="media">-->
                    <!--                    <div class="me-3">-->
                    <!--                        <h6><span>26 Mar</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>-->
                    <!--                    </div>-->
                    <!--                    <div class="media-body">-->
                    <!--                        <div>Responded to need “Volunteer Activities</div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </li>-->
                    <!--        </ul>-->
                    <!--    </article>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        <!--<div class="col-xl-4 col-lg-12">-->
        <!--    <div class="card mb-4">-->
        <!--        <article class="card-body">-->
        <!--            <h5 class="card-title">Revenue Base on Area</h5>-->
        <!--            <canvas id="myChart2" height="217"></canvas>-->
        <!--        </article>-->
        <!--    </div>-->
        <!--    <div class="card mb-4">-->
        <!--        <article class="card-body">-->
        <!--            <h5 class="card-title">Marketing Chanel</h5>-->
        <!--            <span class="text-muted font-xs">Facebook</span>-->
        <!--            <div class="progress mb-3">-->
        <!--                <div class="progress-bar" role="progressbar" style="width: 15%">15%</div>-->
        <!--            </div>-->
        <!--            <span class="text-muted font-xs">Instagram</span>-->
        <!--            <div class="progress mb-3">-->
        <!--                <div class="progress-bar" role="progressbar" style="width: 65%">65%</div>-->
        <!--            </div>-->
        <!--            <span class="text-muted font-xs">Google</span>-->
        <!--            <div class="progress mb-3">-->
        <!--                <div class="progress-bar" role="progressbar" style="width: 51%">51%</div>-->
        <!--            </div>-->
        <!--            <span class="text-muted font-xs">Twitter</span>-->
        <!--            <div class="progress mb-3">-->
        <!--                <div class="progress-bar" role="progressbar" style="width: 80%">80%</div>-->
        <!--            </div>-->
        <!--            <span class="text-muted font-xs">Other</span>-->
        <!--            <div class="progress mb-3">-->
        <!--                <div class="progress-bar" role="progressbar" style="width: 80%">80%</div>-->
        <!--            </div>-->
        <!--        </article>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <h4 class="card-title">Topup Package Activation</h4>
          
        </header>
        <div class="card-body">
            <div class="table-responsive">
                <div class="table-responsive">
                   <table id="topup_package" class="table align-middle table-nowrap mb-0">
                   <thead class="table-light">
                   <tr>
                     <th class="align-middle" scope="col">ID</th>
                                                            <th class="align-middle" scope="col">User Name</th>
                                                            <th class="align-middle" scope="col">Package</th>
                                                            <th class="align-middle" scope="col">Price</th>
                                                            <th class="align-middle" scope="col">Created_at</th>
                   </tr>
                   </thead>
                   <tbody>
                 </tbody>
                 </table>
                </div>
            </div>
            <!-- table-responsive end// -->
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
        $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }); //ajax setup

                    //  view data on table start 
                    $('#packageRevanue').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.packageRevanue.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'package_name',
                                name: 'package_name'
                            },
                             {
                                data: 'price',
                                name: 'price',
                                render: function(data, type, row) {
                                    return 'Rs. ' + data;
                                }
                            },
                            {
                                data: 'created_at',
                                name: 'created_at',
                                render: function (data, type, row) {
                                      return moment(data).fromNow();
                                    // Adjust the format according to your preference
                                }
                            },
                         

                        ]

                    });
                    
                    
                       //  view data on table start 
                    $('#topup_package').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.topup_package.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'package_name',
                                name: 'package_name'
                            },
                             {
                                data: 'price',
                                name: 'price',
                                render: function(data, type, row) {
                                    return 'Rs. ' + data;
                                }
                            },
                            {
                                data: 'created_at',
                                name: 'created_at',
                                render: function (data, type, row) {
                                      return moment(data).fromNow();
                                    // Adjust the format according to your preference
                                }
                            },
                         

                        ]

                    });

                });
</script>
<script>
 // Pass PHP variables to JavaScript
   
    var monthlyRevenueTopup = @json(array_values($monthlyRevenueTopup));
    var monthlyRevenuePackage = @json(array_values($monthlyRevenuePackage));
    console.log(monthlyRevenueTopup)
        /*Sale statistics Chart*/
    if ($('#myChart').length) {
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            
            // The data for our dataset
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                        label: 'package revanue',
                        tension: 0.3,
                        fill: true,
                        backgroundColor: 'rgba(44, 120, 220, 0.2)',
                        borderColor: 'rgba(44, 120, 220)',
                        data: monthlyRevenuePackage
                    },
                    {
                        label: 'top up revanue',
                        tension: 0.3,
                        fill: true,
                        backgroundColor: 'rgba(4, 209, 130, 0.2)',
                        borderColor: 'rgb(4, 209, 130)',
                        data: monthlyRevenueTopup
                    },
                 

                ]
            },
            options: {
                plugins: {
                legend: {
                    labels: {
                    usePointStyle: true,
                    },
                }
                }
            }
        });
    } //End if
</script>

@endsection