
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
							<h3>เพิ่มเอกสารย่อย {{$document->name}}</h3><br>
							<form action="{{route('sub_document.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data" >
								@csrf
							<input class="form-control hide" type="text" id="member_id" name="member_id" placeholder="" data-parsley-required="true" value="{{session()->get('user.member_id')}}"/>	
							<input class="form-control hide" type="text" id="document_id" name="document_id" placeholder="" data-parsley-required="true" value="{{$document->id}}"/>	
							<input class="form-control hide" type="text" id="id" name="id" placeholder="" data-parsley-required="true" />
							<div class="form-group row m-b-15">
								<!-- <div class="col-md-4 col-sm-4 ">
									<center>
									<label class="col-md-3 col-sm-3 col-form-label">รูป</label>
									<div class="col-md-9 col-sm-9 ">
										<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="avatar" style="height: 200px; width: auto;">
										<input class="form-control file-upload" type="file" id="image_name" name="image_name" placeholder="" data-parsley-required="true" />
									</div>
									</center>
								</div> -->
								<div class="col-md-2"></div>
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
										<input class="form-control" type="file" id="filename" name="filename" placeholder="" data-parsley-required="true"/>
									</div>
									</div>
									
									<!-- <div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">ประเภทของเอกสาร:</label>
										<div class="col-md-4">
											{{ Form::select('type_document_id', App\Type_document::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกคำนำหน้า...','class'=>'form-control']) }} 
										</div>

										<label class="col-form-label col-md-2">หมวดหมู่ของเอกสาร:</label>
										<div class="col-md-4">
											{{ Form::select('category_document_id', App\Category_document::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกคำนำหน้า...','class'=>'form-control']) }} 
										</div>
									</div> -->
									<div class="form-group row m-b-15">
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
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-2 col-sm-2 col-form-label" for="file">วันที่ประกาศ  :</label>
									<div class="col-md-4 col-sm-4">
										<input class="form-control" type="text" 
                                        data-provide="datepicker" data-date-language="th-th" name="date_announcement" >
									</div>
									<label class="col-form-label col-md-2">ชั้นความเร็ว:</label>
									<div class="col-md-4">
										{{ Form::select('Level_document_id', App\Level_document::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกชั้นความเร็ว...','class'=>'form-control']) }} 
									</div>
								</div>
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label">สถานะ :</label>
										<div class="col-md-4 col-sm-4 ">
											<div class="radio radio-css radio-inline">
												<input type="radio" name="status_use" id="inlineCssRadio1x" value="1" />
												<label for="inlineCssRadio1x">ใช้งาน</label>
											</div>
											<div class="radio radio-css radio-inline">
												<input type="radio" name="status_use" id="inlineCssRadio2x" value="0" />
												<label for="inlineCssRadio2x">ยกเลิก</label>
											</div>
										</div>
									</div>
									<div class="form-group float-right ">
										<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
										<!-- <button type="submit" class="btn btn-sm btn-default">ยกเลิก</button> -->
									</div>

								</div>
								

							</div>
							
						</form>
					</div>
				</div>

			

					<div class="panel">
						<div class="panel-body">
						<table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle">
							<thead>
								<tr>
									<th width="1%">id</th>
									<th width="25%">ชื่อเอกสาร</th>
									<th width="15%"class="text-nowrap">ไฟล์</th>
									<th width="10%" >สถานะ</th>
									<th width="20%">จัดการ</th>
								</tr>
							</thead>
							<tbody>
								@foreach($sub_document as $row)
								<tr class="odd gradeX"id="{{$row->id}}" >
									<td  class="f-s-600 text-inverse">{{$row->id}}</td>
									<td data-target=name>{{$row->name}}</td>
									<td data-target=file>{{$row->file}}</td>
									<td data-target=status_use>{{$row->status_use}}</td>

									<td>
										<a class="btn btn-yellow"  role="button" data-role="update" data-id="{{$row->id}}">แก้ไข</a>
										<a class="btn btn-red" href="{{route('sub_document.delete',[$row->id])}}" role="button">ลบ</a>

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
$(document).ready(function(){
    $(document).on('click','a[data-role=update]',function(){
      // alert($(this).data('id'));
      var id = $(this).data('id');
      var name = $('#'+id).children('td[data-target=name]').text();

   		$('#id').val(id);
      	$('#name').val(name);

      // alert(id+thumbnail+name+type_product_id+list_price+our_price);

    });

});
</script>
@endsection