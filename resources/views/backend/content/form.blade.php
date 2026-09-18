@php
    $member_id = session()->get('user.member_id');

    $main_menu_id = '';
    $sub_menu_id = '';
    $detail_menu_id = '';
    $image_name = asset('images/images.png');
    $title = '';
    $link = '';
    $filename = '';
    $detail = '';
    $number_show = '';
    if (!empty($menu)) {
        if (!empty($mode)) {
            if ($mode == 'main') {
                $main_menu_id = $menu->id;
            } elseif ($mode == 'sub') {
                $sub_menu_id = $menu->id;
            }
        }
    }

    if (!empty($data_detail_menu)) {
        $detail_menu_id = $data_detail_menu->id;
        $image_name = asset('/storage/content/' . $data_detail_menu->thumbnail);
        $title = $data_detail_menu->title;
        $link = $data_detail_menu->link;
        $filename = $data_detail_menu->file;
        $detail = $data_detail_menu->detail;
        $number_show = !empty($data_detail_menu->number_show) ? $data_detail_menu->number_show : '';
    }
@endphp
<form action="{{ route('content.insert_index') }}" method="POST" id="form_content" name="summernote_form"
    enctype="multipart/form-data">
    @csrf
    <input class="form-control hide" type="text" id="member_id" name="member_id" placeholder=""
        data-parsley-required="true" value="{{ $member_id }}" />

    @if ($mode == 'main')
        <input class="form-control hide" type="text" id="main_menu_id" name="main_menu_id" placeholder=""
            value="{{ $main_menu_id }}" />
    @elseif($mode == 'sub')
        <input class="form-control hide" type="text" id="sub_menu_id" name="sub_menu_id" placeholder=""
            value="{{ $sub_menu_id }}" />
    @endif

    <input class="form-control hide" type="text" id="detail_menu_id" name="detail_menu_id" placeholder=""
        value="{{ $detail_menu_id }}" />

    <div class="row mb-1 justify-content-center">
        @if (!empty($menu->status_use_thumbnail))
            <div class="col-md-4 col-sm-4 ">
                <center>
                    <label class="col-md-3 col-sm-3 col-form-label">รูปหัวข้อ</label>
                    <div class="col-md-9 col-sm-9 ">
                        {{-- <img src="{{$image_name}}"
                             class="avatar img-thumbnail" alt="avatar1"
                             style="height: 200px; width: auto;">
                        <input class="form-control file-upload" type="file"
                               id="image_name" name="image_name" placeholder=""
                               data-parsley-required="true"/> --}}

                        <img src="{{ $image_name }}" class="img-thumbnail preview" id="preview_image_name"
                            style="height: 200px; width: auto;">
                        <input class="form-control file-upload" type="file" name="image_name"
                            data-target="#preview_image_name" accept="image/png, image/gif, image/jpeg">
                    </div>
                </center>
            </div>
        @endif
        <div class="col-md-8 col-sm-8">
            @if (!empty($menu->status_use_title))
                <label class="col-md-2 col-sm-2 col-form-label" for="title">ชื่อหัวข้อ
                    :</label>
                <div class="col-md-10 col-sm-10">
                    <input class="form-control" type="text" id="title" name="title" placeholder=""
                        data-parsley-required="true" value="{{ $title }}" />
                </div>
            @endif
            @if (!empty($menu->status_use_link))
                <label class="col-md-2 col-sm-2 col-form-label" for="link">link
                    :</label>
                <div class="col-md-10 col-sm-10">
                    <input class="form-control" type="text" id="link" name="link" placeholder=""
                        data-parsley-required="true"
                        @if (!empty($data->link)) value="{{ $link }}" @endif />
                </div>
            @endif
            @if (!empty($menu->status_use_file))
                <label class="col-md-2 col-sm-2 col-form-label" for="file">file
                    :</label>
                <div class="col-md-10 col-sm-10">
                    {{ $filename }}
                    <input class="form-control" type="file" id="filename" name="filename" placeholder=""
                        data-parsley-required="true" value="" />
                </div>
            @endif
        </div>
    </div>
    @if (!empty($menu->status_use_detail))
        <label class="col-md-2 col-sm-2 col-form-label" for="fullname">รายละเอียด
            :</label>
        <textarea class="summernote" name="detail" id="detail">{{ $detail }}</textarea>
        <textarea class="hide" name="detail_hidden" id="detail_hidden">{{ $detail }}</textarea>
    @endif

    @if ($menu->number_of_data == 2)
        <div class="row mt-2">
            <label class="col-md-1 col-sm-3 col-form-label" for="fullname">ลำดับการแสดง
                </label>
            <div class="col-md-2 col-sm-4">
                <input class="form-control" type="number" id="number_show" name="number_show" placeholder=""
                    value="{{ $number_show }}" />
            </div>
        </div>
    @endif

    <div class="row justify-content-center text-center mt-2">
        <div class="col-md-3">
            <button type="submit" class="btn btn-lg btn-primary"><i class="fas fa-lg fa-fw me-2 fa-save"></i>บันทึก
            </button>
            <button type="reset" class="btn btn-lg btn-danger">ยกเลิก</button>
        </div>
    </div>


    {{--    @if (!empty($data_detail_menu[0]) && $menu->number_of_data == 1) --}}

    {{--        @if ($mode == 'main') --}}
    {{--            <input class="form-control hide" type="text" id="main_menu_id" name="main_menu_id" --}}
    {{--                   placeholder="" value="{{$menu->id}}"/> --}}
    {{--        @elseif($mode == 'sub') --}}
    {{--            <input class="form-control hide" type="text" id="sub_menu_id" name="sub_menu_id" --}}
    {{--                   placeholder="" value="{{$menu->id}}"/> --}}
    {{--        @endif --}}

    {{--        @foreach ($data_detail_menu as $data) --}}
    {{--            <input class="form-control hide" type="text" id="detail_menu_id" --}}
    {{--                   name="detail_menu_id" placeholder="" --}}
    {{--                   @if (!empty($data->id)) value="{{$data->id}}" @endif /> --}}

    {{--            <div class="form-group row m-b-1"> --}}
    {{--                @if (!empty($menu->status_use_thumbnail)) --}}
    {{--                    <div class="col-md-4 col-sm-4 "> --}}
    {{--                        <center> --}}
    {{--                            <label class="col-md-3 col-sm-3 col-form-label">รูปหัวข้อ</label> --}}
    {{--                            <div class="col-md-9 col-sm-9 "> --}}
    {{--                                <img src="{{asset('images/images.png')}}" --}}
    {{--                                     class="avatar img-thumbnail" alt="avatar1" --}}
    {{--                                     style="height: 200px; width: auto;"> --}}
    {{--                                <input class="form-control file-upload" type="file" --}}
    {{--                                       id="image_name" name="image_name" placeholder="" --}}
    {{--                                       data-parsley-required="true"/> --}}
    {{--                            </div> --}}
    {{--                        </center> --}}
    {{--                    </div> --}}
    {{--                @endif --}}

    {{--                <div class="col-md-8 col-sm-8"> --}}
    {{--                    @if (!empty($menu->status_use_title)) --}}
    {{--                        <label class="col-md-2 col-sm-2 col-form-label" for="title">ชื่อหัวข้อ --}}
    {{--                            :</label> --}}
    {{--                        <div class="col-md-10 col-sm-10"> --}}
    {{--                            <input class="form-control" type="text" id="title" name="title" --}}
    {{--                                   placeholder="" data-parsley-required="true" --}}
    {{--                                   @if (!empty($data->title)) value="{{$data->title}}" @endif /> --}}
    {{--                        </div> --}}
    {{--                    @endif --}}
    {{--                    @if (!empty($menu->status_use_link)) --}}
    {{--                        <label class="col-md-2 col-sm-2 col-form-label" for="link">link --}}
    {{--                            :</label> --}}
    {{--                        <div class="col-md-10 col-sm-10"> --}}
    {{--                            <input class="form-control" type="text" id="link" name="link" --}}
    {{--                                   placeholder="" data-parsley-required="true" --}}
    {{--                                   @if (!empty($data->link)) value="{{$data->link}}" @endif/> --}}
    {{--                        </div> --}}
    {{--                    @endif --}}
    {{--                    @if (!empty($menu->status_use_file)) --}}
    {{--                        <label class="col-md-2 col-sm-2 col-form-label" for="file">file --}}
    {{--                            :</label> --}}
    {{--                        <div class="col-md-10 col-sm-10"> --}}
    {{--                            <input class="form-control" type="file" id="filename" --}}
    {{--                                   name="filename" placeholder="" data-parsley-required="true" --}}
    {{--                                   @if (!empty($data->file)) value="{{$data->file}}" @endif/> --}}
    {{--                        </div> --}}
    {{--                    @endif --}}
    {{--                </div> --}}
    {{--            </div> --}}

    {{--            @if (!empty($menu->status_use_detail)) --}}
    {{--                <label class="col-md-2 col-sm-2 col-form-label" for="fullname">รายละเอียด --}}
    {{--                    :</label> --}}
    {{--                <textarea class="summernote" name="detail" --}}
    {{--                          id="detail">{{$data->detail}}</textarea> --}}
    {{--                <textarea class="hide" name="detail_hidden" --}}
    {{--                          id="detail_hidden">@if (!empty($data->detail)) {{$data->detail}} @endif</textarea> --}}
    {{--            @endif --}}
    {{--            <br> --}}

    {{--            <div class="row justify-content-center text-center mt-2"> --}}
    {{--                <div class="col-md-3"> --}}
    {{--                    <button type="submit" class="btn btn-lg btn-primary"><i --}}
    {{--                            class="fas fa-lg fa-fw me-2 fa-save"></i>บันทึก --}}
    {{--                    </button> --}}
    {{--                    <button type="reset" class="btn btn-lg btn-danger">ยกเลิก</button> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        @endforeach --}}

    {{--    @elseif(empty($data_detail_menu[0]) || $menu->number_of_data == 2) --}}
    {{--        @if ($mode == 'main') --}}
    {{--            <input class="form-control hide" type="text" id="main_menu_id" name="main_menu_id" --}}
    {{--                   placeholder="" value="{{$menu->id}}"/> --}}
    {{--        @elseif($mode == 'sub') --}}
    {{--            <input class="form-control hide" type="text" id="sub_menu_id" name="sub_menu_id" --}}
    {{--                   placeholder="" value="{{$menu->id}}"/> --}}
    {{--        @endif --}}

    {{--        <div class="form-group row m-b-1"> --}}
    {{--            @if (!empty($menu->status_use_thumbnail)) --}}
    {{--                <div class="col-md-4 col-sm-4 "> --}}
    {{--                    <center> --}}
    {{--                        <label class="col-md-3 col-sm-3 col-form-label">รูปหัวข้อ</label> --}}
    {{--                        <div class="col-md-9 col-sm-9 "> --}}
    {{--                            <img src="{{asset('images/images.png')}}" --}}
    {{--                                 class="avatar img-thumbnail" alt="avatar" --}}
    {{--                                 style="height: 200px; width: auto;"> --}}
    {{--                            <input class="form-control file-upload" type="file" id="image_name" --}}
    {{--                                   name="image_name" placeholder="" --}}
    {{--                                   data-parsley-required="true"/> --}}
    {{--                        </div> --}}
    {{--                    </center> --}}
    {{--                </div> --}}
    {{--            @endif --}}

    {{--            <div class="col-md-8 col-sm-8"> --}}
    {{--                @if (!empty($menu->status_use_title)) --}}
    {{--                    <label class="col-md-2 col-sm-2 col-form-label" for="title">ชื่อหัวข้อ --}}
    {{--                        :</label> --}}
    {{--                    <div class="col-md-10 col-sm-10"> --}}
    {{--                        <input class="form-control" type="text" id="title" name="title" --}}
    {{--                               placeholder="" data-parsley-required="true"/> --}}
    {{--                    </div> --}}
    {{--                @endif --}}
    {{--                @if (!empty($menu->status_use_link)) --}}
    {{--                    <label class="col-md-2 col-sm-2 col-form-label" for="link">link :</label> --}}
    {{--                    <div class="col-md-10 col-sm-10"> --}}
    {{--                        <input class="form-control" type="text" id="link" name="link" --}}
    {{--                               placeholder="" data-parsley-required="true"/> --}}
    {{--                    </div> --}}
    {{--                @endif --}}
    {{--                @if (!empty($menu->status_use_file)) --}}
    {{--                    <label class="col-md-2 col-sm-2 col-form-label" for="file">file :</label> --}}
    {{--                    <div class="col-md-10 col-sm-10"> --}}
    {{--                        <input class="form-control" type="file" id="filename" name="filename" --}}
    {{--                               placeholder="" data-parsley-required="true"/> --}}
    {{--                    </div> --}}
    {{--                @endif --}}

    {{--                @if ($menu->number_of_data == 2) --}}
    {{--                    <label class="col-md-2 col-sm-2 col-form-label" for="fullname">ลำดับการแสดง --}}
    {{--                        :</label> --}}
    {{--                    <div class="col-md-4 col-sm-4"> --}}
    {{--                        <input class="form-control" type="number" id="number_show" --}}
    {{--                               name="number_show" placeholder="" data-parsley-required="true"/> --}}
    {{--                    </div> --}}
    {{--                @endif --}}

    {{--            </div> --}}

    {{--        </div> --}}

    {{--        @if (!empty($menu->status_use_detail)) --}}
    {{--            <label class="col-md-2 col-sm-2 col-form-label" for="fullname">รายละเอียด :</label> --}}
    {{--            <textarea class="summernote" name="detail" id="detail"></textarea> --}}
    {{--            <textarea class="hide" name="detail_hidden" id="detail_hidden"></textarea> --}}
    {{--        @endif --}}

    {{--        <div class="row justify-content-center text-center mt-2"> --}}
    {{--            <div class="col-md-3"> --}}
    {{--                <button type="submit" class="btn btn-lg btn-primary"><i --}}
    {{--                        class="fas fa-lg fa-fw me-2 fa-save"></i>บันทึก --}}
    {{--                </button> --}}
    {{--                <button type="reset" class="btn btn-lg btn-danger">ยกเลิก</button> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    @endif --}}

    {{--    <div class="input-field"> --}}
    {{--        <div class="input-images-1" style="padding-top: .5rem;"></div> --}}
    {{--    </div> --}}

</form>
