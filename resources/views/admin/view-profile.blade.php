@extends('includes.admin-layout')

@section('title', 'View Profile')

@section('content')
  <div class="content-wrapper">
      <div class="container-fluid">
            <form id="edit-profile" action="" method="post">
              <div class="card-header">
                <h4 class="modal-title">Edit My Profile</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Full Name</label>
                      <input type="text" id="name" name="name" class="form-control" value="{{auth()->user()->name}}">
                      <span class="error-message name-error"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control" value="{{auth()->user()->email}}">
                      <span class="error-message email-error"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="text" name="mobile" class="form-control" maxlength="10" value="{{auth()->user()->mobile}}">
                      <span class="error-message mobile-error"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" name="address" class="form-control edit_address" value="{{auth()->user()->address}}">
                      <span class="error-message address-error"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary edit-user-submit"><i class="fa fa-check-square-o"></i> Update Profile</button>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#changePassword"><i class="fa fa-check-square-o"></i> Change Password</button>
                <a href="{{route('dashboard')}}"><button type="button" class="btn btn-secondary"><i class="fa fa-times"></i> Go Back</button></a>
                <span class="text-success font-weight-bold"></span>
              </div>
            </form>

            <div class="modal fade" id="changePassword">
              <div class="modal-dialog">
                <form action="" method="post">
                  <div class="modal-content border-dark">
                    <div class="modal-header bg-dark">
                      <h5 class="modal-title text-white">Change Password</h5>
                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Old Password</label>
                          <input type="password" name="password" class="form-control">
                          <span class="error-message password-error"></span>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">New Password</label>
                          <input type="password" name="new_password" class="form-control">
                          <span class="error-message npassword-error"></span>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Confirm New Password</label>
                          <input type="password" name="confirm_password" class="form-control">
                          <span class="error-message cpassword-error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-inverse-dark" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                      <button type="submit" class="btn btn-dark change-password"><i class="fa fa-check-square-o"></i> Change</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
      </div>
      <!-- End container-fluid-->
    </div>
  <!--End content-wrapper-->
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const base_url = "{{ url('/') }}";

        $(".edit-user-submit").click(function(e) {
            e.preventDefault();
            $(".edit-user-submit").text("Please wait");
            $(".text-success").text("");
            var id = '{{auth()->id()}}';

            $.ajax({
                url: base_url+"/admin/update-profile/"+id,
                method: 'post',
                data: $("#edit-profile").serialize(),
                error: function(data) {
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);
                        $(".error-message").show();

                        $.each(message, function(key, value) {
                            name = value.name ?? '';
                            email = value.email ?? '';
                            mobile = value.mobile ?? '';
                            password = value.password ?? '';
                            address = value.address ?? '';
                        });

                        $(".name-error").text(name);
                        $(".email-error").text(email);
                        $(".mobile-error").text(mobile);
                        $(".password-error").text(password);
                        $(".address-error").text(address);
                    }
                },
                success: function(data) {
                    $(".error-message").hide();
                    $(".text-success").text("Profile Details Updated");
                },
                complete: function() {
                    $(".edit-user-submit").text("Update Profile");
                    setTimeout(function () {
                        $(".text-success").text("");
                    }, 5000);
                }
            });
        });

        $(".change-password").click(function(e) {
            e.preventDefault();
            $(".change-password").text("Please wait");
            $(".text-success").text("");
            var id = '{{auth()->id()}}';

            $.ajax({
                url: base_url+"/admin/update-password",
                method: 'post',
                data: $("#changePassword form").serialize(),
                error: function(data) {
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);
                        $(".error-message").show();

                        $.each(message, function(key, value) {
                            password = value.password ?? '';
                            new_password = value.new_password ?? '';
                            confirm_password = value.confirm_password ?? '';
                        });

                        $(".password-error").text(password);
                        $(".npassword-error").text(new_password);
                        $(".cpassword-error").text(confirm_password);
                    }
                },
                success: function(data) {
                    $(".error-message").hide();
                    $("#changePassword").modal('hide');
                    $(".text-success").text("New Password Updated");
                    $("#changePassword form").trigger("reset");
                },
                complete: function() {
                    $(".change-password").text("Change");
                    setTimeout(function () {
                        $(".text-success").text("");
                    }, 5000);
                }
            });
        });
  </script>
@endsection