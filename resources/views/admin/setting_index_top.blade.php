@extends('admin.master')
@section('setting_content')
<div id="content" class="content">
<div class="row">

	<div class="col-xl-12">
				
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">แบบบันทึกข้อมูล (banner ด้านบน)</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<form action="{{route('setting.index_insert')}}" method="POST"  enctype="multipart/form-data" >
					@csrf
					<input type="text" class="hide" name="place" value="top">
					<div class="row justify-content-center">
						@if(empty($data_banner))
							@if(!empty($data_bannertop[0])) 
								<?php $i = $data_bannertop->count(); ?>
								<?php $i = $i+1; ?>
							@else
								<?php $i = 1; ?>
							@endif

							<div class="col-md-8 text-center">
								<label class="col-form-label ">Banner (ขนาด 2600*840 ,1300*420 ,650*210)</label><br>
									<img src="../images/empty2.png" class=" img-thumbnail avatar-input1">
									<input class="form-control file-upload file1" type="file" id="banner" name="file" />
									<div class="row m-t-5">
										<label class="col-form-label col-md-2">ชื่อ Banner</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="name">
										</div>
									</div>
									<div class="row m-t-5">
										<label class="col-form-label col-md-2">link</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="link">
										</div>
									</div>

									<input type="text" class="hide" name="status_show" value="1">
									<input type="text" class="hide" name="ordinal" value="{{$i}}">
							</div>
						@else
							@foreach($data_banner as $row)
							<div class="col-md-8 text-center">
									<label class="col-form-label ">แก้ไข Banner </label><br>
									<!-- <div class="col-md-9 col-sm-9 "> -->
										<img src="{{asset('storage/index/'.$row->file)}}" class=" img-thumbnail avatar-input{{$row->ordinal}}" alt="banner_{{$row->ordinal}}" >
										<input class="form-control file-upload file{{$row->ordinal}}" type="file" id="banner_{{$row->ordinal}}" name="file" placeholder=""  />
										<div class="row m-t-5">
											<label class="col-form-label col-md-2">ชื่อ Banner </label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="name" value="{{$row->name}}">
											</div>
										</div>
										<div class="row m-t-5">
											<label class="col-form-label col-md-2">link</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="link" value="{{$row->link}}">
											</div>
										</div>
										<input type="text" class="hide" name="status_show" value="1">
										<input type="text" class="hide" name="id" value="{{$row->id}}">
										<input type="text" class="hide" name="ordinal" value="{{$row->ordinal}}">
							</div>
							@endforeach

						@endif

					</div>	
					<!-- <br> -->
					<!-- <hr> -->
					<div class="row m-t-5 justify-content-end">
						<div class="col-md-3">
								<button type="submit" class="btn btn-primary m-r-5">บันทึก</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="panel  ">
			<div class="panel-body">
				<table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle">
					<thead>
						<tr>
							<th class="text-nowrap" width="1%" >ลำดับ</th>
							<th class="text-nowrap" >banner</th>
							<th class="text-nowrap" >ชื่อ</th>
							<th  width="10%" class="text-nowrap">จัดการ</th>
						</tr>
					</thead>
					<tbody>
					@if(!empty($data_bannertop[0]))
						@foreach($data_bannertop as $row) 
						<tr class="odd gradeX">
							<td width="1%" class="f-s-600 text-inverse">{{$row->ordinal}}</td>
							<td class="f-s-600 text-inverse">
								<img src="{{asset('storage/index/'.$row->file)}}" class="img-rounded height-70" />
							</td>
							<td>{{$row->name}}</td>
							<td width="12%">
								<a class="btn btn-yellow" href="{{ route('setting_index_top.update',[$row->id]) }}" role="button">แก้ไข</a>
								<a class="btn btn-red" href="{{ route('setting_index_top.delete',[$row->id]) }}" role="button">ลบ</a>
							</td>
						</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			</div>
		</div>
				
	
	</div>
</div>
</div>
@endsection
@section('script_content')
<script type="text/javascript">
 $(document).ready(function(){  
	var readURL = function(input, divShow) {
        console.log(divShow);
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $(divShow).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $(".file1").on('change', function(){
      readURL(this, '.avatar-input1');
    });

    $(".file2").on('change', function(){
      readURL(this, '.avatar-input2');
    });

     $(".file3").on('change', function(){
      readURL(this, '.avatar-input3');
    });
});
$(document).on('change', '.custom-control-input', function(){
	var number = $(this).data('number');
	// console.log("select = "+number);
	if(this.checked){
		$('.custom-control-label[id="'+number+'"]').text("เปิด");
	}else{
		$('.custom-control-label[id="'+number+'"]').text("ปิด");
	}

});

</script>
@endsection