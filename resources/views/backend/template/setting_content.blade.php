@extends('Backend.master')
@section('content')
    @php
        $id = '';
        $title = '';
        $title_short = '';
        $title_eng = '';
        $title_short_eng = '';
        $detail = '';
        $detail_eng = '';
        $logo_main = asset('images/no-image-icon-23483.png');
        $logo_menu = asset('images/no-image-icon-23483.png');
        $logo_icon = asset('images/no-image-icon-23483.png');
        $default_img = asset('images/no-image-icon-23483.png');

        $address = '';
        $telephone = '';
        $telephone2 = '';
        $email = '';
        $facebook = '';
        $website = '';

        $header_color = '';
        $body_color = '';
        $text_hover_color = '';
        if (!empty($template)) {
            $id = $template->id;
            $title = $template->title;
            $title_eng = $template->title_eng;
            $title_short = $template->title_short;
            $title_short_eng = $template->title_short_eng;
            $detail = $template->detail;
            $detail_eng = $template->detail_eng;
            $logo_main = $template->logo_main ? asset('storage/template/' . $template->logo_main) : $logo_main;
            $logo_menu = $template->logo_menu ? asset('storage/template/' . $template->logo_menu) : $logo_menu;
            $logo_icon = $template->logo_icon ? asset('storage/template/' . $template->logo_icon) : $logo_icon;
            $default_img = $template->default_img ? asset('storage/template/' . $template->default_img) : $default_img;
            $header_color = $template->header_color;
            $body_color = $template->body_color;
            $text_hover_color = $template->text_hover_color;
            $address = $template->address;
            $telephone = $template->telephone;
            $telephone2 = $template->telephone2;
            $email = $template->email;
            $facebook = $template->facebook;
            $website = $template->website;
        }
    @endphp
    <h1 class="page-header fw-bold"><i class="far fa-lg fa-fw me-2 fa-building"></i>จัดการข้อมูลหน่วยงาน<small
            class="fw-bold ps-2">(ผู้ดูแลระบบ)</small></h1>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-default1">
                {{--                <div class="panel-heading ui-sortable-handle"> --}}
                {{--                    <h4 class="text-blue-500 mb-0"> --}}
                {{--                        <i class="far fa-lg fa-fw me-2 fa-rectangle-list"></i> --}}
                {{--                        จัดการข้อมูล หน่วยงาน --}}
                {{--                    </h4> --}}
                {{--                </div> --}}
                <div class="panel-body">
                    {{--                    <h4 class="text-blue-500 mb-0 pt-2 "> --}}
                    {{--                        <i class="far fa-lg fa-fw me-2 fa-building"></i> --}}
                    {{--                        จัดการข้อมูลหน่วยงาน --}}
                    {{--                    </h4> --}}
                    {{--                    <hr> --}}
                    <form action="{{ route('template.set_insert') }}" method="POST" name="summernote_form"
                        enctype="multipart/form-data">
                        @csrf
                        <input class="form-control hide" type="text" id="tem_id" name="tem_id" placeholder=""
                            value="{{ $id }}" />
                        <div class="row">
                            <div class="col-md-4 col-sm-4 text-center  align-items-center">

                                <label class="col-md-5 col-sm-5 col-form-label">logo ใหญ่</label>
                                <div class="col-md-12 col-sm-9 ">
                                    <img src="{{ $logo_main }}" class="img-thumbnail preview" id="preview_logo_main"
                                        style="height: 200px; width: auto;">
                                    <input class="form-control file-upload" type="file" name="logo_main"
                                        data-target="#preview_logo_main" accept="image/png, image/gif, image/jpeg">
                                </div>

                                <hr>

                                <label class="col-md-3 col-sm-3 col-form-label">logo เล็ก</label>
                                <div class="col-md-12 col-sm-9 ">
                                    <img src="{{ $logo_menu }}" class="img-thumbnail preview" id="preview_logo_menu"
                                        style="height: 150px; width: auto;">
                                    <input class="form-control file-upload" type="file" name="logo_menu"
                                        data-target="#preview_logo_menu" accept="image/png, image/gif, image/jpeg">
                                </div>

                                <hr>

                                <label class="col-md-3 col-sm-3 col-form-label">logo icon</label>
                                <div class="col-md-12 col-sm-9 ">
                                    <img src="{{ $logo_icon }}" class="img-thumbnail preview" id="preview_logo_icon"
                                        style="height: 150px; width: auto;">
                                    <input class="form-control file-upload" type="file" name="logo_icon"
                                        data-target="#preview_logo_icon" accept="image/png, image/gif, image/jpeg">
                                </div>

                                <hr>

                                <label class="col-md-3 col-sm-3 col-form-label">default_img</label>
                                <div class="col-md-12 col-sm-9 ">
                                    <img src="{{ $default_img }}" class="img-thumbnail preview" id="preview_default_img"
                                        style="height: 150px; width: auto;">
                                    <input class="form-control file-upload" type="file" name="default_img"
                                        data-target="#preview_default_img" accept="image/png, image/gif, image/jpeg">
                                </div>


                            </div>
                            <div class="col-md-8 col-sm-8 ">
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">ชื่อสังกัด : เต็ม(th)</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $title }}"
                                            name="title">
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">ชื่อสังกัด : เต็ม(eng)</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $title_eng }}"
                                            name="title_eng">
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">ชื่อสังกัด : ย่อ(th)</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $title_short }}"
                                            name="title_short">
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">ชื่อสังกัด : ย่อ(eng)</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $title_short_eng }}"
                                            name="title_short_eng">
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">รายละเอียดสังกัด : แบบย่อ(th)</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" rows="3" name="detail">{{ $detail }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">รายละเอียดสังกัด : แบบย่อ(eng)</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" rows="3" name="detail_eng">{{ $detail_eng }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">ที่อยู่สังกัด : (th)</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" rows="3" name="address">{{ $address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">เบอร์โทรศัพท์ :</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" rows="3" name="telephone">{{ $telephone }}</textarea>
                                        {{-- <input type="text" class="form-control" value="{{ $telephone }}"
                                            name="telephone"> --}}
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">โทรสาร :</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $telephone2 }}"
                                            name="telephone2">
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">website :</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $website }}"
                                            name="website">
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">email :</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $email }}"
                                            name="email">
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">Facebook :</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $facebook }}"
                                            name="facebook">
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">สี header</label>
                                    <div class="col-lg-6">
                                        {{--                                        #C90076----{{$header_color}} --}}
                                        <input type="text" class="form-control colorpicker"
                                            value="{{ $header_color }}" name="color_header">
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">สี body</label>
                                    <div class="col-lg-6">
                                        {{--                                        #DD97B1---{{$body_color}} --}}
                                        <input type="text" class="form-control colorpicker"
                                            value="{{ $body_color }}" name="color_body">
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-lg-3 col-form-label">สีตัวหนังสือ </label>
                                    <div class="col-lg-6">
                                        {{--                                        #fff----{{$text_hover_color}} --}}
                                        <input type="text" class="form-control colorpicker"
                                            value="{{ $text_hover_color }}" name="color_hover">
                                    </div>
                                </div>

                                {{--								<div class="form-group row mb-1"> --}}
                                {{--									<label class="col-md-4 col-sm-4 col-form-label">สถานะ menu บน :</label> --}}
                                {{--									<div class="col-md-6 col-sm-6 "> --}}
                                {{--										<div class="radio radio-css radio-inline"> --}}
                                {{--											<input type="radio" name="sub_top" id="inlineCssRadio1x" value="1"  @if ($data->status_show_menu_top == 1) checked @endif/> --}}
                                {{--											<label for="inlineCssRadio1x">มี</label> --}}
                                {{--										</div> --}}
                                {{--										<div class="radio radio-css radio-inline"> --}}
                                {{--											<input type="radio" name="sub_top" id="inlineCssRadio2x" value="0" @if ($data->status_show_menu_top == 0) checked @endif/> --}}
                                {{--											<label for="inlineCssRadio2x">ไม่มี</label> --}}
                                {{--										</div> --}}
                                {{--									</div> --}}
                                {{--								</div> --}}
                                {{--								<div class="form-group row mb-1"> --}}
                                {{--									<label class="col-md-4 col-sm-4 col-form-label">สถานะ menu ข้าง :</label> --}}
                                {{--									<div class="col-md-6 col-sm-6 "> --}}
                                {{--										<div class="radio radio-css radio-inline"> --}}
                                {{--											<input type="radio" name="sub_left" id="inlineCssRadio3x" value="1" @if ($data->status_show_menu_left == 1) checked @endif/> --}}
                                {{--											<label for="inlineCssRadio3x">มี</label> --}}
                                {{--										</div> --}}
                                {{--										<div class="radio radio-css radio-inline"> --}}
                                {{--											<input type="radio" name="sub_left" id="inlineCssRadio4x" value="0" @if ($data->status_show_menu_left == 0) checked @endif/> --}}
                                {{--											<label for="inlineCssRadio4x">ไม่มี</label> --}}
                                {{--										</div> --}}
                                {{--									</div> --}}
                                {{--								</div> --}}
                            </div>
                        </div>
                        <div class="form-group row mt-2 mb-1">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-lg btn-primary m-r-5"><i
                                        class="fas fa-lg fa-fw me-2 fa-save"></i>บันทึก
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('script_content')
    <script type="text/javascript">
        $(".colorpicker").spectrum({
            showInput: true
        });
    </script>
@endsection
