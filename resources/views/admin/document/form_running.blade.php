@php
    $id  = '';
    $runing_number  = '';
    $gp_number = '';
    $person_responsible = '';
    $person_seller = '';
    $title = '';
    $type_project = '';
    $budget = '';
    $date_save = '';
    $year = '';
    $comment = '';
        if(!empty($data_gp)){
            $id  = $data_gp->id;
            $runing_number = $data_gp->runing_number;
            $gp_number = $data_gp->gp_number;
            $person_responsible = $data_gp->person_responsible;
            $person_seller = $data_gp->person_seller;
            $title = $data_gp->title;
            $type_project = $data_gp->type_project;
            $budget = $data_gp->budget;
            $date_save = $data_gp->date_save;
            $year = $data_gp->year;
            $comment = $data_gp->comment;
        }
@endphp
<h4>แบบบันทึกข้อมูล e-GP-Running Number</h4>
<form action="{{route('running.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data">
    @csrf
    <input class="form-control hide" type="text" id="ref_id" name="id" value="{{$id}}"/>
    <div class="form-group row m-b-5 justify-content-center">
        <div class="col-md-8 col-sm-8">
            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-3 col-form-label" for="file">ปีงบประมาณ :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="number" id="year" name="year" value="{{$year}}"/>
                </div>
            </div>
            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-3 col-form-label" for="file">Running-Number :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="text" id="string_number" name="runing_number"
                           value="{{$runing_number}}"/>
                </div>
                <label class="col-md-2 col-sm-3 col-form-label" for="file">e-GP Number :</label>
                <div class="col-md-3 col-sm-3">
                    <input class="form-control" type="text" id="string_number" name="gp_number"
                           value="{{$gp_number}}"/>
                </div>

            </div>

            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-2 col-form-label" for="name">ชื่อเรื่อง :</label>
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
                <label class="col-md-2 col-sm-2 col-form-label" for="file">โครงการ :</label>
                <div class="col-md-6">
                    <input class="form-control" type="text" id="type" name="type_project" value="{{$type_project}}"/>

                </div>
            </div>
            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">งบประมาณ :</label>
                <div class="col-md-6">
                    <input class="form-control" type="number" id="budget" name="budget" value="{{$budget}}"/>
                </div>
            </div>

            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">ผู้รับผิดชอบ :</label>
                <div class="col-md-6">
                    <input class="form-control" type="text" id="type" name="person_responsible" value="{{$person_responsible}}"/>

                </div>
            </div>

            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">ผู้ขาย/ผู้รับจ้าง :</label>
                <div class="col-md-6">
                    <input class="form-control" type="text" id="type" name="person_seller" value="{{$person_seller}}"/>

                </div>
            </div>

            <div class="form-group row m-b-5">
                <label class="col-md-2 col-sm-2 col-form-label" for="file">วันที่ กรอกข้อมูล :</label>
                <div class="col-md-4">
                    <input class="form-control" type="date" id="type" name="date_save" value="{{$date_save}}"/>
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