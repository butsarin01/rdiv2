@extends('admin.master')
@section('setting_people')
<div id="content" class="content">
<div class="row">
	<!-- begin col-6 -->
	<div class="col-xl-3">
		<!-- begin panel -->
		<div class="panel panel-default" data-sortable-id="form-stuff-5">
			<div class="panel-heading">
				<h4 class="panel-title">กลุ่มบุคคล </h4>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th scope="col">id</th>
				      <th scope="col">group</th>
				      <th scope="col">ลำดับ</th>
				      <th scope="col">สถานะ</th>
				    </tr>
				  </thead>
				  <tbody>
					@foreach($group as $row)
						<tr>
					      <th scope="row">{{ $row->id }}</th>
					      <td><a href="{{ route('people.edit',[$row->id]) }}">{{ $row->name }}</a></td>
					      
					      <td>{{ $row->number_show }}</td>
					      <td>
					      	<label class="switch">
							  <input type="checkbox"  class="status_setting_group" group-id="{{$row->id}}" @if($row->status_setting == 1) checked @endif>
							  <span class="slider round"></span>
							</label>
						  </td>
					    </tr>
							
					@endforeach
				    

				  </tbody>
				</table>
			</div>
			
		</div>
		<!-- end panel -->
	</div>

	<div class="col-xl-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">แบบบันทึกกลุ่มบุคคล</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				</div>
			</div>
			<div class="panel-body">
			
			@if(!empty($group_id))	
				
				<form action="{{route('people.group_update')}}" method="POST" name="group_form" enctype="multipart/form-data" >
				@csrf
					<input class="form-control hide" type="text" id="status_setting" name="status_setting"  placeholder="" value="1" />
					<input class="form-control hide" type="text" id="id" name="id"  placeholder="" value="{{$group_id->id}}" />
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="group_name">ชื่อกลุ่มบุคคล :</label>
						<div class="col-md-6 col-sm-6">
							<input class="form-control" type="text" id="group_name" name="group_name" placeholder="" data-parsley-required="true" value="{{$group_id->name}}"/>
						</div>
					</div>
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="number_show">ลำดับการแสดง :</label>
						<div class="col-md-2 col-sm-2">
							<input class="form-control" type="number" id="number_show" name="number_show" placeholder="" data-parsley-required="true"  value="{{$group_id->number_show}}"/>
						</div>
					</div>
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="fullname">การเก็บข้อมูล :</label>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox1" name="status_use_prefix" @if(!empty($group_id->status_use_prefix)) checked @endif/>
							<label for="inlineCssCheckbox1">คำนำหน้า</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox2" name="status_use_name"@if(!empty($group_id->status_use_name)) checked @endif/>
							<label for="inlineCssCheckbox2">ชื่อ</label>
						</div>
						<div class="checkbox checkbox-css checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox3" name="status_use_lastname" @if(!empty($group_id->status_use_lastname)) checked @endif/>
							<label for="inlineCssCheckbox3">นามสกุล</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox4" name="status_use_image" @if(!empty($group_id->status_use_image)) checked @endif/>
							<label for="inlineCssCheckbox4">รูป</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox5" name="status_use_borad" @if(!empty($group_id->status_use_borad)) checked @endif/>
							<label for="inlineCssCheckbox5">กลุ่ม</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox6" name="status_use_position" @if(!empty($group_id->status_use_position)) checked @endif/>
							<label for="inlineCssCheckbox6">ตำแหน่ง</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox7" name="status_use_telephone" @if(!empty($group_id->status_use_telephone)) checked @endif/>
							<label for="inlineCssCheckbox7">เบอร์โทร</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox8" name="status_use_email" @if(!empty($group_id->status_use_email)) checked @endif/>
							<label for="inlineCssCheckbox8">email</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox9" name="status_use_other" @if(!empty($group_id->status_use_other)) checked @endif/>
							<label for="inlineCssCheckbox9">ตำแหน่งอื่นๆ(กรอกข้อมูล)</label>
						</div>
						<div class="col-md-2 col-sm-2">
							<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
						</div>
					</div>
				</form>

				@elseif(empty($group_id))
				<form action="{{route('people.group')}}" method="POST" name="group_form" enctype="multipart/form-data" >
					@csrf
					<input class="form-control hide" type="text" id="status_setting" name="status_setting"  placeholder="" value="1" />
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="group_name">ชื่อกลุ่มบุคคล :</label>
						<div class="col-md-6 col-sm-6">
							<input class="form-control" type="text" id="group_name" name="group_name" placeholder="" data-parsley-required="true" />
						</div>
					</div>
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="number_show">ลำดับการแสดง :</label>
						<div class="col-md-2 col-sm-2">
							<input class="form-control" type="number" id="number_show" name="number_show" placeholder="" data-parsley-required="true" />
						</div>
					</div>
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="fullname">การเก็บข้อมูล :</label>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox1" name="status_use_prefix" />
							<label for="inlineCssCheckbox1">คำนำหน้า</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox2" name="status_use_name"/>
							<label for="inlineCssCheckbox2">ชื่อ</label>
						</div>
						<div class="checkbox checkbox-css checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox3" name="status_use_lastname" />
							<label for="inlineCssCheckbox3">นามสกุล</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox4" name="status_use_image" />
							<label for="inlineCssCheckbox4">รูป</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox5" name="status_use_borad" />
							<label for="inlineCssCheckbox5">กลุ่ม</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox6" name="status_use_position" />
							<label for="inlineCssCheckbox6">ตำแหน่ง</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox7" name="status_use_telephone" />
							<label for="inlineCssCheckbox7">เบอร์โทร</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox8" name="status_use_email" />
							<label for="inlineCssCheckbox8">email</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox9" name="status_use_other" />
							<label for="inlineCssCheckbox9">ตำแหน่งอื่นๆ(กรอกข้อมูล)</label>
						</div>
						<div class="col-md-2 col-sm-2">
							<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
						</div>
					</div>
				</form>
					@endif

						
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">รายการตำแหน่ง</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				</div>
			</div>
			<div class="panel-body">		
				<form action="{{route('people.insert_position')}}" method="POST" name="position_form" enctype="multipart/form-data" >
				@csrf	
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="posotion_name">ชื่อตำแหน่ง :</label>
						<div class="col-md-6 col-sm-6">
							<input class="form-control" type="text" id="posotion_name" name="posotion_name" placeholder="" data-parsley-required="true" />
						</div>
						<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
					</div>
				</form>
				<table id="" class="table table-striped table-bordered table-td-valign-middle">
					<thead>
						<tr>
							<th width="1%">ลำดับ</th>
							<th class="text-nowrap">file</th>
							<th class="text-nowrap">แก้ไข</th>
						</tr>
					</thead>
					<tbody>
						@foreach($position as $row)
						<tr class="odd gradeX">
							<td width="1%" class="f-s-600 text-inverse">{{ $row->id }}</td>
							<td width="40%" class="with-img">{{ $row->name }}</td>
							<td><a  class="btn btn-yellow" href="{{ route('people.edit',[$row->id]) }}" role="button">แก้ไข</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	<!-- end panel -->
	</div>
</div>
</div>
@endsection
@section('script_menu')
<script type="text/javascript">
 $(document).ready(function(){  


	$('.status_setting_group').click(function() {

		var group_id = $(this).attr('group-id');

		var status = $(this).is(":checked") ? 1:0;

		$.ajax({
			url: '{{route('people.setting_update')}}',
			method: 'POST',
			data:{"_token": "{{ csrf_token() }}", 'mode':'people', 'group_id':group_id, 'status_setting':status},
			dataType: 'json',
			success:function(data)
			{
				// alert(data.alert);
			}
		});

	    
	});


});
</script>


@endsection