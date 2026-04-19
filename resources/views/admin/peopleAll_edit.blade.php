
@extends('admin.master')
@section('people_all')
<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin row -->
		<div class="row">
			<!-- begin col-12 -->
			<div class="col-xl-12">
				<!-- begin panel -->
				<div class="panel  ">
					<div class="panel-body">
				
						แบบบันทึกข้อมูลบุคคล 
								
							<form action="{{route('content.update_people')}}" method="POST" name="people_form" enctype="multipart/form-data" >
							@csrf
							<input class="form-control hide" type="text" id="member_id" name="member_id" placeholder="" value="{{session()->get('user.member_id')}}"  />	
							<input class="form-control hide" type="text" id="id" name="id" placeholder=""  value="{{$people_id->id}}" />	
							<input class="form-control hide" type="text" id="group_id" name="group_id" placeholder=""  value="{{$people_id->borad_id}}" />	
							<div class="form-group row m-b-15">
								@if(!empty($group_id->status_use_image))
								<div class="col-md-4 col-sm-4 ">
									<center>
									<label class="col-md-3 col-sm-3 col-form-label">รูปบุคคล</label>
									<div class="col-md-9 col-sm-9 ">
										<img src="{{asset('storage/people/'.$people_id->thumbnail)}}" class="avatar img-thumbnail" alt="avatar" style="height: 200px; width: auto;">
										<input class="form-control file-upload" type="file" id="image_name" name="image_name" placeholder="" data-parsley-required="true"  />
									</div>
									</center>
								</div>
								@endif
								
								<div class="col-md-8 col-sm-8">
								@if(!empty($group_id->status_use_position))	
									<div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">ตำแหน่งในหน่วยงาน:</label>
										<div class="col-md-10">
											{{ Form::select('position_id', App\Position::all()->pluck('name','id'), $people_id->position_id, ['placeholder' => 'กรุณาเลือกตำแหน่ง...','class'=>'form-control']) }} 
										</div>
									</div>
								@endif
								@if(!empty($group_id->status_use_prefix))
									<div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">คำนำหน้า :</label>
										<div class="col-md-10">
											{{ Form::select('prefix_id', App\Prefix::all()->pluck('name','id'), $people_id->prefix_id, ['placeholder' => 'กรุณาเลือกคำนำหน้า...','class'=>'form-control']) }} 
											
										</div>
									</div>
								@endif
								
									<div class="form-group row m-b-15">
									@if(!empty($group_id->status_use_name))	
										<label class="col-md-2 col-sm-2 col-form-label" for="people_name">ชื่อ  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="people_name" name="people_name" placeholder="" data-parsley-required="true" value="{{$people_id->name}}" />
										</div>
									@endif
									@if(!empty($group_id->status_use_lastname))	
										<label class="col-md-2 col-sm-2 col-form-label float-right" for="people_lastname">นามสกุล  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="people_lastname" name="people_lastname" placeholder="" data-parsley-required="true" value="{{$people_id->lastname}}"/>
										</div>
									@endif
									</div>
									@if(!empty($group_id->status_use_other))
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="people_other">ตำแหน่งที่ดำรงอยู่  :</label>
										<div class="col-md-10 col-sm-10">
											<input class="form-control" type="text" id="people_other" name="people_other" placeholder="" data-parsley-required="true" value="{{$people_id->position_self}}"/>
										</div>
									</div>
									@endif

									<div class="form-group row m-b-15">
									@if(!empty($group_id->status_use_telephone))	
										<label class="col-md-2 col-sm-2 col-form-label" for="people_telephone">เบอร์โทร  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="people_telephone" name="people_telephone" placeholder="" data-parsley-required="true" value="{{$people_id->telephone}}"/>
										</div>
									@endif
									@if(!empty($group_id->status_use_email))	
										<label class="col-md-2 col-sm-2 col-form-label float-right" for="people_email">email  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="people_email" name="people_email" placeholder="" data-parsley-required="true" value="{{$people_id->email}}"/>
										</div>
									@endif
									</div>
									<div class="form-group row m-b-15">
									
										<label class="col-md-2 col-sm-2 col-form-label float-right" for="ldep_username">nsru account  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="ldep_username" name="ldep_username" placeholder="" data-parsley-required="true" value="{{$people_id->ldep_username}}"/>
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">กลุ่มการแสดง:</label>
										<div class="col-md-4">
											{{ Form::select('group_prople_id', App\group_prople::where('borad_id',$people_id->borad_id)->pluck('name','id'), $people_id->group_prople_id, ['placeholder' => 'กรุณาเลือกกลุ่ม...','class'=>'form-control']) }} 
										</div>
									</div>


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