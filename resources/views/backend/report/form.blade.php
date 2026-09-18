@php
    $id = '';
    $img_doc = asset('images/images.png');
    $name = '';
    $filename = '';
    $link = '';
    $detail = '';
    $type_document_id = '';
    $category_document_id = '';
    $title_document_id = '';
    $sub_title_document_id = '';
    $ordinal = '';
    $status_use = 1;
    $multifilename = array();
   if(!empty($document)){
        $id = $document->id;
        $img_doc = !empty($document->thumbnail) ? asset('storage/document_img/'.$document->thumbnail) : $img_doc;
        $name = $document->name;
        $filename = $document->file;
        $link = $document->link;
        $detail = $document->detail;

        $type_document_id = $document->type_document_id;
        $category_document_id = $document->category_document_id;
        $title_document_id = $document->title_document_id;
        $sub_title_document_id = $document->sub_title_document_id;

        $ordinal = $document->ordinal;
        $status_use = $document->status_use;

         if(!empty($sub_document[0])){
             $multifilename = $sub_document;
         }
   }

@endphp

<form action="{{route('document.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data">
    @csrf
    <input class="form-control hide" type="text" id="member_id" name="member_id"
           placeholder="" value="{{session()->get('user.member_id')}}"/>
    <input class="form-control hide" type="text" id="document_id" name="document_id" placeholder="" value="{{$id}}"/>
    <input class="form-control hide" type="text" id="mode" name="mode" placeholder="" value="green"/>
    <div class="form-group row mb-1">
        <div class="col-md-4 col-sm-4">
            <center>
                <label class="col-md-3 col-sm-3 col-form-label">รูป</label>
                <div class="col-md-9 col-sm-9 ">
                    <img src="{{$img_doc}}" class="avatar img-thumbnail" alt="avatar"
                         style="height: 200px; width: auto;">
                    <input class="form-control file-upload" type="file" id="image_name"
                           name="image_name" accept="image/png, image/gif, image/jpeg"/>
                </div>
            </center>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="form-group row mb-1">
                <label class="col-md-2 col-sm-2 col-form-label" for="name">ชื่อเอกสาร :</label>
                <div class="col-md-10 col-sm-10">
                    <input class="form-control" type="text" id="name" name="name" value="{{$name}}"
                           placeholder=""/>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">file :</label>
                <div class="col-md-10 col-sm-10">
                    @if(!empty($filename))
                        <a href="{{asset('/storage/document/'.$filename)}}" target="_blank">{{$filename}}</a>
                    @endif
                    <input class="form-control" type="file" id="filename" name="filename"
                           placeholder=""/>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">link :</label>
                <div class="col-md-10 col-sm-10">
                    <input class="form-control" type="text" id="link" name="link" value="{{$link}}"
                           placeholder=""/>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">รายละเอียดเพิ่มเติม:</label>
                <div class="col-md-10 col-sm-10">
                    <textarea class="form-control" rows="3" name="detail">{{$detail}}</textarea>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label class="col-form-label col-md-2">ปี:</label>
                <div class="col-md-4">
                    <select class="form-select dynamic_input_type" id="year" name="year"
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
                <label class="col-form-label col-md-2">หมวดที่:</label>
                <div class="col-md-6">
                    <input class="hide" type="text" name="select_value_type" value="{{$type_document_id}}">
                    <select class="form-select type_document_id dynamic_input_category"
                            id="type_document_id" name="type_document_id"
                            data-dependent="category_document_id">
                        {{-- <option value="0">เลือกประเภท..</option> --}}
                        @if(!empty($type_document ))
                            @foreach($type_document as $row)
                                <option
                                    value="{{$row->id}}" {{($type_document_id == $row->id) ? 'selected' : ''}}>{{$row->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label class="col-form-label col-md-2">ตัวชี้วัด:</label>
                <div class="col-md-6">
                    <input class="hide" type="text" name="select_value_category" value="{{$category_document_id}}">
                    <select class="form-select category_document_id dynamic_input_title"
                            id="category_document_id" name="category_document_id"
                            data-dependent="title_document_id">
                        <option value="0">เลือกหมวดหมู่..</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">หัวข้อ :</label>
                <div class="col-md-6">
                    <input class="hide" type="text" name="select_value_title" value="{{$title_document_id}}">
                    <select class="form-select title_document_id dynamic_input_Subtitle"
                            id="title_document_id" name="title_document_id"
                            data-dependent="sub_title_document_id">
                        <option value="0">เลือกหัวข้อ..</option>
                    </select>
                </div>

            </div>
            <div class="form-group row mb-1">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">หัวข้อย่อย :</label>
                <div class="col-md-6">
                    <input class="hide" type="text" name="select_value_subtitle" value="{{$sub_title_document_id}}">
                    <select class="form-select sub_title_document_id"
                            id="sub_title_document_id" name="sub_title_document_id">
                        <option value="0">เลือกหัวข้อย่อย..</option>
                    </select>
                </div>
            </div>
            {{--                        <div class="form-group row mb-1">--}}
            {{--                                <label class="col-md-2 col-sm-2 col-form-label" for="file">ผู้ส่ง :</label>--}}
            {{--                                <div class="col-md-2">--}}
            {{--                                        {{ Form::select('sent_office_id',App\Sent_office::all()->pluck('name','id'), null, ['placeholder' => 'เลือกผู้ส่ง...','class'=>'form-control']) }}--}}
            {{--                                </div>--}}
            {{--                                <div class="col-md-2 col-sm-2">--}}
            {{--                                        <a href="#modal-dialog" class="btn btn-sm btn-success"--}}
            {{--                                           data-toggle="modal"--}}
            {{--                                           data-target=".bd-example-modal-lg">เพิ่มผู้ส่ง</a>--}}
            {{--                                </div>--}}

            {{--                                <label class="col-md-2 col-sm-3 col-form-label" for="file">เลขที่หนังสือ--}}
            {{--                                    :</label>--}}
            {{--                                <div class="col-md-4 col-sm-4">--}}
            {{--                                        <input class="form-control" type="text" id="number_document"--}}
            {{--                                               name="number_document" placeholder=""--}}
            {{--                                               />--}}
            {{--                                </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="form-group row mb-1">--}}
            {{--                                <label class="col-md-2 col-sm-2 col-form-label" for="file">วันที่ประกาศ--}}
            {{--                                    :</label>--}}
            {{--                                <div class="col-md-4 col-sm-4">--}}
            {{--                                        <input class="form-control" type="text"--}}
            {{--                                               data-provide="datepicker" data-date-language="th-th"--}}
            {{--                                               name="date_announcement">--}}
            {{--                                </div>--}}
            {{--                                <label class="col-form-label col-md-2">ชั้นความเร็ว:</label>--}}
            {{--                                <div class="col-md-4">--}}
            {{--                                        {{ Form::select('Level_document_id', App\Level_document::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกชั้นความเร็ว...','class'=>'form-control']) }}--}}
            {{--                                </div>--}}
            {{--                        </div>--}}
            <div class="form-group row mb-1">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">ลำดับการแสดง
                    :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="number" id="ordinal" name="ordinal" value="{{$ordinal}}"
                           placeholder="">
                </div>
            </div>
            <div class="form-group row mb-1">

                <label class="col-md-2 col-sm-2 col-form-label">สถานะ :</label>
                <div class="col-md-4 col-sm-4 ">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="status_use" id="inlineCssRadio1x" class="form-check-input"
                               value="1" @if($status_use == 1) checked @endif/>
                        <label for="inlineCssRadio1x">ใช้งาน</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="status_use" id="inlineCssRadio2x" class="form-check-input"
                               value="0" @if($status_use == 0) checked @endif/>
                        <label for="inlineCssRadio2x">ยกเลิก</label>
                    </div>
                </div>
            </div>

            {{--            <div class="form-group row mb-1">--}}
            {{--                <div class="col-md-6 col-sm-6 text-center">--}}
            {{--                    <button type="submit" class="btn btn-lg btn-primary float-right">บันทึก--}}
            {{--                    </button>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12 col-sm-12">
            <div class="form-group row ">
                <label class="col-md-2 col-sm-2 col-form-label text-end font-weight-bold"
                       for="file">เอกสารร่วม:</label>
                <div class="col-md-10 col-sm-10">

                    <div class="card border-warning text-warning">
                        <div class="card-body div-multifile">
                            <div class="row ">
                                <label class="col-md-1 col-sm-1 col-form-label" for="name">ชื่อเอกสาร:</label>
                                <div class="col-md-5 col-sm-5">
                                    <input class="form-control" type="text" name="multiname[]"
                                           placeholder=""/>
                                </div>
                                <label class="col-md-1 col-sm-1 col-form-label text-end"
                                       for="file">file :</label>
                                <div class="col-md-5 col-sm-5 ">
                                    <div class="row ">
                                        <div class="col-md-10 col-sm-10">
                                            <input class="form-control" type="file"
                                                   id="multifilename"
                                                   name="multifilename[]" placeholder=""
                                            />
                                        </div>
                                        <div class="col-md-1 col-sm-1">
                                            <button type="button" name="add" id="add_file"
                                                    class="btn btn-info add_file">
                                                <i class="fas fa-lg fa-fw  fa-plus-circle "></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="input-file" value="1">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-6 col-sm-6 py-2">
                    <button type="submit" class="btn btn-lg btn-primary "><i
                            class="fas fa-lg fa-fw me-2 fa-floppy-disk"></i>บันทึก
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@if(!empty($multifilename[0]))
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
                @foreach($multifilename as $key =>$data)
                    <tr>
                        <td align="center">{{($key+1)}}</td>
                        <td>
                            {{--                            <a href="{{asset('storage/sub_document/'.$id.'/'.$data->file)}}" target="_blank">{{$data->name}}</a>--}}
                            {{$data->name}}
                        </td>
                        <td align="center">
                            <a href="{{asset('storage/sub_document/'.$id.'/'.$data->file)}}" target="_blank">
                                {!! $data->setfile()['icon'] !!}
                                {{--                                <span class="fs-6" style="color :{{ $data->setfile()['color']}}">--}}
                                {{--                                    {{$data->file}}--}}
                                {{--                                </span>--}}
                            </a>
                        </td>
                        <td align="center">
                            <a class="btn btn-red btn-sm"
                               href="{{route('sub_document.delete',[$data->id])}}"
                               role="button"><i class="fas fa-lg fa-fw fa-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
