<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$seo->title}}</title>
  <meta name="description" content="{{$seo->description}}">
  <meta name="keywords" content="{{$seo->keywords}}">
  <link rel="shortcut icon" type="image/png" href="{{url('img/favicon.ico')}}">
  <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('css/jobs.css')}}">
</head>

<body>
  <section class="login-block">
    <div class="container">
      <div class="row">
        <div class="col-md-4 login-sec">
          <h2 class="text-center">POST JOB</h2>
          <form class="login-form" method="post" id="post_job" action="{{url('post-job-details')}}">
            @csrf
            <div class="form-group">
              <label class="text-uppercase">Your Name <span class="mandatory">*</span></label>
              <input type="text" class="form-control name" name="name">
              <span class="error-message name-error"></span>
            </div>
            <div class="form-group">
              <label class="text-uppercase">Mobile No. <span class="mandatory">*</span></label>
              <input type="text" class="form-control mobile" name="mobile" maxlength="10">
              <span class="error-message mobile-error"></span>
            </div>
            <div class="form-group">
              <label class="text-uppercase">Email <span class="mandatory">*</span></label>
              <input type="email" class="form-control email" name="email">
              <span class="error-message email-error"></span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-login employer-submit" name="employer-submit">Submit</button>
              <a href="{{url('/')}}" class="btn btn-login">Go Back</a>
            </div>
          </form>
        </div>
        <div class="col-md-8 post-job banner-sec">
        </div>
      </div>
    </div>
  </section>

<script src="{{url('js/jquery-3.2.0.min.js')}}"></script>
<script src="{{url('js/popper.min.js')}}"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/functions.js')}}"></script>

<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
  });

  const base_url = "{{ url('/') }}";

  $(".employer-submit").click(function(e) {
    e.preventDefault();
    $(".employer-submit").text("Please wait");
    
    $.ajax({
      url: base_url+"/set-employer",
      method: 'post',
      dataType: 'json',
      data: $("#post_job").serialize(),
      error: function(data) {
          if(data.status === 422) {
              var message = JSON.parse(data.responseText);

              $.each(message, function(key, value) {
                  name = value.name ?? '';
                  mobile = value.mobile ?? '';
                  email = value.email ?? '';
              });

              $(".name-error").text(name);
              $(".mobile-error").text(mobile);
              $(".email-error").text(email);
          }
      },
      success: function(data) {
        if (data.status == "success") {
          $(".error-message").hide();
          $("#post_job").submit();
        }
      },
      complete: function() {
          $(".employer-submit").text("Submit");
      }
    });
  });
  </script>
</body>

</html>