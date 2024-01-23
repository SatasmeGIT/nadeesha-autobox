@extends('Web.Layout.Layout')
@section('content')
<style>
     @media (max-width: 768px) {
            /* Style for p on mobile */
            .card-body h5 {
                display: none; /* hide h4 on small screens */
            }
            
             .card-body p {
                display: block; /* hide h4 on small screens */
            }
          
        }
           @media (min-width: 768px) {
            /* Style for p on mobile */
            .card-body p {
                display: none; /* hide h4 on small screens */
            }
            
              .card-body h5 {
                display: block; /* hide h4 on small screens */
            }
          
        }
</style>

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="#">Inquire Ads</a>
                </div>
            </div>
        </div>
        
        <div style="background-color:#FECDA6 !important; " class="card m-4 ">
          <div class="card-body">
           <h5 class="text-white">The auto parts you are looking for can be published here. Your inquiries will appear to suppliers who have purchased our ad packages</h4> 
            <p class="text-white">The auto parts you are looking for can be published here. Your inquiries will appear to suppliers who have purchased our ad packages</p>
          </div>
        </div>
        
        <div class="page-content  pb-50">
            <div class="container">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Inquire Ads</h5>
                    
                        <a class="btn btn-success" style="font-size: 11px; font-weight: 700; color: rgb(0, 0, 0) !important;"
                           @if(session('vendor_data'))  href="{{ route('web.inqueryAds') }}"
                           @else href="{{ route('web.inquery_for_visitors') }}" @endif class="ml-auto">
                            VIEW INQUIRIES ({{ $count->count() }})
                        </a>
                    </div>

                    <div class="card-body">
                        <form id="create_form">
                            <div class="row">
                                <input name="userId" type="hidden" value="{{ $userId }}"/>
                                <div class="col-md-12">
                                         <div class="form-group col-md-12">
                                    <input name="image" type="file" id="clear_dropify" class="dropify" data-height="200"
                                        data-allowed-file-extensions="jpeg jpg png" />
                                    <span class="text-danger clear_form_error" id="image_error"></span>
                                </div>
                                <div class="form-group col-12">
                                    <input class="form-control clear_input" placeholder="Title *" name="title"
                                        type="text" />
                                    <span class="text-danger clear_form_error" id="title_error"></span>
                                </div>
                                <div class="form-group col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">+94 </span>
                                        <input type="text" class="form-control clear_input" name="phone"
                                            placeholder="Phone" aria-label="Username" aria-describedby="basic-addon1">

                                    </div>
                                    <span class="clear_form_error text-danger" id="phone_error"></span>
                                </div>

                                <div class="form-group mb-30">
                                    <textarea class="clear_input" id="description" name="additional_information" rows="5"
                                        placeholder="Additional information"></textarea>
                                    <span class="clear_form_error text-danger" id="description_error"></span>
                                </div>

                                <div class="col-md-12">
                                    <button type="button" id="new_ad_btn"
                                        class="btn btn-fill-out submit font-weight-bold">Save
                                        Change</button>
                                </div>
                                </div>

                               
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            
                    <div class="container mt-5">  
                    <div class="card">
                    <div class="card-header">
                    <h5>My Inquery Ads List</h5>
                    </div>
                                <div class="col-md-12">
                                   <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="table-responsive">
                                                <table id="slider_management" class="table align-middle table-nowrap mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="align-middle" scope="col">ID</th>
                                                            <th class="align-middle" scope="col">Image</th>
                                                              <th class="align-middle" scope="col">Title</th>
                                                               <th class="align-middle" scope="col">More</th>
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
                                 </div>
                                </div> 
                      </div>
        
          <!-- Modal -->
        <div class="modal fade" id="more_details" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">More Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Title : <span id="info_title"></span></p>
                      <p>Phone : <span id="info_phone"></span></p>
                      <p>Date : <span id="info_join"></span></p>
                      <p><span id="info_info"></span></p>
                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
                    </div>
                </div>
            </div>
        </div>
       
    </main>
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

            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop ads image here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });
            
                //  view data on table start 
                    $('#slider_management').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('web.inqueryAds.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                         
                             {
                                data: 'image',
                                name: 'image'
                            },
                             {
                                data: 'title',
                                name: 'title'
                            },
                             {
                                data: 'more',
                                name: 'more'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ]

                    });

            //  need to create ajax create 
            $('#new_ad_btn').click(function() {

                document.getElementById("new_ad_btn").disabled = true; //enable button after click it
                $('.clear_form_error').html('');

                // to get csrf
                var form = $('#create_form')[0];
                var form_ajax = new FormData(form); // get form data

                Swal.fire({
                    title: 'Please wait...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
                // ajax post start 
                $.ajax({
                    url: "{{ route('web.create.adsInquery') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: form_ajax,
                    success: function(response) {
                        document.getElementById("new_ad_btn").disabled =
                            false; //enable button after click it
                        Swal.close();
                        if (response.code == 500) {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg

                        } else if (response.code == 400) {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg
                        } else if (response.code == 200) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.msg,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }) //display error msg 

                        }
                       
                       //remove image preview
                       var dropifyElement = $('#clear_dropify').data('dropify');
                        dropifyElement.resetPreview();
                        dropifyElement.clearElement();
                       
                       //remoev image preview
                       
                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        $('#slider_management').DataTable().ajax.reload();
                        //   Swal.close();
                    },
                    error: function(error) {
                        Swal.close();
                        // display validations in created slider 
                        $('#image_error').html(error.responseJSON.errors.image);
                        $('#title_error').html(error.responseJSON.errors.title);
                        $('#phone_error').html(error.responseJSON.errors
                            .phone);
                        $('#description_error').html(error.responseJSON.errors
                            .additional_information);
                        document.getElementById("new_ad_btn").disabled =
                            false; //enable button after click it
                    }
                });
            });
            
             $('body').on('click', '.delete', function() {
                    var id = $(this).data('id');

                    // Display a confirmation dialog using SweetAlert
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            // User confirmed, proceed with the deletion
                            $.ajax({
                                url: '{{ url('/Web/inqueryAds') }}' + '/' + id + '/delete',
                                method: 'GET',
                                success: function(response) {
                                
                                    if (response.code === "success") {
                                        Swal.fire({
                                            title: 'Success!',
                                            icon: 'success',
                                            text: response.msg,
                                            confirmButtonText: 'OK'
                                        });
                                    } else if (response.code === "error") {
                                        Swal.fire({
                                            title: 'Error!',
                                            icon: 'error',
                                            text: response.msg,
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                    $('#slider_management').DataTable().ajax.reload();
                                },
                                error: function(error) {
                                
                                    // Handle error
                                }
                            });
                        }
                    });
                });
                
                //more button
                $('body').on('click', '.more', function() {
                    var id = $(this).data('id');
                            $.ajax({
                                url: '{{ url('/Web/inqueryAds') }}' + '/' + id + '/info',
                                method: 'GET',
                                success: function(response) {
                                $('#info_title').html(response.title);  
                                $('#info_join').html(response.created_at); 
                                $('#info_phone').html(response.phone); 
                                $('#info_info').html(response.additional_information);
                                $('#more_details').modal("show");        
                                console.log(response);
                                },
                                error: function(error) {
                                
                                    // Handle error
                                }
                            });
                });
                //more button
            
        });
    </script>
@endsection
