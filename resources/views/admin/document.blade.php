
@extends('admin.master')
@section('document')
<!-- begin #content -->
<div id="content" class="content">
	<!-- begin row -->
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-xl-12">
			<!-- begin panel -->
			<div class="panel">
				<div class="panel-body">
					<div class="card-body">
						<h4>เพิ่มเอกสาร</h4>
						<form action="{{route('document.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data" >
							@csrf
						<input class="form-control hide" type="text" id="member_id" name="member_id" placeholder="" data-parsley-required="true" value="{{session()->get('user.member_id')}}"/>	
						<div class="form-group row m-b-15">
							<div class="col-md-4 col-sm-4 ">
								<center>
								<label class="col-md-3 col-sm-3 col-form-label">รูป</label>
								<div class="col-md-9 col-sm-9 ">
									<img src="{{asset('images/images.png')}}" class="avatar img-thumbnail" alt="avatar" style="height: 200px; width: auto;">
									<input class="form-control file-upload" type="file" id="image_name" name="image_name" placeholder="" data-parsley-required="true" />
								</div>
								</center>
							</div>
							<div class="col-md-8 col-sm-8">
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="name">ชื่อเอกสาร  :</label>
									<div class="col-md-10 col-sm-10">
										<input class="form-control" type="text" id="name" name="name" placeholder="" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="file">file  :</label>
								<div class="col-md-10 col-sm-10">
									<input class="form-control" type="file" id="filename" name="filename" placeholder="" />
								</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="file">link  :</label>
								<div class="col-md-10 col-sm-10">
									<input class="form-control" type="text" id="link" name="link" placeholder="" />
								</div>
								</div>
								
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-2">ประเภทของเอกสาร:</label>
									<div class="col-md-4">
										{{ Form::select('type_document_id', App\Type_document::whereNull('type_quality_id')->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกประเภท...','class'=>'form-control dynamic_input_category','data-dependent'=>'category_document_id']) }} 
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
									<div class="col-md-6">
										<select class="form-control title_document_id" id="title_document_id" name="title_document_id" >
											<option value="0">เลือกหัวข้อ..</option>
										</select>
									</div>
									<div class="col-md-2 col-sm-2 btn-show-modal-title hide">
										<a href="#modal-dialog-addTitle" class="btn btn-success addTitles" data-toggle="modal" data-target=".bd-example-modal-lg" id="addTitles">เพิ่มหัวข้อ</a>
									</div>
								
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-3 col-form-label" for="file">ลำดับการแสดง  :</label>
									<div class="col-md-3 col-sm-3">
										<input class="form-control" type="number" id="ordinal" name="ordinal" placeholder="" />
									</div>
								</div>
								<!-- <div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="file">ผู้ส่ง  :</label>
									<div class="col-md-2">
										{{ Form::select('sent_office_id',App\Sent_office::all()->pluck('name','id'), null, ['placeholder' => 'เลือกผู้ส่ง...','class'=>'form-control']) }} 
									</div>
									<div class="col-md-2 col-sm-2">
										<a href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">เพิ่มผู้ส่ง</a>
									</div>

									<label class="col-md-2 col-sm-3 col-form-label" for="file">เลขที่หนังสือ  :</label>
									<div class="col-md-4 col-sm-4">
										<input class="form-control" type="text" id="number_document" name="number_document" placeholder="" data-parsley-required="true" />
									</div> 
								</div>-->
								<!-- <div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="file">วันที่ประกาศ  :</label>
									<div class="col-md-4 col-sm-4">
										<input class="form-control" type="text" 
                                        data-provide="datepicker" data-date-language="th-th" name="date_announcement" >
									</div>
									<label class="col-form-label col-md-2">ชั้นความเร็ว:</label>
									<div class="col-md-4">
										{{ Form::select('Level_document_id', App\Level_document::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกชั้นความเร็ว...','class'=>'form-control']) }} 
									</div>
								</div> -->
								<div class="form-group row m-b-15">
									
									<label class="col-md-2 col-sm-2 col-form-label">สถานะ :</label>
									<div class="col-md-4 col-sm-4 ">
										<div class="radio radio-css radio-inline">
											<input type="radio" name="status_use" id="inlineCssRadio1x" value="1" checked />
											<label for="inlineCssRadio1x">ใช้งาน</label>
										</div>
										<div class="radio radio-css radio-inline">
											<input type="radio" name="status_use" id="inlineCssRadio2x" value="0" />
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
                                                        <div class="row ">
                                                            <label class="col-md-1 col-sm-1 col-form-label" for="name">ชื่อเอกสาร:</label>
                                                            <div class="col-md-5 col-sm-5">
                                                                <input class="form-control" type="text"  name="multiname[]"
                                                                       placeholder="" />
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
                                        <div class="row ">
                                            <div class="col-md-6 col-sm-6  float-right ">
                                                <button type="submit" class="btn  btn-primary float-right">บันทึก
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
					</form>
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
						<form method="POST" action="{{route('title_document.insert')}}" id="form_addTitle" >
						@csrf
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label" for="name_type">ประเภทของเอกสาร :</label>
								<div class="col-md-7 col-sm-7">
									<input class="form-control" type="text" id="name_type" name="name_type" placeholder=""  disabled/>
									<input class="form-control hide" type="text" id="id_type" name="id_type" placeholder="" />
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label" for="name_category">หมวดหมู่ของเอกสาร :</label>
								<div class="col-md-7 col-sm-7">
									<input class="form-control" type="text" id="name_category" name="name_category" placeholder="" disabled />
									<input class="form-control hide" type="text" id="id_category" name="id_category" placeholder=""  />
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-md-2 col-sm-2 col-form-label" for="name">หัวข้อ:</label>
								<div class="col-md-10 col-sm-10">
									<!-- <textarea class="form-control" rows="2" name="address"></textarea> -->
									<input class="form-control " type="text" id="name_title" name="name_title" placeholder=""  />
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

		<!-- <div class="modal fade bd-example-modal-lg" id="modal-dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">รายการหน่วยงานที่ส่ง </h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<form action="{{route('sent_office.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data" >
						@csrf
						<input class="form-control hide" type="text" id="sent_office_id" name="sent_office_id" placeholder="" data-parsley-required="true" />

							<div class="form-group row m-b-15">
								<label class="col-md-1 col-sm-1 col-form-label" for="sent_office
								_name">ชื่อย่อ :</label>
								<div class="col-md-2 col-sm-2">
									<input class="form-control" type="text" id="name" name="name" placeholder="" data-parsley-required="true" />
								</div>
								<label class="col-md-1 col-sm-1 col-form-label" for="fullname"> ชื่อเต็ม:</label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" id="fullname" name="fullname" placeholder="" data-parsley-required="true" />
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-md-1 col-sm-1 col-form-label" for="name">ที่อยู่  :</label>
								<div class="col-md-11 col-sm-11">
									<input class="form-control" type="text" id="address" name="address" placeholder="" data-parsley-required="true" />
								</div>
							</div>
							<div class="col-md-6 col-sm-6  float-right ">
								<button type="submit" class="btn btn-sm btn-primary float-right">บันทึก</button>
							</div>
						</form>

						<table class="table table-hover">
						  <thead>
								<tr>
									<th width="2%">ชื่อย่อ</th>
									<th width="15%">ชื่อเต็ม</th>
									<th width="10%"class="text-nowrap">ที่อยู่</th>
									<th width="5%">จัดการ</th>
								</tr>
							</thead>
							<tbody>
								@foreach($sent_office as $row)
								<tr>
									<td>{{$row->name}}</td>
									<td>{{$row->fullname}}</td>
									<td>{{$row->address}}</td>
									<td>
										<a class="btn btn-yellow" href="{{route('document.edit',[$row->id])}}" role="button">แก้ไข</a>
										<a class="btn btn-red" href="{{route('sent_office.delete',[$row->id])}}" role="button">ลบ</a>
									</td>
								</tr>
								@endforeach

							</tbody>
						</table>


					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<a href="javascript:;" class="btn btn-success">Action</a>
					</div>
				</div>
			</div>
		</div> -->

		

		<div class="panel">
			<div class="panel-body">
				<table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle">
					<thead>
						<tr>
							<th width="1%">id</th>
							<th width="4%" data-orderable="false">รูป</th>
							<th width="27%">ชื่อเอกสาร</th>
							<th width="5%"class="text-nowrap">ไฟล์</th>
							<th width="6%"class="text-nowrap">ประเภท</th>
							<th width="5%" >สถานะ</th>
							<th width="10%">จัดการ</th>
						</tr>
					</thead>
					<tbody>
						@foreach($document as $row)
						<tr class="odd gradeX">
							<td  class="f-s-600 text-inverse">{{$row->id}}</td>
							<td  class="with-img">
								@if(!empty($row->thumbnail))
								<img src="{{asset('storage/document_img/'.$row->thumbnail)}}" class="img-rounded height-50" />
								@else
								<?php echo "ไม่มีรูป"; ?>
								@endif
							</td>
							<td >
								@if(!empty($row->link))
									<a href="{{$row->link}}" target="_blank"><i class="fas fa-lg fa-fw m-r-10 fa-link"></i></a>
								@endif

								@if(!empty($row->file))
									<a download="{{$row->file}}" href="{{asset('storage/document/'.$row->file)}}">{{$row->name}}</a>
								@else
									{{$row->name}}
								@endif
							</td>
							<td>
								@if(!empty($row->file))
								<img src="{{asset($row->file_type())}}" height="40">
								@else
									<?php echo "ไม่มีไฟล์"; ?>
								@endif
							</td>
							<td>{{$row->type_document()}}</td>
							<td>{{$row->status_use()}}</td>
							<td>.
								<!-- <a class="btn btn-blue" href="{{route('sub_document.show',[$row->id])}}" role="button">เพิ่มเอกสารย่อย</a> -->
								<a class="btn btn-yellow" href="{{route('document.edit',[$row->id])}}" role="button">แก้ไข</a>
								<a class="btn btn-red" href="{{route('document.delete',[$row->id])}}" role="button">ลบ</a>

							</td>
							
						</tr>	
						@endforeach
					</tbody>
				</table>
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
		// $(document).on('change', '.dynamic_input_category', function(){
		$('.dynamic_input_category').change(function(){
			$('.btn-show-modal-title').removeClass('hide');
			var option = $('option:selected', this).attr('type_document_id');
			var select = $( ".dynamic_input_category option:selected" ).text(); 
			var value = $(this).val();
			var dependent = $(this).data('dependent');
			var url = "{{route('dynamic_category.fetch')}}";
			get_data_dynamic(url,select,value,dependent);

			setTimeout(function() { 
		      	var value_category = $('.dynamic_input_title').val();
				var select_category = $(".dynamic_input_title" ).text(); 
		      	var url_category = "{{route('dynamic_title.fetch')}}";
		      	var dependent_category = $('.dynamic_input_title').data('dependent');
				console.log(select_category);
				get_data_dynamic(url_category,select_category,value_category,dependent_category);

		    }, 500);
		});

		$('.dynamic_input_title').change(function(){
			var value_type = $( '.dynamic_input_category option:selected').val(); 
			var option = $('option:selected', this).attr('category_document_id');
			var select = $( ".dynamic_input_title option:selected" ).text(); 
			var value_category = $(this).val();
			var dependent = $(this).data('dependent');
			var url = "{{route('dynamic_title.fetch')}}";
			get_data_dynamic(url,select,value_category,dependent);

		});

		

		function get_data_dynamic(url,select,value,dependent){
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: url,
				method:"POST",
				data: {select:select,value: value,_token:_token,dependent:dependent},
				success:function(result)
				{
					$('.'+dependent).html(result);
					console.log(result);
				}
			})

		}

		$('.addTitles').click(function () {
            $("#modal-dialog-addTitle").modal("show"); 
			var text_type = $( '.dynamic_input_category option:selected').text();  
			var text_category = $( '.dynamic_input_title option:selected' ).text(); 
			var value_type = $( '.dynamic_input_category option:selected').val();
			var value_category = $( '.dynamic_input_title option:selected' ).val();

			$("#name_type").val(text_type);
			$("#name_category").val(text_category);
			$("#id_type").val(value_type);
			$("#id_category").val(value_category);
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