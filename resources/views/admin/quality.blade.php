@extends('admin.master')
@section('setting_people')
    <div id="content" class="content">
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-xl-3">
                <!-- begin panel -->
                <div class="panel panel-default" data-sortable-id="form-stuff-5">
                    <div class="panel-heading">
                        <h4 class="panel-title">กลุ่มประกันคุณภาพ</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">หัวข้อ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data_quality as $row)
                                <tr>
                                    <td><a href="{{ route('setting_document.index',[$row->id]) }}" class="m-r-15">{{$row->name_th}}</a></td>
                                </tr>    
                                    @foreach($row->year as $row_year)
                                    <tr>
                                        <td >
                                            <a href="{{ route('setting_document.index',[$row->id,$row_year->year]) }}"class="m-l-20" >{{$row_year->year}}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- end panel -->
            </div>

            <div class="col-xl-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(!empty($quality))
                        <div class="row justify-content-center">
                            <form action="{{route('document.insert_year')}}" method="POST" name="year_form" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-sm-3 col-form-label" for="posotion_name">ปี :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="text" id="year" name="year" placeholder="" />
                                        <input class="form-control hide" type="text" id="type_quality_id" name="type_quality_id" value="{{$quality}}" />
                                    </div>
                                    <div class="col-md-1 col-sm-1">
                                        <button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        @endif


                        @if(!empty($year))
                            <h5 class="text-center">{{$year}}</h5>
                        
                        <div id="accordion" class="accordion">
                            <!-- begin card -->
                            <div class="card bg-dark text-white">
                                <div class="card-header bg-dark-darker pointer-cursor d-flex align-items-center" data-toggle="collapse" data-target="#collapseOne">
                                    <i class="fa fa-circle fa-fw text-blue mr-2 f-s-8"></i> เพิ่มข้อมูล
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="form-group row m-b-15">
                                            <label class="col-form-label col-md-2">ปี:</label>
                                            <div class="col-md-4">
                                                <select class="form-control dynamic_input_type" id="year" name="year" data-dependent="type_document_id">
                                                    @if(!empty($years ))
                                                        @foreach($years as $year)
                                                            <option value="{{$year->year}}">{{$year->year}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row m-b-15">
                                            <label class="col-form-label col-md-2">ประเภทของเอกสาร:</label>
                                            <div class="col-md-4">
                                                {{--                                    {{ Form::select('type_document_id', App\Type_document::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกประเภท...',--}}
                                                {{--                                    'class'=>'form-control dynamic_input_category','data-dependent'=>'category_document_id']) }}--}}
                                                <select class="form-control type_document_id dynamic_input_category"
                                                        id="type_document_id" name="type_document_id" data-dependent="category_document_id">
                                                    <option value="0">เลือกประเภท..</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <a href="#modal-dialog-addType" class="btn btn-success addType"
                                                   data-toggle="modal" data-target="#modal-dialog-addType"
                                                   id="addType">เพิ่มประเภท</a>
                                            </div>
                                        </div>
                                        <div class="form-group row m-b-15">
                                            <label class="col-form-label col-md-2">หมวดหมู่ของเอกสาร:</label>
                                            <div class="col-md-4">
                                                <select class="form-control category_document_id dynamic_input_title"
                                                        id="category_document_id" name="category_document_id"
                                                        data-dependent="title_document_id">
                                                    <option value="0">เลือกหมวดหมู่..</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <a href="#modal-dialog-addCategory" class="btn btn-success addCategory"
                                                   data-toggle="modal" data-target="#modal-dialog-addCategory"
                                                   id="addCategory">เพิ่มหมวดหมู่</a>
                                            </div>
                                        </div>
                                        <div class="form-group row m-b-15">
                                            <label class="col-md-2 col-sm-2 col-form-label" for="file">หัวข้อ :</label>
                                            <div class="col-md-4">
                                                <select class="form-control title_document_id dynamic_input_Subtitle" id="title_document_id" name="title_document_id"
                                                        data-dependent="sub_title_document_id">
                                                    <option value="0">เลือกหัวข้อ..</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <a href="#modal-dialog-addTitle" class="btn btn-success addTitles"
                                                   data-toggle="modal" data-target="#modal-dialog-addTitle"
                                                   id="addTitles">เพิ่มหัวข้อ</a>
                                            </div>
                                        </div>
                                      <!--   <div class="form-group row m-b-15">
                                            <label class="col-md-2 col-sm-2 col-form-label" for="file">หัวข้อย่อย :</label>
                                            <div class="col-md-4">
                                                <select class="form-control sub_title_document_id" id="sub_title_document_id" name="sub_title_document_id">
                                                    <option value="0">เลือกหัวข้อย่อย..</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <a href="#modal-dialog-addTitle" class="btn btn-success addSubTitles"
                                                   data-toggle="modal" data-target="#modal-dialog-addSubTitles"
                                                   id="addSubTitles">เพิ่มหัวข้อย่อย</a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(!empty($set_document_setting[0]))
                        <div class="row">
                            <table class="table table-bordered table-sm table-hover">
                                <thead>
                                    <tr align="center">
                                        <th>หัวข้อ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($set_document_setting as $type)
                                    <tr  id="{{$type->id}}">
                                        <td>
                                            <a href="" class="tr-type" id="{{$type->id}}">
                                                <h5  >
                                                    <i class="far fa-lg fa-fw m-r-3 fa-folder"></i>{{$type->name}}
                                                </h5>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#modal-dialog-addType" class="btn btn-sm btn-warning editType"
                                               data-toggle="modal" data-target="#modal-dialog-addType" data-id="{{$type->id}}" data-mode="type"><i class="far fa-lg fa-fw m-r-3 fa-edit"></i>แก้ไขประเภท</a>

                                            <a class="btn btn-sm btn-danger" href="{{route('type_document.delete',[$type->id])}}"
                                                role="button">
                                                <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                            </a>
                                        </td>
                                    </tr>
                                         @foreach($type->category as $category)
                                         <tr >
                                             <td style="padding-left: 30px;">
                                                <a href="">
                                                    <h5 class="media-left">
                                                        <i class="fas fa-lg fa-fw m-r-3 fa-genderless"></i>{{$category->name}}
                                                    </h5>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#modal-dialog-addCategory" class="btn btn-sm btn-warning editCategory"
                                                   data-toggle="modal" data-target="#modal-dialog-addCategory" data-id="{{$category->id}}" data-mode="category">
                                                    <i class="far fa-lg fa-fw m-r-3 fa-edit"></i>แก้ไขหมวดหมู่</a>
                                                <a class="btn btn-sm btn-danger" href="{{route('category_document.delete',[$category->id])}}"
                                                    role="button">
                                                    <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                                </a>
                                            </td>
                                        </tr>
                                            @foreach($category->title as $title)
                                             <tr >
                                                 <td style="padding-left: 60px;">
                                                    <a href="">
                                                        <h5 class="media-left">
                                                            <i class="fas fa-lg fa-fw m-r-3 fa-genderless"></i>{{$title->name}}
                                                        </h5>
                                                    </a>
                                                </td>
                                                 <td>
                                                     <a href="#modal-dialog-addTitle" class="btn btn-sm btn-warning editTitles"
                                                        data-toggle="modal" data-target="#modal-dialog-addTitle" data-id="{{$title->id}}" data-mode="title">
                                                         <i class="far fa-lg fa-fw m-r-3 fa-edit"></i>แก้ไขหัวข้อ</a>
                                                    <a class="btn btn-sm btn-danger" href="{{route('title_document.delete',[$title->id])}}"
                                                        role="button">
                                                        <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                                    </a>
                                                </td>
                                            </tr>
                                                 @foreach($title->sub_title as $sub_title)
                                                 <tr >
                                                     <td style="padding-left: 90px;">
                                                        <a href="">
                                                            <h5 class="media-left">
                                                                <i class="fas fa-lg fa-fw m-r-3 fa-genderless"></i>{{$sub_title->code}} {{$sub_title->name}}
                                                            </h5>
                                                        </a>
                                                    </td>
                                                     <td>
                                                        <a href="#modal-dialog-addSubTitles" class="btn btn-sm btn-warning editSubTitles"
                                                           data-toggle="modal" data-target="#modal-dialog-addSubTitles" data-id="{{$sub_title->id}}" data-mode="SubTitle"
                                                           ><i class="far fa-lg fa-fw m-r-3 fa-edit"></i>แก้ไขหัวข้อย่อย</a>
                                                        <a class="btn btn-sm btn-danger" href="{{route('sub_title_document.delete',[$sub_title->id])}}"
                                                            role="button">
                                                            <i class="far fa-lg fa-fw m-r-3 fa-trash-alt"></i>ลบ
                                                        </a>
                                                    </td>
                                                 </tr>
                                                @endforeach

                                            @endforeach

                                        @endforeach

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-dialog-editText">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">แก้ไขข้อความ </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('type_document.insert')}}" id="form_editText">
                    @csrf
                        <div class="form-group row m-b-15">
                            <label class="col-md-3 col-sm-3 col-form-label" for="name">ประเภทของเอกสาร:</label>
                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" id="name_Type"
                                name="name_Type" placeholder=""/>
                                <input class="form-control " type="text" id="id" name="id" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6  float-right ">
                            <button type="submit"
                                class="btn btn-sm btn-primary float-right submit_Tpe">บันทึก
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-dialog-addType">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มประเภท </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('type_document.insert')}}" id="form_addType">
                        @csrf
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_type">ปี :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-year" type="text" id="name_year_modal" name="year_show" placeholder="" disabled/>
                                <input class="form-control text-year-hide" type="hidden" id="id_year_modal" name="year" placeholder=""/>
                                <input class="form-control text-type_quality-hide" type="hidden" id="id_type_quality_modal" name="type_quality_id" placeholder=""/>
                            </div>
                        </div>
                        <input class="id_type text-type-id hide" type="text" name="id_type" value="">
                        <div class="form-group row m-b-15">
                            <label class="col-md-3 col-sm-3 col-form-label" for="name">ประเภทของเอกสาร:</label>
                            <div class="col-md-9 col-sm-9">
                                <input class="form-control text-type-name" type="text" id="name_type"
                                       name="name_type" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6  float-right ">
                            <button type="submit"
                                    class="btn btn-sm btn-primary float-right submit_Tpe">บันทึก
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-dialog-addCategory">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มหมวดหมู่ </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('category_document.insert')}}" id="form_addCategory">
                        @csrf
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_type">ปี :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-year" type="text" id="name_year_addCategory" name="year_show" placeholder="" disabled/>
                                <input class="form-control text-year-hide" type="hidden" id="id_year_addCategory" name="year" placeholder=""/>
                                <input class="form-control text-type_quality-hide" type="hidden" id="id_type_quality_modal" name="type_quality_id" placeholder=""/>

                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_type">ประเภทของเอกสาร :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-type-name" type="text" id="name_type_modal" name="name_type" placeholder="" disabled/>
                                <input class="form-control text-type-id " type="hidden" id="id_type_modal" name="id_type" placeholder=""/>
                            </div>
                        </div>
                        <input class="id_Category text-category-id hide" type="text" name="id_Category" value="">
                        <div class="form-group row m-b-15">
                            <label class="col-md-2 col-sm-2 col-form-label" for="name">หมวดหมู่:</label>
                            <div class="col-md-10 col-sm-10">
                                <input class="form-control text-category-name" type="text" id="name_Category"
                                       name="name_Category" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6  float-right ">
                            <button type="submit"
                                    class="btn btn-sm btn-primary float-right submit_Category">บันทึก
                            </button>
                        </div>
                    </form>
                </div>
                {{--            <div class="modal-footer">--}}
                {{--                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>--}}
                {{--                <a href="javascript:;" class="btn btn-success">save</a>--}}
                {{--            </div>--}}
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-dialog-addTitle">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มหัวข้อ </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('title_document.insert')}}" id="form_addTitle">
                        @csrf
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_type">ปี :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-year" type="text" id="name_year_addTitle" name="year_show" placeholder="" disabled/>
                                <input class="form-control text-year-hide" type="hidden" id="id_year_addTitle" name="year" placeholder=""/>
                                <input class="form-control text-type_quality-hide" type="hidden" id="id_type_quality_modal" name="type_quality_id" placeholder=""/>

                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_type">ประเภทของเอกสาร
                                :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-type-name" type="text" id="name_type_title" name="name_type"
                                       placeholder="" disabled/>
                                <input class="form-control hide text-type-id" type="text" id="id_type_title" name="id_type"
                                       placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_category">หมวดหมู่ของเอกสาร
                                :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-category-name" type="text" id="name_category"
                                       name="name_category" placeholder="" disabled/>
                                <input class="form-control hide text-category-id" type="text" id="id_category" name="id_category"
                                       placeholder=""/>
                            </div>
                        </div>
                        <input class="id_title text-title-id hide" type="text" name="id_title" value="">
                        <div class="form-group row m-b-15">
                            <label class="col-md-2 col-sm-2 col-form-label" for="name">หัวข้อ:</label>
                            <div class="col-md-10 col-sm-10">
                                <input class="form-control text-title-name" type="text" id="name_title" name="name_title"
                                       placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6  float-right ">
                            <button type="submit" class="btn btn-sm btn-primary float-right submit_title">
                                บันทึก
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-dialog-addSubTitles">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มหัวข้อ </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form method="POST" action="{{route('sub_title_document.insert')}}" id="form_SubaddTitle">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_type">ปี :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-year" type="text" id="name_year_addSubTitles" name="year_show" placeholder="" disabled/>
                                <input class="form-control text-year-hide" type="hidden" id="id_year_addSubTitles" name="year" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_type_SubTitles">ประเภทของเอกสาร
                                :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-type-name" type="text" id="name_type_SubTitles" name="name_type" placeholder="" disabled/>
                                <input class="form-control hide text-type-id" type="text" id="id_type_SubTitles" name="id_type" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_category_SubTitles">หมวดหมู่ของเอกสาร
                                :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-category-name" type="text" id="name_category_SubTitles" name="name_category" placeholder="" disabled/>
                                <input class="form-control hide text-category-id" type="text" id="id_category_SubTitles" name="id_category" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="name_title_SubTitles">หัวข้อ :</label>
                            <div class="col-md-7 col-sm-7">
                                <input class="form-control text-title-name" type="text" id="name_title_SubTitles" name="name_titles" placeholder="" disabled/>
                                <input class="form-control hide text-title-id" type="text" id="id_title_SubTitles" name="id_titles" placeholder=""/>
                            </div>
                        </div>
                        <input class="id_Subtitle hide" type="text" name="id_Subtitle" value="">
                        <div class="form-group row m-b-15">
                            <label class="col-md-3 col-sm-3 col-form-label" for="name">รหัสหัวข้อย่อย:</label>
                            <div class="col-md-9 col-sm-9">
                                <input class="form-control text-Subtitle-code" type="text" id="code_Subtitle" name="code_Subtitle" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-3 col-sm-3 col-form-label" for="name">หัวข้อย่อย:</label>
                            <div class="col-md-9 col-sm-9">
                                <input class="form-control text-Subtitle-name" type="text" id="name_Subtitle" name="name_Subtitle"
                                       placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-3 col-sm-3 col-form-label" for="file">รายละเอียดเพิ่มเติม :</label>
                            <div class="col-md-9 col-sm-9">
                                <textarea class="form-control text-Subtitle-detail" rows="4" name="detail_Subtitle"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">ยกเลิก</a>
                        <button type="submit" class="btn  btn-primary float-right submit_sub_title">
                            บันทึก
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
@section('script_menu')
    <script type="text/javascript">
        $(document).ready(function(){

            $('.editText').click(function() {
                 // get the current row
                 var currentRow=$(this).closest("tr");
                 var text =currentRow.find("td:eq(0)").text(); // get current row 1st table cell TD value
                 var text1 = $(this).parent().parent().find('td:eq(0)').text()
                 var data_id  = $(this).data("id");

                 $('#name_Type').val(text);
                 $('#id').val(data_id);
                 console.log(text1);
            });


            $('.status_setting_group').click(function() {
                var group_id = $(this).attr('group-id');
                var status = $(this).is(":checked") ? 1:0;
                $.ajax({
                    url: '{{route('people.setting_update')}}',
                    method: 'POST',
                    data:{"_token": "{{ csrf_token() }}", 'mode':'people', 'group_id':group_id, 'status_setting':status},
                    dataType: 'json',
                    success:function(data)
                    {
                        // alert(data.alert);
                    }
                });
            });


        });
        $(document).ready(function() {
            fetch_type();
            setTimeout(function() {fetch_category();}, 500);
            setTimeout(function() {fetch_title();}, 1000);
            setTimeout(function() {fetch_sub_title();}, 1500);

            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();
            $(".text-year").val(text_year);
            $(".text-year-hide").val(value_year);
        });

        $('.dynamic_input_type').change(function () {
            var select = $(".dynamic_input_type option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_type.fetch')}}";

            console.log("select = " + select + " value =" + value);
            dynamic_select(select,value,dependent,url);

            setTimeout(function() {fetch_category();}, 500);
            setTimeout(function() {fetch_title();}, 1000);
            setTimeout(function() {fetch_sub_title();}, 1500);

        });

        // $(document).on('change', '.dynamic_input_category', function(){
        $('.dynamic_input_category').change(function () {
            var option = $('option:selected', this).attr('type_document_id');
            var select = $(".dynamic_input_category option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_category.fetch')}}";

            console.log("select = " + select + " value =" + value);
            dynamic_select(select,value,dependent,url);

            setTimeout(function() {fetch_title();}, 500);
            setTimeout(function() {fetch_sub_title();}, 1000);

        });
        // $(document).on('change', '.dynamic_input_title', function(){
        $('.dynamic_input_title').change(function () {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_title.fetch')}}";

            console.log(" select =" + select + "value=" + value);
            dynamic_select(select,value,dependent,url);

            setTimeout(function() {fetch_sub_title();}, 500);
        });

        $('.dynamic_input_Subtitle').change(function () {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_sub_title.fetch')}}";

            console.log(" select =" + select + "value=" + value);
            dynamic_select(select,value,dependent,url);

        });

        function fetch_type(){
            var select_year = $(".dynamic_input_type").text();
            var value_year = $(".dynamic_input_type").val();
            var dependent_year = $(".dynamic_input_type").data('dependent');
            var url_year = "{{route('dynamic_type.fetch')}}";
            console.log("year = " + select_year + " value =" + value_year);
            dynamic_select(select_year,value_year,dependent_year,url_year);
        }
        function fetch_category(){
            var select_type = $(".dynamic_input_category").text();
            var value_type = $(".dynamic_input_category").val();
            var dependent_type = $(".dynamic_input_category").data('dependent');
            var url_type = "{{route('dynamic_category.fetch')}}";
            console.log(" select =" + select_type + "value=" +value_type );
            dynamic_select(select_type,value_type,dependent_type,url_type);
        }
        function fetch_title(){
            var select_category = $(".dynamic_input_title").text();
            var value_category = $(".dynamic_input_title").val();
            var dependent_category = $(".dynamic_input_title").data('dependent');
            var url_category = "{{route('dynamic_title.fetch')}}";
            console.log(" category =" + select_category + "value=" +value_category );
            dynamic_select(select_category,value_category,dependent_category,url_category);
        }
        function fetch_sub_title(){
            var select_title = $(".dynamic_input_Subtitle").text();
            var value_title = $(".dynamic_input_Subtitle").val();
            var dependent_title = $(".dynamic_input_Subtitle").data('dependent');
            var url_title = "{{route('dynamic_sub_title.fetch')}}";
            console.log(" title =" + select_title + "value=" +value_title );
            dynamic_select(select_title,value_title,dependent_title,url_title);
        }

        function dynamic_select(select,value,dependent,url){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: url,
                method: "POST",
                data: {select: select, value: value, _token: _token, dependent: dependent},
                success: function (result) {
                    $('.' + dependent).html(result);
                    console.log(result);
                }
            });
        }

        function dynamic_data(id,mode){
            console.log(id);
            console.log(mode);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{route('dynamic_data.fetch')}}',
                method: "POST",
                data: {id: id, mode: mode, _token: _token},
                success: function (data) {
                    console.log(data);

                    $(".text-year").val(data.year);
                    $(".text-year-hide").val(data.year);

                    $(".text-type-name").val(data.type.name);
                    $(".text-type-id").val(data.type.id);

                    $(".text-category-name").val(data.category.name);
                    $(".text-category-id").val(data.category.id);

                    $(".text-title-name").val(data.title.name);
                    $(".text-title-id").val(data.title.id);

                    $(".text-Subtitle-code").val(data.Subtitle.code);
                    $(".text-Subtitle-name").val(data.Subtitle.name);
                    $(".id_Subtitle").val(data.Subtitle.id);
                    $(".text-Subtitle-detail").val(data.Subtitle.detail);

                    var value_quality_id = $('#type_quality_id').val();
                    $("#id_type_quality_modal").val(value_quality_id);

                }
            });
        }

        $('.editSubTitles').click(function () {
            $("#modal-dialog-addSubTitles").modal("show");
            $('.modal-title').text('แก้ไขหัวข้อย่อย');
            var id = $(this).data('id');
            var mode = $(this).data('mode');
            dynamic_data(id,mode);

        });
        $('.editTitles').click(function () {
            $("#modal-dialog-addTitles").modal("show")
            $('.modal-title').text('แก้ไขหัวข้อ');
            var id = $(this).data('id');
            var mode = $(this).data('mode');
            dynamic_data(id,mode);
        });
        $('.editCategory').click(function () {
            $("#modal-dialog-addTitles").modal("show");
            $('.modal-title').text('แก้ไขหมวดหมู่');
            var id = $(this).data('id');
            var mode = $(this).data('mode');
            dynamic_data(id,mode);

        });
        $('.editType').click(function () {
            $("#modal-dialog-addTitles").modal("show");
            $('.modal-title').text('แก้ไขประเภท');
            var id = $(this).data('id');
            var mode = $(this).data('mode');
            dynamic_data(id,mode);

        });

        $('.addSubTitles').click(function () {
            $("#modal-dialog-addSubTitles").modal("show");
            var text_type = $('.dynamic_input_category option:selected').text();
            var text_category = $('.dynamic_input_title option:selected').text();
            var text_title = $('.dynamic_input_Subtitle option:selected').text();
            var value_type = $('.dynamic_input_category option:selected').val();
            var value_category = $('.dynamic_input_title option:selected').val();
            var value_title = $('.dynamic_input_Subtitle option:selected').val();

            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();

            console.log(text_title);
            console.log(value_title);

            $(".text-year").val(text_year);
            $(".text-year-hide").val(value_year);

            $("#name_type_SubTitles").val(text_type);
            $("#id_type_SubTitles").val(value_type);
            $("#name_category_SubTitles").val(text_category);
            $("#id_category_SubTitles").val(value_category);
            $("#name_title_SubTitles").val(text_title);
            $("#id_title_SubTitles").val(value_title);
        });


        $('.addTitles').click(function () {
            $("#modal-dialog-addTitle").modal("show");
            var text_type = $('.dynamic_input_category option:selected').text();
            var text_category = $('.dynamic_input_title option:selected').text();
            var value_type = $('.dynamic_input_category option:selected').val();
            var value_category = $('.dynamic_input_title option:selected').val();
             var value_quality_id = $('#type_quality_id').val();
            $("#id_type_quality_modal").val(value_quality_id);

            $("#name_type_title").val(text_type);
            $("#id_type_title").val(value_type);
            $("#name_category").val(text_category);
            $("#id_category").val(value_category);
        });

        $('.addCategory').click(function () {
            $("#modal-dialog-addCategory").modal("show");
            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();
            var text_type = $('.dynamic_input_category option:selected').text();
            var value_type = $('.dynamic_input_category option:selected').val();
            var value_quality_id = $('#type_quality_id').val();
            $("#id_type_quality_modal").val(value_quality_id);

            // console.log(value_year);

            $(".text-year").val(text_year);
            $(".text-year-hide").val(value_year);
            $("#name_type_modal").val(text_type);
            $("#id_type_modal").val(value_type);
        });

        $('.addType').click(function () {
            $("#modal-dialog-addType").modal("show");
            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();
            var value_quality_id = $('#type_quality_id').val();

            $("#name_year_modal").val(text_year);
            $("#id_year_modal").val(value_year);
            $("#id_type_quality_modal").val(value_quality_id);

            // console.log(value_type);
        });


    </script>


@endsection
