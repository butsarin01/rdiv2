@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="card-body">
                        <h4 class="text-primary-600"><i class="far fa-lg fa-fw me-2 fa-pen-to-square"></i>
                            @if (!isset($document))
                                เพิ่ม
                            @else
                                แก้ไข
                            @endif หลักสูตร
                        </h4>
                        <hr>
                        @include('backend.course.form')
                    </div>
                </div>
            </div>

            <div class="modal fade bd-example-modal-lg" id="modal-dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">รายการหน่วยงานที่ส่ง </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('sent_office.insert') }}" method="POST" name="summernote_form"
                                enctype="multipart/form-data">
                                @csrf
                                <input class="form-control hide" type="text" id="sent_office_id" name="sent_office_id"
                                    placeholder="" data-parsley-required="true" value="{{ $editing_office->id ?? '' }}" />

                                <div class="form-group row m-b-15">
                                    <label class="col-md-1 col-sm-1 col-form-label"
                                        for="sent_office
                    _name">ชื่อย่อ :</label>
                                    <div class="col-md-2 col-sm-2">
                                        <input class="form-control" type="text" id="name_sent_office" name="name"
                                            placeholder="" value="{{ $editing_office->name ?? '' }}" />
                                    </div>
                                    <label class="col-md-1 col-sm-1 col-form-label" for="fullname">
                                        ชื่อเต็ม:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="text" id="fullname" name="fullname"
                                            placeholder="" data-parsley-required="true" value="{{ $editing_office->fullname ?? '' }}" />
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-1 col-sm-1 col-form-label" for="name">ที่อยู่ :</label>
                                    <div class="col-md-11 col-sm-11">
                                        <input class="form-control" type="text" id="address" name="address"
                                            placeholder="" data-parsley-required="true" value="{{ $editing_office->address ?? '' }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  float-right ">
                                    <button type="submit" class="btn btn-sm btn-primary float-right">บันทึก</button>
                                </div>
                            </form>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="2%">ชื่อย่อ</th>
                                        <th width="15%">ชื่อเต็ม</th>
                                        <th width="10%" class="text-nowrap">ที่อยู่</th>
                                        <th width="5%">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sent_office as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->fullname }}</td>
                                            <td>{{ $row->address }}</td>
                                            <td>
                                                <a class="btn btn-yellow" href="{{ route('sent_office.index', ['id' => $row->id]) }}"
                                                    role="button">แก้ไข</a>
                                                <a class="btn btn-red" href="{{ route('sent_office.delete', [$row->id]) }}"
                                                    role="button">ลบ</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>


                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                            <a href="javascript:;" class="btn btn-success">Action</a>
                        </div>
                    </div>
                </div>
            </div>
            @if (!isset($document))
                <div class="panel">
                    <div class="panel-body">
                        <span class="text-indigo-600 fw-bold fs-4 ">
                            <i class="fas fa-lg fa-fw me-2 fa-book "></i>
                            รายการหลักสูตร
                        </span>
                        <hr class="my-2">
                        <table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle"
                            width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">id</th>
                                    <th width="5%" data-orderable="false">รูป</th>
                                    <th width="50%">ชื่อหลักสูตร</th>
                                    <th width="10%" class="text-nowrap">ไฟล์</th>
                                    <th width="15%" class="text-nowrap">ประเภท</th>
                                    <th width="15%">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_document as $row)
                                    <tr class="odd gradeX">
                                        <td class="f-s-600 text-inverse">{{ $row->id }}</td>
                                        <td class="with-img">
                                            @if (!empty($row->thumbnail))
                                                <img src="{{ asset('storage/course/' . $row->thumbnail) }}"
                                                    class="img-rounded h-50px" />
                                            @else
                                                <?php echo 'ไม่มีรูป'; ?>
                                            @endif
                                        </td>
                                        <td><a download="{{ $row->file }}"
                                                href="{{ asset('storage/course/' . $row->thumbnail) }}">{{ $row->title }}</a>
                                        </td>
                                        <td>
                                            @if (!empty($row->file))
                                                <img src="{{ asset($row->file_type()) }}" height="40">
                                            @else
                                                <?php echo 'ไม่มีไฟล์'; ?>
                                            @endif
                                        </td>
                                        <td>{{ $row->type_document?->name ?? '-' }}</td>
                                        <td>
                                            <a class="btn btn-yellow"
                                                href="{{ route('document.mode', ['course', $row->id]) }}"
                                                role="button">แก้ไข</a>
                                            <a class="btn btn-red" href="{{ route('course.delete', [$row->id]) }}"
                                                role="button">ลบ</a>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script_content')
    @if (!empty($editing_office))
        <script>
            $(function () { new bootstrap.Modal(document.getElementById('modal-dialog')).show(); });
        </script>
    @endif
    <script type="text/javascript">
        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });


        var select_value_type = $("input[name=select_value_type]").val();
        var select_value_category = $("input[name=select_value_category]").val();
        var select_value_title = $("input[name=select_value_title]").val();
        var select_value_subtitle = $("input[name=select_value_subtitle]").val();
        console.log(select_value_type + select_value_category + select_value_title + select_value_subtitle);
        $(document).ready(function() {
            fetch_type(select_value_type, function() {
                fetch_category(select_value_category, function() {
                    fetch_title(select_value_title, function() {
                        fetch_sub_title(select_value_subtitle);
                    });
                });
            });

            updateYearText();
        });


        $('.dynamic_input_type').change(function() {
            var select = $(".dynamic_input_type option:selected").text();
            var value = $(this).val() || '';
            var dependent = $(this).data('dependent');
            var url = "{{ route('dynamic_type.fetch') }}";

            // dynamic_select(select, value, dependent, url);
            // fetch_category( function () {
            //     fetch_title( function () {
            //         fetch_sub_title();
            //     });
            // });

            dynamic_select(select, value, dependent, url, '', '', () => {
                fetch_category('', () => {
                    fetch_title('', () => {
                        fetch_sub_title();
                    });
                });
            });
            updateYearText();
        });

        $('.dynamic_input_category').change(function() {
            var option = $('option:selected', this).attr('type_document_id');
            var select = $(".dynamic_input_category option:selected").text();
            var value = $(this).val() || '';
            var dependent = $(this).data('dependent');
            var url = "{{ route('dynamic_category.fetch') }}";

            // dynamic_select(select, value, dependent, url);
            // fetch_title( function () {
            //     fetch_sub_title();
            // });

            dynamic_select(select, value, dependent, url, '', '', () => {
                fetch_title('', () => {
                    fetch_sub_title();
                });
            });

        });

        $('.dynamic_input_title').change(function() {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val() || '';
            var dependent = $(this).data('dependent');
            var url = "{{ route('dynamic_title.fetch') }}";

            // dynamic_select(select, value, dependent, url);
            // fetch_sub_title();
            dynamic_select(select, value, dependent, url, '', '', () => {
                fetch_sub_title();
            });
        });

        $('.dynamic_input_Subtitle').change(function() {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val() || '';
            var dependent = $(this).data('dependent');
            var url = "{{ route('dynamic_sub_title.fetch') }}";

            dynamic_select(select, value, dependent, url);

        });

        function fetch_type(data = '', callback = null) {
            var select_year = $(".dynamic_input_type").text();
            var value_year = $(".dynamic_input_type").val();
            var dependent_year = $(".dynamic_input_type").data('dependent');
            var url_year = "{{ route('dynamic_type.fetch') }}";
            var name = $(".dynamic_input_type").attr("name");
            console.log("year = " + select_year + " value =" + value_year);
            dynamic_select(select_year, value_year, dependent_year, url_year, name, data, callback);
        }

        function fetch_category(data = '', callback = null) {
            var select_type = $(".dynamic_input_category").text();
            var value_type = $(".dynamic_input_category option:selected").val();
            var dependent_type = $(".dynamic_input_category").data('dependent');
            var url_type = "{{ route('dynamic_category.fetch') }}";
            var name = $(".dynamic_input_category").attr("name");
            console.log(" select =" + select_type + "value=" + value_type);
            dynamic_select(select_type, value_type, dependent_type, url_type, name, data, callback);
        }

        function fetch_title(data = '', callback = null) {
            var select_category = $(".dynamic_input_title").text();
            var value_category = $(".dynamic_input_title option:selected").val();
            var dependent_category = $(".dynamic_input_title ").data('dependent');
            var url_category = "{{ route('dynamic_title.fetch') }}";
            var name = $(".dynamic_input_title").attr("name");
            console.log(" category =" + select_category + "value=" + value_category);
            dynamic_select(select_category, value_category, dependent_category, url_category, name, data, callback);
        }

        function fetch_sub_title(data = '', callback = null) {
            var select_title = $(".dynamic_input_Subtitle").text();
            var value_title = $(".dynamic_input_Subtitle option:selected").val();
            var dependent_title = $(".dynamic_input_Subtitle").data('dependent');
            var url_title = "{{ route('dynamic_sub_title.fetch') }}";
            var name = $(".dynamic_input_Subtitle").attr("name");
            console.log(" title =" + select_title + "value=" + value_title);
            dynamic_select(select_title, value_title, dependent_title, url_title, name, data, callback);
        }

        function dynamic_select(select, value, dependent, url, name = '', data = '', callback = null) {
            var _token = $('input[name="_token"]').val();
            var $dependentSelect = $('select[name="' + dependent + '"]');
            $("#loading_" + dependent).removeClass('hide');
            $dependentSelect.prop('disabled', true).html('<option>กำลังโหลด...</option>');
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    select: select,
                    source: name || (dependent === 'type_document_id' ? 'year' : ''),
                    base: 'course',
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(result) {
                    $('#' + dependent).html(result);
                    $("#loading_" + dependent).addClass('hide');
                    $dependentSelect.html(result).prop('disabled', false);
                    console.log(result, name, dependent);
                    if (data != '') {
                        $('select[name="' + dependent + '"] option[value="' + data + '"]').prop('selected',
                            true);
                    }
                    if (typeof callback === "function") {
                        callback(); // รันฟังก์ชันถัดไป
                    }
                }
            });
        }

        function updateYearText() {
            const text_year = $('.dynamic_input_type option:selected').text();
            const value_year = $('.dynamic_input_type option:selected').val();
            $(".text-year").val(text_year);
            $(".text-year-hide").val(value_year);
        }

        $(document).on("click", ".add_file", function() {
            var i = $('.input-file').val();
            i++;
            $('.input-file').val(i);
            console.log(i);
            var html = '';
            html += '<div class="row p-t-5">';
            // html += '    <div class="col-md-2 col-sm-2">';
            // html += '        <input class="form-control ordinal_question" type="number" name="ordinal_question_array[]" value="'+i+'" />';
            // html += '    </div>';
            html += '   <label class="col-md-1 col-sm-1 col-form-label" for="name">ชื่อเอกสาร:</label>';
            html += '   <div class="col-md-5 col-sm-5">';
            html += '       <input class="form-control" type="text" id="name" name="multiname[]" placeholder="" />';
            html += '   </div>';
            html += '   <label class="col-md-1 col-sm-1 col-form-label text-right" for="file">file :</label>';
            html += '   <div class="col-md-5 col-sm-5 ">';
            html += '      <div class="row ">';
            html += '           <div class="col-md-10 col-sm-10 ">';
            html += '           <input class="form-control" type="file"  name="multifilename[]" />';
            html += '       </div>';
            html += '       <div class="col-md-1 col-sm-1">';
            html += '           <button type="button" name="remove"  class="btn btn-danger btn_remove_question">';
            html += '           <i class="fas fa-lg fa-fw fa-minus-circle " ></i></button>';
            html += '       </div>';
            html += '      </div>';
            html += '   </div>';
            html += '</div>';
            $('.div-multifile').append(html);
        });
        $(document).on('click', '.btn_remove_question', function() {
            console.log($(this).parent().parent().html());
            $(this).parent().parent().parent().parent().remove();
            var numItems = $('.ordinal_question').length;
            console.log(numItems);

            var j;
            $('.ordinal_question').each(function(i, obj) {
                j = i + 1;
                $(this).val(j);
            });

            console.log('j: ' + j);
            $('.input-file').val(j);
        });

        $(document).on('click', '.dynamic-add-table', function() {
            var table = $(this).data('table');
            var i = $('.input-i-' + table).val();
            i++;
            $('.input-i-' + table).val(i);
            console.log(i);
            // var full_title = $(this).data('name_title');
            // const name_array = full_title.split("/");
            // var class_name = name_array[1];

            var input_id = table + '_id[]';
            var input_name = table + '[]';
            var ordinal_name = 'ordinal_' + table + '[]';

            var html = '';
            html += '<div class="mb-1 row">';
            // html += '   <div class="col-md-2">';
            // html += '   <input type="number" class="form-control number-tr-' + table + '" name="' + ordinal_name + '" value="' + i + '">';
            // html += '   </div>';
            html += '   <div class="col-md-11">';
            html += '       <input type="hidden" class="form-control " name="' + input_id + '" value="">';
            html += '       <input type="text" class="form-control" name="' + input_name + '" >';
            html += '   </div>';
            html += '    <div class="col-md-1">';
            html +=
                '       <button type="button" class="btn  btn-danger text-white btn-remove-table" data-table="' +
                table + '">';
            html += '       <i class="fas fa-lg fa-fw fa-minus-circle"></i></button>';
            html += '   </div>';
            html += '</div>';
            $('.dynamic-show-div-' + table).append(html);
        });

        $(document).on('click', '.btn-remove-table', function() {
            $(this).parent().parent().remove();
            var table = $(this).data('table');
            var numItems = $('.number-tr-' + table).length;

            var j;
            $('.number-tr-' + table).each(function(i, obj) {
                j = i + 1;
                $(this).val(j);
            });
            // console.log('j: ' + j);

            $('.input-i-' + table).val(j);
        });
    </script>
@endsection
