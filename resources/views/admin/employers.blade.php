@extends('includes.admin-layout')

@section('title', 'Employers')

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
                            <h4>Employers </h4>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Job Sector</th>
                                        <th>Job Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employers as $key => $value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><a target="_blank" href="{{url('admin/view-employer/'.$value->id)}}">{{ucwords($value->full_name)}}</a></td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->mobile}}</td>
                                        <td>{{$value->job_department}}</td>
                                        <td>{{$value->job_position}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Job Sector</th>
                                        <th>Job Title</th>
                                    </tr>
                                </tfoot>
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
        range_slider("#fromRange", "#age_from");
        range_slider("#toRange", "#age_to");

        $("#fromRange, #toRange").on("input", function() {
            range_slider("#fromRange", "#age_from");
            range_slider("#toRange", "#age_to");
        });
        // $('#default-datatable').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf']
        });

        table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    </script>
@endsection