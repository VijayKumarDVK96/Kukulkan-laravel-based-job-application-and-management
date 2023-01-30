@extends('includes.admin-layout')

@section('title', 'View Candidate')

@section('styles')
    <link href="{{url('admin-assets/plugins/vertical-timeline/css/vertical-timeline.css')}}" rel="stylesheet" />
    <!--Data Tables -->
    <link href="{{url('admin-assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{url('admin-assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="clearfix"></div>

    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
          <div class="col-sm-12">
            <h4 class="page-title">Candidate Profile</h4>
          </div>
        </div>
        <!-- End Breadcrumb-->
        <div class="row">
            <div class="col-lg-4">
              <div class="profile-card-3">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="details">
                      <input type="hidden" name="id" class="id" value="{{ $id }}">
                      <h4 class="mb-1 ml-3">{{ ucwords($candidate->full_name) }}</h4>
                      <h5 class="mb-1 ml-3">{{ $candidate->age . "(" . ucfirst($candidate->gender) . ")" }}</h5>
                      <h5 class="ml-3">{{ $candidate->department . " - " . $candidate->position }}</h5>
                      <h6 class="ml-3">{{ $candidate->state . " - " . $candidate->city }}</h6>
                      <span class="badge badge-{{ $candidate->job_status_class }}"><i class="fa fa-exclamation"></i> {{ $candidate->job_status }}</span>
                    </div>
                    <hr>
                    @if(strlen($candidate->resume) > 0)
                      <a href="{{ url('/')."/resumes/".$candidate->resume }}" class="btn btn-primary btn-sm btn-round waves-effect waves-light m-1">Download Resume</a>
                    @endif
                    <a href="{{ url('admin/edit-candidate/'.$id) }}" class="btn btn-outline-primary btn-sm btn-round waves-effect waves-light m-1">Edit Profile</a>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-1" onclick="deleteProfile({{ $id }})">Delete Profile</button>
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
                      @if ($candidate->experience == 'experienced')
                      <li class="nav-item">
                        <a href="javascript:void();" data-target="#experience" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Experience</span></a>
                      </li>
                      @endif
                    <li class="nav-item">
                      <a href="javascript:void();" data-target="#education" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Education</span></a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void();" data-target="#status" data-toggle="pill" class="nav-link"><i class="icon-speech"></i> <span class="hidden-xs">Status</span></a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void();" data-target="#sms" data-toggle="pill" class="nav-link"><i class="icon-envelope"></i> <span class="hidden-xs">SMS</span></a>
                    </li>
                  </ul>
                  <div class="tab-content p-3">
                    <div class="tab-pane active" id="profile">
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-bordered table-striped table-responsive">
                            <tbody>
                              <tr>
                                <th>Profile Created At</th>
                                <td>{{ $candidate->datetime }}</td>
                              </tr>
                              <tr>
                                <th>Email</th>
                                <td>{{ $candidate->email }}</td>
                              </tr>
                              <tr>
                                <th>Mobile</th>
                                <td>{{ $candidate->mobile }}</td>
                              </tr>
                              <tr>
                                <th>PIN Code</th>
                                <td>{{ $candidate->pin }}</td>
                              </tr>
                              @if(strlen($candidate->about_me) > 0)
                                <tr>
                                  <th>About Me</th>
                                  <td>{{ $candidate->about_me }}</td>
                                </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    @if ($candidate->experience == 'experienced')
                      <div class="tab-pane" id="experience">
                        <div class="row">
                          <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                              <tbody>
                                <tr>
                                  <th>Currently Working</th>
                                  <td>{{ ucwords($candidate->is_working) }}</td>
                                </tr>
                                <tr>
                                  <th>Current / Last Company</th>
                                  <td>{{ $candidate->last_company }}</td>
                                </tr>
                                <tr>
                                  <th>Current / Last Salary (Per yr)</th>
                                  <td>{{ $candidate->current_salary }}</td>
                                </tr>
                                <tr>
                                  <th>Expected Salary (Per yr)</th>
                                  <td>{{ $candidate->expected_salary }}</td>
                                </tr>
                                <tr>
                                  <th>Years of Experience</th>
                                  <td>{{ $candidate->years_of_experience }}</td>
                                </tr>
                                <tr>
                                  <th>Notice Period</th>
                                  <td>{{ $candidate->notice_period }}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    @endif
                    <div class="tab-pane" id="education">
                      <div class="row">
                        <div class="col-lg-12">
                          <section class="cd-timeline js-cd-timeline">
                            <div class="cd-timeline__container">
                              @if(isset($college) && !empty($college))
                                @foreach($college as $value)
                                  <div class="cd-timeline__block js-cd-block">
                                    <div class="cd-timeline__img college cd-timeline__img--bounce-in">
                                      <i class="icon-graduation icons"></i>
                                    </div>

                                    <div class="cd-timeline__content js-cd-content cd-timeline__content--bounce-in">
                                      <h5>{{ $value->name }}</h5>
                                      <h6>{{ $value->graduation_type }}</h6>
                                      <h6>{{ $value->graduation_degree . " - " . $value->graduation_major }}</h6>
                                      <span class="cd-timeline__date">{{ $value->year }}<br>{{ $value->marks }}</span>
                                    </div>
                                  </div>
                                @endforeach
                              @endif

                              @if(isset($school) && !empty($school))
                                @foreach ($school as $value)
                                  <div class="cd-timeline__block js-cd-block">
                                    <div class="cd-timeline__img school cd-timeline__img--bounce-in">
                                      <i class="icon-book-open icons"></i>
                                    </div>

                                    <div class="cd-timeline__content js-cd-content cd-timeline__content--bounce-in">
                                      <h5>{{ $value->name  }}</h5>
                                      <h6>{{ $value->class  }}</h6>
                                      <h6>{{ $value->board  }} - {{ $value->medium  }}</h6>
                                      <span class="cd-timeline__date">{{ $value->year  }}<br>{{ $value->marks  }}</span>
                                    </div>
                                  </div>
                                @endforeach
                              @endif

                            </div>
                          </section> <!-- cd-timeline -->
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="status">
                      @if($candidate->job_status == 'Pending')
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

                    <div class="tab-pane" id="sms">
                      <div class="row">
                        <div class="col-md-12">
                          <form action="" method="get">
                            <div class="form-group">
                              <label for="sms_text">Type your text here (250 characters only)</label>
                              <textarea name="sms_text" class="form-control" id="sms_text"></textarea>
                              <input type="hidden" name="mobile" id="mobile" value="">
                              <span class="error-message sms-error"></span>
                            </div>

                            <button class="btn btn-primary" id="send_sms" type="submit">Send SMS</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Add Status Modal -->
                  <div class="modal fade" id="addStatus">
                    <div class="modal-dialog">
                      <form class="edit-status-form" action="{{url('admin/add-status/'.$id)}}" method="get">
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
                            <button type="submit" class="btn btn-dark add-candidate-status" name="add-candidate-status"><i class="fa fa-check-square-o"></i> Change</button>
                          </div>
                        </div>
                      </form>
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
    <script src="{{url('admin-assets/plugins/vertical-timeline/js/vertical-timeline.js')}}"></script>
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

    $('.job_status').DataTable();
    const base_url = "{{ url('/') }}";

    $(".add-candidate-status").click(function(e) {
      e.preventDefault();

      var description = $("#description").val();

      if(!description) {
        $(".error-message").show();
        $(".description-error").text("Description should not be empty");
      } else {
        $(".error-message").hide();
        $('.edit-status-form').submit();
      }
    });

    $("#send_sms").click(function(e) {
      e.preventDefault();

      var id = $(".id").val();
      var text = $("#sms_text").val();

      if (text.length == 0) {
        $(".error-message").show();
        $(".sms-error").text("Text should not be empty");
      } else if (text.length > 250) {
        $(".error-message").show();
        $(".sms-error").text("SMS Text should be within 250 characters only");
      } else {
        $(".error-message").hide();

        $.ajax({
          url: "controller/CandidatesController.php",
          method: "get",
          data: {
            'sms_text': text,
            'send_candidate_sms': 'yes'
          },
          success: function(data) {
            if (data == 'success') {
              alert("SMS Sent Successfully!");
              window.location.replace("view-candidate.php?id=" + id);
            }
          }
        });
      }
    });

    function deleteProfile(id) {
      if (confirm("Are you sure you want to delete this profile?")) {
        $.ajax({
          url: base_url+"/admin/delete-profile/"+id,
          method: "get",
          success: function(data) {
            if (data == '') {
              alert("Profile Deleted Successfully!");
              window.location.replace("{{url('admin/candidates')}}");
            }
          }
        });
      }
    }
  </script>
@endsection