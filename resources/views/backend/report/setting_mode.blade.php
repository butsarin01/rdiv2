@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-xl-2 col-md-3 ui-sortable">
            <div class="widget-todolist rounded mb-4" data-id="widget">
                <div class="widget-todolist-header ">
                    <div class="widget-todolist-header-title text-center fw-bold">ประจำปี</div>
                </div>
                <div class="widget-todolist-body">
                    @if(!empty($years ))
                        @foreach($years as $year)
                    <div class="widget-todolist-item">
                        <div class="widget-todolist-content">
                            <a href="{{route('document.setting',[$mode,$year->year])}}"><h5 class="mb-2px">{{$year->year}}</h5></a>
                        </div>
                    </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
        <div class="col-xl-10 col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">รายการข้อมูลการดำเนินการตามเกณฑ์</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="card border-primary mb-2">
                        <div class="card-body">
                        <form action="{{route('document.insert_year')}}" method="POST" name="year_form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <label class="col-md-1 col-sm-3 col-form-label" for="posotion_name">ปี :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" id="year" name="year" placeholder=""/>
                                </div>
                                <div class="col-md-1 col-sm-1">
                                    <button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>

                    <div class="card border-primary">
                        <h4 class="text-primary bg-gray-200 p-2 py-3 rounded-2 mb-0"><i
                                class="fas fa-lg fa-fw me-1 fa-cog"></i>จัดข้อมูลการดำเนินการตามเกณฑ์ (หมวด)</h4>
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label class="col-form-label col-md-2">ปี:</label>
                                <div class="col-md-4">
                                    <select class="form-select select-year dynamic_input_type" id="year" name="year"
                                            data-dependent="type_document_id">
                                        @if(!empty($years ))
                                            @foreach($years as $year)
                                                <option value="{{$year->year}}">{{$year->year}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-form-label col-md-2">หมวดที่ :</label>
                                <div class="col-md-6">
                                    <select class="form-select type_document_id dynamic_input_category"
                                            id="type_document_id" name="type_document_id"
                                            data-dependent="category_document_id">
                                        <option value="0">เลือกประเภท..</option>
                                        @if(!empty($types ))
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-3">

                                    <a href="#modal-dialog-add" class="btn btn-success modal-add" data-bs-toggle="modal"
                                       data-mode_action="add" data-table="type" data-number="1"><i
                                            class="fas fa-lg fa-fw me-1 fa-circle-plus"></i>เพิ่มหมวด
                                    </a>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-form-label col-md-2">ตัวชี้วัด:</label>
                                <div class="col-md-6">
                                    <select class="form-select category_document_id dynamic_input_title"
                                            id="category_document_id" name="category_document_id"
                                            data-dependent="title_document_id">
                                        <option value="0">เลือกหมวดหมู่..</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <a href="#modal-dialog-add" class="btn btn-success modal-add" data-bs-toggle="modal"
                                       data-mode_action="add" data-table="category" data-number="2"><i
                                            class="fas fa-lg fa-fw me-1 fa-circle-plus"></i>เพิ่มตัวชี้วัด
                                    </a>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-md-2 col-sm-2 col-form-label" for="file">หัวข้อ :</label>
                                <div class="col-md-6">
                                    <select class="form-select title_document_id dynamic_input_Subtitle"
                                            id="title_document_id" name="title_document_id"
                                            data-dependent="sub_title_document_id">
                                        <option value="0">เลือกหัวข้อ..</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <a href="#modal-dialog-add" class="btn btn-success modal-add" data-bs-toggle="modal"
                                       data-mode_action="add" data-table="title" data-number="3"><i
                                            class="fas fa-lg fa-fw me-1 fa-circle-plus"></i>เพิ่มหัวข้อ
                                    </a>
                                </div>
                            </div>
                            {{--                            <div class="form-group row mb-1">--}}
                            {{--                                <label class="col-md-2 col-sm-2 col-form-label" for="file">หัวข้อย่อย :</label>--}}
                            {{--                                <div class="col-md-4">--}}
                            {{--                                    <select class="form-select sub_title_document_id" id="sub_title_document_id"--}}
                            {{--                                            name="sub_title_document_id">--}}
                            {{--                                        <option value="0">เลือกหัวข้อย่อย..</option>--}}
                            {{--                                    </select>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-md-2 col-sm-2">--}}
                            {{--                                    <a href="#modal-dialog-addTitle" class="btn btn-success addSubTitles"--}}
                            {{--                                       data-toggle="modal" data-target="#modal-dialog-addSubTitles"--}}
                            {{--                                       id="addSubTitles">เพิ่มหัวข้อย่อย</a>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>

                    @if(!empty($year))
                        <h4 class="text-center py-3 mb-0 ">{{$year->year}}</h4>
                    @endif

                    <div class="row ">
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                            <tr align="center" class="bg-default">
                                <th>หัวข้อ</th>
                                <th width="20%">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($set_document_setting as $type)
                                <tr id="{{$type->id}}">
                                    <td>
                                        <h5 class="text-indigo-700">
                                            <i class="far fa-lg fa-fw me-2 fa-folder-open"></i>หมวด {{$type->ordinal}}
                                            : {{$type->name}}
                                        </h5>
                                    </td>
                                    <td>

                                        <a href="#modal-dialog-add" class="btn btn-sm btn-warning modal-edit"
                                           data-bs-toggle="modal"
                                           data-mode_action="edit" data-table="type" data-number="1"
                                           data-id="{{$type->id}}"><i
                                                class="far fa-lg fa-fw me-1 fa-edit"></i>แก้ไขหมวด
                                        </a>

                                        <a class="btn btn-sm btn-danger"
                                           href="{{route('type_document.delete',[$type->id])}}"
                                           role="button">
                                            <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                        </a>
                                    </td>
                                </tr>
                                @foreach($type->category as $category)
                                    <tr>
                                        <td class="ps-30px">
                                            <h5 class="text-blue-700">
                                                <i class="fas  fa-fw me-2 fa-circle"></i>
                                                {{$type->ordinal}}.{{$category->ordinal}} {{$category->name}}
                                            </h5>
                                        </td>
                                        <td>

                                            <a href="#modal-dialog-add" class="btn btn-sm btn-warning modal-edit"
                                               data-bs-toggle="modal"
                                               data-mode_action="edit" data-table="category" data-number="2"
                                               data-id="{{$category->id}}"><i
                                                    class="far fa-lg fa-fw me-1 fa-edit"></i>แก้ไขตัวชี้วัด
                                            </a>

                                            <a class="btn btn-sm btn-danger"
                                               href="{{route('category_document.delete',[$category->id])}}"
                                               role="button">
                                                <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                            </a>
                                        </td>
                                    </tr>
                                    @foreach($category->title as $title)
                                        <tr>
                                            <td style="padding-left: 60px;">
                                                <h5 class="media-left text-teal-600">
                                                    <i class="fas fa-lg fa-fw m-r-3 fa-genderless"></i>
                                                    {{$type->ordinal}}.{{$category->ordinal}}.{{$title->ordinal}} {{$title->name}}
                                                </h5>
                                            </td>
                                            <td>

                                                <a href="#modal-dialog-add" class="btn btn-sm btn-warning modal-edit"
                                                   data-bs-toggle="modal"
                                                   data-mode_action="edit" data-table="title" data-number="3"
                                                   data-id="{{$title->id}}"><i
                                                        class="far fa-lg fa-fw me-1 fa-edit"></i>แก้ไขหัวข้อ
                                                </a>

                                                <a class="btn btn-sm btn-danger"
                                                   href="{{route('title_document.delete',[$title->id])}}"
                                                   role="button">
                                                    <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                                </a>
                                            </td>
                                        </tr>
                                        @foreach($title->sub_title as $sub_title)
                                            <tr>
                                                <td style="padding-left: 90px;">
                                                    <a href="">
                                                        <h5 class="media-left">
                                                            <i class="fas fa-lg fa-fw m-r-3 fa-genderless"></i>{{$sub_title->code}} {{$sub_title->name}}
                                                        </h5>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#modal-dialog-addSubTitles"
                                                       class="btn btn-sm btn-warning editSubTitles"
                                                       data-toggle="modal" data-target="#modal-dialog-addSubTitles"
                                                       data-id="{{$sub_title->id}}" data-mode="SubTitle"
                                                    ><i class="far fa-lg fa-fw m-r-3 fa-edit"></i>แก้ไขหัวข้อย่อย</a>
                                                    <a class="btn btn-sm btn-danger"
                                                       href="{{route('sub_title_document.delete',[$sub_title->id])}}"
                                                       role="button">
                                                        <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="modal-dialog-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title modal-name-text">Modal Dialog</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="POST" action="{{route('manage_document.insert')}}" id="form_add">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="mode" value="">
                        <input type="hidden" name="table" value="">
                        <input type="hidden" name="base" value="green">

                        <div class="form-group row mb-1">
                            <label class="col-md-3 col-sm-3 col-form-label" for="name">ปี:</label>
                            <div class="col-md-4 col-sm-4">
                                <input class="form-control text-year" type="text" id="year"
                                       name="year" readonly/>
                            </div>
                        </div>

                        <div class="div-show-type hide" data-number_div="1">
                            <input class="id_type text-type-id hide" type="text" name="id_type" value="">
                            <div class="form-group row mb-1">
                                <label class="col-md-3 col-sm-3 col-form-label" for="name">ประเภทของเอกสาร:</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control text-type-name" type="text" id="name_type"
                                           name="name_type" placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="div-show-category hide" data-number_div="2">
                            <input class="id_Category text-category-id hide" type="text" name="id_category" value="">
                            <div class="form-group row mb-1">
                                <label class="col-md-3 col-sm-3 col-form-label" for="name">หมวดหมู่:</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control text-category-name" type="text" id="name_category"
                                           name="name_category" placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="div-show-title hide" data-number_div="3">
                            <input class="id_title text-title-id hide" type="text" name="id_title" value="">
                            <div class="form-group row mb-1">
                                <label class="col-md-3 col-sm-3 col-form-label" for="name">หัวข้อ:</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control text-title-name" type="text" id="name_title"
                                           name="name_title"
                                           placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-3 col-sm-3 col-form-label" for="name">ลำดับการแสดง:</label>
                            <div class="col-md-4 col-sm-4">
                                <input class="form-control text-ordinal" type="number" id="ordinal"
                                       name="ordinal" placeholder=""/>
                            </div>
                        </div>

                        <div class="div-show-title hide" data-number_div="3">
                            <div class="form-group row mb-1">
                                <label class="col-md-3 col-sm-3 col-form-label" for="file">รายละเอียดเพิ่มเติม :</label>
                                <div class="col-md-9 col-sm-9">
                                <textarea class="form-control text-title-detail" rows="7"
                                          name="detail_title"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary float-right submit_Tpe"><i
                                class="fas fa-lg fa-fw me-1 fa-floppy-disk"></i>บันทึก
                        </button>
                        <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">ปิดหน้าต่าง</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('script_menu')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.editText').click(function () {
                // get the current row
                var currentRow = $(this).closest("tr");
                var text = currentRow.find("td:eq(0)").text(); // get current row 1st table cell TD value
                var text1 = $(this).parent().parent().find('td:eq(0)').text()
                var data_id = $(this).data("id");

                $('#name_Type').val(text);
                $('#id').val(data_id);
                console.log(text1);
            });


            $('.status_setting_group').click(function () {
                var group_id = $(this).attr('group-id');
                var status = $(this).is(":checked") ? 1 : 0;
                $.ajax({
                    url: '{{route('people.setting_update')}}',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'mode': 'people',
                        'group_id': group_id,
                        'status_setting': status
                    },
                    dataType: 'json',
                    success: function (data) {
                        // alert(data.alert);
                    }
                });
            });


        });
        $(document).ready(function () {
            fetch_type();
            setTimeout(function () {
                fetch_category();
            }, 500);
            setTimeout(function () {
                fetch_title();
            }, 1000);
            setTimeout(function () {
                fetch_sub_title();
            }, 1500);

            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();
            $(".text-year").val(text_year);
            $(".text-year-hide").val(value_year);
        });

        $('.dynamic_input_type').change(function () {
            var select = $(".dynamic_input_type option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_type.fetch')}}";

            // console.log("select = " + select + " value =" + value);
            dynamic_select(select, value, dependent, url);

            setTimeout(function () {
                fetch_category();
            }, 500);
            setTimeout(function () {
                fetch_title();
            }, 1000);
            setTimeout(function () {
                fetch_sub_title();
            }, 1500);

        });
        // $(document).on('change', '.dynamic_input_category', function(){
        $('.dynamic_input_category').change(function () {
            var option = $('option:selected', this).attr('type_document_id');
            var select = $(".dynamic_input_category option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_category.fetch')}}";

            // console.log("select = " + select + " value =" + value);
            dynamic_select(select, value, dependent, url);

            setTimeout(function () {
                fetch_title();
            }, 500);
            setTimeout(function () {
                fetch_sub_title();
            }, 1000);

        });
        // $(document).on('change', '.dynamic_input_title', function(){
        $('.dynamic_input_title').change(function () {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_title.fetch')}}";

            // console.log(" select =" + select + "value=" + value);
            dynamic_select(select, value, dependent, url);

            setTimeout(function () {
                fetch_sub_title();
            }, 500);
        });

        $('.dynamic_input_Subtitle').change(function () {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_sub_title.fetch')}}";

            // console.log(" select =" + select + "value=" + value);
            dynamic_select(select, value, dependent, url);

        });

        function fetch_type() {
            var select_year = $(".dynamic_input_type").text();
            var value_year = $(".dynamic_input_type").val();
            var dependent_year = $(".dynamic_input_type").data('dependent');
            var url_year = "{{route('dynamic_type.fetch')}}";
            // console.log("year = " + select_year + " value =" + value_year);
            dynamic_select(select_year, value_year, dependent_year, url_year);
        }

        function fetch_category() {
            var select_type = $(".dynamic_input_category").text();
            var value_type = $(".dynamic_input_category").val();
            var dependent_type = $(".dynamic_input_category").data('dependent');
            var url_type = "{{route('dynamic_category.fetch')}}";
            // console.log(" select =" + select_type + "value=" + value_type);
            dynamic_select(select_type, value_type, dependent_type, url_type);
        }

        function fetch_title() {
            var select_category = $(".dynamic_input_title").text();
            var value_category = $(".dynamic_input_title").val();
            var dependent_category = $(".dynamic_input_title").data('dependent');
            var url_category = "{{route('dynamic_title.fetch')}}";
            // console.log(" category =" + select_category + "value=" + value_category);
            dynamic_select(select_category, value_category, dependent_category, url_category);
        }

        function fetch_sub_title() {
            var select_title = $(".dynamic_input_Subtitle").text();
            var value_title = $(".dynamic_input_Subtitle").val();
            var dependent_title = $(".dynamic_input_Subtitle").data('dependent');
            var url_title = "{{route('dynamic_sub_title.fetch')}}";
            // console.log(" title =" + select_title + "value=" + value_title);
            dynamic_select(select_title, value_title, dependent_title, url_title);
        }

        function dynamic_select(select, value, dependent, url) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: url,
                method: "POST",
                data: {select: select, value: value, _token: _token, dependent: dependent},
                success: function (result) {
                    $('.' + dependent).html(result);
                    console.log(result);
                }
            });
        }

        function dynamic_data(id, mode) {
            console.log(id);
            console.log(mode);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{route('dynamic_data.fetch')}}',
                method: "POST",
                data: {id: id, mode: mode, _token: _token},
                success: function (data) {
                    console.log(data);

                    $(".text-year").val(data.year);
                    $(".text-year-hide").val(data.year);

                    $(".text-type-name").val(data.type.name);
                    $(".text-type-id").val(data.type.id);

                    $(".text-category-name").val(data.category.name);
                    $(".text-category-id").val(data.category.id);

                    $(".text-category-ordinal").val(data.category.ordinal);

                    $(".text-title-name").val(data.title.name);
                    $(".text-title-id").val(data.title.id);
                    $(".text-title-detail").val(data.title.detail);

                    $(".text-Subtitle-code").val(data.Subtitle.code);
                    $(".text-Subtitle-name").val(data.Subtitle.name);
                    $(".id_Subtitle").val(data.Subtitle.id);
                    $(".text-Subtitle-detail").val(data.Subtitle.detail);


                    if (mode == 'type') {
                        var ordinal = data.type.ordinal;
                    } else if (mode == 'category') {
                        var ordinal = data.category.ordinal;
                    } else if (mode == 'title') {
                        var ordinal = data.title.ordinal;
                    }

                    $(".text-ordinal").val(ordinal);
                }
            });
        }


        $('.modal-edit').click(function () {
            var mode_action = $(this).data('mode_action');
            var table = $(this).data('table');
            var text = $(this).text();
            var number_div = $(this).data('number');
            var id = $(this).data('id');

            console.log(mode_action + '-------' + table + '++++' + text);

            $("input[name=mode]").val(mode_action);
            $("input[name=table]").val(table);
            $(".modal-name-text").text(text);

            dynamic_data(id, table);

            var substr_s = ['-', 'type', 'category', 'title'];
            for (var i = 1; i < substr_s.length; i++) {

                if (i < number_div) {
                    $("#name_" + substr_s[i]).prop("readonly", true);
                } else {
                    $("#name_" + substr_s[i]).prop("readonly", false);
                }

                if (i <= number_div) {
                    console.log("loop", substr_s[i])
                    $(".div-show-" + substr_s[i]).removeClass('hide');
                } else {
                    $(".div-show-" + substr_s[i]).addClass('hide');
                }
            }
        });


        $('.modal-add').click(function () {
            $("#modal-dialog-add").modal("show");
            var mode_action = $(this).data('mode_action');
            var table = $(this).data('table');
            var text = $(this).text();
            var number_div = $(this).data('number');

            console.log(mode_action + '-------' + table + '++++' + text);

            $("input[name=mode]").val(mode_action);
            $("input[name=table]").val(table);
            $(".modal-name-text").text(text);

            var text_year = $('.select-year option:selected').text();
            $("input[name=year]").val(text_year);

            var substr = ['-', 'Type', 'Category', 'Title'];
            var substr_s = ['-', 'type', 'category', 'title'];
            var name_id = ['-', 'type_document_id', 'category_document_id', 'title_document_id'];
            for (var i = 1; i < substr.length; i++) {

                if (i < number_div) {
                    var select_id = $('#' + name_id[i] + ' option:selected');
                    var text_data = select_id.text();
                    var value_data = select_id.val();

                    $("#name_" + substr_s[i]).val(text_data);
                    $("#name_" + substr_s[i]).prop("readonly", true);
                    $("input[name=id_" + substr_s[i] + "]").val(value_data);
                } else {
                    $("#name_" + substr_s[i]).val('');
                    $("#name_" + substr_s[i]).prop("readonly", false);
                    $(".text-ordinal").val('');
                    $(".text-title-detail").val('');
                }

                if (i <= number_div) {
                    console.log("loop", substr_s[i])
                    $(".div-show-" + substr_s[i]).removeClass('hide');
                } else {
                    $(".div-show-" + substr_s[i]).addClass('hide');
                }
            }
        });


    </script>


@endsection

