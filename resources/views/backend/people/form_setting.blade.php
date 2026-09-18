@php
    $array_data_keep = [
        'name_field' => [
            'status_use_prefix',
            'status_use_name',
            'status_use_lastname',
            'status_use_image',
            'status_use_borad',
            'status_use_position',
            'status_use_telephone',
            'status_use_email',
            'status_use_other',
        ],
        'text' => [
            'คำนำหน้า',
            'ชื่อ',
            'นามสกุล',
            'รูป',
            'กลุ่ม',
            'ตำแหน่ง',
            'เบอร์โทร',
            'email',
            'ตำแหน่งอื่นๆ(กรอกข้อมูล)',
        ],
    ];

    $route = route('people.group');
    $id_group = '';
    $name_group = '';
    $number_show = '';
    $group = [];
    $position = [];
    $count = 1;
    if (!empty($group_id)) {
        $route = route('people.group_update');
        $id_group = $group_id->id;
        $name_group = $group_id->name;
        $number_show = $group_id->number_show;
        $position = $group_id->position;
        $group = $group_id->group_people;
        $count = count($position);
    }
@endphp

<form action="{{ $route }}" method="POST" name="group_form" enctype="multipart/form-data">
    @csrf
    <input class="form-control hide" type="text" id="status_setting" name="status_setting" placeholder="" value="1" />
    <input class="form-control hide" type="text" id="id" name="id" placeholder=""
        value="{{ $id_group }}" />
    <div class="form-group row mb-1">
        <label class="col-md-2 col-sm-2 col-form-label" for="group_name">ชื่อกลุ่มบุคคล :</label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" id="group_name" name="group_name" value="{{ $name_group }}" />
        </div>
    </div>
    <div class="form-group row mb-1">
        <label class="col-md-2 col-sm-2 col-form-label" for="number_show">ลำดับการแสดง :</label>
        <div class="col-md-2 col-sm-2">
            <input class="form-control" type="number" id="number_show" name="number_show"
                value="{{ $number_show }}" />
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-md-2 col-sm-2 col-form-label" for="fullname">การเก็บข้อมูล :</label>
        <div class="col-md-10 col-sm-10 mt-2">
            @foreach ($array_data_keep['name_field'] as $key => $row)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="1"
                        id="inlineCssCheckbox{{ $key }}" name="{{ $row }}"
                        @if (!empty($group_id->$row)) checked @endif />
                    <label class="form-check-label"
                        for="inlineCssCheckbox{{ $key }}">{{ $array_data_keep['text'][$key] }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group row mb-2">
        <div class="row ">
            <label class="col-md-2 col-sm-2 col-form-label" for="fullname">ชื่อกลุ่ม :</label>
            <div class="col-md-10 col-sm-10">
                <div class="row mb-0 text-center">
                    <label class="col-md-2 col-sm-2 col-form-label">ลำดับ</label>
                    <label class="col-md-6 col-sm-6 col-form-label">ชื่อกลุ่ม</label>
                </div>
            </div>
        </div>

        <label class="col-md-2 col-sm-2 col-form-label"></label>
        <div class="col-md-10 col-sm-10 ">
            @if (!empty($group[0]))
                <div class="dynamic-show-div-group">
                    @foreach ($group as $key => $row)
                        <div class="row mb-1">
                            <div class="col-md-2">
                                <input type="number" class="form-control number-tr-group" name="ordinal_group[]"
                                    value="{{ $row->ordinal }}">
                            </div>
                            <div class="col-md-8">
                                <input type="hidden" class="form-control " name="group_id[]"
                                    value="{{ $row->id }}">
                                <input type="text" class="form-control " name="group_name[]"
                                    value="{{ $row->name }}">
                            </div>
                            <div class="col-md-1">
                                @if ($key == 0)
                                    <button type="button" class="btn  btn-info text-white dynamic-add-table"
                                        data-group="{{ $id_group }}" data-table="group">
                                        <i class="fas fa-lg fa-fw fa-circle-plus"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn  btn-danger text-white btn-remove-table"
                                        data-table="group">
                                        <i class="fas fa-lg fa-fw fa-minus-circle"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <input type="text" name="count_group" class="input-i-group hide" value="{{ count($group) }}">
            @else
                <div class="dynamic-show-div-group">
                    <div class="row mb-1">
                        <div class="col-md-2">
                            <input type="number" class="form-control number-tr-group" name="ordinal_group[]"
                                value="1">
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" class="form-control " name="group_id[]" value="">
                            <input type="text" class="form-control " name="group_name[]" value="">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn  btn-info text-white dynamic-add-table"
                                data-group="{{ $id_group }}" data-table="group">
                                <i class="fas fa-lg fa-fw fa-circle-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <input type="text" name="count_group" class="input-i-group hide" value="1">
            @endif
        </div>
    </div>
    <div class="form-group row mb-2">
        <div class="row ">
            <label class="col-md-2 col-sm-2 col-form-label" for="fullname">ชื่อตำแหน่ง :</label>
            <div class="col-md-10 col-sm-10">
                <div class="row mb-0 text-center">
                    <label class="col-md-2 col-sm-2 col-form-label">ลำดับ</label>
                    <label class="col-md-6 col-sm-6 col-form-label">ชื่อตำแหน่ง</label>
                </div>
            </div>
        </div>

        <label class="col-md-2 col-sm-2 col-form-label"></label>
        <div class="col-md-10 col-sm-10 ">
            @if (!empty($position[0]))
                <div class="dynamic-show-div-position">
                    @foreach ($position as $key => $row)
                        <div class="row mb-1">
                            <div class="col-md-2">
                                <input type="number" class="form-control number-tr-position"
                                    name="ordinal_position[]" value="{{ $row->ordinal }}">
                            </div>
                            <div class="col-md-8">
                                <input type="hidden" class="form-control " name="position_id[]"
                                    value="{{ $row->id }}">
                                <input type="text" class="form-control " name="position_name[]"
                                    value="{{ $row->name }}">
                            </div>
                            <div class="col-md-1">
                                @if ($key == 0)
                                    <button type="button" class="btn  btn-info text-white dynamic-add-table"
                                        data-group="{{ $id_group }}" data-table="position">
                                        <i class="fas fa-lg fa-fw fa-circle-plus"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn  btn-danger text-white btn-remove-table"
                                        data-table="position">
                                        <i class="fas fa-lg fa-fw fa-minus-circle"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <input type="text" name="count_position" class="input-i-position hide"
                    value="{{ count($position) }}">
            @else
                <div class="dynamic-show-div-position">
                    <div class="row mb-1">
                        <div class="col-md-2">
                            <input type="number" class="form-control number-tr-position" name="ordinal_position[]"
                                value="1">
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" class="form-control " name="position_id[]" value="">
                            <input type="text" class="form-control " name="position_name[]" value="">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn  btn-info text-white dynamic-add-table"
                                data-group="{{ $id_group }}" data-table="position">
                                <i class="fas fa-lg fa-fw fa-circle-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <input type="text" name="count_position" class="input-i-position hide" value="1">
            @endif
        </div>
    </div>

    <div class="form-group row justify-content-center mb-2">
        <div class="col-md-2 col-sm-2 text-center">
            <button type="submit" class="btn btn-lg btn-primary mt-2"><i
                    class="fas fa-lg fa-fw me-5px fa-floppy-disk"></i>บันทึก
            </button>
        </div>
    </div>
</form>
