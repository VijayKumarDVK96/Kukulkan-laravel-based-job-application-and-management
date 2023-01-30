@extends('includes.admin-layout')

@section('title', 'Configuration')

@section('styles')
    <link href="{{url('admin-assets/plugins/summernote/dist/summernote-bs4.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="pull-left">Site Configuration</h4>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs-vertical tabs-vertical-primary">
                                        <ul class="nav nav-tabs flex-column top-icon">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab"
                                                    href="#tab-1"><span>Contact Details</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tab-2"><span>Contact
                                                        Popup</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tab-3"><span>Social
                                                        Links</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="tab-1" class="container tab-pane active">
                                            @foreach($config as $value)
                                                @if($value->type == 'Contact Popup')
                                                <div class="heading-block" style="margin-bottom: 30px">
                                                    <h5 style="float: left">{{$value->name}}</h5>
                                                    <button data-toggle="modal" data-target="#editConfig"
                                                    class="btn btn-primary pull-right"
                                                    onclick="editConfig('{{$value->shortcode}}')">EDIT</button>
                                                    <div class="clearfix"></div>
                                                    <?php echo $value->value ?>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div id="tab-2" class="container tab-pane">
                                            @foreach($config as $value)
                                                @if($value->type == 'Contact Details')
                                                <div class="heading-block" style="margin-bottom: 30px">
                                                    <h5 style="float: left">{{$value->name}}</h5>
                                                    <button data-toggle="modal" data-target="#editConfig"
                                                    class="btn btn-primary pull-right"
                                                    onclick="editConfig('{{$value->shortcode}}')">EDIT</button>
                                                    <div class="clearfix"></div>
                                                    <?php echo $value->value ?>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div id="tab-3" class="container tab-pane">
                                            @foreach($config as $value)
                                                @if($value->type == 'Social Links')
                                                <div class="heading-block" style="margin-bottom: 30px">
                                                    <h5 style="float: left">{{$value->name}}</h5>
                                                    <button data-toggle="modal" data-target="#editConfig"
                                                    class="btn btn-primary pull-right"
                                                    onclick="editConfig('{{$value->shortcode}}')">EDIT</button>
                                                    <div class="clearfix"></div>
                                                    <?php echo $value->value ?>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End Row-->
        </div>
        <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->

    <!-- Edit Configuration Modal -->
    <div class="modal fade" id="editConfig">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Configuration</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea id="config" name="value"></textarea>
                        <input type="hidden" id="shortcode" name="shortcode">
                        <span class="error-message config-error"></span>
                        <span class="error-message shortcode-error"></span>
                    </div>
                    <div class="modal-footer">
                        <span class="text-success font-weight-bold"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary" id="update-config"><i
                                class="fa fa-check-square-o"></i> Update Config</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{url('admin-assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const base_url = "{{ url('/') }}";

        $('#config').summernote({
            height: 200,
            tabsize: 2
        });

        function editConfig(shortcode) {
            $.ajax({
                url: base_url + "/admin/edit-config/" + shortcode,
                method: 'get',
                dataType: 'json',
                success: function (data) {
                    $("#editConfig .modal-title").text(data.name);
                    $("#editConfig #shortcode").val(data.shortcode);
                    $('#config').summernote('code', data.value);
                }
            });
        }

        $("#update-config").click(function (e) {
            e.preventDefault();
            $("#update-config").text("Please wait");
            $(".text-success").text("");
            
            $.ajax({
                url: base_url + "/admin/update-config",
                method: 'post',
                data: $("#editConfig form").serialize(),
                error: function(data) {
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);

                        $.each(message, function(key, value) {
                            values = value.value ?? '';
                            shortcode = value.shortcode ?? '';
                        });

                        $(".config-error").text(values);
                        $(".shortcode-error").text(shortcode);
                    }
                },
                success: function (data) {
                    $(".error-message").hide();
                    $(".text-success").text("Configuration Updated");
                },
                complete: function() {
                    $("#update-config").text("Update Config");
                    setTimeout(function () {
                        $(".text-success").text("");
                    }, 3000);
                }
            });
        });
    </script>
@endsection