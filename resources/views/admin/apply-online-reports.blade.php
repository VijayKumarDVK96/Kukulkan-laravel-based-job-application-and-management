@extends('includes.admin-layout')

@section('title', $title)

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
                            <h4>{{$title}}</h4>
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
                            <form method="post" action="{{url('admin/change-apply-online-reports-status')}}">
                                @csrf
                                @if($title != 'Approved Tutors Lists')
                                <input type="submit" name="change_status" class="btn btn-primary" value="Approve" style="margin-left: 15px; margin-bottom: 15px">
                                @endif
                                
                                <input type="submit" name="change_status" class="btn btn-danger" value="Delete" style="margin-left: 15px; margin-bottom: 15px">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="select-all" name="select-all"></th>
                                            <th>S.no.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Experience</th>
                                            <th>Have Broadband Connection</th>
                                            <th>Qualification</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($candidates as $key => $value)
                                        <tr>
                                            <td><input type="checkbox" name="select[]" value="{{$value->id}}"></td>
                                            <td>{{$key+1}}</td>
                                            <td>{{ucwords($value->name)}}</td>
                                            <td>{{$value->email}}</td>
                                            <td>{{$value->mobile}}</td>
                                            <td>{{$value->experience}}</td>
                                            <td>{{$value->broadband}}</td>
                                            <td>
                                                <?php
                                                    if($value->qualification == "bca")
                                                    echo 'BCA/MCA';
                                                    elseif($value->qualification == "be")
                                                    echo 'BE/ME';
                                                    elseif($value->qualification == "btech")
                                                    echo 'B.Tech/M.Tech';
                                                    elseif($value->qualification == "bscit")
                                                    echo 'BSc IT/Tech Diploma';
                                                    elseif($value->qualification == "mba")
                                                    echo 'B.Tech/BE + MBA';
                                                    elseif($value->qualification == "others")
                                                    echo 'Others';
                                                ?>
                                            </td>
                                            <td>{{$value->gender}}</td>
                                            <td>{{$value->address}}</td>
                                            <td>{{$value->state}}</td>
                                            <td>{{$value->city}}</td>
                                            <td>
                                                @if($value->status == 0)
                                                <span class="badge badge-primary m-1">Pending</span>
                                                @else
                                                <span class="badge badge-success m-1">Approved</span>
                                                @endif
                                            </td>
                                            <td>{{$value->created_at}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
@endsection