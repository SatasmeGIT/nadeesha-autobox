@extends('Admin.Layout.layout')
@section('section')
    <style>
        /* Custom button style */
        .custom-button {
            background-color: #0e920e;
            /* Green background color */
            color: #FFFFFF;
            /* White text color */
            border-radius: 10px;
            /* Rounded corners */
            padding: 10px 20px;
            /* Padding around the text */
            font-size: 16px;
            /* Font size */
            transition: background-color 0.3s ease;
            /* Transition for click effect */
        }

        /* Click effect */
        .custom-button:hover {
            background-color: #6fda6f;
            /* Darker green background color on hover */
            cursor: pointer;
            /* Change cursor to pointer on hover */
        }
    </style>
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Ads</h2>
                <p>You can manage ads management here</p>
            </div>
            <div>
                {{-- <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a> --}}
            </div>
        </div>
        <!-- card end// -->
        <div class="row">
         
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="adsManagement" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Ad Number</th>
                                            <th class="align-middle" scope="col">Title</th>
                                            <th class="align-middle" scope="col">Ad expire date</th>
                                            <th class="align-middle" scope="col">Is Top Ad</th>
                                            <th class="align-middle" scope="col">Top ad expire date</th>
                                            <th class="align-middle" scope="col">Ad Status(Vendor)</th>
                                            <th class="align-middle" scope="col">Ad Status(Admin)</th>
                                            <!--<th class="align-middle" scope="col">Extends Date</th>-->
                                            <th class="align-middle" scope="col">Action</th>
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
            </div>

            {{-- modal start  --}}
            <div class="modal fade" id="more_data" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">More Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                      
                               <p>Ad Number : <span id="ad_number_more"></span></p>
                               <p>Ad Title : <span id="ad_title_more"></span></p>
                               <p>Ad Price : <span id="ad_price_more"></span></p>
                               <p>Ad View Count : <span id="ad_count_more"></span></p>
                               <p>Ad Expire Date : <span id="ad_expireDate_more"></span></p>
                               <p class="mb-2">Ad Posted Date : <span id="ad_posted_date_more"></span></p>
                               <p>Ad Description : <span id="ad_desc_more"></span></p>
                               
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_brand_btn" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            
               <div class="modal fade" id="edit_status" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Ad Status</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                              <form id="status_form">  
                              <div class="col-12">
                                        <div class="form-group">
                                            <input name="id_edit" id="id_edit" value=""  type="hidden">
                                            <input type="checkbox" class="mr-2" name="ad_edit_status" required id="ad_edit_status"
                                                data-toggle="toggle" data-on="Active" data-off="Deactive"
                                                data-onstyle="success" data-offstyle="danger" data-width="200"
                                                data-height="30">
                                          
                             </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_status_btn" class="btn btn-primary">Save changes</button>
                        </div>
                         </form>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="edit_expire_date" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Ad Expire Date</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                              <form id="edit_expire_date_form">  
                              <div class="col-12">
                                        <div class="form-group">
                                            <input name="id_edit" id="edit_expire_id"  type="hidden">
                                            <input type="datetime-local" name="date" class="form-control" id="edit_expire_date_input" >
                                          
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="edit_expire_date_btn" class="btn btn-primary">Save changes</button>
                        </div>
                         </form>
                    </div>
                </div>
            </div>


            <!-- card end// -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
                integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
                integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script>
                $(document).ready(function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }); //ajax setup
                       //  view data on table start 
                    $('#adsManagement').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.adsManagement.recieveData') !!}',
                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'ad_number',
                                name: 'ad_number'
                            },
                            {
                                data: 'ad_title',
                                name: 'ad_title'
                            },
                            {
                                data: 'ad_expire_date',
                                name: 'ad_expire_date'
                            },
                            {
                                data: 'is_top_id',
                                name: 'is_top_id'
                            },
                             {
                                data: 'top_ad_expire_date',
                                name: 'top_ad_expire_date'
                            },
                             {
                                data: 'status',
                                name: 'status'
                            },
                             {
                                data: 'status_admin',
                                name: 'status_admin'
                            },
                            //   {
                            //     data: 'extends',
                            //     name: 'extends'
                            // },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ]

                    });
                    
                $('body').on('click', '.more', function() {
                    var id = $(this).data('id');
                     
                    $.ajax({
                        url: '{{ url('admin/adsManagement') }}' + '/' + id + '/more',
                        method: 'GET',
                        success: function(response) {

                            $('#ad_number_more').html(response.ad_number);
                            $('#ad_title_more').html(response.ad_title);
                            $('#ad_price_more').html(response.ad_price);
                            $('#ad_count_more').html(response.ad_view_count);
                            $('#ad_expireDate_more').html(response.ad_expire_date);
                            $('#ad_topad_expire_date_more').html(response.top_ad_expire_date);
                            $('#ad_posted_date_more').html(response.created_at);
                            $('#ad_desc_more').html(response.ad_description);
                            // $('#ad_number_more').html(response.ad_number);
                            
                            $('#more_data').modal('show');
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });
                
                  $('body').on('click', '.status', function() {
                    var id = $(this).data('id');
              
                    $.ajax({
                        url: '{{ url('admin/adsManagement') }}' + '/' + id + '/status',
                        method: 'GET',
                        success: function(response) {
                       
                          $('#id_edit').val(response.id);
                          if (response.adminStatus == 0) {
                                $('#ad_edit_status').bootstrapToggle('off');
                            } else {
                                $('#ad_edit_status').bootstrapToggle('on');
                            }
                          $('#edit_status').modal('show')
                            
                
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });
                
                $('body').on('click', '.url', function() {
                    var id = $(this).data('id');
                     // Assuming you want to open the detailed ad page in a new tab or window
                    var url = '{{ route("web.detailed_ad", ["id" => ":id"]) }}';
                    url = url.replace(':id', id);
                
                    // Open the detailed ad page in a new tab or window
                    window.open(url, '_blank');
                });
                
                  $('body').on('click', '.extends', function() {
                    var id = $(this).data('id');
                     // Assuming you want to open the detailed ad page in a new tab or window
                     
                      $.ajax({
                        url: '{{ url('admin/adsManagement') }}' + '/' + id + '/status',
                        method: 'GET',
                        success: function(response) {
                          $('#edit_expire_id').val(response.id)
                          $('#edit_expire_date_input').val(response.ad_expire_date)
                          $('#edit_expire_date').modal('show')
                            
                
                        },
                        error: function(error) {}
                    });
                    // ajax code end
 
                    //  $('#edit_expire_date').modal("show");
                });
                
                
                
                 $("#update_status_btn").click(function(){
                     
                          // to get csrf
                    var status_form = $('#status_form')[0];
                    var status_form_ajax = new FormData(status_form); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.adsManagement.updateStatus') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: status_form_ajax,
                        success: function(response) {
                            $('#edit_status').modal('hide');
                            document.getElementById("update_status_btn").disabled = false;

                            if (response.code == "true") {
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            if (response.code == "false") {
                                Swal.fire({
                                    title: 'Error!',
                                    icon: 'info',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                          
                            $('#adsManagement').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("update_status_btn").disabled = false;
                            // display validations in created admin 
                        
                        }
                    });
                 })
                 
                 
                 $('#edit_expire_date_btn').click(function(){
                     
                             // to get csrf
                    var date_form = $('#edit_expire_date_form')[0];
                    var date_form_ajax = new FormData(date_form); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.adsTime.overide') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: date_form_ajax,
                        success: function(response) {
                            console.log(response)
                            $('#edit_expire_date').modal('hide');
                            document.getElementById("edit_expire_date_btn").disabled = false;

                            if (response.code == "true") {
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            if (response.code == "false") {
                                Swal.fire({
                                    title: 'Error!',
                                    icon: 'info',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                          
                            $('#adsManagement').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("edit_expire_date_btn").disabled = false;
                            // display validations in created admin 
                        
                        }
                    });
                     
                     
                 });
                 
               
                 
                 

                });

            </script>



    </section>
@endsection