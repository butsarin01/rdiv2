@extends('backend.master')
@section('content')
    <div class="row">
        @php
            $form = [
                'document' => [
                    'btn' => ['ประเภทเอกสาร', 'หมวดหมู่เอกสาร', 'หัวข้อ', 'หัวข้อย่อย'],
                    'col2' => ['xl' => 12, 'md' => 12],
                    'name_tab' => 'รายการข้อมูลประเภทเอกสาร',
                    'color' => 'primary',
                    'name_form' => 'จัดข้อมูลประเภทเอกสาร',
                    'select' => [
                        1 => [
                            'label' => 'ประเภทเอกสาร',
                            'table' => 'type',
                            'id' => 'type_document_id',
                            'class1' => 'type_document_id',
                            'class2' => 'dynamic_input_category',
                            'dependent' => 'category_document_id',
                            'data' => $types,
                            'value' => 'id',
                            'text' => 'name',
                        ],
                        2 => [
                            'label' => 'หมวดหมู่เอกสาร',
                            'table' => 'category',
                            'id' => 'category_document_id',
                            'class1' => 'category_document_id',
                            'class2' => 'dynamic_input_title',
                            'dependent' => 'title_document_id',
                        ],
                        3 => [
                            'label' => 'หัวข้อ',
                            'table' => 'title',
                            'id' => 'title_document_id',
                            'class1' => 'title_document_id',
                            'class2' => 'dynamic_input_Subtitle',
                            'dependent' => 'sub_title_document_id',
                        ],
                        4 => [
                            'label' => 'หัวข้อย่อย',
                            'table' => 'Subtitle',
                            'id' => 'sub_title_document_id',
                            'class1' => 'sub_title_document_id',
                            'class2' => '',
                            'dependent' => '',
                        ],
                    ],
                ],
                'course' => [
                    'btn' => ['ระดับการศึกษา', 'สาขา/หลักสูตร'],
                    'col2' => ['xl' => 12, 'md' => 12],
                    'name_tab' => 'รายการข้อมูลหลักสูตร',
                    'color' => 'primary',
                    'name_form' => 'จัดข้อมูลประเภทหลักสูตร',
                    'select' => [
                        1 => [
                            'label' => 'ระดับการศึกษา',
                            'table' => 'type',
                            'id' => 'type_document_id',
                            'class1' => 'type_document_id',
                            'class2' => 'dynamic_input_category',
                            'dependent' => 'category_document_id',
                            'data' => $types,
                            'value' => 'id',
                            'text' => 'name',
                        ],
                        2 => [
                            'label' => 'สาขา/หลักสูตร',
                            'table' => 'category',
                            'id' => 'category_document_id',
                            'class1' => 'category_document_id',
                            'class2' => 'dynamic_input_title',
                            'dependent' => 'title_document_id',
                        ],
                    ],
                ],
                'report' => [
                    'btn' => ['หมวดที่', 'ตัวชี้วัด', 'หัวข้อ', 'หัวข้อย่อย'],
                    'col1' => ['xl' => 2, 'md' => 3],
                    'col2' => ['xl' => 10, 'md' => 9],
                    'name_tab' => 'รายการข้อมูลประกันคุณภาพ',
                    'color' => 'green',
                    'name_form' => 'จัดการข้อมูลประกันคุณภาพ',
                    'select' => [
                        [
                            'label' => 'ปี',
                            'table' => '',
                            'id' => 'year',
                            'class1' => 'select-year',
                            'class2' => 'dynamic_input_type',
                            'dependent' => 'type_document_id',
                            'data' => $years,
                            'value' => 'year',
                            'text' => 'year',
                        ],
                        [
                            'label' => 'ประเภทเอกสาร',
                            'table' => 'type',
                            'id' => 'type_document_id',
                            'class1' => 'type_document_id',
                            'class2' => 'dynamic_input_category',
                            'dependent' => 'category_document_id',
                        ],
                        [
                            'label' => 'หมวดหมู่เอกสาร',
                            'table' => 'category',
                            'id' => 'category_document_id',
                            'class1' => 'category_document_id',
                            'class2' => 'dynamic_input_title',
                            'dependent' => 'title_document_id',
                        ],
                        [
                            'label' => 'หัวข้อ',
                            'table' => 'title',
                            'id' => 'title_document_id',
                            'class1' => 'title_document_id',
                            'class2' => 'dynamic_input_Subtitle',
                            'dependent' => 'sub_title_document_id',
                        ],
                        [
                            'label' => 'หัวข้อย่อย',
                            'table' => 'SubTitle',
                            'id' => 'sub_title_document_id',
                            'class1' => 'sub_title_document_id',
                            'class2' => '',
                            'dependent' => '',
                        ],
                    ],
                ],
            ];
        @endphp
        @if (!empty($form[$mode]['col1']))
            <div class="col-xl-{{ $form[$mode]['col1']['xl'] }} col-md-{{ $form[$mode]['col1']['md'] }} ui-sortable">
                <div class="widget-todolist rounded mb-4" data-id="widget">
                    <div class="widget-todolist-header ">
                        <div class="widget-todolist-header-title text-center fw-bold">ประจำปี</div>
                    </div>
                    <div class="widget-todolist-body">
                        @if (!empty($years))
                            @foreach ($years as $year)
                                <div class="widget-todolist-item">
                                    <div class="widget-todolist-content">
                                        <a href="{{ route('document.setting', [$mode, $year->year]) }}">
                                            <h5 class="mb-2px">{{ $year->year }}</h5>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xl-{{ $form[$mode]['col2']['xl'] }} col-md-{{ $form[$mode]['col2']['md'] }}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ $form[$mode]['name_tab'] }}</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    @if ($mode == 'report')
                        <div class="card border-{{ $form[$mode]['color'] }} mb-2">
                            <div class="card-body">
                                <form action="{{ route('document.insert_year') }}" method="POST" name="year_form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <label class="col-md-1 col-sm-3 col-form-label" for="posotion_name">ปี :</label>
                                        <div class="col-md-4 col-sm-4">
                                            <input class="form-control" type="text" id="year" name="year"
                                                placeholder="" required />
                                            <input class="form-control" type="hidden" id="mode" name="mode"
                                                placeholder="" value="{{ $mode }}" />
                                        </div>
                                        <div class="col-md-1 col-sm-1">
                                            <button type="submit"
                                                class="btn btn-sm btn-{{ $form[$mode]['color'] }} m-r-5">บันทึก
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="card border-{{ $form[$mode]['color'] }} mb-3">
                        <h4 class="text-{{ $form[$mode]['color'] }} bg-gray-200 p-2 py-3 rounded-2 mb-0"><i
                                class="fas fa-lg fa-fw me-1 fa-cog"></i>{{ $form[$mode]['name_form'] }}</h4>
                        <div class="card-body">
                            @foreach ($form[$mode]['select'] as $key => $row)
                                <div class="form-group row mb-1">
                                    <label class="col-form-label col-md-2">{{ $row['label'] }}:</label>
                                    <div class="col-md-4">
                                        <select class="form-select {{ $row['class1'] }} {{ $row['class2'] }}"
                                            id="{{ $row['id'] }}" name="{{ $row['id'] }}"
                                            data-dependent="{{ $row['dependent'] }}">

                                            @if ($mode == 'report')
                                                @foreach ($years as $value)
                                                    <option value="{{ $value->year }}">{{ $value->year }}</option>
                                                @endforeach
                                            @elseif($mode == 'document' || $mode == 'course')
                                                @foreach ($types as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if (!empty($row['table']))
                                        <div class="col-md-3 col-sm-3">
                                            <a href="#modal-dialog-add"
                                                class="btn btn-{{ $form[$mode]['color'] }} modal-add"
                                                data-bs-toggle="modal" data-mode_action="add"
                                                data-table="{{ $row['table'] }}" data-number="{{ $key }}"><i
                                                    class="fas fa-lg fa-fw me-1 fa-circle-plus"></i>เพิ่ม{{ $row['label'] }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>

                    @if (!empty($current_year))
                        <h4 class="text-center py-3 mb-0 ">{{ $current_year }}</h4>
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
                                @foreach ($set_document_setting as $type)
                                    <tr id="{{ $type->id }}">
                                        <td>
                                            <h5 class="text-indigo-700">
                                                <i class="far fa-lg fa-fw me-2 fa-folder-open"></i>
                                                {{--                                            {{$type->ordinal}} : --}}
                                                {{ $type->name }}
                                            </h5>
                                        </td>
                                        <td>
                                            <a href="#modal-dialog-add" class="btn btn-sm btn-warning modal-edit"
                                                data-bs-toggle="modal" data-mode_action="edit" data-table="type"
                                                data-number="1" data-id="{{ $type->id }}"><i
                                                    class="far fa-lg fa-fw me-1 fa-edit"></i>แก้ไข{{ $form[$mode]['btn'][0] }}
                                            </a>

                                            <a class="btn btn-sm btn-danger"
                                                href="{{ route('type_document.delete', [$type->id]) }}" role="button">
                                                <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                            </a>
                                        </td>
                                    </tr>
                                    @foreach ($type->category as $category)
                                        <tr>
                                            <td class="ps-30px">
                                                <h5 class="text-blue-700">
                                                    <i class="fas  fa-fw me-2 fa-circle"></i>
                                                    {{--                                                {{$type->ordinal}}.{{$category->ordinal}} --}}
                                                    {{ $category->name }}
                                                </h5>
                                            </td>
                                            <td>

                                                <a href="#modal-dialog-add" class="btn btn-sm btn-warning modal-edit"
                                                    data-bs-toggle="modal" data-mode_action="edit" data-table="category"
                                                    data-number="2" data-id="{{ $category->id }}"><i
                                                        class="far fa-lg fa-fw me-1 fa-edit"></i>แก้ไข{{ $form[$mode]['btn'][1] }}
                                                </a>

                                                <a class="btn btn-sm btn-danger"
                                                    href="{{ route('category_document.delete', [$category->id]) }}"
                                                    role="button">
                                                    <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                                </a>
                                            </td>
                                        </tr>
                                        @foreach ($category->title as $title)
                                            <tr>
                                                <td style="padding-left: 60px;">
                                                    <h5 class="media-left text-teal-600">
                                                        <i class="fas fa-lg fa-fw m-r-3 fa-genderless"></i>
                                                        {{--                                                    {{$type->ordinal}}.{{$category->ordinal}}.{{$title->ordinal}} --}}
                                                        {{ $title->name }}
                                                    </h5>
                                                </td>
                                                <td>

                                                    <a href="#modal-dialog-add" class="btn btn-sm btn-warning modal-edit"
                                                        data-bs-toggle="modal" data-mode_action="edit" data-table="title"
                                                        data-number="3" data-id="{{ $title->id }}"><i
                                                            class="far fa-lg fa-fw me-1 fa-edit"></i>แก้ไข{{ $form[$mode]['btn'][2] }}
                                                    </a>

                                                    <a class="btn btn-sm btn-danger"
                                                        href="{{ route('title_document.delete', [$title->id]) }}"
                                                        role="button">
                                                        <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                                    </a>
                                                </td>
                                            </tr>
                                            @foreach ($title->sub_title as $sub_title)
                                                <tr>
                                                    <td style="padding-left: 90px;">
                                                        <a href="">
                                                            <h5 class="media-left">
                                                                <i
                                                                    class="fas fa-lg fa-fw m-r-3 fa-genderless"></i>{{ $sub_title->code }}
                                                                {{ $sub_title->name }}
                                                            </h5>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#modal-dialog-add"
                                                            class="btn btn-sm btn-warning modal-edit"
                                                            data-bs-toggle="modal" data-mode_action="edit"
                                                            data-table="SubTitle" data-number="4"
                                                            data-id="{{ $sub_title->id }}"><i
                                                                class="far fa-lg fa-fw me-1 fa-edit"></i>แก้ไข{{ $form[$mode]['btn'][3] }}
                                                        </a>

                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('sub_title_document.delete', [$sub_title->id]) }}"
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
                <form method="POST" action="{{ route('manage_document.insert') }}" id="form_add">
                    @csrf
                    @include('backend.' . $mode . '.modal_body')
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary float-right submit_Tpe"><i
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
        $(document).ready(function() {

            $('.editText').click(function() {
                // get the current row
                var currentRow = $(this).closest("tr");
                var text = currentRow.find("td:eq(0)").text(); // get current row 1st table cell TD value
                var text1 = $(this).parent().parent().find('td:eq(0)').text()
                var data_id = $(this).data("id");

                $('#name_Type').val(text);
                $('#id').val(data_id);
                // console.log(text1);
            });





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
                    base: @json($mode),
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


        function dynamic_data(id, mode) {
            // console.log(id);
            // console.log(mode);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ route('dynamic_data.fetch') }}',
                method: "POST",
                data: {
                    id: id,
                    mode: mode,
                    _token: _token
                },
                success: function(data) {
                    // console.log(data);

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
                    } else if (mode == 'Subtitle') {
                        var ordinal = data.Subtitle.ordinal;
                    }

                    $(".text-ordinal").val(ordinal);
                }
            });
        }


        $('.modal-edit').click(function() {
            var mode_action = $(this).data('mode_action');
            var table = $(this).data('table');
            var text = $(this).text();
            var number_div = $(this).data('number');
            var id = $(this).data('id');

            // console.log(mode_action + '-------' + table + '++++' + text);

            $("input[name=mode]").val(mode_action);
            $("input[name=table]").val(table);
            $(".modal-name-text").text(text);

            dynamic_data(id, table);

            var substr_s = ['-', 'type', 'category', 'title', 'Subtitle'];
            for (var i = 1; i < substr_s.length; i++) {

                if (i < number_div) {
                    $("#name_" + substr_s[i]).prop("readonly", true);
                } else {
                    $("#name_" + substr_s[i]).prop("readonly", false);
                }

                if (i <= number_div) {
                    // console.log("loop", substr_s[i])
                    $(".div-show-" + substr_s[i]).removeClass('hide');
                } else {
                    $(".div-show-" + substr_s[i]).addClass('hide');
                }
            }
        });


        $('.modal-add').click(function() {
            $("#modal-dialog-add").modal("show");
            var mode_action = $(this).data('mode_action');
            var table = $(this).data('table');
            var text = $(this).text();
            var number_div = $(this).data('number');

            // console.log(mode_action + '-------' + table + '++++' + text);

            $("input[name=mode]").val(mode_action);
            $("input[name=table]").val(table);
            $(".modal-name-text").text(text);

            var text_year = $('.select-year option:selected').text();
            $("input[name=year]").val(text_year);

            var substr = ['-', 'Type', 'Category', 'Title', 'Subtitle'];
            var substr_s = ['-', 'type', 'category', 'title', 'Subtitle'];
            var name_id = ['-', 'type_document_id', 'category_document_id', 'title_document_id',
                'sub_title_document_id'
            ];
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
                    // console.log("loop", substr_s[i])
                    $(".div-show-" + substr_s[i]).removeClass('hide');
                } else {
                    $(".div-show-" + substr_s[i]).addClass('hide');
                }
            }
        });
    </script>
@endsection
