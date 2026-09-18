@extends('backend.master')
@section('style')
    <style type="text/css">
        .bg-low-yellow-100 {
            background-color: #fbf9ed !important;
        }

        .bg-low-info-100 {
            background-color: #f0fcff !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="card-body">
                        <h4 class="text-primary-600"><i class="far fa-lg fa-fw me-2 fa-pen-to-square"></i>ข้อมูล
                        </h4>
                        {{--                        <hr>--}}
                        <form action="{{route('base.query')}}" method="POST" name="base_query"
                              enctype="multipart/form-data" class="border border-default rounded-2 p-3 mb-3">
                            @csrf
                            <div class="form-group row mb-1 justify-content-center ">
                                <label class="col-form-label  col-lg-1 col-md-1 col-sm-2 col-1 text-center">ปี:</label>
                                <div class="col-lg-1 col-md-3 col-sm-4 col-4">
                                    <select class="form-select dynamic_input_type" id="year" name="year"
                                            data-dependent="type_document_id">
                                        @if(!empty($years ))
                                            @foreach($years as $year)
                                                <option value="{{($year->year-543)}}"
                                                        @if(($year->year-543) == $title_date['year']) selected @endif >{{$year->year}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                                    <select class="form-select dynamic_input_type" id="month" name="month"
                                            data-dependent="type_document_id">
                                        @php($array_thai_month = array(
                                               "1" => "มกราคม",
                                                "2" => "กุมภาพันธ์",
                                                "3" => "มีนาคม",
                                                "4" => "เมษายน",
                                                "5" => "พฤษภาคม",
                                                "6" => "มิถุนายน",
                                                "7" => "กรกฎาคม",
                                                "8" => "สิงหาคม",
                                                "9" => "กันยายน",
                                                "10" => "ตุลาคม",
                                                "11" => "พฤศจิกายน",
                                                "12" => "ธันวาคม",
                                            ))
                                        @foreach($array_thai_month as $i => $row)
                                            <option value="{{$i}}"
                                                    @if($row == $title_date['month_name']) selected @endif>{{$row}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1 justify-content-center">
                                <label class="col-lg-1 col-md-4 col-sm-3 col-10 col-form-label text-center"
                                       for="name">สถานที่ : </label>
                                {{--                                <input type="hidden" value="{{$department->id}}">--}}
                                <div class="col-lg-1 col-md-4 col-sm-4 col-10 ">
                                    <select class="form-select dynamic_input_form" id="main_statistics_id"
                                            name="location_id">
                                        @foreach($location as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-4 col-10 ">
                                    <select class="form-select dynamic_input_form" id="main_statistics_id"
                                            name="department_id">
                                        @foreach($department as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1 justify-content-center hide">
                                <label class="col-lg-2 col-md-2 col-sm-3 col-6 col-form-label text-center"
                                       for="name">ประเภทข้อมูล :</label>
                                <div class="col-lg-3 col-md-3 col-9 pt-2 ">
                                    @foreach($data_main as $row)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                   id="inlineRadio{{$row->id}}"
                                                   name="main_id" value="{{$row->id}}">
                                            <label class="form-check-label"
                                                   for="inlineRadio{{$row->id}}">{{$row->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row my-1 justify-content-center ">
                                <div class="col-md-6 col-sm-6 text-center">
                                    <button type="submit" class="btn btn-lg btn-primary float-right">ดูรายงาน
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="p-2 text-center">
                        <h4>บันทึกข้อมูลการใช้ไฟฟ้าและน้ำประปารายวัน</h4>
                        <h4>
                            ของ <span class="text-blue-500">{{$title_at['my_department']->name}}</span>
                            ประจำเดือน <span
                                class="text-blue-500">{{$title_date['month_name']}} {{$title_date['year']}}</span>
                        </h4>
                        <a href="{{route('base.data.month.pdf', [($title_date['year']-543), $title_date['month_number'], $title_at['my_location']->id, $title_at['my_department']->id])}}"
                           class="btn btn-outline-danger" target="_blank"><i
                                class="far fa-lg fa-fw me-2 fa-file-pdf"></i>ออกรายงาน</a>
                    </div>
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="bg-default">

                        <tr class="text-center align-content-center">
                            <th colspan="2">วันที่บันทึก</th>
                            <th colspan="4" class="bg-yellow-600">ไฟฟ้า</th>
                            <th colspan="3" class="bg-info-100">น้ำประปา</th>
                            <th rowspan="2">จำนวนคนที่เข้าใช้บริการ</th>
                        </tr>
                        <tr class="text-center">
                            <th>วัน</th>
                            <th>ที่</th>
                            <th class="bg-yellow-600">เวลาที่บันทึก</th>
                            <th class="bg-yellow-600">เลขมิเตอร์ที่อ่าน</th>
                            <th class="bg-yellow-600">หน่วยที่ใช้/วัน</th>
                            <th class="bg-yellow-600">ค่า CT</th>
                            <th class="bg-info-100">เวลาที่บันทึก</th>
                            <th class="bg-info-100">เลขมิเตอร์ที่อ่าน</th>
                            <th class="bg-info-100">หน่วยที่ใช้/วัน</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($array_data['th'] as $key => $row)
                            <tr class="text-center {{$now == $array_data['number'][$key] ? 'bg-red-100' : ''}}">
                                <td>{{$array_data['name'][$key]}} {{$array_data['number'][$key]}}</td>
                                <td>{{$row}}</td>
                                <td class="text-blue-900 {{$now == $array_data['number'][$key] ? 'bg-red-100' : 'bg-low-yellow-100'}}">
                                    {{(!empty($array_data['electricity'][$key]) ? $array_data['electricity'][$key]->time_data : '-')}}
                                </td>
                                <td class="text-blue-900 {{$now == $array_data['number'][$key] ? 'bg-red-100' : 'bg-low-yellow-100'}}">
                                    {{(!empty($array_data['electricity'][$key]) ? $array_data['electricity'][$key]->number_miter : '-')}}
                                </td>
                                <td class="text-blue-900 fw-bold {{$now == $array_data['number'][$key] ? 'bg-red-100' : 'bg-low-yellow-100'}}">
                                    {{(!empty($array_data['electricity'][$key]) ? $array_data['electricity'][$key]->value_total : '-')}}
                                </td>
                                <td class="text-blue-900 {{$now == $array_data['number'][$key] ? 'bg-red-100' : 'bg-low-yellow-100'}}">
                                    {{(!empty($array_data['electricity'][$key]) ? $array_data['electricity'][$key]->value_ct : '-')}}
                                </td>
                                <td class="text-info-800 {{$now == $array_data['number'][$key] ? 'bg-red-100' : 'bg-low-info-100'}}">
                                    {{(!empty($array_data['water'][$key]) ? $array_data['water'][$key]->time_data : '-')}}
                                </td>
                                <td class="text-info-800 {{$now == $array_data['number'][$key] ? 'bg-red-100' : 'bg-low-info-100'}}">
                                    {{(!empty($array_data['water'][$key]) ? $array_data['water'][$key]->number_miter : '-')}}
                                </td>
                                <td class="text-info-800 fw-bold {{$now == $array_data['number'][$key] ? 'bg-red-100' : 'bg-low-info-100'}}">
                                    {{(!empty($array_data['water'][$key]) ? $array_data['water'][$key]->value_total : '-')}}
                                </td>
                                <td>
                                    <a href="#modal-dialog" class="btn btn-success" data-bs-toggle="modal">ตรวจสอบ</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfooter>
                            <tr class="fw-bold text-center bg-gray-300">
                                <td colspan="2">รวม</td>
                                @foreach( $array_sum_data as $row)
                                    <td colspan="2">{{$row->name}} (จำนวน {{$row->sum_day}} วัน)</td>
                                    <td>{{$row->sum_value}}</td>
                                    @if(!empty($row->sum_ct))
                                        <td>{{$row->sum_ct}}</td>
                                    @endif
                                @endforeach
                                <td></td>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ตรวจสอบข้อมูล</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="{{route('base.insert')}}" method="POST" name="summernote_form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked"
                                       name="status">
                                <label class="form-check-label" for="flexCheckChecked">
                                    ยืนยันการกรอกข้อมูล
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputEmail1">จำนวนผู้เข้าใช้บริการ</label>
                            <input class="form-control" type="number" id="exampleInputEmail1"
                                   placeholder="จำนวนคน">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="exampleInputEmail1">หมายเหตุ</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        {{--                            <h4>เพิ่มกิจกรรม</h4>--}}
                        {{--                            <div class="mb-3">--}}
                        {{--                                <label class="form-label" for="exampleInputEmail1">กิจกรรม</label>--}}
                        {{--                                <input class="form-control" type="text" id="exampleInputEmail1" placeholder=" ">--}}
                        {{--                            </div>--}}
                        {{--                            <div class="mb-3">--}}
                        {{--                                <label class="form-label" for="exampleInputEmail1">ห้อง</label>--}}
                        {{--                                <input class="form-control" type="text" id="exampleInputEmail1" placeholder=" ">--}}
                        {{--                            </div>--}}
                        {{--                            <div class="mb-3">--}}
                        {{--                                <label class="form-label" for="exampleInputEmail1">จำนวนคน</label>--}}
                        {{--                                <input class="form-control" type="number" id="exampleInputEmail1" placeholder=" ">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">ปิดหน้าต่าง</a>
                            <a href="javascript:;" class="btn btn-success">บันทึก</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script_content')
    <script>
        {{--$(document).on("click", ".btn-change-status", function () {--}}
        {{--    var course_id = $(this).data('course');--}}
        {{--    var course_member_id = $(this).data('course_member');--}}
        {{--    console.log(course_id);--}}
        {{--    console.log(course_member_id);--}}

        {{--    $.ajax({--}}
        {{--        type: 'POST',--}}
        {{--        url: "{{ route('course_member.status') }}",--}}
        {{--        data: {course_id: course_id, course_member_id: course_member_id},--}}
        {{--        success: function (data) {--}}
        {{--            console.log(data);--}}
        {{--            $('.show-form-course-status').html(data);--}}
        {{--            $('#Modal-show-div-course-status').modal('show');--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection
