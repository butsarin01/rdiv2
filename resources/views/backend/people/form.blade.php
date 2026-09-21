@php
    $id_group = '';
    $name_group = '';
    if (!empty($group_id)) {
        $id_group = $group_id->id;
        $name_group = $group_id->name;
    }
    $id = '';
    $image_name = asset('images/no-image-icon-23483.png');
    $position_id = '';
    $group_people_id = '';
    $prefix_id = '';
    $people_name = '';
    $people_lastname = '';
    $people_other = '';
    $people_telephone = '';
    $people_email = '';
    $ldep_username = '';
    $status = 1;
    $link_personal = '';
    $ordinal = '';
    $title = 'แบบบันทึกข้อมูลบุคคล ' . $name_group;
    if (!empty($people_id)) {
        $id = $people_id->id;
        $image_name = $people_id->thumbnail;
        $position_id = $people_id->position_id;
        $group_people_id = $people_id->group_prople_id;
        $prefix_id = $people_id->prefix_id;
        $people_name = $people_id->name;
        $people_lastname = $people_id->lastname;
        $people_other = $people_id->position_self;
        $people_telephone = $people_id->telephone;
        $people_email = $people_id->email;
        $ldep_username = $people_id->ldep_username;
        $link_personal = $people_id->link_personal;
        if (!empty($people_id->thumbnail)) {
            $image_name = asset('/storage/people/' . $people_id->thumbnail);
        } elseif (!empty($people_id->link_image)) {
            $image_name = $people_id->link_image;
        }
        $status = $people_id->status_show;
        $title = 'แบบแก้ไขข้อมูลบุคคล ' . $name_group;
        $ordinal = $people_id->ordinal;
    }

@endphp
<span class="text-blue fw-bold fs-4">
    <i class="far fa-lg fa-fw me-2 fa-pen-to-square "></i>
    {{ $title }}
</span>
<hr>
<form action="{{ route('content.insert_people') }}" method="POST" name="form" enctype="multipart/form-data">
    @csrf
    <input class="form-control hide" type="text" id="member_id" name="member_id"
        value="{{ session()->get('user.member_id') }}" />
    <input class="form-control hide" type="text" id="id" name="id" value="{{ $id }}" />
    <input class="form-control hide" type="text" id="group_id" name="group_id" value="{{ $id_group }}" />

    <div class="form-group row m-b-15  justify-content-center">
        @if (!empty($group_id->status_use_image))
            <div class="col-md-4 col-sm-4 ">
                <center>
                    <label class="col-md-3 col-sm-3 form-label col-form-label">รูปบุคคล</label>
                    <div class="col-md-9 col-sm-9 ">
                        {{-- <img src="{{ $image_name }}" class="avatar img-thumbnail" alt="avatar" id="show_img_member"
                            style="height: 280px; width: auto;">
                        <input class="form-control file-upload mt-1" type="file" id="image_name" name="image_name"
                            placeholder="" accept="image/png, image/gif, image/jpeg" /> --}}

                        <img src="{{ $image_name }}" class="img-thumbnail preview" id="show_img_member"
                            style="height: 280px; width: auto;">
                        <input class="form-control file-upload" type="file" name="image_name"
                            data-target="#show_img_member" accept="image/png, image/gif, image/jpeg">

                        <input class="form-control hide" type="text" id="link_img" name="link_image" />
                    </div>
                </center>
            </div>
        @endif

        <div class="col-md-8 col-sm-8">
            @if (empty($people_id) && Route::has('emp_data_list') && Route::has('dynamic_data_staff.fetch'))
                <div class="alert alert-lime fade show p-15  div-show-type_member">
                    <div class=" row ">
                        <label
                            class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-form-label font-weight-bold text-right">ค้นหาชื่อ:</label>
                        <div class="col-lg-3 col-xl-3">
                            <input id="search-input" type="search" class="form-control name_search"
                                name="name_search " />
                        </div>
                        <div class="col-md-1">
                            <button id="search-button" type="button" class="btn btn-info btn-search ">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <label
                            class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-form-label font-weight-bold text-right">เลือกชื่อ:</label>
                        <div class="col-lg-4 col-xl-4 pull-left">
                            <select name="user_account" class="form-control select-search " id="select-fullname">
                            </select>
                            <small class="result-count-member hide">พบรายชื่อใกล้เคียง 35 รายการ</small>
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($group_id->status_use_position))
                <div class="form-group row m-b-15">
                    <label class="form-label col-form-label col-md-2">กลุ่มในหน่วยงาน:</label>
                    <div class="col-md-9">
                        <select class="form-select" name="group_people_id">
                            @foreach ($data_group as $row)
                                <option value="{{ $row->id }}"
                                    {{ $group_people_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            @if (!empty($group_id->status_use_position))
                <div class="form-group row m-b-15">
                    <label class="form-label col-form-label col-md-2">ตำแหน่งในหน่วยงาน:</label>
                    <div class="col-md-9">
                        <select class="form-select" name="position_id">
                            @foreach ($position as $row)
                                <option value="{{ $row->id }}" {{ $position_id == $row->id ? 'selected' : '' }}>
                                    {{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            @if (!empty($group_id->status_use_prefix))
                <div class="form-group row m-b-15">
                    <label class="form-label col-form-label col-md-2">คำนำหน้า :</label>
                    <div class="col-md-4">
                        <select class="form-select" name="prefix_id" id="ref_prefix_id">
                            @if (!empty($prefix[0]))
                                @foreach ($prefix as $row)
                                    <option value="{{ $row->id }}"
                                        {{ $prefix_id == $row->id ? 'selected' : '' }}>{{ $row->name_th ?? $row->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            @endif

            <div class="form-group row m-b-15">
                @if (!empty($group_id->status_use_name))
                    <label class="col-md-2 col-sm-2 form-label col-form-label" for="people_name">ชื่อ
                        :</label>
                    <div class="col-md-4 col-sm-4">
                        <input class="form-control" type="text" id="people_name" name="people_name" placeholder=""
                            value="{{ $people_name }}" />
                    </div>
                @endif
                @if (!empty($group_id->status_use_lastname))
                    <label class="col-md-2 col-sm-2 form-label col-form-label float-right" for="people_lastname">นามสกุล
                        :</label>
                    <div class="col-md-4 col-sm-4">
                        <input class="form-control" type="text" id="people_lastname" name="people_lastname"
                            placeholder="" value="{{ $people_lastname }}" />
                    </div>
                @endif
            </div>


            <div class="form-group row m-b-15">
                @if (!empty($group_id->status_use_telephone))
                    <label class="col-md-2 col-sm-2 form-label col-form-label" for="people_telephone">เบอร์โทร
                        :</label>
                    <div class="col-md-4 col-sm-4">
                        <input class="form-control" type="text" id="people_telephone" name="people_telephone"
                            placeholder="" value="{{ $people_telephone }}" />
                    </div>
                @endif
                @if (!empty($group_id->status_use_email))
                    <label class="col-md-2 col-sm-2 form-label col-form-label float-right" for="people_email">email
                        :</label>
                    <div class="col-md-4 col-sm-4">
                        <input class="form-control" type="text" id="people_email" name="people_email"
                            placeholder="" value="{{ $people_email }}" />
                    </div>
                @endif
            </div>


            @if (!empty($group_id->status_use_other))
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 form-label col-form-label" for="people_other">ตำแหน่งที่ดำรงอยู่
                        :</label>
                    <div class="col-md-10 col-sm-10">
                        <input class="form-control" type="text" id="people_other" name="people_other"
                            placeholder="" value="{{ $people_other }}" />
                    </div>
                </div>
            @endif
            <div class="form-group row m-b-15">
                <label class="col-md-2 col-sm-2 form-label col-form-label" for="link_personal">link_personal
                    :</label>
                <div class="col-md-10 col-sm-10">
                    <input class="form-control" type="text" id="link_personal" name="link_personal"
                        placeholder="" value="{{ $link_personal }}" />
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-2 col-sm-2 form-label col-form-label float-right" for="ldep_username">nsru
                    account :</label>
                <div class="col-md-4 col-sm-4">
                    <input class="form-control" type="text" id="ldep_username" name="ldep_username"
                        placeholder="" value="{{ $ldep_username }}" />
                </div>
                <div id="loading_ldep_username" class="col-md-1 hide"><i
                        class="fas fa-spinner fa-pulse fs-3 mt-2"></i></div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-2 col-sm-2 form-label col-form-label " for="ldep_username">สถานะดำรงตำแหน่ง
                    :</label>
                <div class="col-md-4 col-sm-4 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineRadio1" value="1"
                            name="status" {{ $status == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio1">อยู่ในตำแหน่ง</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineRadio2" value="0"
                            name="status" {{ $status == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio2">พ้นตำแหน่ง</label>
                    </div>
                    {{--                    <select class="form-select" name="status"> --}}
                    {{--                        <option value="1" {{($status == 1) ? 'selected' : ''}}>อยู่ในตำแหน่ง</option> --}}
                    {{--                        <option value="2" {{($status == 2) ? 'selected' : ''}}>พ้นตำแหน่ง</option> --}}
                    {{--                    </select> --}}
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-2 col-sm-2 form-label col-form-label float-right" for="ordinal">ลำดับการแสดง
                    :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="number" id="ordinal" name="ordinal" placeholder=""
                        value="{{ $ordinal }}" />
                </div>

            </div>

            <div class="row justify-content-center text-center">
                <div class="col-md-6 col-sm-6 py-2">
                    <button type="submit" class="btn btn-lg btn-primary "><i
                            class="fas fa-lg fa-fw me-5px fa-floppy-disk"></i>บันทึก
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>
