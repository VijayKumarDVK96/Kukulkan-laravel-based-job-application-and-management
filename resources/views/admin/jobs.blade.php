@extends('includes.admin-layout')

@section('title', 'Jobs')

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
                            <h4>Jobs </h4>
                            <form action="{{url('admin/filter-jobs')}}" method="post">
                                @csrf
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="experience">
                                                <option value="">Select Experience</option>
                                                <?php
                                                if (isset($_POST['experience'])) {
                                                    foreach ($experience as $value) {
                                                        if ($_POST['experience'] == $value)
                                                            echo '<option value="' . $value . '" selected>' . $value . '</option>';
                                                        else
                                                            echo '<option value="' . $value . '">' . $value . '</option>';
                                                    }
                                                } else {
                                                    foreach ($experience as $value) {
                                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <?php
                                                if (isset($_POST['gender'])) {
                                                    foreach ($gender as $value) {
                                                        if ($_POST['gender'] == $value)
                                                            echo '<option value="' . $value . '" selected>' . $value . '</option>';
                                                        else
                                                            echo '<option value="' . $value . '">' . $value . '</option>';
                                                    }
                                                } else {
                                                    foreach ($gender as $value) {
                                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="status">
                                                <option value="">Job Status</option>
                                                <?php
                                                if (isset($_POST['status'])) {
                                                    foreach ($status as $key => $value) {
                                                        if ($_POST['status'] == $key)
                                                            echo '<option value="' . $key . '" selected>' . $value . '</option>';
                                                        else
                                                            echo '<option value="' . $key . '">' . $value . '</option>';
                                                    }
                                                } else {
                                                    foreach ($status as $key => $value) {
                                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="type">
                                                <option value="">Job Type</option>
                                                <?php
                                                    if (isset($_POST['type'])) {
                                                        foreach ($job_type as $value) {
                                                            if ($_POST['type'] == $value->id)
                                                                echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                                                            else
                                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    } else {
                                                        foreach ($job_type as $value) {
                                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="department">
                                                <option value="">Job Sector</option>
                                                <?php
                                                    if (isset($_POST['department'])) {
                                                        foreach ($department as $value) {
                                                            if ($_POST['department'] == $value->id)
                                                                echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                                                            else
                                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    } else {
                                                        foreach ($department as $value) {
                                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="position">
                                                <option value="">Job Title</option>
                                                <?php
                                                    if (isset($_POST['position'])) {
                                                        foreach ($position as $value) {
                                                            if ($_POST['position'] == $value->id)
                                                                echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                                                            else
                                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    } else {
                                                        foreach ($position as $value) {
                                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="state" id="state">
                                                <option value="">Job State</option>
                                                <?php
                                                    if (isset($_POST['state'])) {
                                                        foreach ($states as $value) {
                                                            if ($_POST['state'] == $value->id)
                                                                echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                                                            else
                                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    } else {
                                                        foreach ($states as $value) {
                                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="city" id="city">
                                                <option value="">Job City</option>
                                                <?php
                                                if (isset($_POST['state']) && strlen(($_POST['state'])) > 0) {
                                                    foreach ($cities as $value) {
                                                        if(isset($_POST['city'])) {
                                                            if ($_POST['city'] == $value->id) {
                                                                echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                                                            } else {
                                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Job Sector</th>
                                        <th>Job Title</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Gender</th>
                                        <th>Experience</th>
                                        <th>Job Type</th>
                                        <th>Job Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><a target="_blank" href="{{url('admin/view-job/'.$value->id)}}">{{ucwords($value->department)}}</a></td>
                                        <td>{{ $value->position }}</td>
                                        <td>{{ $value->state }}</td>
                                        <td>{{ $value->city }}</td>
                                        <td>{{ ucfirst($value->desired_gender) }}</td>
                                        <td>{{ ucfirst($value->job_experience) }}</td>
                                        <td>{{ $value->job_type }}</td>
                                        <td><span class="badge badge-{{ $value->job_status_class }}">{{ $value->job_status }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Department</th>
                                        <th>Position</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Gender</th>
                                        <th>Experience</th>
                                        <th>Job Type</th>
                                        <th>Job Status</th>
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
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf']
        });

        table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    </script>
@endsection