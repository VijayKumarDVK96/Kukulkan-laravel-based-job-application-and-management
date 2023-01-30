@extends('includes.admin-layout')

@section('title', 'SEO')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="pull-left">SEO</h4>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs-vertical tabs-vertical-dark">
                                        <ul class="nav nav-tabs flex-column top-icon">
                                            <?php
                                            foreach($seo as $key => $value) {
                                                $active = ($key == 0) ? "active" : "";
                                            ?>
                                            
                                            <li class="nav-item">
                                                <a class="nav-link {{$active}}" data-toggle="tab" href="#tab-{{$value->id}}"><span>{{$value->page}}</span></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <?php
                                        foreach($seo as $key => $value) {
                                            $active = ($key == 0) ? "active" : "";
                                        ?>
                                        <div id="tab-{{$value->id}}" class="container tab-pane {{$active}}">
                                            <button data-toggle="modal" data-target="#editSeo" class="btn btn-primary pull-right" onclick="editSeo('{{$value->shortcode}}')" >EDIT</button>
                                            <h5><strong>TITLE</strong></h5>
                                            <p>{{$value->title}}</p>

                                            <h5><strong>META DESCRIPTION</strong></h5>
                                            <p class="text-justify">{{$value->description}}</p>

                                            <h5><strong>META KEYWORDS</strong></h5>
                                            <p class="text-justify">{{$value->keywords}}</p>
                                        </div>
                                        <?php } ?>
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

    <!-- Edit SEO Modal -->
    <div class="modal fade" id="editSeo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit SEO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title">
                            <input type="hidden" name="shortcode" id="shortcode">
                            <span class="title-error error-message"></span>
                            <span class="shortcode-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                            <span class="description-error error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="keywords">Keywords</label>
                            <textarea name="keywords" id="keywords" class="form-control" rows="5"></textarea>
                            <span class="keywords-error error-message"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="text-success font-weight-bold"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary" id="update-seo"><i
                                class="fa fa-check-square-o"></i> Update SEO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const base_url = "{{ url('/') }}";

        function editSeo(shortcode) {
            $.ajax({
                url: base_url + "/admin/edit-seo/" + shortcode,
                method: 'get',
                dataType: 'json',
                success: function (data) {
                    $("#editSeo #title").val(data.title);
                    $("#editSeo #shortcode").val(data.shortcode);
                    $("#editSeo #description").text(data.description);
                    $("#editSeo #keywords").text(data.keywords);
                }
            });
        }

        $("#update-seo").click(function (e) {
            e.preventDefault();
            $("#update-seo").text("Please wait");
            $(".text-success").text("");
            
            $.ajax({
                url: base_url + "/admin/update-seo",
                method: 'post',
                data: $("#editSeo form").serialize(),
                error: function(data) {
                    if(data.status === 422) {
                        var message = JSON.parse(data.responseText);

                        $.each(message, function(key, value) {
                            title = value.title ?? '';
                            shortcode = value.shortcode ?? '';
                            description = value.description ?? '';
                            keywords = value.keywords ?? '';
                        });

                        $(".title-error").text(title);
                        $(".shortcode-error").text(shortcode);
                        $(".description-error").text(description);
                        $(".keywords-error").text(keywords);
                    }
                },
                success: function(data) {
                   $(".error-message").hide();
                   $(".text-success").text("SEO Contents Updated");
                },
                complete: function() {
                    $("#update-seo").text("Update Seo");
                    setTimeout(function () {
                        $(".text-success").text("");
                    }, 3000);
                }
            });
        });
    </script>
@endsection