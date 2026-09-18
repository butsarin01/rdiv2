@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-xl-4 ui-sortable">
            <h4 class="text-center">หมวดการใช้ทรัพยากร</h4>
            <div class="widget-list rounded mb-4" data-id="widget">
                @if(!empty($data_main_all ))
                    @foreach($data_main_all as $row)
                        <a href="{{route('statistics.setting',$row->id)}}" class="widget-list-item">
                            <div class="widget-list-media icon">
                                <i class="{{$row->icon}} bg-dark text-white"></i>
                            </div>
                            <div class="widget-list-content">
                                <h3 class="widget-list-title">{{$row->name}}</h3>
                            </div>
                            <div class="widget-list-action text-nowrap text-gray-600 fw-bold text-decoration-none">
                                <i class="fa fa-angle-right fa-lg ms-3 text-gray-500"></i>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="col-xl-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="card-body">
                        <h4 class="text-primary-600"><i class="far fa-lg fa-fw me-2 fa-pen-to-square"></i>จัดการข้อมูล
                        </h4>
                        <hr>
                        @php
                            $id = '';
                            $img = asset('images/images.png');
                            $name = '';
                            $name_eng = '';
                            $unit = '';
                            $icon = '';
                            $color = '';
                            $ordinal = '';
                            $count_input = 1;
                            $array = array();
                           if(!empty($data_main)){
                                $id = $data_main->id;
                                $img = asset('images/images.png');
                                $name = $data_main->name;
                                $name_eng = $data_main->name_eng;
                                $unit = $data_main->unit;
                                $icon = $data_main->icon;
                                $color = $data_main->color;
                                $ordinal = $data_main->ordinal;
                                $array = $data_main->array_input();
                                $count_input = count($array);
                           }

                        @endphp

                        <form action="{{route('statistics.insert')}}" method="POST" name="summernote_form"
                              enctype="multipart/form-data">
                            @csrf
                            <input class="form-control hide" type="text" id="member_id" name="member_id"
                                   placeholder="" value="{{session()->get('user.member_id')}}"/>
                            <input class="form-control hide" type="text" id="document_id" name="id"
                                   placeholder="" value="{{$id}}"/>
                            <div class="form-group row mb-1">
                                <div class="col-md-8 col-sm-8">
                                    <div class="form-group row mb-1">
                                        <label class="col-md-3 col-sm-3 col-form-label" for="name">ชื่อ (ภาษาไทย)
                                            :</label>
                                        <div class="col-md-9 col-sm-9">
                                            <input class="form-control" type="text" id="name" name="name"
                                                   value="{{$name}}"
                                                   placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label class="col-md-3 col-sm-3 col-form-label" for="name">หน่วยปริมาณการใช้
                                            :</label>
                                        <div class="col-md-9 col-sm-9">
                                            <input class="form-control" type="text" id="name" name="unit"
                                                   value="{{$unit}}"
                                                   placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label class="col-md-3 col-sm-3 col-form-label" for="file">รูปที่เป็นสัญลักษณ์
                                            :</label>
                                        <div class="col-md-9 col-sm-9">
                                            <input class="form-control file-upload" type="file" id="image_name"
                                                   name="image_name" accept="image/png, image/gif, image/jpeg"/>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label class="col-md-3 col-sm-3 col-form-label" for="file">ลำดับการแสดง
                                            :</label>
                                        <div class="col-md-3 col-sm-3">
                                            <input class="form-control" type="number" id="ordinal" name="ordinal"
                                                   value="{{$ordinal}}"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    @if(!empty($array[0]))
                                        <div class="form-group row mb-1">
                                            <label class="col-md-3 col-sm-3 col-form-label" for="file">ช่องการบันทึกข้อมูล
                                                :</label>
                                            <div class="col-md-9  div-multifile">
                                                @foreach($array as $key => $row)
                                                    <div class="row {{ $key > 0 ? 'pt-2' : ''}} ">
                                                        <div class="col-md-3 col-sm-3">
                                                            <input class="form-control ordinal_question" type="number"
                                                                   id="ordinal" name="ordinal_input[]"
                                                                   value="{{($key+1)}}"
                                                                   placeholder="">
                                                        </div>
                                                        <div class="col-md-7 col-sm-7">
                                                            <input class="form-control" type="text" id="ordinal"
                                                                   name="name_input[]"
                                                                   value="{{$row}}"
                                                                   placeholder="">
                                                        </div>
                                                        <div class="col-md-1 col-sm-1">
                                                            @if($key == 0)
                                                                <button type="button"
                                                                        class="btn  btn-info text-white dynamic-add-table">
                                                                    <i class="fas fa-lg fa-fw fa-circle-plus"></i>
                                                                </button>
                                                            @else
                                                                <button type="button" name="remove"
                                                                        class="btn btn-danger btn_remove_question">
                                                                    <i class="fas fa-lg fa-fw fa-minus-circle "></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <input type="hidden" class="input-i" value="{{$count_input}}">
                                    @endif
                                    <div class="form-group row pt-2">
                                        <div class="col-md-12 col-sm-12  text-center ">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-lg fa-fw me-2 fa-floppy-disk"></i>บันทึก
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{$img}}" class="avatar img-thumbnail" alt="avatar"
                                         style="height: 200px; width: auto;">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('script_content')
    <script type="text/javascript">
        $.ajaxSetup({
            beforeSend: function (xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });


        $(document).on("click", ".dynamic-add-table", function () {
            var i = $('.input-i').val();
            i++;
            $('.input-i').val(i);
            console.log(i);
            var html = '';
            html += '<div class="row pt-2">';
            html += '    <div class="col-md-3 col-sm-3">';
            html += '        <input class="form-control ordinal_question" type="number" name="ordinal_question_array[]" value="' + i + '" />';
            html += '    </div>';
            // html += '   <label class="col-md-1 col-sm-1 col-form-label" for="name">ชื่อเอกสาร:</label>';
            html += '   <div class="col-md-7 col-sm-7">';
            html += '       <input class="form-control" type="text" id="name" name="multiname[]" placeholder="" />';
            html += '   </div>';
            // html += '   <label class="col-md-1 col-sm-1 col-form-label text-right" for="file">file :</label>';
            // html += '   <div class="col-md-5 col-sm-5 ">';
            // html += '      <div class="row ">';
            // html += '           <div class="col-md-10 col-sm-10 ">';
            // html += '           <input class="form-control" type="file"  name="multifilename[]" />';
            // html += '       </div>';
            html += '       <div class="col-md-1 col-sm-1">';
            html += '           <button type="button" name="remove"  class="btn btn-danger btn_remove_question">';
            html += '           <i class="fas fa-lg fa-fw fa-minus-circle " ></i></button>';
            html += '       </div>';
            // html += '      </div>';
            // html += '   </div>';
            html += '</div>';
            $('.div-multifile').append(html);
        });
        $(document).on('click', '.btn_remove_question', function () {
            console.log($(this).parent().html());
            $(this).parent().parent().remove();
            var numItems = $('.ordinal_question').length;
            console.log(numItems);

            var j;
            $('.ordinal_question').each(function (i, obj) {
                j = i + 1;
                $(this).val(j);
            });

            console.log('j: ' + j);
            $('.input-i').val(j);
        });
    </script>
@endsection
