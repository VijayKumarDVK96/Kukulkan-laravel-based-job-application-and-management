@extends('includes.layout')

@section('content')

    <!-- question-area-start -->
    <div class="row">
        <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
            <div class="section-title">
                <h2>Contact US</h2>
            </div>
        </div>
    </div>
    <div class="question-area">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="question-form-area">
                        <div class="cf-msg"></div>
                        <form action="#" method="post" id="contact_form">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="cf-box">
                                        <input type="text" placeholder="Name" id="name" name="name">
                                        <span class="error-message name-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="cf-box">
                                        <input type="text" placeholder="Mobile Number" id="mobile" name="mobile">
                                        <span class="error-message mobile-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="cf-box">
                                        <input type="text" placeholder="Email" id="email" name="email">
                                        <span class="error-message email-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="cf-box">
                                        <textarea class="contact-textarea" placeholder="Message" id="message"
                                            name="message"></textarea>
                                        <span class="error-message message-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="cf-box">
                                        <button id="submit" class="cont-submit btn-contact" name="submit">SEND MESSAGE</button>
                                    </div>
                                    <div class="text-success font-weight-bold"></div>
                                    <div class="error-message mail-error"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="question-form-img">
                        <img src="{{url('img/contact.png')}}" alt="contact">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- question-area-end -->

    <!-- contact-details-area-start -->
    <div class="contact-details-area">
        <div class="container" style="max-width: 100%">
            <div class="row">
                <div class="col-12">
                    <div class="all-contact-details">
                        <div class="row">
                            <div class="col-lg-1">
                            </div>
                            <?php
                                foreach($contact_details as $contact) {
                                    if($contact->type == 'Contact Details') {
                                    switch($contact->shortcode) {
                                        case 'our-address':
                                            $icons = 'bg-location';
                                            break;
                                        case 'email-address':
                                            $icons = 'bg-mail';
                                            break;
                                        case 'contact':
                                            $icons = 'bg-contact';
                                            break;
                                        case 'call-and-whatsapp':
                                            $icons = 'bg-call-and-whatsapp';
                                            break;
                                        case 'office-hours':
                                            $icons = 'bg-office-hours';
                                            break;
                                        default:
                                            $icons = '';
                                    }
                            ?>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="single-contact-details">
                                    <div class="icon">
                                        <span class="{{$icons}}"></span>
                                    </div>
                                    <h4 class="title">{{$contact->name}}</h4>
                                    <?php echo $contact->value; ?>
                                </div>
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-details-area-end -->
    
    <!-- map-start -->
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.9700707950424!2d78.13295281479368!3d9.936448192894781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b00c5c06c7e56fb%3A0x5b1bcf734d7ede83!2s17%2C%208%2C%20Gokhale%20Rd%2C%20Chinna%20Chokkikulam%2C%20Chockikulam%2C%20Madurai%2C%20Tamil%20Nadu%20625002!5e0!3m2!1sen!2sin!4v1574400474433!5m2!1sen!2sin"
        height="600" style="border:0;" allowfullscreen=""></iframe>
    <!-- map-end -->
@endsection

@section('scripts')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const base_url = "{{ url('/') }}";

        $(".cont-submit").click(function(e) {
            e.preventDefault();
            $(".cont-submit").text("Please wait");
            
            $.ajax({
                url: base_url+"/submit-enquiry",
                method: 'post',
                dataType: 'json',
                data: $("#contact_form").serialize(),
                error: function(data) {
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);
                        $(".error-message").show();

                        $.each(message, function(key, value) {
                            name = value.name ?? '';
                            mobile = value.mobile ?? '';
                            email = value.email ?? '';
                            message = value.message ?? '';
                        });

                        $(".name-error").text(name);
                        $(".mobile-error").text(mobile);
                        $(".email-error").text(email);
                        $(".message-error").text(message);
                    } else if(data.status === 500) {
                        $(".mail-error").text("Submitting Enquiry Failed, Please call us if need to communicate");
                    }
                },
                success: function(data) {
                    $(".error-message").hide();
                    if (data.status == "success") {
                        $("#contact_form").trigger("reset");
                        $(".text-success").text(data.message);
                    }
                },
                complete: function() {
                    $(".cont-submit").text("SEND MESSAGE");
                    setTimeout(function () {
                        $(".text-success").text("");
                    }, 5000);
                }
            });
        });
    </script>
@endsection