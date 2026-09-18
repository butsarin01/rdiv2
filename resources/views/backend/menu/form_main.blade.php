@php
    $main_name = '';
    $status_sub_menu = '';
    $status_promote = '';
    $number_show = $ordinal_next+1;
    $number_of_data = '';
    $join_database = '';
if(!empty($main_id)){
    $main_name = $main_id->name;
    $status_sub_menu = $main_id->status_have_sub;
    $status_promote = $main_id->status_use_promote;
    $number_show = $main_id->number_show;
    $number_of_data = $main_id->number_of_data;
    $join_database = $main_id->join_database;
}
@endphp


<form method="POST" name="form_main_menu_update" enctype="multipart/form-data" action="{{route('menu.main')}}">
    @csrf
    <input class="form-control hide" type="text" id="id" name="id"
           value="@if(!empty($main_id)){{$main_id->id}} @endif"/>
    <input class="form-control hide" type="text" id="status_setting" name="status_setting"
           value="@if(!empty($main_id)){{$main_id->status_setting}}@else 1 @endif"/>
    <input class="form-control hide" type="text" id="status_setting" name="status_keep_data"
           value="@if(!empty($main_id)){{$main_id->status_keep_data}}@else 1 @endif"/>

    @if(!empty($main_id))
        <input type="hidden" name="show_status_sub_menu" class="data_status_sub"
               value="{{$main_id->status_have_sub}}">
    @endif


    <div class="form-group row mb-1">
        <label class="col-md-2 col-sm-2 col-form-label" for="main_menu_name">ชื่อหัวข้อ :</label>
        <div class="col-md-10 col-sm-10">
            <input class="form-control @error('main_menu_name') is-invalid @enderror" type="text"
                   id="main_menu_name" name="main_menu_name" placeholder=""
                   value="{{$main_name}} "/>
        </div>
    </div>
    <div class="form-group row mb-1">
        <label class="col-md-2 col-sm-2 col-form-label">สถานะ sub menu :</label>
        <div class="col-md-3 col-sm-3 mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status_sub_menu" id="inlineCssRadio1x" value="1"
                       @if($status_sub_menu == 1) checked @endif/>
                <label class="form-check-label" for="inlineCssRadio1x">มี</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status_sub_menu" id="inlineCssRadio2x" value="0"
                       @if($status_sub_menu == 0) checked @endif/>
                <label class="form-check-label" for="inlineCssRadio2x">ไม่มี</label>
            </div>
        </div>

        <label class="col-md-2 col-sm-2 col-form-label" for="number_show" align="right">ลำดับการแสดง :</label>
        <div class="col-md-1 col-sm-2">
            <input class="form-control" type="number" id="number_show" name="number_show" value="{{$number_show}}"/>
        </div>
        <label class="col-md-1 col-sm-1 col-form-label" for="join_database" align="right">เชื่อม :</label>
        <div class="col-md-3 col-sm-3">
            @php $array_database = array(
                        'board'=> 'index.board',
                        'document'=> 'index.document_all',
                        'type_document'=> 'index.document_all',
                        'category_document'=> 'index.document_category',
                        'activity'=> 'index.activity_all',
                        'news'=> 'index.news_all',
                        );
            @endphp
            <select class="form-select" name="join_database" id="join_database">
                <option value="">database</option>
                @foreach($array_database as $key => $value)
                    <option value="{{$value}}" {{$value == $join_database ? 'selected' : ''}}>{{$key}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row mb-1 hide">
        <label class="col-md-3 col-sm-3 col-form-label">สถานะที่ใช้การโปรโมท :</label>
        <div class="col-md-3 col-sm-3 mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status_promote" id="Radio1x" value="1"
                       @if($status_promote == 1) checked @endif/>
                <label class="form-check-label" for="Radio1x">ใช้</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status_promote" id="Radio2x" value="0"
                       @if($status_promote == 0) checked @endif/>
                <label class="form-check-label" for="Radio2x">ไม่ใช้</label>
            </div>
        </div>
    </div>

    <div class="form-group row mb-1 detail_main_menu hide">
        <label class="col-md-2 col-sm-2 col-form-label">ข้อมูลที่ต้องบันทึก :</label>
        <div class="col-md-10 col-sm-10 mt-2">

            @php($array_name_status_use = array('title','thumbnail','detail','gallary','file','multiplefile','link'))
            @foreach($array_name_status_use as $key => $value)
                @php($name_field = 'status_use_'.$value)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="1" id="Checkbox_status_use{{$key}}"
                           name="status_{{$value}}"
                           @if(!empty($main_id->$name_field)) checked @endif />
                    <label class="form-check-label" for="Checkbox_status_use{{$key}}">{{$value}}</label>
                </div>
            @endforeach

        </div>
    </div>
    <div class="form-group row m-b-3 detail_main_menu hide">
        <label class="col-md-2 col-sm-2 col-form-label">จำนวนข้อมูลที่เก็บ :</label>
        <div class="col-md-3 col-sm-3 mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="number_of_data" id="number_of_data1" value="1"
                       @if($number_of_data == 1) checked @endif/>
                <label class="form-check-label" for="number_of_data1">one</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="number_of_data" id="number_of_data2" value="2"
                       @if($number_of_data == 2) checked @endif/>
                <label class="form-check-label" for="number_of_data2">many</label>
            </div>
        </div>
    </div>
    <div class="row justify-content-center text-center">
        <div class="col-md-6 col-sm-6 pt-2">
            <button type="submit" class="btn btn-primary "><i class="fas fa-lg fa-fw me-5px fa-floppy-disk"></i>บันทึก
            </button>
        </div>
    </div>
</form>
