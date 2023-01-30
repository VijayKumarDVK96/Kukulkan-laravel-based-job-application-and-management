@extends('includes.admin-layout')

@section('title', 'Edit Job')

@section('styles')
    <link rel="stylesheet" href="{{url('css/select2.min.css')}}">

    <style>
    label {
      display: block;
    }
  </style>
@endsection

@section('content')
    <div class="content-wrapper">
      <div class="container-fluid">
        <h3>Edit Job</h3>
        <form action="#" method="post" id="edit_job">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Company Name <span class="mandatory">*</span></label>
                <input type="text" id="job_company_name" name="company_name" class="form-control" value="{{$job->company_name}}">
                <input type="hidden" name="id" class="id" value="{{$id}}">
                <span class="error-message job-company-error"></span>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="">Company Address <span class="mandatory">*</span></label>
                <input type="text" id="job_company_address" name="company_address" class="form-control" value="{{$job->company_address}}">
                <span class="error-message job-company-address-error"></span>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="">Company Website</label>
                <input type="text" id="job_company_website" name="company_website" class="form-control" value="{{$job->company_website}}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="job_desired_department">Job Vacant Sector <span class="mandatory">*</span></label>
                <select id="job_desired_department" name="desired_department_id" class="autocomplete-select" style='width: 200px;'>
                  <option value="">Select Job Sector</option>
                  <?php
                  foreach ($department as $value) {
                      if($job->desired_department_id == $value->id)
                      echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                      else
                      echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                  }
                  ?>
                </select>
                <span class="error-message job-vacant-department-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="job_desired_position">Job Vacant Title <span class="mandatory">*</span></label>
                <select id="job_desired_position" name="desired_position_id" class="autocomplete-select" style='width: 200px;'>
                  <?php
                  foreach ($position as $value) {
                      if($job->desired_position_id == $value->id)
                      echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                      else
                      echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                  }
                  ?>
                </select>
                <span class="error-message job-vacant-position-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="job_state">State <span class="mandatory">*</span></label>
                <select id="job_state" name="desired_state_id" class="autocomplete-select" style='width: 200px;'>
                  <?php
                      foreach ($states as $value) {
                          if($job->desired_state_id == $value->id)
                          echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                          else
                          echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                      }
                  ?>
                </select>
                <span class="error-message job-vacant-state-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="job_city">City <span class="mandatory">*</span></label>
                <select id="job_city" name="desired_city_id" class="autocomplete-select" style='width: 200px;'>
                </select>
                <span class="error-message job-vacant-city-error"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="fromRange">Required Age From</label>
                <input type="range" name="desired_age_from" min="1" max="100" class="slider" id="fromRange" value="{{$job->desired_age_from}}">
                <p class="slider_display">Age: <span id="age_from"></span></p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="toRange">Required Age To</label>
                <input type="range" name="desired_age_to" min="1" max="100" class="slider" id="toRange" value="{{$job->desired_age_to}}">
                <p class="slider_display">Age: <span id="age_to"></span></p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="job_gender">Required Gender</label>
                <select id="job_gender" name="desired_gender" class="autocomplete-select" style='width: 200px;'>
                  <?php
                  $gender[] = 'any';
                  foreach ($gender as $value) {
                      if($job->desired_gender == $value)
                      echo '<option value="' . strtolower($value) . '" selected>' . $value . '</option>';
                      else
                      echo '<option value="' . strtolower($value) . '">' . $value . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="total_candidates">Total Candidates Needed</label>
                <input type="text" name="total_candidates" class="form-control" id="total_candidates" value="{{$job->total_candidates}}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="job_title">Job Title</label>
                    <input type="text" id="job_title" name="job_title" class="form-control" value="{{$job->job_title}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="job_experience">Job Experience</label>
                    <select id="job_experience" name="job_experience" class="autocomplete-select" style='width: 200px;'>
                      <?php
                      foreach ($experience as $value) {
                          if($job->job_experience == $value)
                          echo '<option value="' . $value . '" selected>' . $value . '</option>';
                          else
                          echo '<option value="' . $value . '">' . $value . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="job_salary_range">Job Salary <span class="mandatory">*</span></label>
                    <select id="job_salary_range" name="job_salary_range_id" class="autocomplete-select" style='width: 200px;'>
                    <option value="">Select Salary Range</option>
                    <?php
                      foreach ($salary_range as $value) {
                          if($job->job_salary_range_id == $value->id)
                          echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                          else
                          echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                      }
                    ?>
                    </select>
                    <span class="error-message job-salary-range-error"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="job_type">Job Type <span class="mandatory">*</span></label>
                    <select id="job_type" name="job_work_type_id" class="autocomplete-select" style='width: 200px;'>
                    <option value="">Select Job Type</option>
                    <?php
                      foreach ($job_type as $value) {
                          if($job->job_work_type_id == $value->id)
                          echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                          else
                          echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                      }
                    ?>
                    </select>
                    <span class="error-message job-type-error"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="job_description">Job Description</label>
              <textarea id="job_description" name="job_description" class="form-control" rows="4">{{$job->job_description}}</textarea>
                    <span class="error-message job-description-error"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="contact_person_name">Contact Person Name <span class="mandatory">*</span></label>
                <input type="text" id="contact_person_name" name="contact_person_name" class="form-control" value="{{$job->contact_person_name}}">
                <span class="error-message contact-name-error"></span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="contact_person_mobile">Contact Person Mobile <span class="mandatory">*</span></label>
                <input type="text" id="contact_person_mobile" name="contact_person_mobile" class="form-control" value="{{$job->contact_person_mobile}}">
                <span class="error-message contact-mobile-error"></span>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="contact_person_position_id">Contact Person Job Title <span class="mandatory">*</span></label>
                <select id="contact_person_position_id" name="contact_person_position_id" class="autocomplete-select" style='width: 300px;'>
                  <?php
                  foreach ($position as $value) {
                      if($job->contact_person_position_id == $value->id)
                      echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                      else
                      echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                  }
                  ?>
                </select>
                <span class="error-message contact-position-error"></span>
              </div>
            </div>
          </div>

          <button type="submit" id="update-requirement" class="btn btn-primary">Save</button>
          <a href="{{url('admin/view-job', $id)}}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button></a>
        </form>
      </div>
      <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->
@endsection

@section('scripts')
    <script src="{{url('js/select2.min.js')}}"></script>
    <script src="{{url('js/functions.js')}}"></script>

    <script>
      $(".autocomplete-select").select2();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
      });

      const base_url = "{{ url('/') }}";

      var id = $(".id").val();

      /**************************************/
      /******SELECT DROPDOWN DATA FETCH******/
      /**************************************/
      range_slider("#fromRange", "#age_from");
      range_slider("#toRange", "#age_to");
      $("#fromRange, #toRange").on("input", function() {
        range_slider("#fromRange", "#age_from");
        range_slider("#toRange", "#age_to");
      });

      function fetchCities() {
          var state_id = $('#job_state').val();
          $.ajax({
              url: base_url+"/show-cities/"+state_id,
              method: 'post',
              success: function(data) {
                  $('#job_city').html(data);
                  var city_id = '<?php echo $job->desired_city_id ?>';
                  $('#job_city option[value='+city_id+']').prop('selected', true);
              }
          });
      }

      fetchCities();

      $('#job_state').change(function() {
          fetchCities();
      });

      $("#update-requirement").click(function (e) {
          e.preventDefault();
          $("#update-requirement").text("Please wait");

          $.ajax({
              url: base_url + "/admin/update-job",
              method: "post",
              data: $("#edit_job").serialize(),
              datatype: "json",
              success: function (data) {
                  $(".error-message").hide();
                  if(data.status == 'success') {
                      $(".modal").modal('hide');
                      alert(data.message);
                      window.location.reload();
                  }
              },
              complete: function (data) {
                if(data.status === 422) {
                  var message = JSON.parse(data.responseText);
                  $(".submit-error").text('Fill all the fields and submit');
                  $(".error-message").show();

                  $.each(message, function(key, value) {
                      job_company_name = value.company_name ?? '';
                      job_company_address = value.company_address ?? '';
                      job_desired_department = value.desired_department_id ?? '';
                      job_desired_position = value.desired_position_id ?? '';
                      job_desired_state = value.desired_state_id ?? '';
                      job_desired_city = value.desired_city_id ?? '';
                      job_title = value.job_title ?? '';
                      required_gender = value.required_gender ?? '';
                      total_candidates = value.total_candidates ?? '';
                      job_experience = value.job_experience ?? '';
                      job_description = value.job_description ?? '';
                      job_type = value.job_work_type_id ?? '';
                      job_salary_range = value.job_salary_range_id ?? '';
                      contact_person_name = value.contact_person_name ?? '';
                      contact_person_mobile = value.contact_person_mobile ?? '';
                      contact_person_position_id = value.contact_person_position_id ?? '';
                  });
              } else {
                  job_company_name = '';
                  job_company_address = '';
                  job_desired_department = '';
                  job_desired_position = '';
                  job_desired_state = '';
                  job_desired_city = '';
                  required_gender = '';
                  total_candidates = '';
                  job_title = '';
                  job_experience = '';
                  job_description = '';
                  job_type = '';
                  job_salary_range = '';
                  contact_person_name = '';
                  contact_person_mobile = '';
                  contact_person_position_id = '';
              }

              $(".job-company-error").text(job_company_name);
              $(".job-company-address-error").text(job_company_address);
              $(".job-vacant-department-error").text(job_desired_department);
              $(".job-vacant-position-error").text(job_desired_position);
              $(".job-vacant-state-error").text(job_desired_state);
              $(".job-vacant-city-error").text(job_desired_city);
              $(".job-required-gender-error").text(required_gender);
              $(".job-total-candidates-error").text(total_candidates);
              $(".job-title-error").text(job_title);
              $(".job-experience-error").text(job_experience);
              $(".job-description-error").text(job_description);
              $(".job-type-error").text(job_type);
              $(".job-salary-range-error").text(job_salary_range);
              $(".contact-name-error").text(contact_person_name);
              $(".contact-mobile-error").text(contact_person_mobile);
              $(".contact-position-error").text(contact_person_position_id);

                  // if (data.status === 422) {
                  //     $(".submit-error").text('Fill all the fields and submit');
                  //     var message = JSON.parse(data.responseText);
                  //     $(".error-message").show();

                  //     $.each(message, function (key, value) {
                  //         name = value.full_name ?? '';
                  //         mobile = value.mobile ?? '';
                  //         email = value.email ?? '';
                  //         company_name = value.company_name ?? '';
                  //         company_address = value.company_address ?? '';
                  //         job_department = value.job_department ?? '';
                  //         job_position = value.job_position ?? '';
                  //     });
                  // } else {
                  //     name = '';
                  //     mobile = '';
                  //     email = '';
                  //     company_name = '';
                  //     company_address = '';
                  //     job_department = '';
                  //     job_position = '';
                  // }

                  // $(".name-error").text(name);
                  // $(".mobile-error").text(mobile);
                  // $(".email-error").text(email);
                  // $(".company-error").text(company_name);
                  // $(".company-address-error").text(company_address);
                  // $(".job-department-error").text(job_department);
                  // $(".job-position-error").text(job_position);

                  $("#update-requirement").text("Submit");
              }
          });
      });

      // $("#update-requirement").click(function(e) {
      //   e.preventDefault();
      //   var id = $(".id").val();
      //   var job_company_name = check_required("#job_company_name", ".job-company-error", "Required");
      //   var job_company_address = check_required("#job_company_address", ".job-company-address-error", "Required");
      //   var job_company_website = $("#job_company_website").val();
      //   var job_desired_department = check_selectbox("#job_desired_department", ".job-vacant-department-error");
      //   var job_desired_position = check_selectbox("#job_desired_position", ".job-vacant-position-error");
      //   var job_desired_state = check_selectbox("#job_state", ".job-vacant-state-error");
      //   var job_desired_city = check_selectbox("#job_city", ".job-vacant-city-error");
      //   var age_from = $("#age_from").text();
      //   var age_to = $("#age_to").text();
      //   var job_gender = $("#job_gender").val();
      //   var total_candidates = $("#total_candidates").val();
      //   var job_title = $("#job_title").val();
      //   var job_experience = $("#job_experience").val();
      //   var job_salary_range = check_selectbox("#job_salary_range", ".job-salary-range-error");
      //   var job_type = check_selectbox("#job_type", ".job-type-error");
      //   var job_description = $("#job_description").val();
      //   var contact_person_name = check_required("#contact_person_name", ".contact-name-error", "Name is required");
      //   var contact_person_mobile = check_mobile("#contact_person_mobile", ".contact-mobile-error");
      //   var contact_person_position_id = check_selectbox("#contact_person_position_id", ".contact-position-error");

      //   if (job_company_name.length > 0 && job_company_address.length > 0 && job_desired_department.length > 0 && job_desired_position.length > 0 && job_desired_state.length > 0 && job_desired_city.length > 0 && job_salary_range.length > 0 && job_type.length > 0 && contact_person_name.length > 0 && contact_person_mobile.length > 0 && contact_person_position_id.length > 0) {
      //     $.ajax({
      //       url: base_url+"/admin/update-job",
      //       method: "post",
      //       datatype: "json",
      //       data: {
      //         "id": id,
      //         "company_name": job_company_name,
      //         "company_address": job_company_address,
      //         "company_website": job_company_website,
      //         "desired_department_id": job_desired_department,
      //         "desired_position_id": job_desired_position,
      //         "desired_state_id": job_desired_state,
      //         "desired_city_id": job_desired_city,
      //         "desired_age_from": age_from,
      //         "desired_age_to": age_to,
      //         "desired_gender": job_gender,
      //         "total_candidates": total_candidates,
      //         "job_title": job_title,
      //         "job_experience": job_experience,
      //         "job_salary_range_id": job_salary_range,
      //         "job_work_type_id": job_type,
      //         "job_description": job_description,
      //         "contact_person_name": contact_person_name,
      //         "contact_person_mobile": contact_person_mobile,
      //         "contact_person_position_id": contact_person_position_id,
      //       },
      //       success: function(data) {
      //         if (data.status == "success") {
      //           $(".error-message").hide();
      //           alert(data.message);
      //           window.location.reload();
      //         }
      //       }
      //     });
      //   }
      // });
  </script>
@endsection