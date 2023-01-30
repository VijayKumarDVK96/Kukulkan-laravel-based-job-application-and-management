@extends('includes.admin-layout')

@section('title', 'View Employer')

@section('content')
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
          <div class="col-sm-12">
            <h4 class="page-title">Employer Profile</h4>
          </div>
        </div>
        <!-- End Breadcrumb-->
        <div class="row">
            <div class="col-lg-4">
              <div class="profile-card-3">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="details">
                      <h4 class="mb-1 ml-3">{{ ucwords($employer->full_name) }}</h4>
                      <h5 class="ml-3">{{ $employer->job_department . " - " . $employer->job_position }}</h5>
                    </div>
                    <hr>
                    <a href="{{url('admin/edit-employer', $id)}}"><button class="btn btn-primary">Edit Profile</button></a>
                    <button class="btn btn-danger"  onclick="deleteEmployer({{ $id }})">Delete Profile</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
                <div class="card-body">
                  <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                    <li class="nav-item">
                      <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void();" data-target="#jobs" data-toggle="pill" class="nav-link"><i class="icon-user"></i> <span class="hidden-xs">Jobs</span></a>
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
                                <td>{{ $employer->company_name }}</td>
                              </tr>
                              <tr>
                                <th>Company Address</th>
                                <td>{{ $employer->company_address }}</td>
                              </tr>
                              @if (strlen($employer->company_website) > 0)
                              <tr>
                                <th>Company Website</th>
                                <td><a href="http://{{ $employer->company_website }}" target="_blank">{{ $employer->company_website }}</a></td>
                              </tr>
                              @endif
                              <tr>
                                <th>Mobile</th>
                                <td>{{ $employer->mobile }}</td>
                              </tr>
                              <tr>
                                <th>Email</th>
                                <td>{{ $employer->email }}</td>
                              </tr>
                              <tr>
                                <th>Profile Created At</th>
                                <td>{{ $employer->datetime }}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="jobs">
                      <div class="row">
                        <div class="col-md-12">
                          {{-- <a href="add-job.php?id={{ $id }}"><button class="btn btn-primary" style="margin-bottom: 10px">Add New Job</button></a> --}}
                          <table class="table table-bordered table-responsive">
                            <thead>
                              <tr>
                                <th>S.no.</th>
                                <th>Job Sector</th>
                                <th>Job Title</th>
                                <th>Job Status</th>
                                <th>Date and Time</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($jobs as $key => $value)
                                <tr>
                                  <td>{{ $key+1 }}</td>
                                  <td><a target="_blank" href="{{url('admin/view-job/'.$value->job_id)}}">{{$value->department}}</a></td>
                                  <td>{{ $value->position }}</td>
                                  <td><span class="badge badge-{{ $value->status_class }}"><i class="fa fa-exclamation"></i> {{ $value->status }}</span></td>
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
        </div>
      </div>
      <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->
@endsection

@section('scripts')
    <script src="{{url('js/functions.js')}}"></script>

    <script>
    const base_url = "{{ url('/') }}";

    function deleteEmployer(id) {
      if (confirm("Are you sure you want to delete this profile?")) {
        $.ajax({
          url: base_url+"/admin/delete-employer/"+id,
          method: "get",
          success: function(data) {
            if (data == '') {
              alert("Profile Deleted Successfully!");
              window.location.replace("{{url('admin/employers')}}");
            }
          }
        });
      }
    }
  </script>
@endsection