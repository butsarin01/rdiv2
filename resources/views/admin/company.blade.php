
@extends('admin.master1')
@section('company')
<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin row -->
		<div class="row">
			<!-- begin col-12 -->
			<div class="col-xl-12">
				<!-- begin panel -->
				<div id="accordion" class="accordion">
				<div class="card ">
					<div class="card-header  pointer-cursor d-flex align-items-center" data-toggle="collapse" data-target="#collapseOne">
						<i class="fas fa-lg fa-fw m-r-10 fa-plus-circle text-blue "></i> แบบบันทึกข้อมูลบริษัท
					</div>
					<div id="collapseOne" class="collapse" data-parent="#accordion">
						<div class="card-body">
							<form action="{{route('company.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data" >
								@csrf
							<input class="form-control hide" type="text" id="member_id" name="member_id" placeholder="" data-parsley-required="true" value="{{session()->get('user.member_id')}}"/>	
							<div class="form-group row m-b-15">
								<div class="col-md-4 col-sm-4 ">
									<center>
									<label class="col-md-3 col-sm-3 col-form-label">รูปบริษัท</label>
									<div class="col-md-9 col-sm-9 ">
										<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="avatar" style="height: 200px; width: auto;">
										<input class="form-control file-upload" type="file" id="image_name" name="image_name" placeholder="" data-parsley-required="true" />
									</div>
									</center>
								</div>
								<div class="col-md-8 col-sm-8">
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="name">ชื่อบริษัท  :</label>
										<div class="col-md-10 col-sm-10">
											<input class="form-control" type="text" id="name" name="name" placeholder="" data-parsley-required="true" />
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="name">เจ้าของโครงการ  :</label>
										<div class="col-md-10 col-sm-10">
											<input class="form-control" type="text" id="owner" name="owner" placeholder="" data-parsley-required="true" />
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="telephone">เบอร์โทร  :</label>
										<div class="col-md-10 col-sm-10">
											<input class="form-control" type="text" id="telephone" name="telephone" placeholder="" data-parsley-required="true" />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-2 col-form-label">วัน/เดือน/ปี ที่เข้าร่วม:</label>
										<div class="col-lg-5">
											<input type="text" class="form-control" id="datepicker-autoClose" placeholder=""  name="date_join" />
										</div>
										<label class="col-lg-2 col-form-label">ปี ที่เข้าร่วม:</label>
										<div class="col-lg-3">
											<input type="text" class="form-control" placeholder=""  name="year_join" />
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">ประเภทของสินค้าบริษัท:</label>
										<div class="col-md-10">
											{{ Form::select('type_company_id', App\Type_company::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกคำนำหน้า...','class'=>'form-control']) }} 
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-md-3 col-sm-3 col-form-label">สถานะ การดำเนินกิจการ :</label>
										<div class="col-md-3 col-sm-3 ">
											<div class="radio radio-css radio-inline">
												<input type="radio" name="status_office" id="inlineCssRadio1x" value="1" />
												<label for="inlineCssRadio1x">กำลัง</label>
											</div>
											<div class="radio radio-css radio-inline">
												<input type="radio" name="status_office" id="inlineCssRadio2x" value="0" />
												<label for="inlineCssRadio2x">ยกเลิก</label>
											</div>
										</div>
									</div>

									<label class="col-md-2 col-sm-2 col-form-label" for="benefit">ประโยชน์ :</label>
									<textarea class="summernote" name="benefit" id="benefit"></textarea>
									<textarea class="hide" name="benefit_hidden" id="benefit_hidden"></textarea>


								</div>

							</div>
							<div class="form-group float-right ">
								<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
								<!-- <button type="submit" class="btn btn-sm btn-default">ยกเลิก</button> -->
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>

			

					<div class="panel  ">
						<div class="panel-body">
						<table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle">
							<thead>
								<tr>
									<th width="1%">id</th>
									<th width="4%" data-orderable="false">รูปบริษัท</th>
									<th width="15%">บริษัท</th>
									<th width="3%"class="text-nowrap">วัน/เดือน/ปี ที่เข้าร่วม</th>
									<th width="3%"class="text-nowrap">ประเภทของสินค้าบริษัท</th>
									<th width="1%" >สถานะ</th>
									<th width="2%">แก้ไข</th>
								</tr>
							</thead>
							<tbody>
								@foreach($company as $row)
								<tr class="odd gradeX">
									<td  class="f-s-600 text-inverse">{{$row->id}}</td>
									<td  class="with-img">
										<img src="{{asset('storage/company/'.$row->thumbnail)}}" class="img-rounded height-70" /><br>{{$row->thumbnail}}</td>
									<td >{{$row->name}}<br>
										{{$row->owner}}<br>
										เบอร์โทร : {{$row->telephone}}
									</td>
									<td>{{$row->date_join}}</td>
									<td>{{$row->type_company()}}</td>
									<td>{{$row->status_office}}</td>

									<td>
										<a class="btn btn-blue" href="{{route('product.show',[$row->id])}}" role="button">เพิ่มสินค้า</a>
										<a class="btn btn-yellow" href="{{route('company.edit',[$row->id])}}" role="button">แก้ไข</a>
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