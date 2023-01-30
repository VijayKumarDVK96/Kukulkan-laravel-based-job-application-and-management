@extends('includes.admin-layout')

@section('title', 'Add Candidate')

@section('styles')
    <link rel="stylesheet" href="{{url('css/select2.min.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <h3>Add Candidate</h3>
            <form action="" id="add_candidate" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="text-uppercase">Name <span class="mandatory">*</span></label>
                                <input type="text" class="form-control name" name="name">
                                <span class="error-message name-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-uppercase">Mobile No. <span class="mandatory">*</span></label>
                            <input type="text" class="form-control mobile" name="mobile" maxlength="10">
                            <span class="error-message mobile-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-uppercase">Email <span class="mandatory">*</span></label>
                            <input type="email" class="form-control email" name="email">
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
                                        <?php
                                        foreach ($department as $value) {
                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="error-message desired-department-error"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="desired_position">Preferred job title <span class="mandatory">*</span></label>
                                    <select id='desired_position' name='desired_position' class="autocomplete-select" style='width: 250px;'>
                                        <option value="">Select Job Title</option>
                                        <?php
                                        foreach ($position as $value) {
                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="error-message desired-position-error"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="desired_state">Preferred state <span class="mandatory">*</span></label>
                                    <select id='desired_state' name='desired_state' class="autocomplete-select" style='width: 250px;'>
                                        <option value="">Select State</option>
                                        <?php
                                            foreach ($states as $value) {
                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                            }
                                        ?>
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
                            <input type="radio" class="color" id="fresher" name="experience" value="fresher">
                            <label for="fresher">
                                <span></span>
                            </label>
                            <label for="fresher">FRESHER</label>
                        </div>

                        <div class="custom-radios">
                            <input type="radio" class="color" id="experienced" name="experience" value="experienced">
                            <label for="experienced">
                                <span></span>
                            </label>
                            <label for="experienced">EXPERIENCED</label>
                        </div>

                        <span class="error-message experience-error"></span>
                    </div>
                    <div class="col-md-2 well">
                        <div class="custom-radios">
                            <input type="radio" class="color" id="male" name="gender" value="male">
                            <label for="male">
                                <span></span>
                            </label>
                            <label for="male">MALE</label>
                        </div>
                        <div class="custom-radios">
                            <input type="radio" class="color" id="female" name="gender" value="female">
                            <label for="female">
                                <span></span>
                            </label>
                            <label for="female">FEMALE</label>
                        </div>

                        <span class="error-message gender-error"></span>
                    </div>
                    <div class="col-md-2 well">
                        <div class="custom-radios">
                            <input type="radio" class="color" id="single" name="marital_status" value="single">
                            <label for="single">
                                <span></span>
                            </label>
                            <label for="single">SINGLE</label>
                        </div>
                        <div class="custom-radios">
                            <input type="radio" class="color" id="married" name="marital_status" value="married">
                            <label for="married">
                                <span></span>
                            </label>
                            <label for="married">MARRIED</label>
                        </div>

                        <span class="error-message marital-status-error"></span>
                    </div>
                </div>

                <!-- Experience Block - Hidden Default -->
                <div class="card experienced-block">
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
                                        <option value="working">Working</option>
                                        <option value="not_working">Not Working</option>
                                    </select>
                                    <span class="error-message working-error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="last_company">Current / Last Company</label>
                                    <input type="text" name="last_company" id="last_company" class="form-control">
                                    <span class="error-message last-company-error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="years_of_experience">Years of experience</label>
                                    <input type="text" class="form-control" name="years_of_experience" id="years_of_experience">
                                    <span class="error-message years-error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="current_salary_range">Current / Last Salary (Per yr)</label>
                                    <select id="current_salary_range" name="current_salary_range" class="autocomplete-select" style='width: 300px;'>
                                        <option value="">Select Salary Range</option>
                                        <?php
                                            foreach ($salary_range as $value) {
                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="error-message current-salary-error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="expected_salary_range">Expected Salary (Per yr)</label>
                                    <select id="expected_salary_range" name="expected_salary_range" class="autocomplete-select" style='width: 300px;'>
                                        <option value="">Select Salary Range</option>
                                        <?php
                                            foreach ($salary_range as $value) {
                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="error-message expected-salary-error"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="notice_period">Notice Period</label>
                                    <select id="notice_period" name="notice_period" class="autocomplete-select" style='width: 300px;'>
                                        <option value="">Select Notice Period</option>
                                        <?php
                                            foreach ($notice_period as $value) {
                                                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                            }
                                        ?>
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
                                <h4 class="text-bold pull-left">Add Education</h4>
                                <button type="button" class="btn btn-warning pull-right add_college" data-toggle="modal" data-target="#addCollege">ADD COLLEGE</h5></a>
                                <button type="button" class="btn btn-danger pull-right add_school" style="margin-right: 10px;" data-toggle="modal" data-target="#addSchool">ADD SCHOOL</h5></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="education-block">
                            <div class="row"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dob">Date of Birth <span class="mandatory">*</span></label>
                            <input type="date" id="dob" name="dob" class="form-control">
                            <span class="error-message dob-error"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pin">Location PIN Code <span class="mandatory">*</span></label>
                            <input type="text" id="pin" name="pin" class="form-control" maxlength="6">
                            <span class="error-message pin-error"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="about_me">About Me</label>
                            <textarea name="about_me" id="about_me" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary candidate-details-submit">Submit</button>
                <span class="error-message submit-error"></span>
            </form>

            <!-- Add School Modal -->
            <div class="modal fade" id="addSchool" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="#" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Add School</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Class <span class="mandatory">*</span></label>
                                        <select class="form-control school_class" name="school_class_id">
                                            <option value="">Select Class</option>
                                            <?php
                                                foreach ($school_class as $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message school-class-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>School Board <span class="mandatory">*</span></label>
                                        <select class="form-control school_board" name="school_board_id">
                                            <option value="">Select Board</option>
                                            <?php
                                                foreach ($school_board as $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message school-board-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>School Medium <span class="mandatory">*</span></label>
                                        <select class="form-control school_medium" name="school_medium_id">
                                            <option value="">Select Medium</option>
                                            <?php
                                                foreach ($school_medium as $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message school-medium-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>School Name</label>
                                        <input type="text" name="school_name" class="form-control school_name" placeholder="Enter School Name">
                                        <span class="error-message school-name-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Marks <span class="mandatory">*</span></label>
                                        <select class="form-control school_total_marks" name="total_marks_id">
                                            <option value="">Select Marks</option>
                                            <?php
                                                foreach ($total_marks as $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message school-total-marks-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Passed Out Year <span class="mandatory">*</span></label>
                                        <select class="form-control school_passed_out_year" name="passed_out_year">
                                            <option value="">Select Year</option>
                                            <?php
                                                foreach ($year as $value) {
                                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message school-year-error"></span>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="add-school-submit" class="btn btn-danger">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add College Modal -->
            <div class="modal fade" id="addCollege" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="#" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Add College</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Graduation <span class="mandatory">*</span></label>
                                        <select class="form-control graduation_type" name="graduation_type_id">
                                            <option value="">Select Graduation</option>
                                            <?php
                                                foreach ($type as $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message graduation-type-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Degree <span class="mandatory">*</span></label>
                                        <select class="form-control graduation_degree" name="graduation_degree_id">
                                            <option value="">Select Degree</option>
                                            <?php
                                                foreach ($degree as $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message graduation-degree-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Course <span class="mandatory">*</span></label>
                                        <select class="form-control graduation_major"  name="graduation_major_id">
                                            <option value="">Select Course</option>
                                            <?php
                                                foreach ($major as $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message graduation-major-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>College Name</label>
                                        <input type="text" placeholder="Enter College Name" class="form-control college_name" name="college_name">
                                        <span class="error-message college-name-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Marks <span class="mandatory">*</span></label>
                                        <select class="form-control college_total_marks"  name="total_marks_id">
                                            <option value="">Select Marks</option>
                                            <?php
                                                foreach ($total_marks as $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message college-total-marks-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Passed Out Year <span class="mandatory">*</span></label>
                                        <select class="form-control college_passed_out_year" name="passed_out_year">
                                            <option value="">Select Year</option>
                                            <?php
                                                foreach ($year as $value) {
                                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="error-message college-year-error"></span>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning" id="add-college-submit">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
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
    <script src="{{url('js/select2.min.js')}}"></script>
    <script src="{{url('js/functions.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const base_url = "{{ url('/') }}";

        $('#desired_state').change(function() {
            var state = $(this).val();
            $.ajax({
                url: base_url+"/show-cities/"+state,
                method: 'post',
                success: function(data) {
                    $('#desired_city').html(data);
                }
            });
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
        /***********EDUCATION SUBMIT***********/
        /**************************************/

        // Add School Form
        $("#add-school-submit").click(function(e) {
            e.preventDefault();
            $("#add-school-submit").text("Please wait");

            $.ajax({
                url: base_url+"/add-school",
                method: 'post',
                datatype: "json",
                data: $("#addSchool form").serialize(),
                success: function(data) {
                    if(data.status == 'success') {
                        $("#addSchool").modal('hide');

                        classes = $(".school_class option:selected").text();
                        board = $(".school_board option:selected").text();
                        medium = $(".school_medium option:selected").text();
                        name = $(".school_name").val();
                        total_marks = $(".school_total_marks option:selected").text();
                        passed_out_year = $(".school_passed_out_year option:selected").text();

                        $(".education-block .row").append('<div class="col-md-3"><div class="card-block well"><button type="button" class="btn" onclick="deleteSchool(this, '+data.message.id+')"><span class="close">X</span></button><h5>'+classes+'</h5><span>'+name+'</span><span>'+medium+'</span><span>'+board+'</span><span>'+total_marks+'</span><span>'+passed_out_year+'</span></div></div>');
                    }
                },
                complete: function(data) {
                    // console.log(data.status);
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);

                        $.each(message, function(key, value) {
                            classes = value.school_class_id ?? '';
                            board = value.school_board_id ?? '';
                            medium = value.school_medium_id ?? '';
                            names = value.school_name ?? '';
                            total_marks = value.total_marks_id ?? '';
                            passed_out_year = value.passed_out_year ?? '';
                        });
                    } else {
                        classes = '';
                        board = '';
                        medium = '';
                        names = '';
                        total_marks = '';
                        passed_out_year = '';
                    }

                    $(".school-class-error").text(classes);
                    $(".school-board-error").text(board);
                    $(".school-medium-error").text(medium);
                    $(".school-name-error").text(names);
                    $(".school-total-marks-error").text(total_marks);
                    $(".school-year-error").text(passed_out_year);

                    $("#add-school-submit").text("Save");
                }
            });
        });

        // Add College Form
        $("#add-college-submit").click(function(e) {
            e.preventDefault();
            $("#add-college-submit").text("Please wait");

            $.ajax({
                url: base_url+"/add-college",
                method: 'post',
                datatype: "json",
                data: $("#addCollege form").serialize(),
                success: function(data) {
                    if(data.status == 'success') {
                        $("#addCollege").modal('hide');

                        type = $(".graduation_type option:selected").text();
                        degree = $(".graduation_degree option:selected").text();
                        major = $(".graduation_major option:selected").text();
                        name = $(".college_name").val();
                        total_marks = $(".college_total_marks option:selected").text();
                        passed_out_year = $(".college_passed_out_year option:selected").text();

                        $(".education-block .row").append('<div class="col-md-3"><div class="card-block well"><button type="button" class="btn" onclick="deleteCollege(this, '+data.message.id+')"><span class="close">X</span></button><h5>'+type+'</h5><span>'+degree+'</span><span>'+major+'</span><span>'+name+'</span><span>'+total_marks+'</span><span>'+passed_out_year+'</span></div></div>');
                    }
                },
                complete: function(data) {
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);

                        $.each(message, function(key, value) {
                            type = value.graduation_type_id ?? '';
                            degree = value.graduation_degree_id ?? '';
                            major = value.graduation_major_id ?? '';
                            names = value.college_name ?? '';
                            total_marks = value.total_marks_id ?? '';
                            passed_out_year = value.passed_out_year ?? '';
                        });
                    } else {
                        type = '';
                        degree = '';
                        major = '';
                        names = '';
                        total_marks = '';
                        passed_out_year = '';
                    }

                    $(".graduation-type-error").text(type);
                    $(".graduation-degree-error").text(degree);
                    $(".graduation-major-error").text(major);
                    $(".college-name-error").text(names);
                    $(".college-total-marks-error").text(total_marks);
                    $(".college-year-error").text(passed_out_year);

                    $("#add-college-submit").text("Save");
                }
            });
        });

        function deleteSchool(e, id) {
             $.ajax({
                url: base_url+"/unset-school/"+id,
                success: function(data) {
                    $(e).closest(".col-md-3").remove();
                }
            });
        }

        function deleteCollege(e, id) {
             $.ajax({
                url: base_url+"/unset-college/"+id,
                success: function(data) {
                    $(e).closest(".col-md-3").remove();
                }
            });
        }

        function unsetEducation() {
            $.ajax({
                url: base_url+"/unset-education",
                method: 'get',
            });
        }

        // Delete Education session if page refreshed
        function checkFirstVisit() {
            if(document.cookie.indexOf('education')==-1) {
                document.cookie = 'education=1';
            } else {
                unsetEducation();
            }
        }

        // Delete Education session if browser tab closed
        $(window).on("beforeunload", function() { 
            unsetEducation();
        });
       
        /**************************************/
        /*******CANDIDATE DETAILS SUBMIT*******/
        /**************************************/
        $(".candidate-details-submit").click(function(e) {
            e.preventDefault();
            $(".candidate-details-submit").text("Please wait");
            $.ajax({
                url: base_url+"/create-candidate",
                method: 'post',
                datatype: "json",
                data: $("#add_candidate").serialize(),
                error: function(data) {
                    if(data.status === 422) {
                        $(".submit-error").text('Fill all the fields and submit');
                        var message = JSON.parse(data.responseText);

                        $.each(message, function(key, value) {
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
                success: function(data) {
                    $(".error-message").hide();
                    if(data.status == 'success') {
                        $(".modal").modal('hide');
                        alert(data.message);
                        window.location.reload();
                    }
                },
                complete: function() {
                    $(".candidate-details-submit").text("Submit");
                }
            });
        });
    </script>
@endsection