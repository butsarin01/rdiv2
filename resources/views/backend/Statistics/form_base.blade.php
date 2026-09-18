@extends('backend.master')
@section('content')
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
        $status_use = '';
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
    <div class="row">
        <div class="col-xl-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="card-body">
                        <h4 class="text-primary-600"><i class="far fa-lg fa-fw me-2 fa-pen-to-square"></i>เพิ่มข้อมูล
                        </h4>
                        <hr>

                        <form action="{{route('base.insert')}}" method="POST" name="summernote_form"
                              enctype="multipart/form-data">
                            @csrf
                            <input class="form-control hide" type="text" id="member_id" name="member_id"
                                   placeholder="" value="{{session()->get('user.member_id')}}"/>
                            <input class="form-control hide" type="text" id="document_id" name="id" placeholder=""
                                   value="{{$id}}"/>
                            <div class="form-group row mb-1 justify-content-center">

                                {{--        <div class="form-group row mb-1 justify-content-center">--}}
                                {{--            <label class="col-form-label  col-lg-1 col-md-1 col-sm-2 col-2">ปี:</label>--}}
                                {{--            <div class="col-lg-2 col-md-3 col-sm-4 col-4">--}}
                                {{--                <select class="form-select dynamic_input_type" id="year" name="year"--}}
                                {{--                        data-dependent="type_document_id">--}}
                                {{--                    @if(!empty($years ))--}}
                                {{--                        @foreach($years as $year)--}}
                                {{--                            <option value="{{$year->year}}">{{$year->year}}</option>--}}
                                {{--                        @endforeach--}}
                                {{--                    @endif--}}
                                {{--                </select>--}}
                                {{--            </div>--}}
                                {{--            <div class="col-lg-2 col-md-3 col-sm-4 col-4">--}}
                                {{--                <select class="form-select dynamic_input_type" id="month" name="month"--}}
                                {{--                        data-dependent="type_document_id">--}}
                                {{--                    @php($array_thai_month = array(--}}
                                {{--                           "1" => "มกราคม",--}}
                                {{--                            "2" => "กุมภาพันธ์",--}}
                                {{--                            "3" => "มีนาคม",--}}
                                {{--                            "4" => "เมษายน",--}}
                                {{--                            "5" => "พฤษภาคม",--}}
                                {{--                            "6" => "มิถุนายน",--}}
                                {{--                            "7" => "กรกฎาคม",--}}
                                {{--                            "8" => "สิงหาคม",--}}
                                {{--                            "9" => "กันยายน",--}}
                                {{--                            "10" => "ตุลาคม",--}}
                                {{--                            "11" => "พฤศจิกายน",--}}
                                {{--                            "12" => "ธันวาคม",--}}
                                {{--                        ))--}}
                                {{--                    @foreach($array_thai_month as $i => $row)--}}
                                {{--                        <option value="{{$i}}">{{$row}}</option>--}}
                                {{--                    @endforeach--}}
                                {{--                </select>--}}
                                {{--            </div>--}}
                                {{--        </div>--}}

                                <div class="form-group row mb-1 justify-content-center ">
                                    <label
                                        class="col-lg-3 col-md-4 col-sm-4 col-8 col-form-label bg-cyan-100 py-2 rounded-2 text-center">
                                        ประจำวันที่ (วัน/เดือน/ปี)
                                    </label>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-9 bg-cyan-100 py-2 rounded-2">
                                        <input type="text" class="form-control input_date_autoclose"
                                               data-provide="datepicker"
                                               data-date-language="th-th1" name="date_data"
                                               placeholder="วัน/เดือน/ปี" value="{{$today}}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-1 justify-content-center">
                                    <label class="col-lg-3 col-md-4 col-sm-3 col-10 col-form-label text-center"
                                           for="name">สถานที่ : {{$department->name}}</label>
                                    <input type="hidden" name="deperment_id" value="{{$department->id}}">
                                    <input type="hidden" name="location_id" value="{{$location->id}}">
                                    {{--                                    <div class="col-lg-3 col-md-4 col-sm-4 col-10 text-center">--}}
                                    {{--                                        <select class="form-select dynamic_input_form" id="main_statistics_id"--}}
                                    {{--                                                name="department_id"--}}
                                    {{--                                                >--}}
                                    {{--                                            @foreach($department as $row)--}}
                                    {{--                                                <option value="{{$row->id}}">{{$row->name}}</option>--}}
                                    {{--                                            @endforeach--}}
                                    {{--                                        </select>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="form-group row mb-1 justify-content-center">
                                    <label class="col-lg-2 col-md-2 col-sm-3 col-6 col-form-label text-center"
                                           for="name">ประเภทข้อมูล :</label>
                                    <div class="col-lg-3 col-md-3 col-9 pt-2 text-center">
                                        @foreach($data_main as $row)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                       id="inlineRadio{{$row->id}}"
                                                       name="main_id" value="{{$row->id}}" required>
                                                <label class="form-check-label"
                                                       for="inlineRadio{{$row->id}}">{{$row->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row mb-1 justify-content-center div-number_employee">
                                    <label class="col-lg-2 col-md-2 col-sm-3 col-6 col-form-label text-center"
                                           for="name">เลขมิเตอร์ :</label>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-10 text-center">
                                        <input class="form-control" type="text" id="number_employee"
                                               name="number_miter" required
                                               placeholder=""/>
                                    </div>

                                    <div class="form-group row my-1 justify-content-center ">
                                        <div class="col-md-6 col-sm-6 text-center">
                                            <button type="submit" class="btn btn-lg btn-primary float-right">บันทึก
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <h4 class="text-green-600"><i class="far fa-lg fa-fw me-2 fa-pen-to-square"></i>ข้อมูลที่บันทึกรายวัน
                    </h4>
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th>ประเภท</th>
                            <th>เลขมิเตอร์</th>
                            <th>จำนวนที่ใช้</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($check_data[0]))
                            @foreach($check_data as $row)
                                <tr class="text-center">
                                    <td>{{$row->type_main()->name}}</td>
                                    <td>{{$row->number_miter}}</td>
                                    <td>{{$row->value_total}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">ไม่พบข้อมูล</td>
                            </tr>
                        @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
