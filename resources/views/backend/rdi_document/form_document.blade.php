@php
    $doc_id = '';
    $number = '';
    $string_number = '';
    $date_register = '';
    $office_from = '';
    $office_to = '';
    $title = '';
    $account_active = '';
    $year = isset($selectedYear) && preg_match('/^[0-9]{4}$/', $selectedYear) ? $selectedYear : '';
    $comment = '';

    if(!empty($data_doc)){
        $doc_id = $data_doc->id;
        $number = $data_doc->number;
        $string_number = $data_doc->string_number;
        $date_register = $data_doc->date_register;
        $office_from = $data_doc->office_from;
        $office_to = $data_doc->office_to;
        $title = $data_doc->title;
        $account_active = $data_doc->account_active;
        $year = $data_doc->year;
        $comment = $data_doc->comment;
    }
@endphp
<h4>แบบบันทึกข้อมูล หนังสือออก ({{ $document_type === 1 ? 'ภายนอก' : 'ภายใน' }})</h4>
<form action="{{route('document_rdi.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="{{ $document_type }}">
    @if (isset($selectedYear))
        <p class="text-muted">กรอกช่อง “ที่” เช่น 0000/2569 เพื่อจัดรายการเข้าปี 2569</p>
    @else
        <input type="hidden" name="year" value="{{ $year ?: (date('Y') + 543) }}">
    @endif
    <input class="form-control hide" type="text" id="ref_id" name="ref_id" value="{{$doc_id}}"/>
    <div class="form-group row mb-2 justify-content-center">
        <div class="col-md-8 col-sm-8">
            <div class="form-group row mb-2">
                <label class="col-md-2 col-sm-3 col-form-label" for="file">เลขทะเบียนส่ง :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="text" id="number" name="number" value="{{$number}}"/>
                </div>

                <label class="col-md-2 col-sm-3 col-form-label" for="file">ที่ :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="text" id="string_number" name="string_number"
                           value="{{$string_number}}"/>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label class="col-md-2 col-sm-3 col-form-label" for="file">ลงวันที่ :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="date" id="date_register" name="date_register" value="{{$date_register}}"/>
                </div>

                <label class="col-md-2 col-sm-3 col-form-label" for="file">ประเภทหนังสือ :</label>
                <div class="col-md-3 col-sm-3 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineRadio1" name="type" value="1">
                        <label class="form-check-label" for="inlineRadio1">ภายนอก</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="customRadio2" name="type" value="2">
                        <label class="form-check-label" for="customRadio2">ภายใน</label>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-2">
                 <label class="col-md-2 col-sm-3 col-form-label" for="file">จาก :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="text" id="office_to" name="office_to"
                           value="{{$office_to}}"/>
                </div>

                <label class="col-md-2 col-sm-3 col-form-label" for="file">ถึง :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="text" id="office_from" name="office_from" value="{{$office_from}}"/>
                </div>

               
            </div>

            <div class="form-group row mb-2">
                <label class="col-md-2 col-sm-2 col-form-label" for="name">ชื่อเรื่อง :</label>
                <div class="col-md-10 col-sm-10">
                    <input class="form-control" type="text" id="title" name="title" value="{{$title}}"/>
                </div>
            </div>
            {{--            <div class="form-group row mb-2">--}}
            {{--                <label class="col-md-2 col-sm-2 col-form-label" for="file">file  :</label>--}}
            {{--                <div class="col-md-10 col-sm-10">--}}
            {{--                    <input class="form-control" type="file" id="filename" name="filename" placeholder="" />--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="form-group row mb-2">--}}
            {{--                <label class="col-md-2 col-sm-2 col-form-label" for="file">link  :</label>--}}
            {{--                <div class="col-md-10 col-sm-10">--}}
            {{--                    <input class="form-control" type="text" id="link" name="link" placeholder="" />--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <div class="form-group row mb-2">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">ผู้ปฏิบัติ :</label>
                <div class="col-md-6">
                    <input class="form-control" type="text" id="account_active" name="account_active" value="{{$account_active}}"/>

                </div>
            </div>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-6 col-sm-6 ">
            <button type="submit" class="btn btn-primary float-end">บันทึก
            </button>
        </div>
    </div>

</form>
