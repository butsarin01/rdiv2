{{--<div class="border border-blue rounded p-2 mb-1">--}}
@php
    $sub_id = '';
    $sub_main_name = '';
    $sub_status_sub_menu = '';
    $sub_status_promote = '';
    $sub_number_show = 0;
    $sub_number_of_data = '';
    $sub_join_database = '';
if(!empty($sub_menu_id)){
    $sub_id = $sub_menu_id->id;
    $sub_main_name = $sub_menu_id->name;
    $sub_status_sub_menu = $sub_menu_id->status_have_sub;
    $sub_status_promote = $sub_menu_id->status_use_promote;
    $sub_number_show = $sub_menu_id->number_show;
    $sub_number_of_data = $sub_menu_id->number_of_data;
    $sub_join_database = $sub_menu_id->join_database;
}
@endphp


<form method="POST" name="form_sub_menu" enctype="multipart/form-data"
      action="{{route('menu.sub')}}">
    @csrf
    <input class="form-control hide" type="text" id="status_setting" name="status_setting"
           placeholder="" value="1"/>
    <input class="form-control hide" type="text" id="main_menu_id" name="main_menu_id"
           placeholder="" value="{{$main_id->id}}"/>
    <input class="form-control hide" type="text" id="sub_menu_id" name="sub_menu_id"
           placeholder="" value="{{$sub_id}}"/>
    <div class="form-group row mb-1">
        <label class="col-md-D2 col-sm-2 col-form-label" for="sub_menu_name">ชื่อsub menu :</label>
        <div class="col-md-3 col-sm-3">
            <input class="form-control" type="text" id="sub_menu_name" name="sub_menu_name"
                   placeholder="" data-parsley-required="true" value="{{$sub_main_name}}"/>
        </div>
        <label class="col-md-2 col-sm-2 col-form-label" align="right">ลำดับการแสดง :</label>
        <div class="col-md-2 col-sm-2">
            <input class="form-control" type="number" id="number_show" name="number_show"
                   placeholder="" data-parsley-required="true" value="{{$sub_number_show}}"/>
        </div>
        <label class="col-md-1 col-sm-1 col-form-label" align="right">เชื่อม :</label>
        <div class="col-md-2 col-sm-2">
            @php $array_database = array(
                        'board'=> 'index.board',
                        'document'=> 'index.document_all',
                        'type_document'=> 'index.document_all',
                        'category_document'=> 'index.document_category',
                        'activity'=> 'index.activity_all',
                        'news'=> 'index.news_all',
                        'statistics'=>'index.statistics_detail',
                        'report'=>'index.report_detail',
                        );
            @endphp
            <select class="form-select" name="join_database" id="join_database">
                <option value="">database</option>
                @foreach($array_database as $key => $value)
                    <option value="{{$value}}" {{$value == $sub_join_database ? 'selected' : ''}}>{{$key}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row mb-1">
        <label class="col-md-2 col-sm-2 col-form-label">ข้อมูลที่ต้องบันทึก :</label>
        <div class="col-md-10 col-sm-10 mt-2">

            @php($array_name_status_use = array('title','thumbnail','detail','gallary','file','multiplefile','link'))
            @foreach($array_name_status_use as $key => $value)
                @php($name_field = 'status_use_'.$value)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="1" id="Checkbox_status_use_sub{{$key}}"
                           name="status_{{$value}}" @if(!empty($sub_menu_id->$name_field)) checked @endif/>
                    <label class="form-check-label" for="Checkbox_status_use_sub{{$key}}">{{$value}}</label>
                </div>
            @endforeach

        </div>
    </div>
    <div class="form-group row mb-1 ">
        <label class="col-md-2 col-sm-2 col-form-label">จำนวนข้อมูลที่เก็บ :</label>
        <div class="col-md-3 col-sm-3 mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="number_of_data" id="inlineCssRadio5x" value="1"
                       checked/>
                <label class="form-check-label" for="inlineCssRadio5x">one</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="number_of_data" id="inlineCssRadio6x" value="2"/>
                <label class="form-check-label" for="inlineCssRadio6x">many</label>
            </div>
        </div>
        {{--        <label class="col-md-3 col-sm-3 col-form-label">สถานะที่ใช้การโปรโมท :</label>--}}
        {{--        <div class="col-md-3 col-sm-3 mt-2">--}}
        {{--            <div class="form-check form-check-inline">--}}
        {{--                <input class="form-check-input" type="radio" name="status_promote" id="Radio33x" value="1"/>--}}
        {{--                <label class="form-check-label" for="Radio33x">ใช้</label>--}}
        {{--            </div>--}}
        {{--            <div class="form-check form-check-inline">--}}
        {{--                <input class="form-check-input" type="radio" name="status_promote" id="Radio43x" value="0" checked/>--}}
        {{--                <label class="form-check-label" for="Radio43x">ไม่ใช้</label>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="col-md-7 col-sm-7 text-end">
            <button type="submit" class="btn  btn-primary "><i class="fas fa-lg fa-fw me-5px fa-floppy-disk"></i>บันทึก
            </button>
        </div>
    </div>

</form>
{{--</div>--}}
