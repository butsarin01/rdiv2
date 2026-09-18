@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="card-body">
                        <h4 class="text-primary-600"><i class="far fa-lg fa-fw me-2 fa-pen-to-square"></i>
                            @if(!empty($data_document[0])) เพิ่ม @else แก้ไข @endif ข้อมูลการดำเนินงาน
                        </h4>
                        <hr>
                        @include('backend.report.form')
                    </div>
                </div>
            </div>

            @if(!empty($data_document[0]))
                <div class="panel">
                    <div class="panel-body">
                    <span class="text-indigo-600 fw-bold fs-4 ">
                        <i class="fas fa-lg fa-fw me-2 fa-book "></i>
                        รายการข้อมูล
                    </span>
                        <hr class="my-2">
                        <table id="data-table-keytable"
                               class="table table-striped table-bordered table-td-valign-middle"
                               width="100%">
                            <thead>
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="5%" data-orderable="false">รูป</th>
                                <th width="">ชื่อเอกสาร</th>
                                <th width="5%" class="text-nowrap">ไฟล์</th>
                                <th width="25%" class="text-nowrap">หมวด</th>
                                <th width="5%">ปี</th>
                                <th width="10%">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data_document as $row)
                                <tr class="odd gradeX">
                                    <td class="f-s-600 text-inverse">{{$row->id}}</td>
                                    <td class="with-img">
                                        @if(!empty($row->thumbnail))
                                            <img src="{{asset('storage/document_img/'.$row->thumbnail)}}"
                                                 class="img-rounded h-25px"/>
                                        @else
                                            <?php echo "ไม่มีรูป"; ?>
                                        @endif
                                    </td>
                                    <td><a download="{{$row->file}}"
                                           href="{{asset('storage/document/'.$row->file)}}">{{$row->name}}</a></td>
                                    <td>@if(!empty($row->file))
                                            <img src="{{asset($row->file_type())}}" height="40">
                                        @else
                                            <?php echo "ไม่มีไฟล์"; ?>
                                        @endif
                                    </td>
                                    <td><span
                                            class="fw-bold">{{$row->type_document()->ordinal}}</span> {{$row->type_document()->name}}
                                    </td>
                                    <td>{{$row->year()}}</td>
                                    <td>
                                    <!-- <a class="btn btn-blue" href="{{route('sub_document.show',[$row->id])}}" role="button">เพิ่มเอกสารย่อย</a> -->
                                        <a class="btn btn-yellow" href="{{route('document.edit',['green',$row->id])}}"
                                           role="button">แก้ไข</a>
                                        <a class="btn btn-red" href="{{route('document.delete',[$row->id])}}"
                                           role="button">ลบ</a>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
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
        var select_value_type = $("input[name=select_value_type]").val();
        var select_value_category = $("input[name=select_value_category]").val();
        var select_value_title = $("input[name=select_value_title]").val();
        var select_value_subtitle = $("input[name=select_value_subtitle]").val();

        $(document).ready(function () {
            fetch_type(select_value_type);
            setTimeout(function () {
                fetch_category(select_value_category);
            }, 500);
            setTimeout(function () {
                fetch_title(select_value_title);
            }, 1000);
            setTimeout(function () {
                fetch_sub_title(select_value_subtitle);
            }, 1500);

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
            dynamic_select(select, value, dependent, url);

            setTimeout(function () {
                fetch_category();
            }, 500);
            setTimeout(function () {
                fetch_title();
            }, 1000);
            setTimeout(function () {
                fetch_sub_title();
            }, 1500);

        });
        // $(document).on('change', '.dynamic_input_category', function(){
        $('.dynamic_input_category').change(function () {
            var option = $('option:selected', this).attr('type_document_id');
            var select = $(".dynamic_input_category option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_category.fetch')}}";

            console.log("select = " + select + " value =" + value);
            dynamic_select(select, value, dependent, url);

            setTimeout(function () {
                fetch_title();
            }, 500);
            setTimeout(function () {
                fetch_sub_title();
            }, 1000);

        });
        // $(document).on('change', '.dynamic_input_title', function(){
        $('.dynamic_input_title').change(function () {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_title.fetch')}}";

            console.log(" select =" + select + "value=" + value);
            dynamic_select(select, value, dependent, url);

            setTimeout(function () {
                fetch_sub_title();
            }, 500);
        });

        $('.dynamic_input_Subtitle').change(function () {
            var select = $(".dynamic_input_title option:selected").text();
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var url = "{{route('dynamic_sub_title.fetch')}}";

            console.log(" select =" + select + "value=" + value);
            dynamic_select(select, value, dependent, url);

        });

        function fetch_type(data) {
            var select_year = $(".dynamic_input_type").text();
            var value_year = $(".dynamic_input_type").val();
            var dependent_year = $(".dynamic_input_type").data('dependent');
            var url_year = "{{route('dynamic_type.fetch')}}";
            var name = $(".dynamic_input_type").attr("name");
            // console.log("year = " + select_year + " value =" + value_year);
            dynamic_select(select_year, value_year, dependent_year, url_year,name,data);
        }

        function fetch_category(data) {
            var select_type = $(".dynamic_input_category").text();
            var value_type = $(".dynamic_input_category").val();
            var dependent_type = $(".dynamic_input_category").data('dependent');
            var url_type = "{{route('dynamic_category.fetch')}}";
            var name = $(".dynamic_input_category").attr("name");
            // console.log(" select =" + select_type + "value=" + value_type);
            dynamic_select(select_type, value_type, dependent_type, url_type,name,data);
        }

        function fetch_title(data) {
            var select_category = $(".dynamic_input_title").text();
            var value_category = $(".dynamic_input_title").val();
            var dependent_category = $(".dynamic_input_title").data('dependent');
            var url_category = "{{route('dynamic_title.fetch')}}";
            var name = $(".dynamic_input_title").attr("name");
            // console.log(" category =" + select_category + "value=" + value_category);
            dynamic_select(select_category, value_category, dependent_category, url_category,name,data);
        }

        function fetch_sub_title(data) {
            var select_title = $(".dynamic_input_Subtitle").text();
            var value_title = $(".dynamic_input_Subtitle").val();
            var dependent_title = $(".dynamic_input_Subtitle").data('dependent');
            var url_title = "{{route('dynamic_sub_title.fetch')}}";
            var name = $(".dynamic_input_Subtitle").attr("name");
            // console.log(" title =" + select_title + "value=" + value_title);
            dynamic_select(select_title, value_title, dependent_title, url_title,name,data);
        }

        function dynamic_select(select, value, dependent, url, name, data) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: url,
                method: "POST",
                data: {select: select, value: value, _token: _token, dependent: dependent},
                success: function (result) {
                    $('.' + dependent).html(result);
                    // console.log(result,name,dependent);
                    // console.log(name,dependent);
                    if (data != '') {
                        $('select[name=' + dependent + '] option[value=' + data + ']').prop('selected', true);
                    }
                }
            });

        }

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
            // console.log(text_year);
            $(".text-year").val(text_year);
            $(".text-year-hide").val(value_year);

            //

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

            // console.log(text_type);

            $("#name_type").val(text_type);
            $("#name_category").val(text_category);
            $("#id_type").val(value_type);
            $("#id_category").val(value_category);
        });

        $('.addCategory').click(function () {
            $("#modal-dialog-addCategory").modal("show");
            var text_year = $('.dynamic_input_type option:selected').text();
            var value_year = $('.dynamic_input_type option:selected').val();
            var text_type = $('.dynamic_input_category option:selected').text();
            var value_type = $('.dynamic_input_category option:selected').val();

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

            $("#name_year_modal").val(text_year);
            $("#id_year_modal").val(value_year);

            // console.log(value_type);
        });

        //       $('.submit_title').click(function () {
        //        $("#form_addTitle").submit(function() {
        // 	    var value_type = $( '.dynamic_input_category option:selected').val();
        // 		var value_category = $( '.dynamic_input_title option:selected' ).val();
        // 		var name_title = $("input[name=name_title]").val();
        // 		var _token = $('input[name="_token"]').val();
        // 		console.log(value_type + value_category+name_title);
        // 	 //    $.ajax({
        // 		// 	url: "{{route('title_document.insert')}}",
        // 		// 	method:'POST',
        // 		// 	data: {name_title:name_title,id_type: value_type,id_category:value_category,_token:"{{ csrf_token() }}"},
        // 		// 	success:function(result)
        // 		// 	{
        // 		// 		// $('.title_document_id').html(result);
        // 		// 		console.log(result);
        // 		// 	}
        // 		// })
        // 	});
        // });


        $(document).on("click", ".add_file", function () {
            var i = $('.input-file').val();
            i++;
            $('.input-file').val(i);
            console.log(i);
            var html = '';
            html += '<div class="row p-t-5">';
            // html += '    <div class="col-md-2 col-sm-2">';
            // html += '        <input class="form-control ordinal_question" type="number" name="ordinal_question_array[]" value="'+i+'" />';
            // html += '    </div>';
            html += '   <label class="col-md-1 col-sm-1 col-form-label" for="name">ชื่อเอกสาร:</label>';
            html += '   <div class="col-md-5 col-sm-5">';
            html += '       <input class="form-control" type="text" id="name" name="multiname[]" placeholder="" />';
            html += '   </div>';
            html += '   <label class="col-md-1 col-sm-1 col-form-label text-right" for="file">file :</label>';
            html += '   <div class="col-md-5 col-sm-5 ">';
            html += '      <div class="row ">';
            html += '           <div class="col-md-10 col-sm-10 ">';
            html += '           <input class="form-control" type="file"  name="multifilename[]" />';
            html += '       </div>';
            html += '       <div class="col-md-1 col-sm-1">';
            html += '           <button type="button" name="remove"  class="btn btn-danger btn_remove_question">';
            html += '           <i class="fas fa-lg fa-fw fa-minus-circle " ></i></button>';
            html += '       </div>';
            html += '      </div>';
            html += '   </div>';
            html += '</div>';
            $('.div-multifile').append(html);
        });
        $(document).on('click', '.btn_remove_question', function () {
            console.log($(this).parent().parent().html());
            $(this).parent().parent().parent().parent().remove();
            var numItems = $('.ordinal_question').length;
            console.log(numItems);

            var j;
            $('.ordinal_question').each(function (i, obj) {
                j = i + 1;
                $(this).val(j);
            });

            console.log('j: ' + j);
            $('.input-file').val(j);
        });
    </script>
@endsection
