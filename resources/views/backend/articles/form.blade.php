@php
    $id = '';
    $img_doc = asset('images/images.png');
    $ordinal = '';
    $status_use = 1;
    $image_name = '';
    $title = '';
    $date_start = '';
    $date_end = '';
    $place = '';
    $group_people_id = '';
    $detail = '';
    $people_id = '';

    if (!empty($article)) {
        $id = $article->id;
        $img_doc = !empty($article->img) ? asset('storage/article_img/' . $article->img) : $img_doc;
        $title = $article->title;
        $date_start = $article->date_start;
        $date_end = $article->date_end;
        $place = $article->place;
        $group_people_id = $article->group_people_id;
        $detail = $article->detail;
        $data_gallery = $article->gallery();
        $people_id = $article->people_id;
    }

@endphp

<form action="{{ route('article.insert') }}" method="POST" name="summernote_form" enctype="multipart/form-data">
    @csrf
    <input class="form-control hide" type="text" id="member_id" name="member_id" placeholder=""
        value="{{ session()->get('user.member_id') }}" />
    <input class="form-control hide" type="text" id="article_id" name="article_id" placeholder=""
        value="{{ $id }}" />
    <input class="form-control hide" type="text" id="mode_article_id" name="mode_article_id" placeholder=""
        value="{{ $mode_article->id }}" />
    <input class="form-control hide" type="text" id="mode" name="mode" placeholder="" value="article" />

    <div class="form-group row mb-1">
        @if (!empty($mode_article->status_use_thumbnail))
            <div class="col-md-4 col-sm-4 mb-3">
                <center>
                    <label class="col-md-3 col-sm-3 form-label mb-1">รูปหัวข้อ</label>
                    <div class="col-md-10 col-sm-10 ">
                        <img src="{{ $img_doc }}" class="img-thumbnail preview" id="preview_image_name"
                            style="height: 100%; width: auto;">
                        <input class="form-control file-upload" type="file" name="image_name"
                            data-target="#preview_image_name" accept="image/png, image/gif, image/jpeg">
                    </div>
                </center>
            </div>
        @endif
        <div class="{{ !empty($mode_article->status_use_thumbnail) ? 'col-md-8 col-sm-8' : 'col-md-12 col-sm-12' }} ">
            @if (!empty($mode_article->status_use_title))
                <div class="mb-2">
                    <label for="title" class="form-label">หัวเรื่อง (Title)</label>
                    <input type="text" class="form-control" id="title" name="title" maxlength="250"
                        value="{{ $title }}" placeholder="กรอกหัวเรื่อง">
                </div>
            @endif
            @if (!empty($mode_article->status_use_date_start) || !empty($mode_article->status_use_date_end))
                <div class="row mb-2">
                    @if (!empty($mode_article->status_use_date_start))
                        <div class="col-6">
                            <label for="date_start" class="form-label">วันที่เริ่มต้น (Start Date)</label>
                            <input type="date" class="form-control" id="date_start" name="date_start"
                                value="{{ $date_start }}">
                        </div>
                    @endif
                    @if (!empty($mode_article->status_use_date_end))
                        <div class="col-6">
                            <label for="date_end" class="form-label">วันที่สิ้นสุด (End Date)</label>
                            <input type="date" class="form-control" id="date_end" name="date_end"
                                value="{{ $date_end }}">
                        </div>
                    @endif
                </div>
            @endif
            @if (!empty($mode_article->status_use_place))
                <div class="mb-2">
                    <label for="place" class="form-label">สถานที่ (Place)</label>
                    <input type="text" class="form-control" id="place" name="place" placeholder="ระบุสถานที่"
                        value="{{ $place }}">
                </div>
            @endif

            <div class="row mb-2">
                <div class="col-md-5">
                    <label class="form-label ">แผนก :</label>
                    <select class="form-select group_people_id " id="group_people_id" name="group_people_id">
                        <option value="">ไม่ระบุ</option>
                        @if (!empty($groups))
                            @foreach ($groups as $row)
                                <option value="{{ $row->id }}"
                                    {{ $group_people_id == $row->id ? 'selected' : '' }}>{{ $row->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-7">
                    <label class="form-label ">ผู้ให้ข้อมูล :</label>
                    <select class="form-select people_id " id="people_id" name="people_id">
                        <option value="">ไม่ระบุ</option>
                        @if (!empty($people))
                            @foreach ($people as $row)
                                <option value="{{ $row->id }}" {{ $people_id == $row->id ? 'selected' : '' }}>
                                    {{ $row->prefix() }}{{ $row->name }} {{ $row->lastname }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        @if (!empty($mode_article->status_use_detail))
            <div class="mb-3">
                <label for="detail" class="form-label">รายละเอียด (Detail)</label>
                {{--                <textarea class="form-control" id="detail" name="detail" rows="5" --}}
                {{--                          placeholder="รายละเอียดกิจกรรม"></textarea> --}}
                <textarea class="summernote" name="detail" id="detail">{{ $detail }}</textarea>
            </div>
        @endif
        <div class="mb-3 hide">
            <label for="ordinal" class="form-label">ลำดับ (Ordinal)</label>
            <input type="number" class="form-control" id="ordinal" name="ordinal" placeholder="กรอกลำดับตัวเลข">
        </div>
        @if (!empty($mode_article->status_use_gallery))
            <div class="form-group">
                <label class="col-form-label">รูปกิจกรรม
                    :</label> <small>รองรับไฟล์ (jpg-jpeg-gif-png) ขนาดไม่เกิน 5MB จำนวน 4-8
                    รูป </small>
                <input type="file" class="form-control mt-2" id="gallery-photo-add" name="images[]"
                    accept="image/jpeg,image/png,image/gif" multiple>
                <div class="gallery d-flex flex-wrap gap-2 mt-3"></div>
            </div>
            @if (!empty($data_gallery[0]))
                <hr>
                <div class="form-group " align="center">
                    <p>จัดการูปกิจกรรม </p>
                </div><br>

                <div class="row m-t-2">
                    @foreach ($data_gallery as $data)
                        {{--                                        @if ($data->type_status == 'gallery') --}}
                        <div class="col-sm-2 text-center">
                            <div class="mb-2"
                                style="border: 1px solid #ccc!important; border-radius: 10px; padding: 5px;">
                                <!-- <a  href="/" data-toggle="lightbox" data-gallery="example-gallery" class="col-lg-3 col-md-4 col-6 my-3 wrap-pic-w hov1 trans-03">
                                        <img src="/" class="img-fluid card"/>
                                    </a> -->
                                <img src="{{ asset('storage/gallerys/' . $data->folder_name . '/' . $data->file) }}"
                                    class="img-fluid card" />
                                <a class="btn btn-red" href="{{ route('article.gallery.delete', [$data->id]) }}"
                                    role="button">ลบ</a>
                            </div>
                        </div>
                        {{--                                        @endif --}}
                    @endforeach
                </div>
            @endif
        @endif

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
                <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-lg btn-primary ">
                    <i class="fas fa-lg fa-fw me-2 fa-floppy-disk"></i>บันทึก
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
