@extends('includes.admin-layout')

@section('title', 'Edit Employer')

@section('styles')
    <link rel="stylesheet" href="{{url('css/select2.min.css')}}">
@endsection

@section('content')
   <div class="content-wrapper">
            <div class="container-fluid">
                <h3>Edit Employer</h3>
                <!-- Recent Orders -->
                <form action="" method="post" id="edit_employer">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="text-uppercase">Your Name <span class="mandatory">*</span></label>
                                    <input type="text" class="form-control name" name="full_name" value="{{$employer->full_name}}">
                                    <span class="error-message name-error"></span>
                                    <input type="hidden" name="id" class="id" value="{{$id}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Mobile No. <span class="mandatory">*</span></label>
                                <input type="text" class="form-control mobile" name="mobile" value="{{$employer->mobile}}">
                                <span class="error-message mobile-error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Email <span class="mandatory">*</span></label>
                                <input type="email" class="form-control email" name="email" value="{{$employer->email}}">
                                <span class="error-message email-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_name">Company Name <span class="mandatory">*</span></label>
                                <input type="text" id="company_name" name="company_name" class="form-control" value="{{$employer->company_name}}">
                                <span class="error-message company-error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_address">Company Address <span class="mandatory">*</span></label>
                                <input type="text" id="company_address" name="company_address" class="form-control" value="{{$employer->company_address}}">
                                <span class="error-message company-address-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="company_website">Company Website</label>
                                <input type="text" id="company_website" class="form-control" value="{{$employer->company_website}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="desired_department">Your Job Sector <span class="mandatory">*</span></label>
                                <select id="desired_department" name="job_department" class="autocomplete-select" style='width: 300px;'>
                                    <?php
                                        foreach ($department as $value) {
                                            if($employer->job_department == $value->id)
                                            echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                                            else
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
                                    <?php
                                        foreach ($position as $value) {
                                            if($employer->job_position == $value->id)
                                            echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                                            else
                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                        }
                                    ?>
                                </select>
                                <span class="error-message job-position-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <button type="submit" class="btn btn-primary" id="employer-submit">Submit</button>
                    </div>
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

        var id = $(".id").val();

        /**************************************/
        /*******EMPLOYERS DETAILS SUBMIT*******/
        /**************************************/

        $("#employer-submit").click(function (e) {
            e.preventDefault();
            $("#employer-submit").text("Please wait");

            $.ajax({
                url: base_url + "/admin/update-employer",
                method: "post",
                data: $("#edit_employer").serialize(),
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