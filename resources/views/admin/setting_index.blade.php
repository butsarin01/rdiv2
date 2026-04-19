@extends('admin.master')
@section('setting_content')
<div id="content" class="content">
<div class="row">

	<div class="col-xl-12">
				
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">แบบบันทึกข้อมูล (banner ด้านข้างขวา)</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				</div>
			</div>
			<div class="panel-body">

				<form action="{{route('setting.index_insert')}}" method="POST"  enctype="multipart/form-data" >
					@csrf
					<input type="text" class="hide" name="place" value="right">
					<div class="row">
						
						@if(!isset($data_banner))
					
							@for ($i=1; $i <= 3 ; $i++)	
							<div class="col-md-4 text-center">
									<label class="col-form-label ">Banner {{$i}}</label><br>
									<!-- <div class="col-md-9 col-sm-9 "> -->
										<img src="../images/images.png" class=" img-thumbnail avatar-input{{$i}}" alt="banner_{{$i}}" >
										<input class="form-control file-upload file{{$i}}" type="file" id="banner_{{$i}}" name="file[]" placeholder=""  />
										<div class="row m-t-5">
											<label class="col-form-label col-md-3">ชื่อ Banner {{$i}}</label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="name[]">
											</div>
										</div>
										<div class="row m-t-5">
											<label class="col-form-label col-md-3">link {{$i}}</label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="link[]">
											</div>
										</div>
										<div class="row m-t-5">
											<label class="col-form-label col-md-4 text-left">สถานะการแสดง</label>
											<div class="col-md-1">
												<div class="custom-control custom-switch" style="margin-top:10px;">	
												  	<input type="checkbox" class="custom-control-input" id="customSwitch{{$i}}" 
												  	name="status_show[]" value="1" data-number={{$i}} checked>
												  	<label class="custom-control-label" for="customSwitch{{$i}}" id="{{$i}}" >
												  		เปิด
												  	</label>
												</div>
												
											</div>
										</div>

										<input type="text" class="hide" name="id[]" value="">
										<input type="text" class="hide" name="ordinal[]" value="{{$i}}">
									<!-- </div> -->
								<!-- </div> -->
							</div>
							@endfor
						@else
							@foreach($data_banner as $key => $row)
							<div class="col-md-4 text-center">
									<label class="col-form-label ">Banner {{$row->ordinal}}</label><br>
									<!-- <div class="col-md-9 col-sm-9 "> -->
										@if(!empty($row->file))
										<img src="{{asset('storage/index/'.$row->file)}}" class=" img-thumbnail avatar-input{{$row->ordinal}}" alt="banner_{{$row->ordinal}}" >
										@else
										<img src="../images/images.png" class=" img-thumbnail avatar-input{{$row->ordinal}}" alt="banner_{{$row->ordinal}}" >
										@endif
										<input class="form-control file-upload file{{$row->ordinal}}" type="file" id="banner_{{$row->ordinal}}" name="file[]" placeholder=""  />
										<div class="row m-t-5">
											<label class="col-form-label col-md-3">ชื่อ Banner {{$row->ordinal}}</label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="name[]" value="{{$row->name}}">
											</div>
										</div>
										<div class="row m-t-5">
											<label class="col-form-label col-md-3">link {{$row->ordinal}}</label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="link[]" value="{{$row->link}}">
											</div>
										</div>
										<div class="row m-t-5">
											<label class="col-form-label col-md-4 text-left">สถานะการแสดง</label>
											<div class="col-md-1">
												<div class="custom-control custom-switch" style="margin-top:10px;">	
												  	<input type="checkbox" class="custom-control-input" id="customSwitch{{$row->ordinal}}" 
												  	name="status_show[{{$row->ordinal-1}}]" value="1" data-number={{$row->ordinal}} @if($row->status_show == 1) checked @endif>
												  	<label class="custom-control-label" for="customSwitch{{$row->ordinal}}" id="{{$row->ordinal}}" >
												  		@if($row->status_show == 1) เปิด
												  		@else ปิด
												  		@endif
												  	</label>
												</div>
												
											</div>
										</div>

										<input type="text" class="hide" name="id[]" value="{{$row->id}}">
										<input type="text" class="hide" name="ordinal[]" value="{{$row->ordinal}}">
							</div>
							@endforeach

						@endif

					</div>	
					<br>
					<hr>
					<div class="form-group row m-b-15">
						<div class="col-md-12">
							<center>
								<button type="submit" class="btn btn-primary m-r-5">บันทึก</button>
							</center>
						</div>
					</div>
				</form>
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