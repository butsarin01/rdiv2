
@extends('admin.master')
@section('document')
<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin row -->
		<div class="row">
			<!-- begin col-12 -->
			<div class="col-xl-12">
				<!-- begin panel -->
				<div class="panel  ">
					<div class="panel-body">
						<h3>แก้ไข {{$document->name}}</h3>
						<form action="{{route('document.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data" >
							@csrf
						<input class="form-control hide" type="text" id="member_id" name="member_id" placeholder="" data-parsley-required="true" value="{{session()->get('user.member_id')}}"/>
						<div class="form-group row m-b-15">
						<input class="form-control hide" type="text" id="document_id" name="document_id" placeholder=""  value="{{$document->id}}" />
							<div class="col-md-4 col-sm-4 ">
								<center>
								<label class="col-md-3 col-sm-3 col-form-label">รูป</label>
								<div class="col-md-9 col-sm-9 ">
									 @if(!empty($document->thumbnail))
                                    <img src="{{asset('storage/document_img/'.$document->thumbnail)}}"
                                         class="avatar img-thumbnail" alt="avatar"
                                         style="height: 200px; width: auto;">
                                    @else
                                    <img src="{{asset('images/images.png')}}" class="avatar img-thumbnail"
                                         alt="avatar" style="height: 200px; width: auto;">
                                    @endif
									<input class="form-control file-upload" type="file" id="image_name" name="image_name" placeholder="" data-parsley-required="true" />
								</div>
								</center>
							</div>
							<div class="col-md-8 col-sm-8">
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="name">ชื่อเอกสาร  :</label>
									<div class="col-md-10 col-sm-10">
										<input class="form-control" type="text" id="name" name="name" placeholder="" data-parsley-required="true"  value="{{$document->name}}"/>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="file">file  :</label>
								<div class="col-md-10 col-sm-10">
                                    @if(!empty($document->file))
                                        <a href="{{asset('storage/document/'.$document->file)}}"
                                           target="_blank">
                                            {{$document->file}}
                                        </a>
                                    @endif
									<input class="form-control" type="file" id="filename" name="filename" placeholder="" data-parsley-required="true"/>

								</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="link">link  :</label>
								<div class="col-md-10 col-sm-10">
                                    @if(!empty($document->link))
                                        <a href="{{$document->link}}" target="_blank">
                                            <!-- {{$document->link}} -->
                                            <i class="fas fa-lg fa-fw m-r-2 fa-link"></i> link
                                        </a>
                                    @endif
									<input class="form-control" type="text" id="link" name="link" placeholder="" value="{{$document->link}}" />

								</div>
								</div>

								<input class="hide" type="text" name="select_value_category" value="{{$document->category_document_id}}">
                                    <input class="hide" type="text" name="select_value_title" value="{{$document->title_document_id}}">
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-2">ประเภทของเอกสาร:</label>
									<div class="col-md-4">

                                        {{ Form::select('type_document_id', App\Type_document::all()->pluck('name','id'), $document->type_document_id, ['placeholder' => 'กรุณาเลือกประเภท...','class'=>'form-control dynamic_input_category','data-dependent'=>'category_document_id']) }}

									</div>

									<label class="col-form-label col-md-2">หมวดหมู่ของเอกสาร:</label>
									<div class="col-md-4">
										<select class="form-control category_document_id dynamic_input_title" id="category_document_id" name="category_document_id" data-dependent="title_document_id">

											<option value="0">เลือกหมวดหมู่..</option>
										</select>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="file">หัวข้อ  :</label>
									<div class="col-md-3">
										<select class="form-control title_document_id" id="title_document_id" name="title_document_id" >
											<option value="0">เลือกหัวข้อ..</option>
										</select>
									</div>
									<div class="col-md-2 col-sm-2">
										<a href="#modal-dialog-addTitle" class="btn btn-success addTitles" data-toggle="modal" data-target=".bd-example-modal-lg" id="addTitles">เพิ่มหัวข้อ</a>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-3 col-form-label" for="file">ลำดับการแสดง  :</label>
									<div class="col-md-3 col-sm-3">
										<input class="form-control" type="number" id="ordinal" name="ordinal" placeholder="" value="{{$document->ordinal}}" />
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label">สถานะ :</label>
									<div class="col-md-4 col-sm-4 ">
										<div class="radio radio-css radio-inline">
											<input type="radio" name="status_use" id="inlineCssRadio1x" value="1" @if($document->status_use == 1) checked @endif/>
											<label for="inlineCssRadio1x">ใช้งาน</label>
										</div>
										<div class="radio radio-css radio-inline">
											<input type="radio" name="status_use" id="inlineCssRadio2x" value="0" @if($document->status_use == 0) checked @endif/>
											<label for="inlineCssRadio2x">ยกเลิก</label>
										</div>
									</div>
								</div>
							</div>
						</div>
								<div class="row ">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group row ">
                                        <label class="col-md-2 col-sm-2 col-form-label text-right font-weight-bold" for="file">เอกสารร่วม:</label>
                                        <div class="col-md-10 col-sm-10">

                                            <div class="card border-warning text-warning">
                                                <div class="card-body div-multifile">
                                                    <div class="row">
                                                        <label class="col-md-1 col-sm-1 col-form-label" for="name">ชื่อเอกสาร:</label>
                                                        <div class="col-md-5 col-sm-5">
                                                            <input class="form-control" type="text"  name="multiname[]" placeholder="" />
                                                        </div>
                                                        <label class="col-md-1 col-sm-1 col-form-label text-right" for="file">file :</label>
                                                        <div class="col-md-5 col-sm-5 ">
                                                            <div class="row ">
                                                                <div class="col-md-10 col-sm-10">
                                                                    <input class="form-control" type="file" id="multifilename"
                                                                           name="multifilename[]" placeholder=""
                                                                           data-parsley-required="true"/>
                                                                </div>
                                                                <div class="col-md-1 col-sm-1">
                                                                    <button type="button" name="add" id="add_file"
                                                                            class="btn btn-info add_file">
                                                                        <i class="fas fa-lg fa-fw  fa-plus-circle "></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="input-file" value="1">
                                            </div>
                                        </div>
                                    </div>
								@if(!empty($sub_document[0]))
                                        <div class="form-group row">
                                            <label class="col-md-2 col-sm-2 col-form-label text-right font-weight-bold" for="file">เอกสารที่บันทึก :</label>
                                            <div class="col-md-10 col-sm-10">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                    <tr align="center">
                                                        <th align="center">ลำดับที่</th>
                                                        <th>ชื่อเอกสาร</th>
                                                        <th>ไฟล์เอกสาร</th>
                                                        <th align="center">จัดการ</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $count_file = 0 ; ?>
                                                        @foreach($sub_document as $data)
                                                            <?php $count_file++; ?>
                                                            <tr>
                                                                <td align="center">{{$count_file}}</td>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->file}}</td>
                                                                <td align="center">
                                                                    <a class="btn btn-red btn-sm"
                                                                       href="{{route('sub_document.delete',[$data->id])}}" role="button">ลบ</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
								<div class="form-group float-right ">
									<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
									<!-- <button type="submit" class="btn btn-sm btn-default">ยกเลิก</button> -->
								</div>

							</div>


						</div>

					</form>
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
						<form method="POST" action="{{route('title_document.insert')}}" id="form_addTitle" >
						@csrf
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label" for="name_type">ประเภทของเอกสาร :</label>
								<div class="col-md-7 col-sm-7">
									<input class="form-control" type="text" id="name_type" name="name_type" placeholder=""  disabled/>
									<input class="form-control " type="text" id="id_type" name="id_type" placeholder="" />
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label" for="name_category">หมวดหมู่ของเอกสาร :</label>
								<div class="col-md-7 col-sm-7">
									<input class="form-control" type="text" id="name_category" name="name_category" placeholder="" disabled />
									<input class="form-control " type="text" id="id_category" name="id_category" placeholder=""  />
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-md-2 col-sm-2 col-form-label" for="name">หัวข้อ:</label>
								<div class="col-md-10 col-sm-10">
									<!-- <textarea class="form-control" rows="2" name="address"></textarea> -->
									<input class="form-control" type="text" id="name_title" name="name_title" placeholder=""  />
								</div>
							</div>
							<div class="col-md-6 col-sm-6  float-right ">
								<button type="submit" class="btn btn-sm btn-primary float-right submit_title" >บันทึก</button>
							</div>
						</form>


					</div>
					<!-- <div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<a href="javascript:;" class="btn btn-success">save</a>
					</div> -->
				</div>
			</div>
		</div>





				<!-- end panel -->
			</div>
			<!-- end col-10 -->
		</div>
		<!-- end row -->
	</div>
	<!-- end #content -->
@endsection
@section('script_content')
<script type="text/javascript">
	$.ajaxSetup({
	    beforeSend: function(xhr, type) {
	        if (!type.crossDomain) {
	            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
	        }
	    },
	});
	$(document).ready(function(){
		  fetch_category();
            setTimeout(function() {fetch_title();}, 500);

            // $(document).on('change', '.dynamic_input_category', function(){
            $('.dynamic_input_category').change(function () {
                var option = $('option:selected', this).attr('type_document_id');
                var select = $(".dynamic_input_category option:selected").text();
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var url = "{{route('dynamic_category.fetch')}}";

                console.log("select = " + select + " value =" + value);
                dynamic_select(select,value,dependent,url);
            });
            // $(document).on('change', '.dynamic_input_title', function(){
            $('.dynamic_input_title').change(function () {
                var select = $(".dynamic_input_title option:selected").text();
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var url = "{{route('dynamic_title.fetch')}}";

                console.log(" select =" + select + "value=" + value);
                dynamic_select(select,value,dependent,url);

            });
            $('.addTitles').click(function () {
                $("#modal-dialog-addTitle").modal("show");
                var text_type = $('.dynamic_input_category option:selected').text();
                var text_category = $('.dynamic_input_title option:selected').text();
                var value_type = $('.dynamic_input_category option:selected').val();
                var value_category = $('.dynamic_input_title option:selected').val();

                $("#name_type").val(text_type);
                $("#name_category").val(text_category);
                $("#id_type").val(value_type);
                $("#id_category").val(value_category);
            });

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

            function dynamic_select(select,value,dependent,url){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {select: select, value: value, _token: _token, dependent: dependent},
                    success: function (result) {
                        $('.' + dependent).html(result);
                        console.log(result);

                        var select_value_category = $("input[name=select_value_category]").val();
                        console.log(select_value_category);

                        $('.category_document_id option[value='+select_value_category+']').prop('selected', true);

                        var select_value_title = $("input[name=select_value_title]").val();
                        console.log(select_value_title);

                        $('.title_document_id option[value='+select_value_category+']').prop('selected', true);

                    }
                });

            }

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

    });
    $(document).on("click", ".add_file", function () {
            var i = $('.input-file').val();
            i++;
            $('.input-file').val(i);
            console.log(i);
            var html = '';
            html += '<div class="row p-t-5">';
            // html += '	<div class="col-md-2 col-sm-2">';
            // html += '		<input class="form-control ordinal_question" type="number" name="ordinal_question_array[]" value="'+i+'" />';
            // html += '	</div>';
            html += '   <label class="col-md-1 col-sm-1 col-form-label" for="name">ชื่อเอกสาร:</label>';
            html += '   <div class="col-md-5 col-sm-5">';
            html += '       <input class="form-control" type="text" id="name" name="multiname[]" placeholder="" />';
            html += '   </div>';
            html += '   <label class="col-md-1 col-sm-1 col-form-label text-right" for="file">file :</label>';
            html += '   <div class="col-md-5 col-sm-5 ">';
            html += '      <div class="row ">';
            html += '         	<div class="col-md-10 col-sm-10 ">';
            html += '      		<input class="form-control" type="file"  name="multifilename[]" />';
            html += '      	</div>';
            html += '      	<div class="col-md-1 col-sm-1">';
            html += '      		<button type="button" name="remove"  class="btn btn-danger btn_remove_question">';
            html += '      		<i class="fas fa-lg fa-fw fa-minus-circle " ></i></button>';
            html += '      	</div>';
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
