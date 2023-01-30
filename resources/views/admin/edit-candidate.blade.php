@extends('includes.admin-layout')

@section('title', 'Edit Candidate')

@section('styles')
    <link rel="stylesheet" href="{{url('css/select2.min.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
            <div class="container-fluid">
                <h3>Edit Candidate</h3>
                <form action="" id="update_candidate" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="text-uppercase">Name <span class="mandatory">*</span></label>
                                    <input type="text" class="form-control name" name="name" value="<?php echo $candidate->full_name ?>">
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <span class="error-message name-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Mobile No. <span class="mandatory">*</span></label>
                                <input type="text" class="form-control mobile" name="mobile" maxlength="10" value="<?php echo $candidate->mobile ?>">
                                <span class="error-message mobile-error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Email <span class="mandatory">*</span></label>
                                <input type="email" class="form-control email" name="email" value="<?php echo $candidate->email ?>">
                                <span class="error-message email-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desired_department">Preferred job sector <span class="mandatory">*</span></label>
                                        <select id='desired_department' name='desired_department' class="autocomplete-select" style='width: 250px;'>
                                            <option value="">Select Job Sector</option>
                                            @foreach ($department as $value)
                                                @if($candidate->desired_department_id == $value->id)
                                                <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                @else
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="error-message desired-department-error"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desired_position">Preferred job title <span class="mandatory">*</span></label>
                                        <select id='desired_position' name='desired_position' class="autocomplete-select" style='width: 250px;'>
                                            <option value="">Select Job Title</option>
                                            @foreach ($position as $value)
                                                @if($candidate->desired_position_id == $value->id)
                                                <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                @else
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="error-message desired-position-error"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desired_state">Preferred state <span class="mandatory">*</span></label>
                                        <select id='desired_state' name='desired_state' class="autocomplete-select" style='width: 250px;'>
                                            <option value="">Select State</option>
                                            @foreach ($states as $value)
                                                @if($candidate->desired_state_id == $value->id)
                                                <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                @else
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="error-message desired-state-error"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desired_city">Preferred city <span class="mandatory">*</span></label>
                                        <select id='desired_city' name='desired_city' class="autocomplete-select" style='width: 250px;'>
                                            <option value="">Select State First</option>
                                        </select>
                                        <span class="error-message desired-city-error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 well">
                            <div class="custom-radios">
                                <input type="radio" class="color" id="fresher" name="experience" value="fresher" <?php echo ($candidate->experience == 'fresher') ? 'checked' : '' ?>>
                                <label for="fresher">
                                    <span></span>
                                </label>
                                <label for="fresher">FRESHER</label>
                            </div>

                            <div class="custom-radios">
                                <input type="radio" class="color" id="experienced" name="experience" value="experienced" <?php echo ($candidate->experience == 'experienced') ? 'checked' : '' ?>>
                                <label for="experienced">
                                    <span></span>
                                </label>
                                <label for="experienced">EXPERIENCED</label>
                            </div>

                            <span class="error-message experience-error"></span>
                        </div>
                        <div class="col-md-2 well">
                            <div class="custom-radios">
                                <input type="radio" class="color" id="male" name="gender" value="male" <?php echo ($candidate->gender == 'male') ? 'checked' : '' ?>>
                                <label for="male">
                                    <span></span>
                                </label>
                                <label for="male">MALE</label>
                            </div>
                            <div class="custom-radios">
                                <input type="radio" class="color" id="female" name="gender" value="female" <?php echo ($candidate->gender == 'female') ? 'checked' : '' ?>>
                                <label for="female">
                                    <span></span>
                                </label>
                                <label for="female">FEMALE</label>
                            </div>

                            <span class="error-message gender-error"></span>
                        </div>
                        <div class="col-md-2 well">
                            <div class="custom-radios">
                                <input type="radio" class="color" id="single" name="marital_status" value="single" <?php echo ($candidate->marital_status == 'single') ? 'checked' : '' ?>>
                                <label for="single">
                                    <span></span>
                                </label>
                                <label for="single">SINGLE</label>
                            </div>
                            <div class="custom-radios">
                                <input type="radio" class="color" id="married" name="marital_status" value="married" <?php echo ($candidate->marital_status == 'married') ? 'checked' : '' ?>>
                                <label for="married">
                                    <span></span>
                                </label>
                                <label for="married">MARRIED</label>
                            </div>

                            <span class="error-message marital-status-error"></span>
                        </div>
                    </div>

                    @php
                        $display = ($candidate->experience == 'experienced') ? 'style: block' : '';
                    @endphp
                    <!-- Experience Block - Hidden Default -->
                    <div class="card experienced-block" {{$display}}>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-bold pull-left">Experience</h4>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="text-uppercase" for="working">Is Currently working?</label>
                                        <select id="working" name="working" class="autocomplete-select" style='width: 300px;'>
                                            <option value="">Select Working Status</option>
                                            <?php
                                            if($candidate->is_working == 'working') {
                                            ?>
                                            <option value="working" selected>Working</option>
                                            <option value="not_working">Not Working</option>
                                            <?php
                                            } else {
                                            ?>
                                            <option value="working">Working</option>
                                            <option value="not_working" selected>Not Working</option>
                                            <?php } ?>
                                        </select>
                                        <span class="error-message working-error"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="last_company">Current / Last Company</label>
                                    <input type="text" name="last_company" id="last_company" class="form-control" value="{{$candidate->last_company}}">
                                        <span class="error-message last-company-error"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="years_of_experience">Years of experience</label>
                                        <input type="text" class="form-control" name="years_of_experience" id="years_of_experience"  value="{{$candidate->years_of_experience}}">
                                        <span class="error-message years-error"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="current_salary_range">Current / Last Salary (Per yr)</label>
                                        <select id="current_salary_range" name="current_salary_range" class="autocomplete-select" style='width: 300px;'>
                                            <option value="">Select Salary Range</option>
                                            @foreach ($salary_range as $value)
                                                @if($candidate->current_salary_range_id == $value->id)
                                                <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                @else
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="error-message current-salary-error"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="expected_salary_range">Expected Salary (Per yr)</label>
                                        <select id="expected_salary_range" name="expected_salary_range" class="autocomplete-select" style='width: 300px;'>
                                            <option value="">Select Salary Range</option>
                                            @foreach ($salary_range as $value)
                                                @if($candidate->expected_salary_range_id == $value->id)
                                                <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                @else
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="error-message expected-salary-error"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="notice_period">Notice Period</label>
                                        <select id="notice_period" name="notice_period" class="autocomplete-select" style='width: 300px;'>
                                            <option value="">Select Notice Period</option>
                                            @foreach ($notice_period as $value)
                                                @if($candidate->notice_period_id == $value->id)
                                                <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                @else
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="error-message notice-period-error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="margin-bottom: 20px">
                                    <h4 class="text-bold pull-left">Education</h4>
                                </div>
                            </div>

                            <div class="education-block">
                                @foreach($candidate_school as $school)
                                <div class="card border border-warning">
                                    <div class="card-header bg-warning text-white">School</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">School Class</label>
                                                    <select name="school_class[]" class="form-control">
                                                        @foreach($school_class as $value)
                                                            @if($value->id == $school->school_class_id)
                                                            <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                            @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="school_id[]" value="{{$school->id}}">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">School Board</label>
                                                    <select name="school_board[]" class="form-control">
                                                        @foreach($school_board as $value)
                                                            @if($value->id == $school->school_board_id)
                                                            <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                            @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">School Medium</label>
                                                    <select name="school_medium[]" class="form-control">
                                                        @foreach($school_medium as $value)
                                                            @if($value->id == $school->school_medium_id)
                                                            <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                            @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">School Name</label>
                                                    <input type="text" name="school_name[]" value="{{$school->school_name}}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Total Marks</label>
                                                    <select name="school_total_marks[]" class="form-control">
                                                        @foreach($total_marks as $value)
                                                            @if($value->id == $school->total_marks_id)
                                                            <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                            @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Passed Out Year</label>
                                                    <select name="school_passed_out_year[]" class="form-control">
                                                        @foreach($year as $value)
                                                            @if($value == $school->passed_out_year)
                                                            <option value="{{$value}}" selected>{{$value}}</option>
                                                            @else
                                                            <option value="{{$value}}">{{$value}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @foreach($candidate_college as $college)
                                <div class="card border border-danger">
                                    <div class="card-header bg-danger text-white">College</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Graduation</label>
                                                    <select name="graduation_type[]" class="form-control">
                                                        @foreach($type as $value)
                                                            @if($value->id == $college->graduation_type_id)
                                                            <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                            @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="college_id[]" value="{{$college->id}}">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Degree</label>
                                                    <select name="graduation_degree[]" class="form-control">
                                                        @foreach($degree as $value)
                                                            @if($value->id == $college->graduation_degree_id)
                                                            <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                            @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Course</label>
                                                    <select name="graduation_major[]" class="form-control">
                                                        @foreach($major as $value)
                                                            @if($value->id == $college->graduation_major_id)
                                                            <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                            @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">College Name</label>
                                                    <input type="text" name="college_name[]" value="{{$college->college_name}}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Total Marks</label>
                                                    <select name="college_total_marks[]" class="form-control">
                                                        @foreach($total_marks as $value)
                                                            @if($value->id == $college->total_marks_id)
                                                            <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                            @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Passed Out Year</label>
                                                    <select name="college_passed_out_year[]" class="form-control">
                                                        @foreach($year as $value)
                                                            @if($value == $college->passed_out_year)
                                                            <option value="{{$value}}" selected>{{$value}}</option>
                                                            @else
                                                            <option value="{{$value}}">{{$value}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dob">Date of Birth <span class="mandatory">*</span></label>
                                <input type="date" id="dob" name="dob" class="form-control" value="<?php echo $candidate->dob ?>">
                                <span class="error-message dob-error"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pin">Location PIN Code <span class="mandatory">*</span></label>
                                <input type="text" id="pin" name="pin" class="form-control" maxlength="6"  value="<?php echo $candidate->pin ?>">
                                <span class="error-message pin-error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_me">About Me</label>
                                <textarea name="about_me" id="about_me" class="form-control"><?php echo $candidate->about_me ?></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary candidate-details-submit">Submit</button>
                    <a href="{{url('admin/view-candidate', $id)}}" class="btn btn-secondary">Go Back</a>
                    <span class="error-message submit-error"></span>
                </form>

                <!--End Row-->
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

        function fetchCities() {
            var state_id = $('#desired_state').val();
            $.ajax({
                url: base_url+"/show-cities/"+state_id,
                method: 'post',
                success: function(data) {
                    $('#desired_city').html(data);
                    var city_id = '<?php echo $candidate->desired_city_id ?>';
                    $('#desired_city option[value='+city_id+']').prop('selected', true);
                }
            });
        }

        fetchCities();

        $('#desired_state').change(function() {
            fetchCities();
        });

        if ($("#experienced").prop("checked")) {
            $(".experienced-block").show();
        }

        $("#experienced").click(function() {
            if ($(this).prop("checked")) {
                $(".experienced-block").show();
            }
        });

        $("#fresher").click(function() {
            if ($(this).prop("checked")) {
                $(".experienced-block").hide();
            }
        });
    </script>

    <script>
        
        /**************************************/
        /*******CANDIDATE DETAILS SUBMIT*******/
        /**************************************/
        $(".candidate-details-submit").click(function (e) {
           e.preventDefault();
           $(".candidate-details-submit").text("Please wait");
           $.ajax({
               url: base_url + "/admin/update-candidate",
               method: 'post',
               datatype: "json",
               data: $("#update_candidate").serialize(),
               error: function (data) {
                   if (data.status === 422) {
                       $(".submit-error").text('Fill all the fields and submit');
                       var message = JSON.parse(data.responseText);

                       $.each(message, function (key, value) {
                           name = value.name ?? '';
                           mobile = value.mobile ?? '';
                           email = value.email ?? '';
                           department = value.desired_department || '';
                           position = value.desired_position || '';
                           state = value.desired_state || '';
                           city = value.desired_city || '';
                           experience = value.experience || '';
                           gender = value.gender || '';
                           marital_status = value.marital_status || '';
                           working = value.working || '';
                           last_company = value.last_company || '';
                           years_of_experience = value.years_of_experience || '';
                           current_salary_range = value.current_salary_range || '';
                           expected_salary_range = value.expected_salary_range || '';
                           notice_period = value.notice_period || '';
                           dob = value.dob || '';
                           pin = value.pin || '';
                       });

                       $(".name-error").text(name);
                       $(".mobile-error").text(mobile);
                       $(".email-error").text(email);
                       $(".desired-department-error").text(department);
                       $(".desired-position-error").text(position);
                       $(".desired-state-error").text(state);
                       $(".desired-city-error").text(city);
                       $(".experience-error").text(experience);
                       $(".gender-error").text(gender);
                       $(".marital-status-error").text(marital_status);
                       $(".working-error").text(working);
                       $(".last-company-error").text(last_company);
                       $(".years-error").text(years_of_experience);
                       $(".current-salary-error").text(current_salary_range);
                       $(".expected-salary-error").text(expected_salary_range);
                       $(".notice-period-error").text(notice_period);
                       $(".dob-error").text(dob);
                       $(".pin-error").text(pin);
                   }
               },
               success: function (data) {
                   $(".error-message").hide();
                   if (data.status == 'success') {
                       $(".modal").modal('hide');
                       alert(data.message);
                       window.location.reload();
                   }
               },
               complete: function () {
                   $(".candidate-details-submit").text("Submit");
               }
           });
        });
    </script>
@endsection