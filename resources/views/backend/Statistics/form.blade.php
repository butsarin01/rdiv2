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

<form action="{{route('statistics.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data">
    @csrf
    <input class="form-control hide" type="text" id="member_id" name="member_id"
           placeholder="" value="{{session()->get('user.member_id')}}"/>
    <input class="form-control hide" type="text" id="document_id" name="id" placeholder="" value="{{$id}}"/>
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
                <label class="col-lg-3 col-md-4 col-sm-3 col-4 col-form-label bg-cyan-100 py-2 rounded-2 d-flex align-items-center">
                    ประจำวันที่ (วัน/เดือน/ปี) :
                </label>
                <div class="col-lg-3 col-md-4 col-sm-4 col-5 bg-cyan-100 py-2 rounded-2">
                    <input type="text" class="form-control input_date_autoclose"
                           data-provide="datepicker"
                           data-date-language="th-th" name="date_data"
                           placeholder="วัน/เดือน/ปี" value="" required="">
                </div>
        </div>
        <div class="form-group row mb-1 justify-content-center">
            <label class="col-lg-3 col-md-4 col-sm-3 col-4 col-form-label" for="name">ประเภทข้อมูล :</label>
            <div class="col-lg-3 col-md-4 col-sm-4 col-5">
                <select class="form-select dynamic_input_form" id="main_statistics_id" name="main_statistics_id"
                        data-dependent="type_document_id">
                    @foreach($data_main as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="div-show-form"></div>

        {{--        <div class="form-group row mb-1 justify-content-center div-number_employee">--}}
        {{--            <label class="col-lg-2 col-md-4 col-sm-3 col-4 col-form-label" for="name">จำนวนพนักงาน (คน) :</label>--}}
        {{--            <div class="col-lg-3 col-md-4 col-sm-4 col-5">--}}
        {{--                <input class="form-control" type="text" id="number_employee" name="number_employee" value=""--}}
        {{--                       placeholder=""/>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="form-group row mb-1 justify-content-center div-value_month">--}}
        {{--            <label class="col-lg-2 col-md-4 col-sm-3 col-4 col-form-label" for="name">ปริมาณการใช้..../เดือน :</label>--}}
        {{--            <div class="col-lg-3 col-md-4 col-sm-4 col-5">--}}
        {{--                <input class="form-control" type="text" id="value_month" name="value_month" value=""--}}
        {{--                       placeholder=""/>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="form-group row mb-1 justify-content-center div-cost_month">--}}
        {{--            <label class="col-lg-2 col-md-4 col-sm-3 col-4 col-form-label" for="name">ค่าใช้จ่าย/เดือน (บาท) :</label>--}}
        {{--            <div class="col-lg-3 col-md-4 col-sm-4 col-5">--}}
        {{--                <input class="form-control" type="text" id="cost_month" name="cost_month" value=""--}}
        {{--                       placeholder=""/>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="form-group row mb-1 justify-content-center div-value_employee">--}}
        {{--            <label class="col-lg-2 col-md-4 col-sm-3 col-4 col-form-label" for="name">ปริมาณการใช้ต่อพนักงาน :</label>--}}
        {{--            <div class="col-lg-3 col-md-4 col-sm-4 col-5">--}}
        {{--                <input class="form-control" type="text" id="value_employee" name="value_employee" value=""--}}
        {{--                       placeholder=""/>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="form-group row mb-1 justify-content-center ">
            <div class="col-md-6 col-sm-6 text-center">
                <button type="submit" class="btn btn-lg btn-primary float-right">บันทึก
                </button>
            </div>
        </div>
    </div>
    <div class="row hide">
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
@section('script_content')
    <script type="text/javascript">
        $(".input_date_autoclose").datepicker({
            todayHighlight: true,
            autoclose: true,
        });
        $.ajaxSetup({
            beforeSend: function (xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });

        var main_id = $('#main_statistics_id option:selected').val();
        dynamic_select(main_id);

        $(document).on("change keyup", ".value_month", function () {
            var arr = [];
            arr = $.map($(".value_month"), function (select) {
                return $(select).val();
            });
            var total = 0;
            for (var i = 0; i < arr.length; i++) {
                total += parseFloat(arr[i]) << 0;
                console.log(arr[i]+'----'+'+++++++'+total);
            }

            // var num11 = parseFloat(total);
            var total11 = total.toFixed(2);

            $('#value_total_month').val(total11);
        });

        $(document).on("change keyup", "#number_employee", function () {
            cal_value_of_emp()
        });

        $(document).on("change keyup", "#value_total_month", function () {
            cal_value_of_emp()
        });

        function cal_value_of_emp() {
            var value_total = $('#value_total_month').val();
            var num_emp = $('#number_employee').val();
            var total1 = value_total / num_emp;
            console.log(total1);
            var num = parseFloat(total1);
            var total = num.toFixed(2);
            $('#value_employee').val(total);
        }

        $(document).on("change", ".dynamic_input_form", function () {
            var main_id = $('#main_statistics_id option:selected').val();
            dynamic_select(main_id);
        });

        function dynamic_select(main_id) {
            $.ajax({
                url: "{{route('input_form.fetch')}}",
                method: "POST",
                data: {main_id: main_id},
                success: function (result) {
                    $('.div-show-form').html(result);
                }
            });
        }
    </script>
@endsection
