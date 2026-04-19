@extends('admin.master')
@section('body_content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4 class="panel-title">แบบบันทึกข้อมูล
                            @if(!empty($menu->name)) {{$menu->name}}  @endif


                        </h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                               data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                               data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">


                        <form action="{{route('content.insert_index')}}" method="POST" id="form_content"
                              name="summernote_form" enctype="multipart/form-data">
                            @csrf
                            <input class="form-control hide" type="text" id="member_id" name="member_id" placeholder=""
                                   data-parsley-required="true" value="{{session()->get('user.member_id')}}"/>

                            @if(!empty($data_detail_menu[0]) && $menu->number_of_data == 1)

                                @if($mode == 'main')
                                    <input class="form-control hide" type="text" id="main_menu_id" name="main_menu_id"
                                           placeholder="" value="{{$menu->id}}"/>
                                @elseif($mode == 'sub')
                                    <input class="form-control hide" type="text" id="sub_menu_id" name="sub_menu_id"
                                           placeholder="" value="{{$menu->id}}"/>
                                @endif

                                @foreach($data_detail_menu as $data)
                                    <input class="form-control hide" type="text" id="detail_menu_id"
                                           name="detail_menu_id" placeholder=""
                                           @if(!empty($data->id)) value="{{$data->id}}" @endif />

                                    <div class="form-group row m-b-1">
                                        @if(!empty($menu->status_use_thumbnail))
                                            <div class="col-md-4 col-sm-4 ">
                                                <center>
                                                    <label class="col-md-3 col-sm-3 col-form-label">รูปหัวข้อ</label>
                                                    <div class="col-md-9 col-sm-9 ">
                                                        @if(!empty($data->thumbnail))
                                                            <img src="{{asset('storage/content/'.$data->thumbnail)}}"
                                                                 class="avatar img-thumbnail" alt="avatar"
                                                                 style="height: 200px; width: auto;">
                                                        @else
                                                            <img src="{{asset('images/images.png')}}"
                                                                 class="avatar img-thumbnail"
                                                                 alt="avatar" style="height: 200px; width: auto;">
                                                        @endif
                                                        <input class="form-control file-upload" type="file"
                                                               id="image_name" name="image_name" placeholder=""
                                                               data-parsley-required="true"/>
                                                    </div>
                                                </center>
                                            </div>
                                        @endif

                                        <div class="col-md-8 col-sm-8">
                                            @if(!empty($menu->status_use_title))
                                                <label class="col-md-2 col-sm-2 col-form-label" for="title">ชื่อหัวข้อ
                                                    :</label>
                                                <div class="col-md-10 col-sm-10">
                                                    <input class="form-control" type="text" id="title" name="title"
                                                           placeholder="" data-parsley-required="true"
                                                           @if(!empty($data->title)) value="{{$data->title}}" @endif />
                                                </div>
                                            @endif
                                            @if(!empty($menu->status_use_link))
                                                <label class="col-md-2 col-sm-2 col-form-label" for="link">link
                                                    :</label>
                                                <div class="col-md-10 col-sm-10">
                                                    <input class="form-control" type="text" id="link" name="link"
                                                           placeholder="" data-parsley-required="true"
                                                           @if(!empty($data->link)) value="{{$data->link}}" @endif/>
                                                </div>
                                            @endif
                                            @if(!empty($menu->status_use_file))
                                                <label class="col-md-2 col-sm-2 col-form-label" for="file">file
                                                    :</label>
                                                <div class="col-md-10 col-sm-10">
                                                    <input class="form-control" type="file" id="filename"
                                                           name="filename" placeholder="" data-parsley-required="true"
                                                           @if(!empty($data->file)) value="{{$data->file}}" @endif/>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if(!empty($menu->status_use_detail))
                                        <label class="col-md-2 col-sm-2 col-form-label" for="fullname">รายละเอียด
                                            :</label>
                                        <textarea class="summernote" name="detail" id="detail"></textarea>
                                        <textarea class="hide" name="detail_hidden"
                                                  id="detail_hidden">@if(!empty($data->detail)) {{$data->detail}} @endif</textarea>
                                    @endif
                                    <br>
                                    <div class="form-group float-right ">
                                        <button type="submit" class="btn btn-sm btn-primary m-r-5 btn-save">บันทึก
                                        </button>
                                    </div>
                                @endforeach

                            @elseif(empty($data_detail_menu[0]) || $menu->number_of_data == 2)
                                @if($mode == 'main')
                                    <input class="form-control hide" type="text" id="main_menu_id" name="main_menu_id"
                                           placeholder="" value="{{$menu->id}}"/>
                                @elseif($mode == 'sub')
                                    <input class="form-control hide" type="text" id="sub_menu_id" name="sub_menu_id"
                                           placeholder="" value="{{$menu->id}}"/>
                                @endif

                                <div class="form-group row m-b-1">
                                    @if(!empty($menu->status_use_thumbnail))
                                        <div class="col-md-4 col-sm-4 ">
                                            <center>
                                                <label class="col-md-3 col-sm-3 col-form-label">รูปหัวข้อ</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <img src="{{asset('images/images.png')}}"
                                                         class="avatar img-thumbnail" alt="avatar"
                                                         style="height: 200px; width: auto;">
                                                    <input class="form-control file-upload" type="file" id="image_name"
                                                           name="image_name" placeholder=""
                                                           data-parsley-required="true"/>
                                                </div>
                                            </center>
                                        </div>
                                    @endif

                                    <div class="col-md-8 col-sm-8">
                                        @if(!empty($menu->status_use_title))
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-2 col-sm-2 col-form-label text-right" for="title">ชื่อหัวข้อ
                                                    :</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input class="form-control" type="text" id="title" name="title"
                                                           placeholder="" data-parsley-required="true"/>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty($menu->status_use_link))
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-2 col-sm-2 col-form-label text-right" for="link">link :</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input class="form-control" type="text" id="link" name="link"
                                                           placeholder="" data-parsley-required="true"/>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty($menu->status_use_file))
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-2 col-sm-2 col-form-label text-right" for="file">file :</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input class="form-control" type="file" id="filename" name="filename"
                                                           placeholder="" data-parsley-required="true"/>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty($menu->status_use_range_date))
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-2 col-sm-2 col-form-label text-right" for="file">ช่วงวันที่ (เดือน/วัน/ปี): </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <div class="input-group input-daterange">
                                                        <input type="text" class="form-control" name="start_date"
                                                               placeholder="Date Start">
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="form-control" name="end_date"
                                                               placeholder="Date End">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($menu->number_of_data == 2)
                                            <div class="form-group row m-b-10">
                                                <label class="col-md-2 col-sm-2 col-form-label text-right" for="fullname">ลำดับการแสดง :</label>
                                                <div class="col-md-2 col-sm-2">
                                                    <input class="form-control" type="number" id="number_show"
                                                           name="number_show" value="{{$count_data}}"/>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                </div>

                                @if(!empty($menu->status_use_detail))
                                    <label class="col-md-2 col-sm-2 col-form-label" for="fullname">รายละเอียด :</label>
                                    <textarea class="summernote" name="detail" id="detail"></textarea>
                                    <textarea class="hide" name="detail_hidden" id="detail_hidden"></textarea>
                                @endif
                            <!-- <br> -->
                                <div class="form-group  float-right">
                                    <!-- <center> -->
                                    <button type="submit" class="btn btn-primary m-r-5 btn-save btn-block">บันทึก
                                    </button>
                                    <!-- <button type="submit" class="btn btn-primary btn-block">บันทึก</button> -->
                                    <!-- </center> -->
                                </div>

                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if($menu->number_of_data == 2)

            <div class="col-xl-12">
                <div class="panel  ">
                    <div class="panel-body">
                        <table id="data-table-keytable"
                               class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap" width="1%">number</th>
                                @if(!empty($menu->status_use_title))
                                    <th>title</th>
                                    @endif
                                @if(!empty($menu->status_use_thumbnail))
                                    <th class="text-nowrap">image</th>
                                    @endif
                                @if(!empty($menu->status_use_file))
                                    <th class="text-nowrap">file</th>
                                    @endif
                                @if(!empty($menu->status_use_link))
                                    <th class="text-nowrap">link</th>
                                    @endif
                                @if(!empty($menu->status_use_range_date))
                                    <th class="text-nowrap">ช่วงวันที่</th>
                                    @endif
                                <th width="10%" class="text-nowrap">แก้ไข</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($data_detail_menu[0]))
                                @foreach($data_detail_menu as $data)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="f-s-600 text-inverse">{{$data->number_show}}</td>
                                        @if(!empty($data->title))
                                            <td class="f-s-600 text-inverse">{{$data->title}}</td>
                                        @endif
                                        @if(!empty($data->thumbnail))
                                            <td class="f-s-600 text-inverse">
                                                <img src="{{asset('storage/content/'.$data->thumbnail)}}" class="img-rounded height-60"/>
{{--                                                {{$data->thumbnail}}--}}
                                            </td>
                                        @endif
                                        @if(!empty($data->file))
                                            <td class="f-s-600 text-inverse">{{$data->file}}</td>
                                        @endif
                                        @if(!empty($data->link))
                                            <td class="f-s-600 text-inverse">
                                                <a href="{{$data->link}}" class="btn btn-outline-info"
                                                   target="_blank"><i class="fas fa-lg fa-fw fa-link"></i></a>
                                            </td>
                                        @endif
                                        @if($data->start_date != '0000-00-00')
                                            <td class="f-s-600 text-inverse">{{$data->start_date}} - {{$data->end_date}}
                                            </td>
                                        @endif


                                        <td>
                                            <a class="btn btn-yellow"
                                               href="{{ route('content.edit',[$data->id,$menu->id,$mode]) }}"
                                               role="button">แก้ไข</a>
                                            <a class="btn btn-red"
                                               href="{{route('content.delete_detail_menu',[$data->id])}}" role="button">ลบ</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    @endif




    <!-- end panel -->
    </div>
    <!-- end col-10 -->

    <!-- end row -->


    <!-- end #content -->
@endsection
@section('script_content')
    <script>

        setTimeout(function () {
            var html = $('#detail_hidden').val();
            $('.note-placeholder').css('display', 'none');
            $('.note-editable').html(html);

        }, 1000);


    </script>
@endsection
