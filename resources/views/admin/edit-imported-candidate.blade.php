@extends('includes.admin-layout')

@section('title', 'Edit Imported Candidate')

@section('styles')
    <link rel="stylesheet" href="{{url('css/select2.min.css')}}">
@endsection

@section('content')
   <div class="content-wrapper">
            <div class="container-fluid">
                <h3>Edit Candidate</h3>
                <!-- Recent Orders -->
                <form action="" method="post" id="edit_candidate">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="text-uppercase">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" value="{{$candidate->full_name}}">
                                    <span class="error-message name-error"></span>
                                    <input type="hidden" name="id" class="id" value="{{$candidate->id}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="text-uppercase">Designation</label>
                                    <input type="text" class="form-control" name="designation" value="{{$candidate->designation}}">
                                    <span class="error-message designation-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="text-uppercase">Last Company</label>
                                    <input type="text" class="form-control" name="last_company" value="{{$candidate->last_company}}">
                                    <span class="error-message last-company-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="text-uppercase">Education</label>
                                    <input type="text" class="form-control" name="education" value="{{$candidate->education}}">
                                    <span class="error-message education-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Mobile No.</label>
                                <input type="text" class="form-control" name="mobile" value="{{$candidate->mobile}}">
                                <span class="error-message mobile-error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$candidate->email}}">
                                <span class="error-message email-error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Experience</label>
                                <input type="text" class="form-control" name="experience" value="{{$candidate->experience}}">
                                <span class="error-message experience-error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Gender</label>
                                <input type="text" class="form-control" name="gender" value="{{$candidate->gender}}">
                                <span class="error-message gender-error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Age</label>
                                <input type="text" class="form-control" name="age" value="{{$candidate->age}}">
                                <span class="error-message age-error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Salary</label>
                                <input type="text" class="form-control" name="salary" value="{{$candidate->salary}}">
                                <span class="error-message salary-error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Source</label>
                                <input type="text" class="form-control" name="source" value="{{$candidate->source}}">
                                <span class="error-message source-error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-uppercase">Remarks</label>
                                <input type="text" class="form-control" name="remarks" value="{{$candidate->remarks}}">
                                <span class="error-message remarks-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <button type="submit" class="btn btn-primary" id="candidate-submit">Submit</button>
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
        /*******CANDIDATES DETAILS SUBMIT******/
        /**************************************/

        $("#candidate-submit").click(function (e) {
            e.preventDefault();
            $("#candidate-submit").text("Please wait");
            var id = $(".id").val();

            $.ajax({
                url: base_url + "/admin/update-imported-candidate/"+id,
                method: "post",
                data: $("#edit_candidate").serialize(),
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
                    }

                    $("#candidate-submit").text("Submit");
                }
            });
        });

        
    </script>
@endsection