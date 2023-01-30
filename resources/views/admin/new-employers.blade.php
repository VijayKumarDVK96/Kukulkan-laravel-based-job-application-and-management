@extends('includes.admin-layout')

@section('title', 'New Employers')

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

                        @if(Session::has('message'))
                        <div class="alert alert-icon-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <div class="alert-icon icon-part-success">
                                <i class="icon-check"></i>
                            </div>
                            <div class="alert-message">
                                <span><strong>{{session('message')}}</strong></span>
                            </div>
                        </div>
                        @endif

                        <div class="table-responsive">
                            <form method="post" action="{{url('admin/change-employer-profile-status')}}">
                                @csrf
                                <input type="submit" name="change_status" class="btn btn-primary" value="Approve" style="margin-left: 15px; margin-bottom: 15px">
                                <input type="submit" name="change_status" class="btn btn-danger" value="Delete" style="margin-left: 15px; margin-bottom: 15px">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="select-all" name="select-all"></th>
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
                                            <td><input type="checkbox" name="select[]" value="{{ $value->id }}"></td>
                                            <td>{{ $key+1 }}</td>
                                            <td><a target="_blank" href="{{url('admin/view-employer/'.$value->id)}}">{{ucwords($value->full_name)}}</a></td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->mobile }}</td>
                                            <td>{{ $value->job_department }}</td>
                                            <td>{{ $value->job_position }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><input type="checkbox" class="select-all" name="select-all"></th>
                                            <th>S.no.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Job Sector</th>
                                            <th>Job Title</th>
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
    <script src="{{url('js/functions.js')}}"></script>
    <!--Data Tables js-->
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $('#default-datatable').DataTable();
        $(".select-all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection