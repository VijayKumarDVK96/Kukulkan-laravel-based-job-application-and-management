// $(".autocomplete-select").select2();

function check_required(attribute, error, message) {
    var check = $(attribute).val();
    if (check.length == 0) {
        $(error).html(message);
        $(attribute).addClass('border-error');
        $(error).show();
    } else {
        $(attribute).removeClass('border-error');
        $(error).hide();
        return check;
    }
}

function check_email(attribute, error) {
    var email = $(attribute).val();
    var email_pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

    if(email.length > 0) {
        if (email_pattern.test(email)) {
            $(error).hide();
            $(attribute).removeClass('border-error');
            return email;
        } 
        else {
            $(error).html("Invalid email address");
            $(error).show();
            $(attribute).addClass('border-error');
        }
    } else {
        $(error).html("Email is required");
        $(error).show();
        $(attribute).addClass('border-error');
    }
}

function check_radio(attribute, error) {
    var check = $(attribute + ":checked").val();
    if (check) {
        $(error).hide();
        return check;
    } else {
        $(error).html("Required");
        $(error).show();
    }
}

function check_selectbox(attribute, error) {
    var check = $(attribute).val();
    if (check) {
        $(error).hide();
        return check;
    } else {
        $(error).html("Required");
        $(error).show();
    }
}

function check_password() {
    var password = $(".password").val();
    var cpassword = $(".cpassword").val();

    if (password.length < 5) {
        $(".password-error").html("At least 5 characters");
        $(".password-error").show();
    } else if (cpassword.length < 5) {
        $(".cpassword-error").html("At least 5 characters");
        $(".cpassword-error").show();
    } else if (password != cpassword) {
        $(".cpassword-error").html("Passwords Doesn't Match");
        $(".cpassword-error").show();
    } else {
        $(".cpassword-error").hide();
        return password;
    }
}

function check_mobile(mobile, error) {
    var mobileno = $(mobile).val();
    var pattern = new RegExp(/[^0-9\.]/g);

    if(mobileno.length < 10) {
        $(error).html("Enter 10 numbers");
        $(error).show();
    } else if (mobileno.length > 10) {
        $(error).html("Enter only 10 numbers");
        $(error).show();
    }
    else if (mobileno.length == 10) {
        if (pattern.test(mobileno)) {
            $(error).html("Enter only numbers");
            $(error).show();
        } else {
            $(error).hide();
            return mobileno;
        }
    }
}

function check_pincode(pincode, error) {
    var pin = $(pincode).val();
    var pattern = new RegExp(/[^0-9\.]/g);
    if (pin.length < 6) {
        $(error).html("Enter 6 numbers");
        $(error).show();
    } else if (pin.length > 6) {
        $(error).html("Enter only 6 numbers");
        $(error).show();
    } else if (pin.length == 6) {
        if (pattern.test(pin)) {
            $(error).html("Enter only numbers");
            $(error).show();
        } else {
            $(error).hide();
            return pin;
        }
    }
}


function range_slider(slide, show) {
    var slider = $(slide).val();
    $(show).html(slider);
}