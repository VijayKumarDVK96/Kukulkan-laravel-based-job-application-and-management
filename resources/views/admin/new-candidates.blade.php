@extends('includes.admin-layout')

@section('title', 'New Candidates')

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
                            <h4>New Candidates</h4>
                        </div>

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
                        
                        <div class="table-responsive">
                            <form method="post" action="{{url('admin/change-candidate-profile-status')}}">
                                @csrf
                                <input type="submit" name="change_status" class="btn btn-primary" value="Approve" style="margin-left: 15px; margin-bottom: 15px">
                                <input type="submit" name="change_status" class="btn btn-danger" value="Delete" style="margin-left: 15px; margin-bottom: 15px">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="select-all" name="select-all"></th>
                                            <th>S.no.</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Experience</th>
                                            <th>Gender</th>
                                            <th>Job Sector</th>
                                            <th>Job Title</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>PIN Code</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($candidates as $key => $value)
                                        <tr>
                                            <td><input type="checkbox" name="select[]" value="{{$value->id}}"></td>
                                            <td>{{$key+1}}</td>
                                            <td><a target="_blank" href="{{url('admin/view-candidate/'.$value->id)}}">{{ucwords($value->full_name)}}</a></td>
                                            <td>{{$value->age}}</td>
                                            <td>{{$value->email}}</td>
                                            <td>{{$value->mobile}}</td>
                                            <td>{{ucfirst($value->experience)}}</td>
                                            <td>{{ucfirst($value->gender)}}</td>
                                            <td>{{$value->job_department}}</td>
                                            <td>{{$value->job_position}}</td>
                                            <td>{{$value->job_state}}</td>
                                            <td>{{$value->job_city}}</td>
                                            <td>{{$value->pin}}</td>
                                            <td>{{$value->created_at}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><input type="checkbox" class="select-all" name="select-all"></th>
                                            <th>S.no.</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Experience</th>
                                            <th>Gender</th>
                                            <th>Job Sector</th>
                                            <th>Job Title</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>PIN Code</th>
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
        $(".select-all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>

    <script>
        // $('#default-datatable').DataTable();
        var table = $('#default-datatable').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf']
        });

        table.buttons().container().appendTo('#default-datatable_wrapper .col-md-6:eq(0)');
    </script>
@endsection