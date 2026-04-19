
@extends('admin.master')
@section('body_content')
<!-- begin #content -->
<div id="content" class="content">
			<!-- begin row -->
<div class="row">
<div class="col-xl-12">
			<div class="panel panel-default ">
				<div class="panel-heading">
					<h4 class="panel-title">แบบบันทึกข้อมูล
					 @if(!empty($menu->name)) {{$menu->name}}  @endif


					</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
					</div>
				</div>
				<div class="panel-body">




				<form action="{{route('content.insert_index')}}" method="POST" id="form_content" name="summernote_form" enctype="multipart/form-data" >
					@csrf
					<input class="form-control hide" type="text" id="member_id" name="member_id" placeholder="" data-parsley-required="true" value="{{session()->get('user.member_id')}}"/>

				@if(!empty($data_detail_menu))


					@if($mode == 'main')
							<input class="form-control hide" type="text" id="main_menu_id" name="main_menu_id" placeholder="" value="{{$menu->id}}" />
						@elseif($mode == 'sub')
							<input class="form-control hide" type="text" id="sub_menu_id" name="sub_menu_id" placeholder="" value="{{$menu->id}}" />
						@endif

						@foreach($data_detail_menu as $data)
							<input class="form-control hide" type="text" id="detail_menu_id" name="detail_menu_id" placeholder="" @if(!empty($data->id)) value="{{$data->id}}" @endif />

							<div class="form-group row m-b-15">
								@if(!empty($menu->status_use_thumbnail))
								<div class="col-md-4 col-sm-4 ">
									<center>
									<label class="col-md-3 col-sm-3 col-form-label">รูปหัวข้อ</label>
									<div class="col-md-9 col-sm-9 ">
										<img src="{{asset('storage/content/'.$data->thumbnail)}}" class="avatar img-thumbnail" alt="avatar" style="height: 200px; width: auto;">
										<input class="form-control file-upload" type="file" id="image_name" name="image_name" placeholder="" data-parsley-required="true" />
									</div>
									</center>
								</div>
								@endif


                                <div class="col-md-8 col-sm-8">
                                @if(!empty($menu->status_use_title))
                                    <div class="form-group row m-b-10">
                                        <label class="col-md-2 col-sm-2 col-form-label text-right" for="title">ชื่อหัวข้อ
                                            :</label>
                                        <div class="col-md-9 col-sm-9">
                                            <input class="form-control" type="text" id="title" name="title"
                                                   @if(!empty($data->title)) value="{{$data->title}}" @endif data-parsley-required="true"/>
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($menu->status_use_link))
                                    <div class="form-group row m-b-10">
                                        <label class="col-md-2 col-sm-2 col-form-label text-right" for="link">link :</label>
                                        <div class="col-md-9 col-sm-9">
                                            <input class="form-control" type="text" id="link" name="link"
                                                   @if(!empty($data->link)) value="{{$data->link}}" @endif data-parsley-required="true"/>
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($menu->status_use_file))
                                    <div class="form-group row m-b-10">
                                        <label class="col-md-2 col-sm-2 col-form-label" for="file">file :</label>
                                        <div class="col-md-9 col-sm-9">
                                            @if(!empty($data->file))
                                                <a href="{{asset('storage/file/'.$data->file)}}"
                                                   target="_blank">
                                                    {{$data->file}}
                                                </a>
                                            @endif
                                            <input class="form-control" type="file" id="filename" name="filename"
                                                   placeholder="" data-parsley-required="true"/>
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($menu->status_use_range_date))
                                    <div class="form-group row m-b-10">
                                        <label class="col-md-2 col-sm-2 col-form-label text-right" for="file">ช่วงวันที่ (เดือน/วัน/ปี): </label>
                                        <div class="col-md-9 col-sm-9">
                                            <div class="input-group input-daterange">
                                                <input type="text" class="form-control" name="start_date"
                                                       placeholder="Date Start" @if(!empty($data->start_date)) value="{{$data->start_date_input()}}" @endif>
                                                <span class="input-group-addon">to</span>
                                                <input type="text" class="form-control" name="end_date"
                                                       placeholder="Date End" @if(!empty($data->end_date)) value="{{$data->end_date_input()}}" @endif>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($menu->number_of_data == 2)
                                    <div class="form-group row m-b-10">
                                        <label class="col-md-2 col-sm-2 col-form-label text-right" for="fullname">ลำดับการแสดง :</label>
                                        <div class="col-md-2 col-sm-2">
                                            <input class="form-control" type="number" id="number_show"
                                                   name="number_show" value="{{$data->number_show}}"/>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            </div>
								@if(!empty($menu->status_use_detail))
								<label class="col-md-2 col-sm-2 col-form-label" for="fullname">รายละเอียด :</label>
								<textarea class="summernote" name="detail" id="detail"></textarea>
								<textarea class="hide" name="detail_hidden" id="detail_hidden">@if(!empty($data->detail)) {{$data->detail}} @endif</textarea>
								@endif

							<div class="form-group row float-right ">
								<button type="submit" class="btn btn-primary m-r-5 btn-save">บันทึก</button>
							</div>
						@endforeach

				@endif
				</form>
				</div>
			</div>
		</div>
	</div>






					<!-- end panel -->
				</div>
				<!-- end col-10 -->

			<!-- end row -->


		<!-- end #content -->
	@endsection
@section('script_content')
	<script>

		setTimeout(function(){
			var html = $('#detail_hidden').val();
			$('.note-placeholder').css('display', 'none');
			$('.note-editable').html(html);

		}, 1000);


	</script>
@endsection
