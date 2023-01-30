@extends('includes.admin-layout')

@section('title', 'View Employer')

@section('styles')
    <!--Data Tables -->
    <link href="{{url('admin-assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{url('admin-assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
          <div class="col-sm-12">
            <h4 class="page-title">Job Profile</h4>
          </div>
        </div>
        <!-- End Breadcrumb-->
        <div class="row">
            <div class="col-lg-4">
              <div class="profile-card-3">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="details">
                      <h5 class="ml-3">{{ $job->department . " - " . $job->position }}</h5>
                      <h6 class="ml-3">{{ $job->state . " - " . $job->city }}</h6>
                      <span class="badge badge-{{ $job->job_status_class }}"><i class="fa fa-exclamation"></i> {{ $job->job_status }}</span>
                    </div>
                    <hr>
                    <h5>Job Posted By: </h5>
                    <h5>
                      <a target="_blank" href="{{url('admin/view-employer/'.$job->employer_id)}}">{{ucwords($job->posted_by)}}</a>
                    </h5>
                    <a href="{{url('admin/edit-job', $id)}}"><button class="btn btn-success">Edit Job</button></a>
                    <button class="btn btn-danger delete-job" onclick="deleteJob({{ $id }})">Delele Job</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
                <div class="card-body">
                  <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                    <li class="nav-item">
                      <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Job</span></a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void();" data-target="#status" data-toggle="pill" class="nav-link"><i class="icon-speech"></i> <span class="hidden-xs">Status</span></a>
                    </li>
                  </ul>
                  <div class="tab-content p-3">
                    <div class="tab-pane active" id="profile">
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-bordered table-striped">
                            <tbody>
                              <tr>
                                <th>Company Name</th>
                                <td>{{ $job->company_name }}</td>
                              </tr>
                              <tr>
                                <th>Company Address</th>
                                <td>{{ $job->company_address }}</td>
                              </tr>
                              @if(isset($job->company_website))
                              <tr>
                                <th>Company Website</th>
                                <td>{{ $job->company_website }}</td>
                              </tr>
                              @endif
                              <tr>
                                <th>Job Available For</th>
                                <td>{{ $job->desired_gender }}</td>
                              </tr>
                              <tr>
                                <th>Total Candidates</th>
                                <td>{{ $job->total_candidates }}</td>
                              </tr>
                              <tr>
                                <th>Needed Candidates</th>
                                <td>
                                  {{ $job->needed_candidates }}
                                  @if ($job->needed_candidates != 0)
                                  <button class="btn btn-primary" data-toggle="modal" data-target="#updateCount">Update</>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <th>Contact Person Name</th>
                                <td>{{ $job->contact_person_name }}</td>
                              </tr>
                              <tr>
                                <th>Contact Person Mobile</th>
                                <td>{{ $job->contact_person_mobile }}</td>
                              </tr>
                              <tr>
                                <th>Contact Person Position</th>
                                <td>{{ $job->contact_person_position }}</td>
                              </tr>
                              <tr>
                                <th>Job Created At</th>
                                <td>{{ $job->datetime }}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="status">
                      @if($job->job_status == 'Pending')
                        <div class="row">
                          <div class="col-md-12">
                            <button type="button" class="btn btn-warning add-status-btn waves-effect waves-light" data-toggle="modal" data-target="#addStatus">Add Status</button>
                          </div>
                        </div>
                      @endif
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-responsive table-bordered tabled-striped job_status mt-1">
                            <thead>
                              <tr>
                                <th>S.no.</th>
                                <th>Contacted User</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Date and Time</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach ($job_status as $key => $value)
                                <tr>
                                  <td>{{ $key+1 }}</td>
                                  <td>{{ ucfirst($value->user) }}</td>
                                  <td><span class="badge badge-{{ $value->status_class }}"><i class="fa fa-exclamation"></i> {{ $value->status }}</span></td>
                                  <td>{{ $value->description }}</td>
                                  <td>{{ $value->datetime }}</td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="updateCount">
              <div class="modal-dialog">
                <form class="update-candidate-count-form" action="{{url('admin/update-candidate-count/'.$id)}}" method="get">
                  <div class="modal-content border-dark">
                    <div class="modal-header bg-dark">
                      <h5 class="modal-title text-white">Update Candidates Count</h5>
                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Needed Candidates</label>
                          <input type="text" name="needed_candidates" class="form-control needed_candidates" value="{{ $job->needed_candidates }}">
                          <span class="error-message count-error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-inverse-dark" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                      <button type="submit" class="btn btn-dark update-count" name="update-count"><i class="fa fa-check-square-o"></i> Change</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="modal fade" id="addStatus">
              <div class="modal-dialog">
                <form class="update-job-status-form" action="{{url('admin/update-job-status/'.$id)}}" method="get">
                  <div class="modal-content border-dark">
                    <div class="modal-header bg-dark">
                      <h5 class="modal-title text-white">Add Status</h5>
                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Status</label>
                          <select class="form-control" name="status" id="status">
                            @foreach ($status as $key => $value)
                              <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                          </select>
                          <span class="error-message status-error"></span>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                          <span class="error-message description-error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-inverse-dark" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                      <button type="submit" class="btn btn-dark add-requirement-status" name="add-requirement-status"><i class="fa fa-check-square-o"></i> Change</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
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

    $('.job_status').DataTable();
    const base_url = "{{ url('/') }}";

    $(".update-count").click(function(e) {
      e.preventDefault();

      var needed_candidates = $(".needed_candidates").val();

      if(!needed_candidates) {
        $(".error-message").show();
        $(".count-error").text("Needed Candidates should not be empty");
      } else {
        $(".error-message").hide();
        $('.update-candidate-count-form').submit();
      }
    });

    $(".add-requirement-status").click(function(e) {
      e.preventDefault();

      var description = $("#description").val();

      if(!description) {
        $(".error-message").show();
        $(".description-error").text("Description should not be empty");
      } else {
        $(".error-message").hide();
        $('.update-job-status-form').submit();
      }
    });

    function deleteJob(id) {
      if (confirm("Are you sure you want to delete this job?")) {
        $.ajax({
          url: base_url+"/admin/delete-job/"+id,
          method: "get",
          success: function(data) {
            if (data == '') {
              alert("Job Deleted Successfully!");
              window.location.replace("{{url('admin/jobs')}}");
            }
          }
        });
      }
    }
  </script>
@endsection