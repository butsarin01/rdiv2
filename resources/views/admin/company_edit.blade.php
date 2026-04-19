
@extends('admin.master')
@section('company')
<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin row -->
		<div class="row">
			<!-- begin col-12 -->
			<div class="col-xl-12">
				<!-- begin panel -->
				<div class="panel  ">
					<div class="panel-body">
						<form action="{{route('company.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data" >
						@csrf
						<input class="form-control hide" type="text" id="member_id" name="member_id" placeholder="" data-parsley-required="true" value="{{session()->get('user.member_id')}}"/>
						<input class="form-control hide" type="text" id="company_id" name="company_id" placeholder=""  value="{{$company->id}}" />		
							<div class="form-group row m-b-15">
								<div class="col-md-4 col-sm-4 ">
									<center>
									<label class="col-md-3 col-sm-3 col-form-label">รูปบริษัท</label>
									<div class="col-md-9 col-sm-9 ">
										<img src="{{asset('storage/company/'.$company->thumbnail)}}" class="avatar img-thumbnail" alt="avatar" style="height: 200px; width: auto;">
										<input class="form-control file-upload" type="file" id="image_name" name="image_name" placeholder="" data-parsley-required="true" />
									</div>
									</center>
								</div>
								<div class="col-md-8 col-sm-8">
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="name">ชื่อบริษัท  :</label>
										<div class="col-md-10 col-sm-10">
											<input class="form-control" type="text" id="name" name="name" placeholder="" data-parsley-required="true" value="{{$company->name}}"/>
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="name">เจ้าของโครงการ  :</label>
										<div class="col-md-10 col-sm-10">
											<input class="form-control" type="text" id="owner" name="owner" placeholder="" data-parsley-required="true" value="{{$company->owner}}"/>
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="telephone">เบอร์โทร  :</label>
										<div class="col-md-10 col-sm-10">
											<input class="form-control" type="text" id="telephone" name="telephone" placeholder="" data-parsley-required="true" value="{{$company->telephone}}"/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-2 col-form-label">วัน/เดือน/ปี ที่เข้าร่วม:</label>
										<div class="col-lg-5">
											<input type="text" class="form-control" id="datepicker-autoClose" placeholder=""  name="date_join" value="{{$company->date_join}}"/>
										</div>
										<label class="col-lg-2 col-form-label">ปี ที่เข้าร่วม:</label>
										<div class="col-lg-3">
											<input type="text" class="form-control" placeholder=""  name="year_join" value="{{$company->year_join}}"/>
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">ประเภทของสินค้าบริษัท:</label>
										<div class="col-md-10">
											{{ Form::select('type_company_id', App\Type_company::all()->pluck('name','id'), $company->type_company_id, ['placeholder' => 'กรุณาเลือกคำนำหน้า...','class'=>'form-control']) }} 
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-md-3 col-sm-3 col-form-label">สถานะ การดำเนินกิจการ :</label>
										<div class="col-md-3 col-sm-3 ">
											<div class="radio radio-css radio-inline">
												<input type="radio" name="status_office" id="inlineCssRadio1x" value="1" @if($company->status_office == 1) checked @endif/>
												<label for="inlineCssRadio1x">กำลัง</label>
											</div>
											<div class="radio radio-css radio-inline">
												<input type="radio" name="status_office" id="inlineCssRadio2x" value="0" @if($company->status_office == 0) checked @endif/>
												<label for="inlineCssRadio2x">ยกเลิก</label>
											</div>
										</div>
									</div>

									<label class="col-md-2 col-sm-2 col-form-label" for="benefit">ประโยชน์ :</label>
									<textarea class="summernote" name="benefit" id="benefit">{{$company->benefit}}</textarea>
									<textarea class="hide" name="benefit_hidden" id="benefit_hidden">{{$company->benefit}}</textarea>


								</div>

							</div>
							<div class="form-group float-right ">
								<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
								<!-- <button type="submit" class="btn btn-sm btn-default">ยกเลิก</button> -->
							</div>
						</form>
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
	<script>
		
		setTimeout(function(){
			var html = $('#benefit_hidden').val();
			$('.note-placeholder').css('display', 'none');
			$('.note-editable').html(html);

		}, 1000);

		
	</script>
@endsection