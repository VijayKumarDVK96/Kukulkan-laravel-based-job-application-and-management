@extends('includes.admin-layout')

@section('title', 'Imported Candidates')

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

                                @if(Session::has('success'))
                                    <div class="alert alert-icon-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <div class="alert-icon icon-part-success">
                                            <i class="icon-check"></i>
                                        </div>
                                        <div class="alert-message">
                                            <span><strong>{{session('success')}}</strong></span>
                                        </div>
                                    </div>
                                @endif

                                @if(Session::has('error'))
                                <div class="alert alert-icon-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <div class="alert-icon icon-part-danger">
                                        <i class="icon-close"></i>
                                    </div>
                                    <div class="alert-message">
                                        <span><strong>{{session('error')}}</strong></span>
                                    </div>
                                </div>
                                @endif

                                <h4 class="pull-left">Imported Candidates</h4>
                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#import">Import</button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="table-responsive">
                                <form method="post" action="{{url('admin/delete-imported-candidates')}}">
                                    @csrf
                                    <input type="submit" name="change_status" class="btn btn-danger" value="Delete" style="margin-left: 15px; margin-bottom: 15px">
                                    <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="select-all" name="select-all"></th>
                                                <th>S.no.</th>
                                                <th>Full Name</th>
                                                <th>Designation</th>
                                                <th>Last Company</th>
                                                <th>Education</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Location</th>
                                                <th>Experience</th>
                                                <th>Gender</th>
                                                <th>Age</th>
                                                <th>Salary</th>
                                                <th>Source</th>
                                                <th>Remarks</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($candidates as $key => $value)
                                            <tr>
                                                <td><input type="checkbox" name="select[]" value="{{$value['id']}}"></td>
                                                <td><a href="{{url('admin/edit-imported-candidate', $value->id)}}">{{$key+1}}</a></td>
                                                <td>{{$value['full_name']}}</td>
                                                <td>{{$value['designation']}}</td>
                                                <td>{{$value['last_company']}}</td>
                                                <td>{{$value['education']}}</td>
                                                <td>{{$value['mobile']}}</td>
                                                <td>{{$value['email']}}</td>
                                                <td>{{$value['location']}}</td>
                                                <td>{{$value['experience']}}</td>
                                                <td>{{$value['gender']}}</td>
                                                <td>{{$value['age']}}</td>
                                                <td>{{$value['salary']}}</td>
                                                <td>{{$value['source']}}</td>
                                                <td>{{$value['remarks']}}</td>
                                                <td>{{$value['created_at']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S.no.</th>
                                                <th>Full Name</th>
                                                <th>Designation</th>
                                                <th>Last Company</th>
                                                <th>Education</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Location</th>
                                                <th>Experience</th>
                                                <th>Gender</th>
                                                <th>Age</th>
                                                <th>Salary</th>
                                                <th>Source</th>
                                                <th>Remarks</th>
                                                <th>Created At</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Row-->
            </div>
            <!-- End container-fluid-->
        </div>
        <!--End content-wrapper-->

        <!-- Import Modal -->
        <div class="modal fade" id="import">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{url('admin/import-candidates')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Import Candidates</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Upload a .csv format file</label>
                                        <input type="file" id="file" name="file" class="form-control">
                                        <span class="error-message name-error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-success" id="add-staff-submit"><i class="fa fa-check-square-o"></i> Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
    
    <script src="{{url('js/functions.js')}}"></script>

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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const base_url = "{{ url('/') }}";

        // State Dependent Selector
        $('#state').change(function() {
            var state = $(this).val();
            $.ajax({
                url: base_url+"/show-cities/"+state,
                method: 'post',
                success: function(data) {
                    $('#city').html(data);
                }
            });
        });
    </script>

    <script>
        range_slider("#fromRange", "#age_from");
        range_slider("#toRange", "#age_to");

        $("#fromRange, #toRange").on("input", function() {
            range_slider("#fromRange", "#age_from");
            range_slider("#toRange", "#age_to");
        });
    </script>

    <script>
        // $('#default-datatable').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf']
        });

        table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    </script>

    <script>
        $(".select-all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection