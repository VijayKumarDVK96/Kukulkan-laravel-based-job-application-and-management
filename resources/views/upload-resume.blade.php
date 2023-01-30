<!DOCTYPE html>
<html lang="en">

<head>
  <title>Upload Resume</title>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link rel="shortcut icon" type="image/png" href="{{url('img/favicon.ico')}}">
  <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('css/jobs.css')}}">
</head>

<body>
  <section class="resume-block apply-block">
    <div class="container">
      <div class="row">
        <div class="col-md-4 login-sec apply-sec resume-sec">
          <h2 class="text-center">UPLOAD RESUME</h2>
          <form class="resume-form" method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label class="text-uppercase">Upload Resume<br>(.pdf, .doc, .docx formats)</label>
              <input type="file" class="form-control resume" name="resume">
              <span class="error-message name-error"></span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-login btn-apply resume-submit" name="resume-submit">Upload</button>
              <a href="{{url('/')}}"><button type="button" class="btn btn-login btn-apply">Skip</button></a>
            </div>
            <span class="error-message resume-error"></span>
          </form>

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

    $(".resume-submit").click(function(e) {
      e.preventDefault();
      $(".resume-submit").text("Please wait");
      var formData = new FormData($('.resume-form')[0]);
      $.ajax({
        url: base_url+'/upload',
        data: formData,
        async: false,
        contentType: false,
        processData: false,
        cache: false,
        type: 'POST',
        dataType: "json",
        error: function(data) {
            if(data.status === 422) {
                var message = JSON.parse(data.responseText);

                $.each(message, function(key, value) {
                    resume = value.resume ?? '';
                });

                $(".resume-error").html(resume);
            }
        },
        success: function(data) {
          if (data.status == 'success') {
            $(".error-message").hide();
            alert(data.message);
            window.location.replace("{{url('/')}}");
          // } else if (data.status == 'error') {
            // $(".error-message").show();
            // $(".resume-error").html(data.message.resume);
          }
        },
        complete: function() {
            $(".resume-submit").text("Upload");
        }
      });
    });
  </script>
</body>

</html>