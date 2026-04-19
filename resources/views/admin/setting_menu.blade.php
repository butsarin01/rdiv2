
@extends('admin.master')
@section('setting_menu')
<div id="content" class="content">
<div class="row">

	<div class="col-xl-3">
		<div class="panel panel-default" data-sortable-id="form-stuff-5">
			<div class="panel-heading">
				<h4 class="panel-title">Main Menu </h4>
				<a class="btn btn-primary" href="{{route('menu.index')}}" role="button">เพิ่ม Main menu</a>
			</div>
			<div class="panel-body">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th scope="col">id</th>
				      <th scope="col">Main menu</th>
				      <th scope="col">ลำดับ</th>
				      <th scope="col">สถานะ</th>
				    </tr>
				  </thead>
				  <tbody>
					@foreach($main_menu_all as $main)
						<tr>
					      <th scope="row">{{ $main->number_show }}</th>
					      <td><a href="{{ route('menu.edit',[$main->id]) }}">{{ $main->name }}</a></td>
					      <td>{{ $main->number_show }}</td>
					      <td>
					      	<label class="switch">
							  <input type="checkbox"  class="status_setting_main" main-id="{{$main->id}}" @if($main->status_setting == 1) checked @endif>
							  <span class="slider round"></span>
							</label>
						  </td>

					    </tr>

					@endforeach


				  </tbody>
				</table>

			</div>
			<!-- end panel-body -->

		</div>
		<!-- end panel -->
	</div>

	<div class="col-xl-9">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">แบบบันทึกข้อมูล</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				</div>
			</div>
			<div class="panel-body">


				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif



			@if(!empty($main_id))

			<!-- {!! Form::model($main_id,['route'=>['menu.main_update',$main_id->id],'method'=>'put',])!!} -->
				<form  method="POST" name="form_main_menu_update" enctype="multipart/form-data" action="{{route('menu.main_update')}}">
					@csrf
					<input class="form-control hide" type="text" id="id" name="id" placeholder="" value="{{$main_id->id}}"  />
					<input class="form-control hide" type="text" id="status_setting" name="status_setting"  placeholder=""   value="{{$main_id->status_setting}}"  />
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="main_menu_name">ชื่อหัวข้อ :</label>
						<div class="col-md-8 col-sm-7">
							<input class="form-control @error('main_menu_name') is-invalid @enderror" type="text" id="main_menu_name" name="main_menu_name" placeholder=""  value="{{$main_id->name}}" />
						</div>
					</div>
					<div class="form-group row m-b-15">
						<label class="col-md-3 col-sm-3 col-form-label">สถานะ sub menu :</label>
						<div class="col-md-2 col-sm-2 ">
							@if($main_id->status_have_sub == 1)
							<div class="radio radio-css radio-inline">
								<input type="radio" name="status_sub_menu" id="inlineCssRadio1x" value="1" checked/>
								<label for="inlineCssRadio1x">มี</label>
							</div>
							<div class="radio radio-css radio-inline">
								<input type="radio" name="status_sub_menu" id="inlineCssRadio2x" value="0" />
								<label for="inlineCssRadio2x">ไม่มี</label>
							</div>
							@else
							<div class="radio radio-css radio-inline">
								<input type="radio" name="status_sub_menu" id="inlineCssRadio1x" value="1" />
								<label for="inlineCssRadio1x">มี</label>
							</div>
							<div class="radio radio-css radio-inline">
								<input type="radio" name="status_sub_menu" id="inlineCssRadio2x" value="0" checked/>
								<label for="inlineCssRadio2x">ไม่มี</label>
							</div>
							@endif
						</div>

						<label class="col-md-2 col-sm-2 col-form-label" for="fullname">ลำดับการแสดง :</label>
						<div class="col-md-2 col-sm-2">
							<input class="form-control" type="number" id="number_show" name="number_show"  placeholder="" value="{{$main_id->number_show}}" />
						</div>
						<label class="col-md-1 col-sm-1 col-form-label" for="fullname">เชื่อม :</label>
						<div class="col-md-2 col-sm-2">

								<select class="form-control" name="join_database" id="join_database">
									<option value="">database</option>
									<option value="board">board</option>
									<option value="index.company_all">company</option>
									<option value="index.document_all">document</option>
									<option value="type_document">type_document</option>
									<option value="index.company_year">company_year</option>
									<option value="index.activity_all">activity</option>
									<option value="index.news_all">news</option>
								</select>

						</div>
					</div>

						<div class="form-group row m-b-15 detail_main_menu ">
							<label class="col-md-3 col-sm-3 col-form-label">ข้อมูลที่ต้อการบันทึก :</label>
							<div class="checkbox checkbox-css  checkbox-inline">
								<input type="checkbox" value="1" id="inlineCssCheckbox1" name="status_title"  @if(!empty($main_id->status_use_title)) checked @endif />
								<label for="inlineCssCheckbox1">title</label>
							</div>
							<div class="checkbox checkbox-css  checkbox-inline">
								<input type="checkbox" value="1" id="inlineCssCheckbox2" name="status_thumbnail" @if(!empty($main_id->status_use_thumbnail)) checked @endif/>
								<label for="inlineCssCheckbox2">thumbnail</label>
							</div>
							<div class="checkbox checkbox-css checkbox-inline">
								<input type="checkbox" value="1" id="inlineCssCheckbox3" name="status_detail" @if(!empty($main_id->status_use_detail)) checked @endif/>
								<label for="inlineCssCheckbox3">detail</label>
							</div>
							<div class="checkbox checkbox-css  checkbox-inline">
								<input type="checkbox" value="1" id="inlineCssCheckbox4"  name="status_gallary"@if(!empty($main_id->status_use_gallery)) checked @endif/>
								<label for="inlineCssCheckbox4">Gallary</label>
							</div>
							<div class="checkbox checkbox-css  checkbox-inline">
								<input type="checkbox" value="1" id="inlineCssCheckbox5" name="status_file"@if(!empty($main_id->status_use_file)) checked @endif/>
								<label for="inlineCssCheckbox5">file</label>
							</div>
							<div class="checkbox checkbox-css  checkbox-inline">
								<input type="checkbox" value="1" id="inlineCssCheckbox6" name="status_link"@if(!empty($main_id->status_use_link)) checked @endif/>
								<label for="inlineCssCheckbox6">link</label>
							</div>
						</div>
						<div class="form-group row m-b-15 detail_main_menu">
							<label class="col-md-3 col-sm-3 col-form-label">จำนวนข้อมูลที่เก็บ :</label>
							<div class="col-md-3 col-sm-3 ">
								@if($main_id->number_of_data == 1)
								<div class="radio radio-css radio-inline">
									<input type="radio" name="number_of_data" id="inlineCssRadio3x" value="1" checked/>
									<label for="inlineCssRadio3x">one</label>
								</div>
								<div class="radio radio-css radio-inline">
									<input type="radio" name="number_of_data" id="inlineCssRadio4x" value="2" />
									<label for="inlineCssRadio4x">many</label>
								</div>
								@else
								<div class="radio radio-css radio-inline">
									<input type="radio" name="number_of_data" id="inlineCssRadio3x" value="1" />
									<label for="inlineCssRadio3x">one</label>
								</div>
								<div class="radio radio-css radio-inline">
									<input type="radio" name="number_of_data" id="inlineCssRadio4x" value="2" checked/>
									<label for="inlineCssRadio4x">many</label>
								</div>
								@endif
							</div>
						</div>
						<div class="float-right">
							<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
						</div>

					</form>

				@elseif(empty($main_id))
				<form  method="POST" name="form_main_menu" enctype="multipart/form-data" action="{{route('menu.main')}}">
					@csrf

					<input class="form-control hide" type="text" id="status_setting" name="status_setting"  placeholder="" value="1" />
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="main_menu_name">ชื่อหัวข้อ :</label>
						<div class="col-md-8 col-sm-7">
							<input class="form-control @error('main_menu_name') is-invalid @enderror" type="text" id="main_menu_name" name="main_menu_name" placeholder=""  />
						</div>
					</div>
					<div class="form-group row m-b-15">
						<label class="col-md-3 col-sm-3 col-form-label">สถานะ sub menu :</label>
						<div class="col-md-2 col-sm-2 ">
							<div class="radio radio-css radio-inline">
								<input type="radio" name="status_sub_menu" id="inlineCssRadio1x" value="1" />
								<label for="inlineCssRadio1x">มี</label>
							</div>
							<div class="radio radio-css radio-inline">
								<input type="radio" name="status_sub_menu" id="inlineCssRadio2x" value="0" />
								<label for="inlineCssRadio2x">ไม่มี</label>
							</div>
						</div>
						<label class="col-md-2 col-sm-2 col-form-label" for="fullname">ลำดับการแสดง :</label>
						<div class="col-md-1 col-sm-1">
							<input class="form-control" type="number" id="number_show" name="number_show"  placeholder="" data-parsley-required="true" />
						</div>
						<label class="col-md-1 col-sm-1 col-form-label" for="fullname">เชื่อม :</label>
						<div class="col-md-2 col-sm-2">
								<select class="form-control" name="join_database" id="join_database">
									<option value="">database</option>
									<option value="board">board</option>
									<option value="index.company_all">company</option>
									<option value="index.document_all">document</option>
									<option value="type_document">type_document</option>
									<option value="index.company_year">company_year</option>
									<option value="index.activity_all">activity</option>
									<option value="index.news_all">news</option>
								</select>
						</div>

					</div>
					<div class="form-group row m-b-15 detail_main_menu hide">
						<label class="col-md-3 col-sm-3 col-form-label">ข้อมูลที่ต้อการบันทึก :</label>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox1" name="status_title"  />
							<label for="inlineCssCheckbox1">title</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox2" name="status_thumbnail" />
							<label for="inlineCssCheckbox2">thumbnail</label>
						</div>
						<div class="checkbox checkbox-css checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox3" name="status_detail" />
							<label for="inlineCssCheckbox3">detail</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox4"  name="status_gallary"/>
							<label for="inlineCssCheckbox4">Gallary</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox5" name="status_file"/>
							<label for="inlineCssCheckbox5">file</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox6" name="status_link"/>
							<label for="inlineCssCheckbox6">link</label>
						</div>
					</div>
					<div class="form-group row m-b-15 detail_main_menu hide">
						<label class="col-md-3 col-sm-3 col-form-label">จำนวนข้อมูลที่เก็บ :</label>
						<div class="col-md-3 col-sm-3 ">
							<div class="radio radio-css radio-inline">
								<input type="radio" name="number_of_data" id="inlineCssRadio3x" value="1" checked/>
								<label for="inlineCssRadio3x">one</label>
							</div>
							<div class="radio radio-css radio-inline">
								<input type="radio" name="number_of_data" id="inlineCssRadio4x" value="2" />
								<label for="inlineCssRadio4x">many</label>
							</div>
						</div>
					</div>
					<div class="float-right">
						<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
					</div>
				</form>
			@endif

			</div>
		</div>





		@if(!empty($main_id))
		@if($main_id->status_have_sub == 1)
		<div class="panel panel-default detail_sub_menu ">
			<div class="panel-heading">
				<h4 class="panel-title">Sub Menu</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<form  method="POST" name="form_sub_menu" enctype="multipart/form-data" action="{{route('menu.sub')}}">
					@csrf
					<input class="form-control hide" type="text" id="status_setting" name="status_setting"  placeholder="" value="1" />
					<input class="form-control hide" type="text" id="main_menu_id" name="main_menu_id" placeholder="" value="{{$main_id->id}}"  />
					<div class="form-group row m-b-15">
						<label class="col-md-2 col-sm-2 col-form-label" for="sub_menu_name">ชื่อsub menu :</label>
						<div class="col-md-3 col-sm-3">
							<input class="form-control" type="text" id="sub_menu_name" name="sub_menu_name" placeholder="" data-parsley-required="true" />
						</div>
						<label class="col-md-2 col-sm-2 col-form-label" for="fullname">ลำดับการแสดง :</label>
						<div class="col-md-2 col-sm-2">
							<input class="form-control" type="number" id="number_show" name="number_show"  placeholder="" data-parsley-required="true" />
						</div>
						<label class="col-md-1 col-sm-1 col-form-label" for="fullname">เชื่อม :</label>
						<div class="col-md-2 col-sm-2">
								<select class="form-control" name="join_database" id="join_database">
									<option value="">database</option>
									<option value="board">board</option>
									<option value="index.company_all">company</option>
									<option value="index.document_all">document</option>
									<option value="type_document">type_document</option>
									<option value="index.company_year">company_year</option>
									<option value="index.activity_all">activity</option>
									<option value="index.news_all">news</option>
								</select>
						</div>
					</div>
					<div class="form-group row m-b-15">
						<label class="col-md-3 col-sm-3 col-form-label">ข้อมูลที่ต้อการบันทึก :</label>

						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox11" name="status_title"  />
							<label for="inlineCssCheckbox11">title</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox12" name="status_thumbnail" />
							<label for="inlineCssCheckbox12">thumbnail</label>
						</div>
						<div class="checkbox checkbox-css checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox13" name="status_detail" />
							<label for="inlineCssCheckbox13">detail</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox14"  name="status_gallery"/>
							<label for="inlineCssCheckbox14">Gallary</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox15" name="status_file"/>
							<label for="inlineCssCheckbox15">file</label>
						</div>
						<div class="checkbox checkbox-css  checkbox-inline">
							<input type="checkbox" value="1" id="inlineCssCheckbox16" name="status_link"/>
							<label for="inlineCssCheckbox16">link</label>
						</div>
                        <div class="checkbox checkbox-css  checkbox-inline">
                            <input type="checkbox" value="1" id="inlineCssCheckbox17" name="status_range_date"/>
                            <label for="inlineCssCheckbox17">range_date</label>
                        </div>
					</div>
					<div class="form-group row m-b-15 ">
						<label class="col-md-3 col-sm-3 col-form-label">จำนวนข้อมูลที่เก็บ :</label>
						<div class="col-md-3 col-sm-3 ">
							<div class="radio radio-css radio-inline">
								<input type="radio" name="number_of_data" id="inlineCssRadio5x" value="1" checked/>
								<label for="inlineCssRadio5x">one</label>
							</div>
							<div class="radio radio-css radio-inline">
								<input type="radio" name="number_of_data" id="inlineCssRadio6x" value="2" />
								<label for="inlineCssRadio6x">many</label>
							</div>
						</div>

						<div class="form-group col-md-3">
							<button type="submit" class="btn btn-sm btn-primary m-r-5 pull-right">บันทึก</button>
						</div>


					</div>
					<!-- <div class="form-group row m-b-15 float-right">
						<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>

					</div> -->

				</form>
				<table id="" class="table table-striped table-bordered table-td-valign-middle">
					<thead>
						<tr>
							<th width="1%" class="f-s-600 text-inverse">ลำดับ</th>
							<th width="35%" class="with-img" class="text-nowrap">Sub menu</th>
							<th class="text-nowrap">title</th>
							<th class="text-nowrap">thumbnail</th>
							<th class="text-nowrap">detail</th>
							<th class="text-nowrap">Gallary</th>
							<th class="text-nowrap">file</th>
							<th class="text-nowrap">link</th>
							<th class="text-nowrap">num_data</th>
							<th class="text-nowrap">สถานะ</th>
							<th class="text-nowrap">แก้ไข</th>

						</tr>
					</thead>
					<tbody>
					@foreach($sub_id as $sub)
						<tr class="odd gradeX">
							<td >{{$sub->number_show}}</td>
							<td >{{$sub->name}}</td>
							<td>{{$sub->status_use_title}}</td>
							<td>{{$sub->status_use_thumbnail}}</td>
							<td>{{$sub->status_use_detail}}</td>
							<td>{{$sub->status_use_gallery}}</td>
							<td>{{$sub->status_use_file}}</td>
							<td>{{$sub->status_use_link}}</td>
							<td>@if($sub->number_of_data == 1) one @else many @endif</td>

							<td>
						      	<label class="switch">
								  <input type="checkbox"  class="status_setting_sub" sub-id="{{$sub->id}}"
								  @if($sub->status_setting == 1) checked @endif>
								  <span class="slider round"></span>
								</label>
							</td>
							<td>
							<a  class="btn btn-yellow" href="{{ route('menu.sub_edit',[$sub->id]) }}" role="button">แก้ไข</a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
				</div>
			</div>
			@endif
		@endif


		</div>

	<!-- end panel -->
	</div>
</div>
</div>
@endsection

@section('script_menu')
<script type="text/javascript">
 $(document).ready(function(){
	$('input[type="radio"]').change(function() {
		var status_sub_menu = $("input[name=status_sub_menu]:checked").val();
		// alert(status_sub_menu);
		if (status_sub_menu == 0) {
			$('.detail_main_menu').removeClass('hide');
			$('.detail_sub_menu').addClass('hide');
		}else if (status_sub_menu == 1) {
			$('.detail_main_menu').addClass('hide');
			$('.detail_sub_menu').removeClass('hide');
		}

	});

	$('.status_setting_main').click(function() {

		var main_id = $(this).attr('main-id');

		var status = $(this).is(":checked") ? 1:0;

		$.ajax({
			url: '{{route('menu.setting_update')}}',
			method: 'POST',
			data:{"_token": "{{ csrf_token() }}", 'mode':'main', 'main_id':main_id, 'status_setting_main':status},
			dataType: 'json',
			success:function(data)
			{
				// alert(data.alert);
			}
		});


	});


	$('.status_setting_sub').click(function() {

		var sub_id = $(this).attr('sub-id');

		var status = $(this).is(":checked") ? 1:0;

		$.ajax({
			url: '{{route('menu.setting_update')}}',
			method: 'POST',
			data:{"_token": "{{ csrf_token() }}", 'mode':'sub', 'sub_id':sub_id, 'status_setting_sub':status},
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

