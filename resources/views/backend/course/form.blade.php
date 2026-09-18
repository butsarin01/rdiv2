@php
    $id = '';
    $img_doc = asset('images/images.png');
    $ordinal = '';
    $status_use = 1;
    $title = '';
    $title_eng = '';
    $title_short = '';
    $title_short_eng = '';
    $unit = '';
    $detail = '';
    $course_open = '';
    $occupation = '';
    $link = [];
    $group_people_id = '';
    $type_document_id = '';
    $category_document_id = '';

    $title_document_id = '';
    $sub_title_document_id = '';

    if (!empty($document)) {
        $id = $document->id;
        $img_doc = !empty($document->thumbnail) ? asset('storage/course/' . $document->thumbnail) : $img_doc;
        $title = $document->title;
        $title_eng = $document->title_eng;
        $title_short = $document->title_short;
        $title_short_eng = $document->title_short_eng;
        $link = explode('|', $document->link);
        $detail = $document->detail;
        $unit = $document->unit;

        $course_open = $document->course_open;
        $occupation = $document->occupation;

        $type_document_id = $document->type_document_id;
        $category_document_id = $document->category_document_id;
        $group_people_id = $document->group_people_id;

        $ordinal = $document->ordinal;
        $status_use = $document->status_use;
    }

@endphp

<form action="{{ route('course.insert') }}" method="POST" name="summernote_form" enctype="multipart/form-data">
    @csrf
    <input class="form-control hide" type="text" id="member_id" name="member_id" placeholder=""
        value="{{ session()->get('user.member_id') }}" />
    <input class="form-control hide" type="text" id="course_id" name="course_id" placeholder=""
        value="{{ $id }}" />
    <input class="form-control hide" type="text" id="mode" name="mode" placeholder="" value="course" />

    <div class="form-group row mb-1">
        <div class="col-md-4 col-sm-4">
            <center>
                <label class="col-md-3 col-sm-3 col-form-label">รูป</label>
                <div class="col-md-9 col-sm-9 ">
                    <img src="{{ $img_doc }}" class="avatar img-thumbnail" alt="avatar"
                        style="height: 100%; width: auto;">
                    <input class="form-control file-upload" type="file" id="image_name" name="image_name"
                        accept="image/png, image/gif, image/jpeg" />
                </div>
            </center>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="form-group row mb-1">
                <label class="col-md-3 col-sm-3 col-form-label" for="name">ชื่อเต็มปริญญาภาษาไทย :</label>
                <div class="col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="name" name="title" value="{{ $title }}"
                        placeholder="" />
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-3 col-sm-3 col-form-label" for="name">ชื่อเต็มปริญญาภาษาอังกฤษ :</label>
                <div class="col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="name" name="title_eng"
                        value="{{ $title_eng }}" placeholder="" />
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-3 col-sm-3 col-form-label" for="name">ชื่อย่อปริญญาภาษาอังกฤษ :</label>
                <div class="col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="name" name="title_short"
                        value="{{ $title_short }}" placeholder="" />
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-3 col-sm-3 col-form-label" for="name">ชื่อย่อปริญญาภาษาอังกฤษ :</label>
                <div class="col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="name" name="title_short_eng"
                        value="{{ $title_short_eng }}" placeholder="" />
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-3 col-sm-3 col-form-label" for="name">จำนวนหน่วยกิตที่เรียน :</label>
                <div class="col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="name" name="unit" value="{{ $unit }}"
                        placeholder="" />
                </div>
            </div>

            <div class="form-group row mb-1">
                <label class="col-md-3 col-sm-3 col-form-label" for="file">รายละเอียด:</label>
                <div class="col-md-8 col-sm-8">
                    <textarea class="form-control" rows="3" name="detail">{{ $detail }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-3 col-sm-3 col-form-label" for="file">หลักสูตรที่เปิด:</label>
                <div class="col-md-8 col-sm-8">
                    <textarea class="form-control" rows="3" name="course_open">{{ $course_open }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-3 col-sm-3 col-form-label" for="file">แนวทางการประกอบอาชีพ:</label>
                <div class="col-md-8 col-sm-8">
                    <textarea class="form-control" rows="3" name="occupation">{{ $occupation }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-form-label col-md-3">ระดับการศึกษา:</label>
                <div class="col-md-6">
                    <select class="form-select type_document_id dynamic_input_category" id="type_document_id"
                        name="type_document_id" data-dependent="category_document_id">
                        {{-- <option value="0">เลือกประเภท..</option> --}}
                        @if (!empty($type_document))
                            @foreach ($type_document as $row)
                                <option value="{{ $row->id }}"
                                    {{ $type_document_id == $row->id ? 'selected' : '' }}>{{ $row->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div id="loading_type_document_id" class="col-md-1 hide"><i class="fas fa-spinner fa-pulse"></i>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label class="col-form-label col-md-3">สาขา/หลักสูตร:</label>
                <div class="col-md-6">
                    <input class="hide" type="text" name="select_value_category"
                        value="{{ $category_document_id }}">
                    <select class="form-select category_document_id dynamic_input_title" id="category_document_id"
                        name="category_document_id" data-dependent="title_document_id">
                        {{--                        <option value="0">เลือกหมวดหมู่..</option> --}}
                    </select>
                </div>
                <div id="loading_category_document_id" class="col-md-1 hide"><i class="fas fa-spinner fa-pulse"></i>
                </div>
            </div>
            {{--            <div class="form-group row mb-1"> --}}
            {{--                <label class="col-md-2 col-sm-2 col-form-label" for="file">หัวข้อ :</label> --}}
            {{--                <div class="col-md-6"> --}}
            {{--                    <input class="hide" type="text" name="select_value_title" value="{{$title_document_id}}"> --}}
            {{--                    <select class="form-select title_document_id dynamic_input_Subtitle" --}}
            {{--                            id="title_document_id" name="title_document_id" --}}
            {{--                            data-dependent="sub_title_document_id"> --}}
            {{--                    </select> --}}
            {{--                </div> --}}
            {{--                <div id="loading_title_document_id" class="col-md-1 hide"><i class="fas fa-spinner fa-pulse"></i></div> --}}
            {{--            </div> --}}
            {{--            <div class="form-group row mb-1"> --}}
            {{--                <label class="col-md-2 col-sm-2 col-form-label" for="file">หัวข้อย่อย :</label> --}}
            {{--                <div class="col-md-6"> --}}
            {{--                    <input class="hide" type="text" name="select_value_subtitle" value="{{$sub_title_document_id}}"> --}}
            {{--                    <select class="form-select sub_title_document_id" --}}
            {{--                            id="sub_title_document_id" name="sub_title_document_id"> --}}
            {{--                    </select> --}}
            {{--                </div> --}}
            {{--                <div id="loading_sub_title_document_id" class="col-md-1 hide"><i class="fas fa-spinner fa-pulse"></i> --}}
            {{--                </div> --}}
            {{--            </div> --}}
            <div class="form-group row mb-1">
                <label class="col-form-label col-md-3">กลุ่มบุคลากร:</label>
                <div class="col-md-6">
                    <select class="form-select group_people_id " id="group_people_id" name="group_people_id">
                        <option value="">เลือกประเภท..</option>
                        @if (!empty($groups))
                            @foreach ($groups as $row)
                                <option value="{{ $row->id }}"
                                    {{ $group_people_id == $row->id ? 'selected' : '' }}>{{ $row->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label class="col-md-3 col-sm-3 col-form-label" for="file">วิดีโอแนะนำ (link youtube) :</label>
                <div class="col-md-7 col-sm-7">
                    @if (!empty($link[0]))
                        <div class="dynamic-show-div-link">
                            @foreach ($link as $key => $row)
                                <div class="row mb-1">
                                    {{--                                    <div class="col-md-2"> --}}
                                    {{--                                        <input type="number" class="form-control number-tr-position" name="ordinal_position[]" --}}
                                    {{--                                               value="{{$row->ordinal}}"> --}}
                                    {{--                                    </div> --}}
                                    <div class="col-md-8">
                                        <input type="text" class="form-control " name="link[]"
                                            value="{{ $row }}">
                                    </div>
                                    <div class="col-md-1">
                                        @if ($key == 0)
                                            <button type="button" class="btn  btn-info text-white dynamic-add-table"
                                                data-group="1" data-table="link">
                                                <i class="fas fa-lg fa-fw fa-circle-plus"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn  btn-danger text-white btn-remove-table"
                                                data-table="link">
                                                <i class="fas fa-lg fa-fw fa-minus-circle"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="text" name="count_link" class="input-i-link hide"
                            value="{{ count($link) }}">
                    @else
                        <div class="dynamic-show-div-link">
                            <div class="row mb-1">
                                {{--                                <div class="col-md-2"> --}}
                                {{--                                    <input type="number" class="form-control number-tr-position" name="ordinal_position[]" value="1"> --}}
                                {{--                                </div> --}}
                                <div class="col-md-6">
                                    <input type="text" class="form-control " name="link[]" value="">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn  btn-info text-white dynamic-add-table"
                                        data-group="1" data-table="link">
                                        <i class="fas fa-lg fa-fw fa-circle-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="count_link" class="input-i-link hide" value="1">
                    @endif

                </div>

                {{--            <div class="form-group row mb-1"> --}}
                {{--                <label class="col-md-2 col-sm-2 col-form-label" for="file">ลำดับการแสดง --}}
                {{--                    :</label> --}}
                {{--                <div class="col-md-3 col-sm-3"> --}}
                {{--                    <input class="form-control" type="number" id="ordinal" name="ordinal" value="{{$ordinal}}" --}}
                {{--                           placeholder=""> --}}
                {{--                </div> --}}
                {{--            </div> --}}
                <div class="form-group row mb-1">
                    <label class="col-md-3 col-sm-3 col-form-label">สถานะ :</label>
                    <div class="col-md-3 col-sm-3 mt-2">
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status_use" id="inlineCssRadio1x" class="form-check-input"
                                value="1" @if ($status_use == 1) checked @endif />
                            <label for="inlineCssRadio1x">ใช้งาน</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status_use" id="inlineCssRadio2x" class="form-check-input"
                                value="0" @if ($status_use == 0) checked @endif />
                            <label for="inlineCssRadio2x">ยกเลิก</label>
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group row mb-1">
                    <div class="col-md-6 col-sm-6  float-right ">
                        <button type="submit" class="btn  btn-primary float-right">บันทึก
                        </button>
                    </div>
                </div> -->
            </div>
        </div>
        {{--    <div class="row "> --}}
        {{--        <div class="col-md-12 col-sm-12"> --}}
        {{--            <div class="form-group row "> --}}
        {{--                <label class="col-md-2 col-sm-2 col-form-label text-end font-weight-bold" --}}
        {{--                       for="file">เอกสารร่วม:</label> --}}
        {{--                <div class="col-md-10 col-sm-10"> --}}

        {{--                    <div class="card border-warning text-warning"> --}}
        {{--                        <div class="card-body div-multifile"> --}}
        {{--                            <div class="row "> --}}
        {{--                                <label class="col-md-1 col-sm-1 col-form-label" for="name">ชื่อเอกสาร:</label> --}}
        {{--                                <div class="col-md-5 col-sm-5"> --}}
        {{--                                    <input class="form-control" type="text" name="multiname[]" --}}
        {{--                                           placeholder=""/> --}}
        {{--                                </div> --}}
        {{--                                <label class="col-md-1 col-sm-1 col-form-label text-end" --}}
        {{--                                       for="file">file :</label> --}}
        {{--                                <div class="col-md-5 col-sm-5 "> --}}
        {{--                                    <div class="row "> --}}
        {{--                                        <div class="col-md-10 col-sm-10"> --}}
        {{--                                            <input class="form-control" type="file" --}}
        {{--                                                   id="multifilename" --}}
        {{--                                                   name="multifilename[]" placeholder="" --}}
        {{--                                            /> --}}
        {{--                                        </div> --}}
        {{--                                        <div class="col-md-1 col-sm-1"> --}}
        {{--                                            <button type="button" name="add" id="add_file" --}}
        {{--                                                    class="btn btn-info add_file"> --}}
        {{--                                                <i class="fas fa-lg fa-fw  fa-plus-circle "></i> --}}
        {{--                                            </button> --}}
        {{--                                        </div> --}}
        {{--                                    </div> --}}
        {{--                                </div> --}}
        {{--                            </div> --}}
        {{--                        </div> --}}
        {{--                        <input type="hidden" class="input-file" value="1"> --}}
        {{--                    </div> --}}
        {{--                </div> --}}
        {{--            </div> --}}
        <div class="row justify-content-center text-center">
            <div class="col-md-6 col-sm-6 py-2">
                <button type="submit" class="btn btn-lg btn-primary "><i
                        class="fas fa-lg fa-fw me-2 fa-floppy-disk"></i>บันทึก
                </button>
            </div>
        </div>
    </div>
    {{--    </div> --}}
</form>

@if (!empty($multifilename[0]))
    <div class="form-group row">
        <label class="col-md-2 col-sm-2 col-form-label text-end fw-bold" for="file">เอกสารที่บันทึก :</label>
        <div class="col-md-10 col-sm-10">
            <table class="table table-hover table-bordered">
                <thead class="bg-default-200">
                    <tr align="center">
                        <th align="center" width="7%">ลำดับที่</th>
                        <th>ชื่อเอกสาร</th>
                        <th width="5%">ไฟล์</th>
                        <th align="center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($multifilename as $key => $data)
                        <tr>
                            <td align="center">{{ $key + 1 }}</td>
                            <td>
                                {{--                            <a href="{{asset('storage/sub_document/'.$id.'/'.$data->file)}}" target="_blank">{{$data->name}}</a> --}}
                                {{ $data->name }}
                            </td>
                            <td align="center">
                                <a href="{{ asset('storage/sub_document/' . $id . '/' . $data->file) }}"
                                    target="_blank">
                                    {!! $data->setfile()['icon'] !!}
                                    {{--                                <span class="fs-6" style="color :{{ $data->setfile()['color']}}"> --}}
                                    {{--                                    {{$data->file}} --}}
                                    {{--                                </span> --}}
                                </a>
                            </td>
                            <td align="center">
                                <a class="btn btn-red btn-sm" href="{{ route('sub_document.delete', [$data->id]) }}"
                                    role="button"><i class="fas fa-lg fa-fw fa-trash-can"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
