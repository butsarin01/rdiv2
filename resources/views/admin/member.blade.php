@extends('admin.master')
@section('member')
<div id="content" class="content">
<div class="row">
	

	<div class="col-xl-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">แบบบันทึกกลุ่มบุคคล</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				</div>
			</div>
			<div class="panel-body">
			
		
				
				<form action="{{route('member.insert')}}" method="POST" name="member_form" enctype="multipart/form-data" >
				@csrf
					
					<div class="form-group row m-b-15">
						<div class="col-md-1"></div>
						<label class="col-md-1 col-sm-1 col-form-label" for="username">username :</label>
						<div class="col-md-4 col-sm-4">
							<input class="form-control" type="text" id="username" name="username" placeholder="" data-parsley-required="true" />
						</div>
					
						<label class="col-form-label col-md-1">สิทธิ์การใช้งาน :</label>
						<div class="col-md-3">
							{{ Form::select('permisstion_id', App\Permisstion::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกสิทธิ์...','class'=>'form-control']) }} 
							
						</div>
					
						
						<div class="col-md-2 col-sm-2">
							<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
						</div>
					</div>
				</form>

				<table id="" class="table table-striped table-bordered table-td-valign-middle">
					<thead>
						<tr>
							<th width="5%">ลำดับ</th>
							<th class="text-nowrap">username</th>
							<th class="text-nowrap">สิทธิ์การใช้งาน</th>
							<th class="text-nowrap">แก้ไข</th>
						</tr>
					</thead>
					<tbody>
						@foreach($member as $row)
						<tr class="odd gradeX">
							<td width="1%" class="f-s-600 text-inverse">{{ $row->id }}</td>
							<td width="40%" class="with-img">{{ $row->username }}</td>
							<td width="40%" class="with-img">{{ $row->permisstion_id }}</td>
							<td>
								<a  class="btn btn-yellow" href="" role="button">แก้ไข</a>
								<a  class="btn btn-red" href="{{ route('member.delete',[$row->id]) }}" role="button">ลบ</a>
							</td>
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



