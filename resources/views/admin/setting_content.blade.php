@extends('admin.master')
@section('setting_content')
<div id="content" class="content">
<div class="row">

	<div class="col-xl-12">
				
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">แบบบันทึกข้อมูล</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				</div>
			</div>
			<div class="panel-body">

				@if(!empty($template)) {{$template}} @endif
				<form action="{{route('template.set_insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data" >
					@csrf

				@if(!empty($template[0]))
					@foreach($template as $data) 
					<input class="form-control hide" type="text" id="tem_id" name="tem_id" placeholder="" @if(!empty($data->id)) value="{{$data->id}}" @endif />	
						<div class="row">
							<div class="col-md-6 col-sm-6 ">
								<center>
									<label class="col-md-3 col-sm-3 col-form-label">logo ใหญ่</label>
									<div class="col-md-9 col-sm-9 ">

										<img src="{{asset('storage/template/'.$data->logo_main)}}" class=" img-thumbnail avatar-input1" alt="avatar" style="height: 100px; width: auto;">

										<input class="form-control file-upload file1" type="file" id="logo_main" name="logo_main" placeholder="" data-parsley-required="true" />
									</div>
									<label class="col-md-3 col-sm-3 col-form-label">logo เล็ก</label>
									<div class="col-md-9 col-sm-9 ">
										<img src="{{asset('storage/template/'.$data->logo_menu)}}" class=" img-thumbnail avatar-input2" alt="avatar" style="height: 100px; width: auto;">
										<input class="form-control file-upload file2" type="file" id="logo_menu" name="logo_menu" placeholder="" data-parsley-required="true" />
									</div>
								</center>
							</div>
							<div class="col-md-6 col-sm-6 ">
								<div class="form-group row m-b-15">
									<label class="col-lg-4 col-form-label">สี header</label>
									<div class="col-lg-6">
										<div class="input-group colorpicker-component" data-color="rgb(0, 0, 0)" data-color-format="rgb"  id="colorpicker-append">
											<input type="text" value="rgb(0, 0, 0)" readonly="" class="form-control" id="colorpicker-append-input" name="color_header" @if(!empty($data->header_color)) value="{{$data->header_color}}" @endif/>
											<span class="input-group-append">
												<label class="input-group-text" for="colorpicker-append-input"><i class="fa fa-square fa-lg"></i></label>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-lg-4 col-form-label">สี body</label>
									<div class="col-lg-6">
										<div class="input-group colorpicker-component" data-color="rgb(0, 0, 0)" data-color-format="rgb"  id="colorpicker-append">
											<input type="text" value="rgb(0, 0, 0)" readonly="" class="form-control" id="colorpicker-append-input" name="color_body"/>
											<span class="input-group-append">
												<label class="input-group-text" for="colorpicker-append-input"><i class="fa fa-square fa-lg"></i></label>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-lg-4 col-form-label">สีตัวหนังสือ </label>
									<div class="col-lg-6">
										<div class="input-group colorpicker-component" data-color="rgb(0, 0, 0)" data-color-format="rgb"  id="colorpicker-append">
											<input type="text" value="rgb(0, 0, 0)" readonly="" class="form-control" id="colorpicker-append-input" name="color_hover"/>
											<span class="input-group-append">
												<label class="input-group-text" for="colorpicker-append-input"><i class="fa fa-square fa-lg"></i></label>
											</span>
										</div>
									</div>
								</div>
							
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label">สถานะ menu บน :</label>
									<div class="col-md-6 col-sm-6 ">
										<div class="radio radio-css radio-inline">
											<input type="radio" name="sub_top" id="inlineCssRadio1x" value="1"  @if($data->status_show_menu_top == 1) checked @endif/>
											<label for="inlineCssRadio1x">มี</label>
										</div>
										<div class="radio radio-css radio-inline">
											<input type="radio" name="sub_top" id="inlineCssRadio2x" value="0" @if($data->status_show_menu_top == 0) checked @endif/>
											<label for="inlineCssRadio2x">ไม่มี</label>
										</div>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label">สถานะ menu ข้าง :</label>
									<div class="col-md-6 col-sm-6 ">
										<div class="radio radio-css radio-inline">
											<input type="radio" name="sub_left" id="inlineCssRadio3x" value="1" @if($data->status_show_menu_left == 1) checked @endif/>
											<label for="inlineCssRadio3x">มี</label>
										</div>
										<div class="radio radio-css radio-inline">
											<input type="radio" name="sub_left" id="inlineCssRadio4x" value="0" @if($data->status_show_menu_left == 0) checked @endif/>
											<label for="inlineCssRadio4x">ไม่มี</label>
										</div>
									</div>
								</div>
							</div>
						</div>	
						<br>
						<div class="form-group row m-b-15">
							<div class="col-md-12">
								<center>
									<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
								</center>
							</div>
						</div>
						@endforeach
					@else
					<div class="row">
						<div class="col-md-6 col-sm-6 ">
							<center>
								<label class="col-md-3 col-sm-3 col-form-label">logo ใหญ่</label>
								<div class="col-md-9 col-sm-9 ">

									<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class=" img-thumbnail avatar-input1" alt="avatar" style="height: 100px; width: auto;">

									<input class="form-control file-upload file1" type="file" id="logo_main" name="logo_main" placeholder="" data-parsley-required="true" />
								</div>
								<label class="col-md-3 col-sm-3 col-form-label">logo เล็ก</label>
								<div class="col-md-9 col-sm-9 ">
									<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class=" img-thumbnail avatar-input2" alt="avatar" style="height: 100px; width: auto;">
									<input class="form-control file-upload file2" type="file" id="logo_menu" name="logo_menu" placeholder="" data-parsley-required="true" />
								</div>
							</center>
						</div>
						<div class="col-md-6 col-sm-6 ">
							<div class="form-group row m-b-15">
								<label class="col-lg-4 col-form-label">สี header</label>
								<div class="col-lg-6">
									<div class="input-group colorpicker-component" data-color="rgb(0, 0, 0)" data-color-format="rgb"  id="colorpicker-append">
										<input type="text" value="rgb(0, 0, 0)" readonly="" class="form-control" id="colorpicker-append-input" name="color_header" />
										<span class="input-group-append">
											<label class="input-group-text" for="colorpicker-append-input"><i class="fa fa-square fa-lg"></i></label>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-lg-4 col-form-label">สี body</label>
								<div class="col-lg-6">
									<div class="input-group colorpicker-component" data-color="rgb(0, 0, 0)" data-color-format="rgb"  id="colorpicker-append">
										<input type="text" value="rgb(0, 0, 0)" readonly="" class="form-control" id="colorpicker-append-input" name="color_body"/>
										<span class="input-group-append">
											<label class="input-group-text" for="colorpicker-append-input"><i class="fa fa-square fa-lg"></i></label>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-lg-4 col-form-label">สีตัวหนังสือ </label>
								<div class="col-lg-6">
									<div class="input-group colorpicker-component" data-color="rgb(0, 0, 0)" data-color-format="rgb"  id="colorpicker-append">
										<input type="text" value="rgb(0, 0, 0)" readonly="" class="form-control" id="colorpicker-append-input" name="color_hover"/>
										<span class="input-group-append">
											<label class="input-group-text" for="colorpicker-append-input"><i class="fa fa-square fa-lg"></i></label>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">สถานะ menu บน :</label>
								<div class="col-md-6 col-sm-6 ">
									<div class="radio radio-css radio-inline">
										<input type="radio" name="sub_top" id="inlineCssRadio1x" value="1" />
										<label for="inlineCssRadio1x">มี</label>
									</div>
									<div class="radio radio-css radio-inline">
										<input type="radio" name="sub_top" id="inlineCssRadio2x" value="0" />
										<label for="inlineCssRadio2x">ไม่มี</label>
									</div>
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">สถานะ menu ข้าง :</label>
								<div class="col-md-6 col-sm-6 ">
									<div class="radio radio-css radio-inline">
										<input type="radio" name="sub_left" id="inlineCssRadio3x" value="1" />
										<label for="inlineCssRadio3x">มี</label>
									</div>
									<div class="radio radio-css radio-inline">
										<input type="radio" name="sub_left" id="inlineCssRadio4x" value="0" />
										<label for="inlineCssRadio4x">ไม่มี</label>
									</div>
								</div>
							</div>
						</div>
					</div>	
					<br>
					<div class="form-group row m-b-15">
						<div class="col-md-12">
							<center>
								<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
							</center>
						</div>
					</div>

					@endif
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
});
</script>
@endsection