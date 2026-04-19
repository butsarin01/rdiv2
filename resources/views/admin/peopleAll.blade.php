
@extends('admin.master')
@section('people_all')
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
						<i class="fas fa-lg fa-fw m-r-10 fa-plus-circle text-blue "></i> แบบบันทึกข้อมูลบุคคล {{$group_id->name}}
					</div>
					<div id="collapseOne" class="collapse" data-parent="#accordion">
						<div class="card-body">
							<form action="{{route('content.insert_people')}}" method="POST" name="form" enctype="multipart/form-data" >
							@csrf
							<input class="form-control hide" type="text" id="member_id" name="member_id" placeholder="" value="{{session()->get('user.member_id')}}"  />	
							<input class="form-control hide" type="text" id="group_id" name="group_id" placeholder="" value="{{$group_id->id}}"  />	
							<div class="form-group row m-b-15">
								@if(!empty($group_id->status_use_image))
								<div class="col-md-4 col-sm-4 ">
									<center>
									<label class="col-md-3 col-sm-3 col-form-label">รูปบุคคล</label>
									<div class="col-md-9 col-sm-9 ">
										<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="avatar" style="height: 200px; width: auto;">
										<input class="form-control file-upload" type="file" id="image_name" name="image_name" placeholder="" data-parsley-required="true" />
									</div>
									</center>
								</div>
								@endif
								
								<div class="col-md-8 col-sm-8">
								@if(!empty($group_id->status_use_position))	
									<div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">ตำแหน่งในหน่วยงาน:</label>
										<div class="col-md-10">
											{{ Form::select('position_id', App\Position::orderBy('oridal')->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกตำแหน่ง...','class'=>'form-control']) }} 
										</div>
									</div>
								@endif
								@if(!empty($group_id->status_use_prefix))
									<div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">คำนำหน้า :</label>
										<div class="col-md-10">
											{{ Form::select('prefix_id', App\Prefix::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกคำนำหน้า...','class'=>'form-control']) }} 
											
										</div>
									</div>
								@endif
								
									<div class="form-group row m-b-15">
									@if(!empty($group_id->status_use_name))	
										<label class="col-md-2 col-sm-2 col-form-label" for="people_name">ชื่อ  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="people_name" name="people_name" placeholder="" data-parsley-required="true" />
										</div>
									@endif
									@if(!empty($group_id->status_use_lastname))	
										<label class="col-md-2 col-sm-2 col-form-label float-right" for="people_lastname">นามสกุล  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="people_lastname" name="people_lastname" placeholder="" data-parsley-required="true" />
										</div>
									@endif
									</div>
									@if(!empty($group_id->status_use_other))
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="people_other">ตำแหน่งที่ดำรงอยู่  :</label>
										<div class="col-md-10 col-sm-10">
											<input class="form-control" type="text" id="people_other" name="people_other" placeholder="" data-parsley-required="true" />
										</div>
									</div>
									@endif

									<div class="form-group row m-b-15">
									@if(!empty($group_id->status_use_telephone))	
										<label class="col-md-2 col-sm-2 col-form-label" for="people_telephone">เบอร์โทร  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="people_telephone" name="people_telephone" placeholder="" data-parsley-required="true" />
										</div>
									@endif
									@if(!empty($group_id->status_use_email))	
										<label class="col-md-2 col-sm-2 col-form-label float-right" for="people_email">email  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="people_email" name="people_email" placeholder="" data-parsley-required="true" />
										</div>
									@endif
									</div>
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label float-right" for="ldep_username">nsru account  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="text" id="ldep_username" name="ldep_username" placeholder="" data-parsley-required="true" />
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">กลุ่มการแสดง:</label>
										<div class="col-md-4">
											{{ Form::select('group_prople_id', App\group_prople::where('borad_id',$group_id->id)->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกกลุ่ม...','class'=>'form-control']) }} 
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
				</div>
			</div>

			

					<div class="panel  ">
						<div class="panel-body">
						<table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle">
							<thead>
								<tr>
									<th width="1%">id</th>
									<th width="1%" data-orderable="false">รูป</th>
									<th class="text-nowrap">ตำแหน่ง</th>
									<th class="text-nowrap">ชื่อ-นามสกุล</th>
									<th class="text-nowrap">แก้ไข</th>
									
								</tr>
							</thead>
							<tbody>
								@foreach($peopleAll_id as $row)
								<tr class="odd gradeX">
									<td  class="f-s-600 text-inverse">{{$row->id}}</td>
									<td  class="with-img">
										<img src="{{asset('storage/people/'.$row->thumbnail)}}" class="img-rounded height-70" />{{$row->thumbnail}}</td>
									<td >{{$row->position()}}</td>
									<td>
									@if(!empty($row->name))	
										@if(!empty($row->prefix_id))	{{$row->prefix()}} @endif
										{{$row->name}} {{$row->lastname}}<br>
									@endif
										{{$row->position_self}} 
									</td>
									<td>
										<a class="btn btn-yellow" href="{{route('content.edit_people',[$row->id])}}" role="button">แก้ไข</a>

										<a class="btn btn-red" href="{{route('content.delete_people',[$row->id])}}" role="button">ลบ</a>
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