@php
    $ref_id = '';
    $year = '';
    $string_number = '';
    $title = '';
    $type = '';
    $budget = '';
    if(!empty($data_ref)){
        $ref_id = $data_ref->id;
        $year = $data_ref->year;
        $string_number = $data_ref->string_number;
        $title = $data_ref->title;
        $type = $data_ref->type;
        $budget = $data_ref->budget;
    }
@endphp
<h4>แบบบันทึกข้อมูล เลขอ้างอิงนากา</h4>
<form action="{{route('reference_naga.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data" >
    @csrf
    <input class="form-control hide" type="text" id="ref_id" name="ref_id"  value="{{$ref_id}}"/>
    <div class="form-group row m-b-5 justify-content-center">
        <div class="col-md-8 col-sm-8">
            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-3 col-form-label" for="file">ปีงบประมาณ  :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="number" id="year" name="year" value="{{$year}}" />
                </div>

                <label class="col-md-2 col-sm-3 col-form-label" for="file">เลขอ้างอิง :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="text" id="string_number" name="string_number" value="{{$string_number}}" />
                </div>
            </div>

            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-2 col-form-label" for="name">ชื่อเรื่อง  :</label>
                <div class="col-md-10 col-sm-10">
                    <input class="form-control" type="text" id="title" name="title" value="{{$title}}"/>
                </div>
            </div>
            {{--            <div class="form-group row m-b-5">--}}
            {{--                <label class="col-md-2 col-sm-2 col-form-label" for="file">file  :</label>--}}
            {{--                <div class="col-md-10 col-sm-10">--}}
            {{--                    <input class="form-control" type="file" id="filename" name="filename" placeholder="" />--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="form-group row m-b-5">--}}
            {{--                <label class="col-md-2 col-sm-2 col-form-label" for="file">link  :</label>--}}
            {{--                <div class="col-md-10 col-sm-10">--}}
            {{--                    <input class="form-control" type="text" id="link" name="link" placeholder="" />--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">โครงการ  :</label>
                <div class="col-md-6">
                    <input class="form-control" type="text" id="type" name="type" value="{{$type}}"  />

                </div>
            </div>
            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">งบประมาณ  :</label>
                <div class="col-md-6">
                    <input class="form-control" type="number" id="budget" name="budget" value="{{$budget}}"  />
                </div>
            </div>

        </div>
    </div>

    <div class="row ">
        <div class="col-md-6 col-sm-6 ">
            <button type="submit" class="btn btn-primary float-right">บันทึก
            </button>
        </div>
    </div>

</form>