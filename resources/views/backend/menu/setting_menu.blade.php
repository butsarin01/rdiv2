@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-xl-3 m-0">
            <div class="panel border border-primary mb-2">
                <div class="panel-body row p-2">
                    <h3 class="col-md-6 align-content-center">Main Menu </h3>
                    <div class="col-md-6 text-end">
                        <a class="btn btn-primary" href="{{route('menu.index')}}" role="button">เพิ่ม Main menu</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered widget-table rounded border-primary" data-id="widget">
                <thead class="text-center">
                <tr>
                    <th rowspan="2" scope="col">ลำดับ</th>
                    <th rowspan="2" scope="col">Main menu</th>
                    <th colspan="2" scope="col">สถานะ</th>
                </tr>
                <tr>
                    <th scope="col">แสดง</th>
                    <th scope="col">เก็บ</th>
                </tr>
                </thead>
                <tbody>
                @php($ordinal_next = 0)
                @foreach($main_menu_all as $main)
                    <tr>
                        <td scope="row" align="center">{{ $main->number_show }}</td>
                        <td><a href="{{ route('menu.edit',[$main->id]) }}">{{ $main->name }}</a></td>
                        <td class="text-center">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input status_setting_main change_status_menu" type="checkbox"
                                       id="SwitchChecksetting{{$main->id}}" data-id="{{$main->id}}" data-name="setting" data-mode="main"
                                       @if($main->status_setting == 1) checked @endif>
                                <label class="form-check-label" for="SwitchChecksetting{{$main->id}}"></label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check form-switch  ">
                                <input class="form-check-input status_keep_data change_status_menu" type="checkbox"
                                       id="SwitchCheck{{$main->id}}" data-id="{{$main->id}}" data-name="keep_data" data-mode="main"
                                       @if($main->status_keep_data == 1) checked @endif>
                                <label class="form-check-label" for="SwitchCheck{{$main->id}}"></label>
                            </div>
                        </td>
                    </tr>
                    @php($ordinal_next = $main->number_show)
                @endforeach
                </tbody>
            </table>


        </div>
        <div class="col-xl-9 p-0">
            <div class="panel ">
                <div class="panel-heading bg-green-100">
                    <h4 class="panel-title"><i class="far fa-lg fa-fw me-5px fa-pen-to-square"></i>แบบบันทึกข้อมูล</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @include('backend.menu.form_main')
                </div>
            </div>


            @if(!empty($main_id))
                @if($main_id->status_have_sub == 1)
                    <div class="panel  detail_sub_menu ">
                        <div class="panel-heading  bg-lime-100">
                            <h4 class="panel-title"><i class="fas fa-lg fa-fw me-5px fa-bookmark"></i>Sub Menu</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                   data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                   data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('backend.menu.form_sub')
                            <hr>
                            <table class="table table-hover table-bordered table-td-valign-middle table-sm">
                                <thead class="bg-default">
                                <tr class="text-center">
                                    <th width="1%" class="f-s-600 text-inverse">ลำดับ</th>
                                    <th width="35%" class="with-img">Sub menu</th>
                                    <th class="text-nowrap">title</th>
                                    <th class="text-nowrap">thumbnail</th>
                                    <th class="text-nowrap">detail</th>
                                    <th class="text-nowrap">gallary</th>
                                    <th class="text-nowrap">file</th>
                                    <th class="text-nowrap">link</th>
                                    <th class="text-nowrap">num_data</th>
                                    <th class="text-nowrap">เชื่อม</th>
                                    <th class="text-nowrap">สถานะ</th>
                                    <th class="text-nowrap">แก้ไข</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($array_database_td = array(
                                        'index.board' =>'board',
                                        'index.document_all'=>'document',
                                        'index.document_category' =>'category_document',
                                         'index.activity_all'=>'activity',
                                         'index.news_all'=>'news',
                                         'index.statistics_detail'=>'statistics',
                                         'index.report_detail'=>'report',
                                        'index.complaint_show' => 'complaint',
                                        'index.direct_line_show' => 'direct',
                                        'index.violate_show' => 'violate',
                                        'index.qa_show' => 'qa',
                                        'index.comment_show' => 'comment',
                                        'index.course_all' => 'course' ,
                                        ))
                                @foreach($sub_id as $sub)
                                    <tr class="text-center">
                                        <td>{{$sub->number_show}}</td>
                                        <td class="text-start">{{$sub->name}}</td>
                                        <td>{{$sub->status_use_title}}</td>
                                        <td>{{$sub->status_use_thumbnail}}</td>
                                        <td>{{$sub->status_use_detail}}</td>
                                        <td>{{$sub->status_use_gallery}}</td>
                                        <td>{{$sub->status_use_file}}</td>
                                        <td>{{$sub->status_use_link}}</td>
                                        <td>@if($sub->number_of_data == 1) one @else many @endif</td>
                                        <td>
                                            @if(!empty($sub->join_database))
                                                {{$array_database_td[$sub->join_database]}}
                                            @else - @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch ">
                                                <input class="form-check-input status_setting_sub change_status_menu" type="checkbox"
                                                       sub-id="{{$sub->id}}" data-id="{{$sub->id}}" data-name="setting" data-mode="sub"
                                                       @if($sub->status_setting == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-yellow btn-sm"
                                               href="{{ route('menu.sub_edit',[$sub->id]) }}"
                                               role="button">แก้ไข</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif


        </div>
    </div>
@endsection

@section('script_menu')

    <script type="text/javascript">
        $(document).ready(function () {
            var data_status_sub = $('.data_status_sub').val();
            console.log(data_status_sub);
            if (data_status_sub == undefined || data_status_sub == 1) {
                $('.detail_main_menu').addClass('hide');
            } else if (data_status_sub == 0) {
                $('.detail_main_menu').removeClass('hide');
            }

            $('input[type="radio"]').change(function () {
                var status_sub_menu = $("input[name=status_sub_menu]:checked").val();
                // alert(status_sub_menu);
                if (status_sub_menu == 0) {
                    $('.detail_main_menu').removeClass('hide');
                    $('.detail_sub_menu').addClass('hide');
                } else if (status_sub_menu == 1) {
                    $('.detail_main_menu').addClass('hide');
                    $('.detail_sub_menu').removeClass('hide');
                }

            });


            $(document).on('click', '.change_status_menu', function () {
                var name = 'status_'+$(this).data('name');
                var id = $(this).attr('data-id');
                var status = $(this).is(":checked") ? 1 : 0;
                var mode = $(this).data('mode');
                update_setting_menu(mode, id, name, status);
            });

            function update_setting_menu(mode, id, name_class, status) {
                $.ajax({
                    url: '{{route('menu.setting_update')}}',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        mode: mode,
                        id: id,
                        field: name_class,
                        status: status
                    },
                    dataType: 'json',
                    success: function (data) {
                        $.gritter.add({
                            title: data.alert,
                            text: data.menu,
                            class_name: 'gritter-light'
                        });
                    }
                });
            }

        });
    </script>


@endsection

