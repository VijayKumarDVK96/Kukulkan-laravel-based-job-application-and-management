@extends('includes.admin-layout')

@section('title', 'Staffs')

@section('styles')
    <!--Data Tables -->
    <link href="{{url('admin-assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{url('admin-assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Recent Orders -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-transparent shadow-none border border-light">
                        <div class="card-header bg-transparent border-0">
                            <h4 class="pull-left">Staffs </h4>
                            @if(Auth::user()->roles[0]->role=="Admin")
                            <button type="button" class="btn btn-dark waves-effect waves-light pull-right" data-toggle="modal" data-target="#addStaff">Add New Staff</button>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="staffs">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        @if(Auth::user()->roles[0]->role=="Admin")
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        @endif
                                    </tr>
                                </thead>
                                @foreach($staffs as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ ucfirst($value->name) }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->mobile }}</td>
                                        <td>{{ $value->address }}</td>
                                        @if(Auth::user()->roles[0]->role=="Admin")
                                            <td><button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#editStaff" onclick="editStaff({{ $value->id }})">Edit</button></td>

                                            <td><button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#deleteStaff{{ $value->id }}">Delete</button></td>

                                            <!-- Delete Staff Modal -->
                                            <div class="modal fade" id="deleteStaff{{ $value->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Staff</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5>Are you sure you want to delete this staff?</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                                <a href="{{url('admin/delete-staff/'.$value->id)}}" class="btn btn-danger"><i class="fa fa-check-square-o"></i> Delete Staff</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Row-->
        </div>
        <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->

    <!-- Add Staff Modal -->
    <div class="modal fade" id="addStaff">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Staff</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" id="name" class="form-control" name="name">
                                    <span class="error-message name-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email">
                                    <span class="error-message email-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" id="mobile" class="form-control mobile" maxlength="10" name="mobile">
                                    <span class="error-message mobile-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control" name="password">
                                    <span class="error-message password-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" class="form-control" name="address">
                                    <span class="error-message address-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <span class="error-message add-staff-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="text-success font-weight-bold"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success" id="add-staff-submit"><i class="fa fa-check-square-o"></i> Add New Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Staff Modal -->
    <div class="modal fade" id="editStaff">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit New Staff</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" id="name" class="form-control" name="name">
                                    <input type="hidden" class="id" name="id">
                                    <span class="error-message name-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email">
                                    <span class="error-message email-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" id="mobile" class="form-control mobile" maxlength="10" name="mobile">
                                    <span class="error-message mobile-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" class="form-control" name="address">
                                    <span class="error-message address-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" id="password" class="form-control" name="password">
                                    <span class="error-message password-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <span class="error-message edit-staff-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="text-success font-weight-bold"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary" id="edit-staff-submit"><i class="fa fa-check-square-o"></i> Update Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--Data Tables js-->
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/jszip.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js')}}"></script>

    <script>
        var table = $('#staffs').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf']
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const base_url = "{{ url('/') }}";

        $("#add-staff-submit").click(function(e) {
            e.preventDefault();
            $("#add-staff-submit").text("Please wait");
            $(".text-success").text("");

            $.ajax({
                url: base_url+"/admin/add-staff",
                method: 'post',
                data: $("#addStaff form").serialize(),
                error: function(data) {
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);
                        $(".error-message").show();

                        $.each(message, function(key, value) {
                            name = value.name ?? '';
                            email = value.email ?? '';
                            mobile = value.mobile ?? '';
                            password = value.password ?? '';
                            address = value.address ?? '';
                        });

                        $("#addStaff .name-error").text(name);
                        $("#addStaff .email-error").text(email);
                        $("#addStaff .mobile-error").text(mobile);
                        $("#addStaff .password-error").text(password);
                        $("#addStaff .address-error").text(address);
                    }
                },
                success: function(data) {
                    $(".error-message").hide();
                    $(".text-success").text("Staff Details Added");
                    $("#addStaff form")[0].reset();
                },
                complete: function() {
                    $("#add-staff-submit").text("Add New Staff");
                    setTimeout(function () {
                        $(".text-success").text("");
                    }, 3000);
                }
            });
        });

        function editStaff(id) {
            $.ajax({
                url: base_url+"/admin/edit-staff/"+id,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    $("#editStaff .id").val(data.id);
                    $("#editStaff #name").val(data.name);
                    $("#editStaff #email").val(data.email);
                    $("#editStaff #mobile").val(data.mobile);
                    $("#editStaff #address").val(data.address);
                }
            });
        }

        $("#edit-staff-submit").click(function(e) {
            e.preventDefault();
            $("#edit-staff-submit").text("Please wait");
            $(".text-success").text("");
            var id = $("#editStaff .id").val();

            $.ajax({
                url: base_url+"/admin/update-profile/"+id,
                method: 'post',
                data: $("#editStaff form").serialize(),
                error: function(data) {
                    if(data.status === 422) {
                        $(".error-message").show();
                        var message = JSON.parse(data.responseText);

                        $.each(message, function(key, value) {
                            name = value.name ?? '';
                            email = value.email ?? '';
                            mobile = value.mobile ?? '';
                            password = value.password ?? '';
                            address = value.address ?? '';
                        });

                        $("#editStaff .name-error").text(name);
                        $("#editStaff .email-error").text(email);
                        $("#editStaff .mobile-error").text(mobile);
                        $("#editStaff .password-error").text(password);
                        $("#editStaff .address-error").text(address);
                    }
                },
                success: function(data) {
                    $(".error-message").hide();
                    $(".text-success").text("Staff Details Updated");
                },
                complete: function() {
                    $("#edit-staff-submit").text("Update Staff");
                    setTimeout(function () {
                        $(".text-success").text("");
                    }, 3000);
                }
            });
        });
    </script>
@endsection