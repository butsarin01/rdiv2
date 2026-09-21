<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    {{-- <link href="{{asset('assets_b/css/default/app.css')}}" rel="stylesheet" /> --}}

    <link href="{{ asset('assets_b/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_b/css/default/app.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets_b/plugins/summernote/dist/summernote-lite.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets_b/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets_b/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets_b/plugins/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css') }}"
        rel="stylesheet" />

    <link href="{{ asset('assets_b/plugins/spectrum-colorpicker2/dist/spectrum.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_b/plugins/tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_b/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_b/plugins/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />


    <link href="{{ asset('assets_b/plugins/abpetkov-powerange/dist/powerange.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_b/plugins/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" />
    @if (file_exists(public_path('bootstrap-datepicker-thai-thai/css/datepicker.css')))
        <link href="{{ asset('bootstrap-datepicker-thai-thai/css/datepicker.css') }}" rel="stylesheet" media="screen">
    @else
        <link href="{{ asset('assets_b/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" media="screen">
    @endif
    <style type="text/css">
        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 14px;
            /*font-family: 'K2D', sans-serif;*/
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        span,
        .navbar a {
            font-family: 'Sarabun', sans-serif;
        }

        .gallery img {
            width: 120px;
            height: 90px;
            object-fit: cover;
            border: 1px solid #d9e0e7;
            border-radius: 6px;
            padding: 3px;
            background: #fff;
        }
    </style>
    @yield('style')

</head>

<body>
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>

    <div id="app" class="app app-header-fixed app-sidebar-fixed">
        <div id="header" class="app-header">
            <div class="navbar-header">
                <a href="{{ route('index') }}" class="navbar-brand ">
                    <img src="{{ asset('images/nsru_2.png') }}" class="me-1"><span
                        class="fw-bold">NSRU</span>-Admin-rdi
                </a>
                <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-nav">
                <div class="navbar-item navbar-user dropdown">
                    <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center"
                        data-bs-toggle="dropdown">
                        <img src="{{ session()->get('user.image_user') }}" alt="" />
                        <span>
                            <span class="d-none d-md-inline">{{ session()->get('user.ldap_username') }}</span>
                            <b class="caret"></b>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end me-1">
                        <a href="{{ route('index') }}" class="dropdown-item">Frontend</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item text-red-600">Log Out</a>
                    </div>
                </div>
            </div>
        </div>

        @include('backend.menu.show_menu')


        <div id="content" class="app-content">
            @yield('content')
        </div>

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top"
            data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </div>
    <script src="{{ asset('assets_b/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets_b/js/app.min.js') }}"></script>

    <script src="{{ asset('assets_b/plugins/summernote/dist/summernote-lite.min.js') }}"></script>

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('assets_b/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets_b/js/demo/table-manage-keytable.demo.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/@highlightjs/cdn-assets/highlight.min.js') }}"></script>
    <script src="{{ asset('assets_b/js/demo/render.highlight.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('assets_b/plugins/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/jquery.maskedinput/src/jquery.maskedinput.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/tag-it/js/tag-it.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/clipboard/dist/clipboard.min.js') }}"></script>
    {{-- <script src="{{asset('assets_b/js/demo/form-plugins.demo.js')}}"></script> --}}

    <script src="{{ asset('assets_b/plugins/abpetkov-powerange/dist/powerange.min.js') }}"></script>
    <script src="{{ asset('assets_b/js/demo/form-slider-switcher.demo.js') }}"></script>

    <script src="{{ asset('assets_b/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>

    <script src="{{ asset('assets_b/plugins/spectrum-colorpicker2/dist/spectrum.min.js') }}"></script>

    @if (file_exists(public_path('bootstrap-datepicker-thai-thai/js/bootstrap-datepicker.js')))
    <script src="{{ asset('bootstrap-datepicker-thai-thai/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('bootstrap-datepicker-thai-thai/js/bootstrap-datepicker-thai.js') }}"></script>
    <script src="{{ asset('bootstrap-datepicker-thai-thai/js/locales/bootstrap-datepicker.th.js') }}"></script>
    @else
    <script src="{{ asset('assets_b/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets_b/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}"></script>
    @endif

    @yield('script_content')
    <script>
        $('.summernote').summernote({
            placeholder: 'Hi, this is summernote. Please, write text here! Super simple WYSIWYG editor on Bootstrap',
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true, // set focus to editable area after initializing summernote
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Sarabun'], // Add 'Sarabun' here
            fontNamesIgnoreCheck: ['Sarabun'], // This helps with web fonts loading correctly
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                // ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['height', ['height']]
            ],
        });

        function readURL(input, target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(target).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // ดักทุก input file ที่มี class file-upload
        $(document).on('change', '.file-upload', function() {
            let target = $(this).data('target'); // เช่น "#preview_logo_menu"
            readURL(this, target);
        });
    </script>


    <script>
        setTimeout(function() {
            var html = $('#detail_hidden').val();
            $('.note-placeholder').css('display', 'none');
            $('.note-editable').html(html);
        }, 1000);


        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallery-photo-add').on('change', function() {
                imagesPreview(this, 'div.gallery');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add_text_datetime').click(function() {
                i++;
                var html = '';
                html += '<tr id="row' + i + '">';
                html += '	<td>';
                html +=
                    '		<input type="text" name="datetime_activity[]" placeholder="วันและเวลา ที่มีกิจกรรม" class="form-control name_list xxx"  id="datepicker-autoClose" />';
                html += '	</td>';
                html += '	<td>';
                html += '		<div class="input-group " >';
                html +=
                    '			<input type="text" class="form-control" name="time_begin_activity[]" placeholder="เวลาเริ่มต้น"/>';
                html += '				<span class="input-group-addon">';
                html += '					<i class="fa fa-clock"></i>';
                html += '				</span>';
                html += '		</div>';
                html += '	</td>	';
                html += '   <td>';
                html += '        <div class="input-group " >';
                html +=
                    '			<input type="text" class="form-control" name="time_end_activity[]" placeholder="เวลาสิ้นสุด"/>';
                html += '				<span class="input-group-addon">';
                html += '					<i class="fa fa-clock"></i>';
                html += '				</span>';
                html += '		</div>	';
                html += '   </td>';
                html += '	<td>';
                html += '		<button type="button" name="remove" id="' + i +
                    '" class="btn btn-danger btn_remove">X</button>';
                html += '	</td>';
                html += '</tr>';
                $('#dynamic_field').append(html);
                $('.xxx').datepicker();

            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
            $('#submit').click(function() {
                $.ajax({
                    url: "name.php",
                    method: "POST",
                    data: $('#add_name').serialize(),
                    success: function(data) {
                        alert(data);
                        $('#add_name')[0].reset();
                    }
                });
            });

            // var readURL = function(input) {
            //     if (input.files && input.files[0]) {
            //         var reader = new FileReader();

            //         reader.onload = function(e) {
            //             $('.avatar').attr('src', e.target.result);
            //         }

            //         reader.readAsDataURL(input.files[0]);
            //     }
            // }


            // $(".file-upload").on('change', function() {
            //     readURL(this);
            // });

        });
    </script>

    @yield('script_menu')
</body>

</html>
