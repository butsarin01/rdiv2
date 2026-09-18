@extends('backend.master')
@section('content')
    <div class="row ">
        <div class="col-xl-12 ">
            @if (isset($article))
                <div class="row justify-content-center">
                    <div class="panel col-10">
                        <div class="panel-body ">
                            <div class="card-body ">
                                <h4 class="text-warning-600"><i class="far fa-lg fa-fw me-2 fa-pen-to-square"></i>
                                    @if (!isset($article))
                                        เพิ่ม
                                    @else
                                        แก้ไข
                                    @endifข้อมูล{{ $mode_article->name }}
                                    ({{ $mode_article->name_eng }})
                                </h4>
                                <hr>
                                @include('backend.articles.form')
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            @if (!isset($article))
                <div class="panel">
                    <div class="panel-body">
                        <div class="row justify-content-between1">
                            <div class="col-6">
                                <span class="text-indigo-600 fw-bold fs-4 ">
                                    <i class="fas fa-lg fa-fw me-2 fa-book "></i>
                                    รายการ{{ $mode_article->name }} ({{ $mode_article->name_eng }})
                                </span>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                    <i class="fas fa-lg fa-fw me-1 fa-circle-plus"></i>
                                    เพิ่มข้อมูล
                                </button>
                            </div>
                        </div>

                        <hr class="my-2">
                        <table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle"
                            width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">id</th>
                                    <th width="5%" data-orderable="false">รูป</th>
                                    <th width="50%">รายการ{{ $mode_article->name }}</th>
                                    {{--                                <th width="10%" class="text-nowrap">ไฟล์</th> --}}
                                    <th width="15%" class="text-nowrap">วันที่จัดกิจกรรม</th>
                                    <th width="15%">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_article as $index => $row)
                                    <tr class="odd gradeX">
                                        <td class="f-s-600 text-inverse">{{ $index + 1 }}</td>
                                        <td class="with-img">
                                            @if (!empty($row->img))
                                                <img src="{{ asset('storage/article_img/' . $row->img) }}"
                                                    class="img-rounded h-50px" />
                                            @else
                                                <?php echo 'ไม่มีรูป'; ?>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $row->title }}
                                            {{ $row->groupPeople ? $row->groupPeople->name : '' }}
                                        </td>
                                        <td>
                                            @if (!empty($row->date_start))
                                                {{ $row->set_format_date() }}
                                            @else
                                                {{ $row->set_format_date_save() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-yellow"
                                                href="{{ route('article.index', [$mode_article->name_eng, $row->id]) }}"
                                                role="button">แก้ไข</a>
                                            <a class="btn btn-red" href="{{ route('article.delete', [$row->id]) }}"
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
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary fw-bold" id="addModalLabel">เพิ่มข้อมูล</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('backend.articles.form')
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-warning fw-bold" id="editModalLabel">แก้ไขข้อมูล</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="show-data-modal"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_content')
    <script type="text/javascript">
        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });
        $(document).ready(function() {
            fetch_type();
            setTimeout(function() {
                fetch_category();
            }, 500);
            setTimeout(function() {
                fetch_title();
            }, 1000);
            setTimeout(function() {
                fetch_sub_title();
            }, 1500);

            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();
            $(".text-year").val(text_year);
            $(".text-year-hide").val(value_year);
        });


        $('.dynamic_input_type').change(function() {
            var select = $(".dynamic_input_type option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{ route('dynamic_type.fetch') }}";

            console.log("select = " + select + " value =" + value);
            dynamic_select(select, value, dependent, url);

            setTimeout(function() {
                fetch_category();
            }, 500);
            setTimeout(function() {
                fetch_title();
            }, 1000);
            setTimeout(function() {
                fetch_sub_title();
            }, 1500);

        });


        // $(document).on('change', '.dynamic_input_category', function(){
        $('.dynamic_input_category').change(function() {
            var option = $('option:selected', this).attr('type_document_id');
            var select = $(".dynamic_input_category option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{ route('dynamic_category.fetch') }}";

            console.log("select = " + select + " value =" + value);
            dynamic_select(select, value, dependent, url);

            setTimeout(function() {
                fetch_title();
            }, 500);
            setTimeout(function() {
                fetch_sub_title();
            }, 1000);

        });
        // $(document).on('change', '.dynamic_input_title', function(){
        $('.dynamic_input_title').change(function() {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{ route('dynamic_title.fetch') }}";

            console.log(" select =" + select + "value=" + value);
            dynamic_select(select, value, dependent, url);

            setTimeout(function() {
                fetch_sub_title();
            }, 500);
        });

        $('.dynamic_input_Subtitle').change(function() {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{ route('dynamic_sub_title.fetch') }}";

            console.log(" select =" + select + "value=" + value);
            dynamic_select(select, value, dependent, url);

        });

        function fetch_type() {
            var select_year = $(".dynamic_input_type").text();
            var value_year = $(".dynamic_input_type").val();
            var dependent_year = $(".dynamic_input_type").data('dependent');
            var url_year = "{{ route('dynamic_type.fetch') }}";
            console.log("year = " + select_year + " value =" + value_year);
            dynamic_select(select_year, value_year, dependent_year, url_year);
        }

        function fetch_category() {
            var select_type = $(".dynamic_input_category").text();
            var value_type = $(".dynamic_input_category").val();
            var dependent_type = $(".dynamic_input_category").data('dependent');
            var url_type = "{{ route('dynamic_category.fetch') }}";
            console.log(" select =" + select_type + "value=" + value_type);
            dynamic_select(select_type, value_type, dependent_type, url_type);
        }

        function fetch_title() {
            var select_category = $(".dynamic_input_title").text();
            var value_category = $(".dynamic_input_title").val();
            var dependent_category = $(".dynamic_input_title").data('dependent');
            var url_category = "{{ route('dynamic_title.fetch') }}";
            console.log(" category =" + select_category + "value=" + value_category);
            dynamic_select(select_category, value_category, dependent_category, url_category);
        }

        function fetch_sub_title() {
            var select_title = $(".dynamic_input_Subtitle").text();
            var value_title = $(".dynamic_input_Subtitle").val();
            var dependent_title = $(".dynamic_input_Subtitle").data('dependent');
            var url_title = "{{ route('dynamic_sub_title.fetch') }}";
            console.log(" title =" + select_title + "value=" + value_title);
            dynamic_select(select_title, value_title, dependent_title, url_title);
        }

        function dynamic_select(select, value, dependent, url) {
            var _token = $('input[name="_token"]').val();
            $("#loading_" + dependent).removeClass('hide');
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(result) {
                    $('.' + dependent).html(result);
                    $("#loading_" + dependent).addClass('hide');
                    console.log(result);
                }
            });

        }

        $('.addSubTitles').click(function() {
            $("#modal-dialog-addSubTitles").modal("show");
            var text_type = $('.dynamic_input_category option:selected').text();
            var text_category = $('.dynamic_input_title option:selected').text();
            var text_title = $('.dynamic_input_Subtitle option:selected').text();
            var value_type = $('.dynamic_input_category option:selected').val();
            var value_category = $('.dynamic_input_title option:selected').val();
            var value_title = $('.dynamic_input_Subtitle option:selected').val();

            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();
            console.log(text_year);
            $(".text-year").val(text_year);
            $(".text-year-hide").val(value_year);

            //

            $("#name_type_SubTitles").val(text_type);
            $("#id_type_SubTitles").val(value_type);
            $("#name_category_SubTitles").val(text_category);
            $("#id_category_SubTitles").val(value_category);
            $("#name_title_SubTitles").val(text_title);
            $("#id_title_SubTitles").val(value_title);
        });

        $('.addTitles').click(function() {
            $("#modal-dialog-addTitle").modal("show");
            var text_type = $('.dynamic_input_category option:selected').text();
            var text_category = $('.dynamic_input_title option:selected').text();
            var value_type = $('.dynamic_input_category option:selected').val();
            var value_category = $('.dynamic_input_title option:selected').val();

            // console.log(text_type);

            $("#name_type").val(text_type);
            $("#name_category").val(text_category);
            $("#id_type").val(value_type);
            $("#id_category").val(value_category);
        });

        $('.addCategory').click(function() {
            $("#modal-dialog-addCategory").modal("show");
            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();
            var text_type = $('.dynamic_input_category option:selected').text();
            var value_type = $('.dynamic_input_category option:selected').val();

            console.log(value_year);

            $(".text-year").val(text_year);
            $(".text-year-hide").val(value_year);
            $("#name_type_modal").val(text_type);
            $("#id_type_modal").val(value_type);
        });

        $('.addType').click(function() {
            $("#modal-dialog-addType").modal("show");
            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();

            $("#name_year_modal").val(text_year);
            $("#id_year_modal").val(value_year);

            // console.log(value_type);
        });

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
