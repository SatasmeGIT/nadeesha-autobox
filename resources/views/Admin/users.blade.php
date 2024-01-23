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

        .addColorToIcon {
            color: #20a10f !important;
        }

        .img-rounded {
            border-radius: 90px !important;
            object-fit: fill !important;
            height: 10px !important;
            width: 10px !important;
        }
    </style>
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Users Management</h2>
                <p>You can manage users here</p>
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
                                <table id="users" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">User Name</th>
                                            <th class="align-middle" scope="col">Email</th>
                                            <th class="align-middle" scope="col">Image</th>
                                            <th class="align-middle" scope="col">Status</th>
                                            <th class="align-middle" scope="col">Position</th>
                                            <th class="align-middle" scope="col">Details</th>

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
            <div class="modal fade" id="edit_user" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User Status</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- form start   --}}
                            <form id="update_user_form">
                                <input type="hidden" class="form-control clear_input"  name="id" id="user_id">
                                <div class="row">
                                    <hr style="margin-top: 8px !important;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="mr-2" name="user_status" required
                                                id="edit_user_status" data-toggle="toggle" data-on="Active"
                                                data-off="Deactive" data-onstyle="success" data-offstyle="danger"
                                                data-width="200" data-height="30">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_user_btn" class="btn btn-primary">Save
                                changes</button>
                            </form>
                            {{-- form end   --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal  --}}

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
                    $('#users').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.users.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'email',
                                name: 'email'
                            },
                            {
                                data: 'image',
                                name: 'image'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'position',
                                name: 'position'
                            },
                            {
                                data: 'deatils',
                                name: 'deatils'
                            },

                        ]

                    });

                });

                $('body').on('click', '.more', function() {

                    var id = $(this).data('id');
                    var url = '/admin/users/more/' + id;
                    window.location.href = url;

                });

                $('body').on('click', '.edit', function() {

                var id = $(this).data('id');
                $.ajax({
                        url: '{{ url('/admin/users') }}' + '/status/' + id ,
                        method: 'GET',
                        success: function(response) {
                            $('#user_id').val(response.id)
                            // need to update status  this is where i stop

                            //start status of vehicle type 
                            if (response.status == 0) {
                                $('#edit_user_status').bootstrapToggle('off');
                            } else {
                                $('#edit_user_status').bootstrapToggle('on');
                            }
                            //end status of vehicle type  
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                $('#edit_user').modal('show')

                });

                $('#update_user_btn').click(function(){
                    document.getElementById("update_user_btn").disabled = true;
                    $('.clear_form_error').html('');

                    // to get csrf
                    var update_user_form = $('#update_user_form')[0];
                    var update_user_form_ajax = new FormData(update_user_form); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.users.update.status') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: update_user_form_ajax,
                        success: function(response) {
                            $('#edit_user').modal('hide');
                            document.getElementById("update_user_btn").disabled = false;

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
                                    title: 'error!',
                                    icon: 'error',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            $('.clear_input').val('');
                            $('.clear_form_error').html('');
                            $('#users').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("update_user_btn").disabled = false;
                        }
                    });
                    
                })
            </script>



    </section>
@endsection
