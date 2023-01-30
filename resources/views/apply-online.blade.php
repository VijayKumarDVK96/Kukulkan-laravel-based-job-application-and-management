<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Female Coding Tutor</title>
    <link rel="shortcut icon" type="image/png" href="{{url('img/favicon.ico')}}">
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
</head>
<body>

    <div class="container align-center">
        <div class="col-md-6">
            <div class="apply-job-logo">
                <a href="{{url('/')}}">
                    <img src="{{url('img/logo.png')}}" alt="">
                </a>
            </div>
            
            <div class="card">
                <div class="card-header text-center">
                    <h2>Female Coding Tutor - Apply Online</h2>
                </div>
                <div class="card-body">
                    <form action="#" method="post" class="apply_online">
                        @csrf
                        <div class="form-group">
                            <label for="">Full Name</label>
                            <input type="text" class="form-control" name="name">
                            <span class="name-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="Male" checked>Male
                                </label>
                            </div>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="Female">Female
                                </label>
                            </div>
                            <span class="gender-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email">
                            <span class="email-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input type="text" class="form-control" name="mobile">
                            <span class="mobile-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Highest Education Qualification</label>
                            <select name="qualification" class="form-control">
                                <option value="" hidden="">Select Qualification</option>
                                <option value="bca">BCA/MCA</option>
                                <option value="be">BE/ME</option>
                                <option value="btech">B.Tech/M.Tech</option>
                                <option value="bscit">BSc IT/Tech Diploma</option>
                                <option>B.Tech/BE + MBA</option>
                                <option value="others">Others</option>
                            </select>
                            <span class="qualification-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" class="form-control"></textarea>
                            <span class="address-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <select id='state' name='state_id' class="autocomplete-select form-control">
                                <option value="">Select State</option>
                                <?php
                                    foreach ($states as $value) {
                                        if($value->id == 35)
                                        echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                                        else
                                        echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                    }
                                ?>
                            </select>
                            <span class="state-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <select id='city' name='city_id' class="autocomplete-select form-control">
                                <option value="">Select City</option>
                                <?php
                                    foreach ($cities as $value) {
                                        echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                    }
                                ?>
                            </select>
                            <span class="city-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Do you have any prior coding experience?</label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="experience" value="yes" checked>Yes
                                </label>
                            </div>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="experience" value="no">No
                                </label>
                            </div>
                            <span class="experience-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Do you have broadband connection in your home?</label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="broadband" value="yes" checked>Yes
                                </label>
                            </div>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="broadband" value="no">No
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Apply Now</button>
                            <div class="text-success font-weight-bold"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{url('js/jquery-3.2.0.min.js')}}"></script>

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

        $(".apply_online button").click(function(e) {
            e.preventDefault();
            $(".apply_online button").text("Please wait");
            
            $.ajax({
                url: base_url+"/apply-job-online",
                method: 'post',
                dataType: 'json',
                data: $(".apply_online").serialize(),
                error: function(data) {
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);
                        $(".error-message").show();

                        $.each(message, function(key, value) {
                            name = value.name ?? '';
                            gender = value.gender ?? '';
                            email = value.email ?? '';
                            mobile = value.mobile ?? '';
                            qualification = value.qualification ?? '';
                            address = value.address ?? '';
                            state = value.state_id ?? '';
                            city = value.city_id ?? '';
                            experience = value.experience ?? '';
                        });

                        $(".name-error").text(name);
                        $(".gender-error").text(gender);
                        $(".email-error").text(email);
                        $(".mobile-error").text(mobile);
                        $(".qualification-error").text(qualification);
                        $(".address-error").text(address);
                        $(".state-error").text(state);
                        $(".city-error").text(city);
                        $(".experience-error").text(experience);
                    }
                },
                success: function(data) {
                    if (data.status == "success") {
                        $(".error-message").hide();
                        $(".apply_online").trigger("reset");
                        $(".text-success").text(data.message);
                    }
                },
                complete: function() {
                    $(".apply_online button").text("Apply Now");
                    setTimeout(function () {
                        $(".text-success").text("");
                    }, 5000);
                }
            });
        });
	  </script>
    
</body>
</html>