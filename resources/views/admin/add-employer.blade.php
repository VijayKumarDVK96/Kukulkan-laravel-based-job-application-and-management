@extends('includes.admin-layout')

@section('title', 'Add Employer')

@section('styles')
    <link rel="stylesheet" href="{{url('css/select2.min.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <h3>Add Employer</h3>
            <form action="" method="post" id="add_employer">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="text-uppercase">Your Name <span class="mandatory">*</span></label>
                                <input type="text" class="form-control name" name="full_name">
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
                        <div class="form-group">
                            <label for="company_name">Company Name <span class="mandatory">*</span></label>
                            <input type="text" id="company_name" name="company_name" class="form-control">
                            <span class="error-message company-error"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_address">Company Address <span class="mandatory">*</span></label>
                            <input type="text" id="company_address" name="company_address" class="form-control">
                            <span class="error-message company-address-error"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="company_website">Company Website</label>
                            <input type="text" id="company_website" name="company_website" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="desired_department">Your Job Sector <span class="mandatory">*</span></label>
                            <select id="desired_department" name="job_department" class="autocomplete-select" style='width: 300px;'>
                                <option value="">Select Job Sector</option>
                                <?php
                                foreach ($department as $value) {
                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                }
                                ?>
                            </select>
                            <span class="error-message job-department-error"></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="desired_position">Your Job Title <span class="mandatory">*</span></label>
                            <select id="desired_position" name="job_position" class="autocomplete-select" style='width: 300px;'>
                                <option value="">Select Job Title</option>
                                <?php
                                foreach ($position as $value) {
                                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                }
                                ?>
                            </select>
                            <span class="error-message job-position-error"></span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-bold pull-left">Add Requirement</h4>
                                <a href="" data-toggle="modal" data-target="#addJob">
                                    <h5 class="text-bold pull-right">ADD JOB</h5>
                                </a>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="row requirement-block">
                        </div>
                    </div>
                </div>

                <div class="form-check">
                    <button type="submit" class="btn btn-primary" id="employer-submit">Submit</button>
                    <span class="error-message submit-error"></span>
                </div>
            </form>
            <!--End Row-->
        </div>
        <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->

    <!-- Add Job Modal -->
    <div class="modal fade" id="addJob" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="#" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Job</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Company Name <span class="mandatory">*</span></label>
                                    <input type="text" id="job_company_name" class="form-control" name="company_name">
                                    <span class="error-message job-company-error"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Company Address <span class="mandatory">*</span></label>
                                    <input type="text" id="job_company_address" class="form-control" name="company_address">
                                    <span class="error-message job-company-address-error"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Company Website</label>
                                    <input type="text" id="job_company_website" class="form-control" name="company_website">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="job_desired_department">Job Vacant Sector <span class="mandatory">*</span></label>
                                    <select id="job_desired_department" name="desired_department_id"  class="autocomplete-select" style='width: 200px;'>
                                        <option value="">Select Job Sector</option>
                                        <?php
                                        foreach ($department as $value) {
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
                                    <select id="job_desired_position" name="desired_position_id"  class="autocomplete-select" style='width: 200px;'>
                                        <option value="">Select Job Title</option>
                                        <?php
                                        foreach ($position as $value) {
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
                                        <option value="">Select State</option>
                                        <?php
                                            foreach ($states as $value) {
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
                                    <select id="job_city" name="desired_city_id"  class="autocomplete-select" style='width: 200px;'>
                                        <option value="">Select State First</option>
                                    </select>
                                    <span class="error-message job-vacant-city-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fromRange">Required Age From</label>
                                    <input type="range" min="1" max="100" value="25" name="desired_age_from" class="slider" id="fromRange">
                                    <p class="slider_display">Age: <span id="age_from"></span></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="toRange">Required Age To</label>
                                    <input type="range" min="1" max="100" value="50" name="desired_age_to" class="slider" id="toRange">
                                    <p class="slider_display">Age: <span id="age_to"></span></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="job_gender">Required Gender</label>
                                    <select id="job_gender" name="desired_gender" class="autocomplete-select" style='width: 200px;'>
                                        <option value="any">Any</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <span class="error-message job-required-gender-error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="job_city">Total Candidates Needed</label>
                                    <input type="number" class="form-control" id="total_candidates" name="total_candidates">
                                    <span class="error-message job-total-candidates-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="job_title">Job Title</label>
                                            <input type="text" id="job_title" name="job_title" class="form-control" placeholder="eg: Python Developers needed">
                                            <span class="error-message job-title-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="job_experience">Job Experience</label>
                                            <select id="job_experience" class="autocomplete-select" style="width: 200px;" name="job_experience">
                                                <option value="">Select Experience</option>
                                                <option value="fresher">Fresher</option>
                                                <option value="experienced">Experienced</option>
                                            </select>
                                            <span class="error-message job-experience-error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="job_salary_range">Job Salary <span class="mandatory">*</span></label>
                                            <select id="job_salary_range" class="autocomplete-select" style="width: 200px;" name="job_salary_range_id">
                                            <option value="">Select Salary Range</option>
                                            <?php
                                                foreach ($salary_range as $value) {
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
                                            <select id="job_type" name="job_work_type_id"  class="autocomplete-select" style='width: 200px;'>
                                                <option value="">Select Job Type</option>
                                                <?php
                                                foreach ($job_type as $value) {
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
                                <textarea id="job_description" name="job_description" class="form-control" rows="4"></textarea>
                                <span class="error-message job-description-error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact_person_name">Contact Person Name <span class="mandatory">*</span></label>
                                    <input type="text" id="contact_person_name" name="contact_person_name" class="form-control">
                                    <span class="error-message contact-name-error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact_person_mobile">Contact Person Mobile <span class="mandatory">*</span></label>
                                    <input type="text" id="contact_person_mobile" name="contact_person_mobile" class="form-control" maxlength="10">
                                    <span class="error-message contact-mobile-error"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact_person_position_id">Contact Person Job Title <span class="mandatory">*</span></label>
                                    <select id="contact_person_position_id" name="contact_person_position_id" class="autocomplete-select" style='width: 300px;'>
                                        <option value="">Select Job Title</option>
                                        <?php
                                        foreach ($position as $value) {
                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="error-message contact-position-error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="add-requirement" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

        $(".autocomplete-select").select2();

        const base_url = "{{ url('/') }}";

        $('#job_state').change(function() {
            var state = $(this).val();
            $.ajax({
                url: base_url+"/show-cities/"+state,
                method: 'post',
                success: function(data) {
                    $('#job_city').html(data);
                }
            });
        });

        function unsetRequirement() {
            $.ajax({
                url: base_url+"/unset-requirement",
                method: 'get',
            });
        }

        // Delete Education session if page refreshed
        function checkFirstVisit() {
            if(document.cookie.indexOf('requirement')==-1) {
                document.cookie = 'requirement=1';
            } else {
                unsetRequirement();
            }
        }

        // Delete Education session if browser tab closed
        $(window).on("beforeunload", function() { 
            unsetRequirement();
        });

        /**************************************/
        /******SELECT DROPDOWN DATA FETCH******/
        /**************************************/
        range_slider("#fromRange", "#age_from");
        range_slider("#toRange", "#age_to");
        $("#fromRange, #toRange").on("input", function() {
            range_slider("#fromRange", "#age_from");
            range_slider("#toRange", "#age_to");
        });

        /**************************************/
        /***********ADD REQUIREMENTS***********/
        /**************************************/

        $("#add-requirement").click(function(e) {
            e.preventDefault();
            $("#add-requirement").text("Please wait");

            $.ajax({
                url: base_url+"/add-requirement",
                method: 'post',
                datatype: "json",
                data: $("#addJob form").serialize(),
                success: function(data) {
                    if(data.status == 'success') {
                        $("#addJob").modal('hide');
                        $(".error-message").hide();

                        job_company_name = $("#job_company_name").val();
                        job_company_address = $("#job_company_address").val();
                        job_company_website = $("#job_company_website").val() || '-';
                        job_desired_department = $("#job_desired_department option:selected").text();
                        job_desired_position = $("#job_desired_position option:selected").text();
                        job_desired_state = $("#job_state option:selected").text();
                        job_desired_city = $("#job_city option:selected").text();
                        job_desired_city = $("#job_city option:selected").text();
                        age_from = $("#age_from").text();
                        age_to = $("#age_to").text();
                        job_gender = $("#job_gender option:selected").text();
                        total_candidates = $("#total_candidates").val() || '-';
                        job_title = $("#job_title").val() || '-';
                        job_experience = $("#job_experience option:selected").text();
                        job_salary_range = $("#job_salary_range option:selected").text();
                        job_type = $("#job_type option:selected").text();
                        job_description = $("#job_description").val() || '-';
                        contact_person_name = $("#contact_person_name").val();
                        contact_person_mobile = $("#contact_person_mobile").val();
                        contact_person_position_id = $("#contact_person_position_id").val();

                        $(".requirement-block").append('<div class="col-md-6"><div class="card-block well"><button type="button" class="btn delete-btn" onclick="deleteRequirement(this, '+data.message.id+')">X</button><table class="table table-bordered table-responsive"><tbody><tr><th>Company Name</th><td>'+job_company_name+'</td></tr><tr></tr><tr><th>Company Address</th><td>'+job_company_address+'</td></tr><tr></tr><tr><th>Company Website</th><td>'+job_company_website+'</td></tr><tr></tr><tr><th>Vacant Department</th><td>'+job_desired_department+'</td></tr><tr></tr><tr><th>Vacant Position</th><td>'+job_desired_position+'</td></tr><tr></tr><tr><th>Vacant State</th><td>'+job_desired_state+'</td></tr><tr></tr><tr><th>Vacant City</th><td>'+job_desired_city+'</td></tr><tr></tr><tr><th>Age From</th><td>'+age_from+'</td></tr><tr></tr><tr><th>Age To</th><td>'+age_to+'</td></tr><tr></tr><tr><th>Only for gender</th><td>'+job_gender+'</td></tr><tr></tr><tr><th>Total Candidates Needed</th><td>'+total_candidates+'</td></tr><tr></tr><tr><th>Job Title</th><td>'+job_title+'</td></tr><tr></tr><tr><th>Job Experience</th><td>'+job_experience+'</td></tr><tr></tr><tr><th>Salary Range</th><td>'+job_salary_range+'</td></tr><tr></tr><tr><th>Job Work Type</th><td>'+job_type+'</td></tr><tr></tr><tr><th>Job Description</th><td>'+job_description+'</td></tr><tr></tr><tr><th>Contact Person Name</th><td>'+contact_person_name+'</td></tr><tr></tr><tr><th>Contact Person Mobile</th><td>'+contact_person_mobile+'</td></tr><tr></tr><tr><th>Contact Person Position</th><td>'+contact_person_position_id+'</td></tr><tr></tr></tbody></table></div></div>');
                    }
                },
                complete: function(data) {
                    // console.log(data.status);
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);

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

                    $("#add-requirement").text("Save");
                }
            });
        });

        function deleteRequirement(e, id) {
             $.ajax({
                url: base_url+"/unset-job/"+id,
                success: function(data) {
                    $(e).closest(".col-md-6").remove();
                }
            });
        }

        /**************************************/
        /*******EMPLOYERS DETAILS SUBMIT*******/
        /**************************************/
        $("#employer-submit").click(function (e) {
            e.preventDefault();
            $("#employer-submit").text("Please wait");

            $.ajax({
                url: base_url + "/create-employer",
                method: "post",
                data: $("#add_employer").serialize(),
                datatype: "json",
                success: function (data) {
                    $(".error-message").hide();
                    if(data.status == 'success') {
                        $(".modal").modal('hide');
                        alert(data.message);
                        window.location.replace(base_url+'admin/employers');
                    }
                },
                complete: function (data) {
                    if (data.status === 422) {
                        $(".submit-error").text('Fill all the fields and submit');
                        var message = JSON.parse(data.responseText);
                        $(".error-message").show();

                        $.each(message, function (key, value) {
                            name = value.full_name ?? '';
                            mobile = value.mobile ?? '';
                            email = value.email ?? '';
                            company_name = value.company_name ?? '';
                            company_address = value.company_address ?? '';
                            job_department = value.job_department ?? '';
                            job_position = value.job_position ?? '';
                        });
                    } else {
                        name = '';
                        mobile = '';
                        email = '';
                        company_name = '';
                        company_address = '';
                        job_department = '';
                        job_position = '';
                    }

                    $(".name-error").text(name);
                    $(".mobile-error").text(mobile);
                    $(".email-error").text(email);
                    $(".company-error").text(company_name);
                    $(".company-address-error").text(company_address);
                    $(".job-department-error").text(job_department);
                    $(".job-position-error").text(job_position);

                    $("#employer-submit").text("Submit");
                }
            });
        });
    </script>
@endsection