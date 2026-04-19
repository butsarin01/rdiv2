<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Admin</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
	<link href="assets/css/default/app.css" rel="stylesheet" />

	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE CSS ================== -->
	<link href="assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatables.net-keytable-bs4/css/keytable.bootstrap4.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE CSS STYLE ================== -->	
	<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
	<link href="assets/plugins/abpetkov-powerange/dist/powerange.min.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/dropzone/dist/min/dropzone.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	<style>
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 40px;
	  height: 24px;
	}

	.switch input { 
	  opacity: 0;
	  width: 0;
	  height: 0;
	}

	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 19px;
	  width: 19px;
	  left: 2px;
	  bottom: 2px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input:checked + .slider {
	  background-color: #2196F3;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(17px);
	  -ms-transform: translateX(17px);
	  transform: translateX(17px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 24px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}
	</style>
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> <b>Color</b> Admin</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header --><!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
			
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{session()->get('user.image_user')}}" alt="" /> 
						<span class="d-none d-md-inline">{{session()->get('user.ldap_username')}}</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{route('logout')}}" class="dropdown-item">Log Out</a>
					</div>
				</li>
			</ul>
			<!-- end header-nav -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="{{session()->get('user.image_user')}}" alt="" />
							</div>
							<div class="info">{{session()->get('user.full_name')}}
								<small>{{session()->get('user.permisstion_name')}}
									{{session()->get('user.permisstion')}}</small>
							</div>
						</a>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->

				<ul class="nav">
					<li class="nav-header">Navigation</li>
					<?php $per =  session()->get('user.permisstion');?>
				@if($per == 1 || $per == 2 || $per == 3)
					
					@if(!empty($main_menu_all))
						@foreach($main_menu_all as $main)
							@if($main->status_setting == 1 && $main->join_database=='')
								@if(!empty($main->submenu[0]))
								<li class="has-sub">
									<a href="javascript:;">
										<b class="caret"></b>
										<i class="fas fa-home fa-fw"></i> 
										<span>{{ $main->name }} </span>
									</a>
									<ul class="sub-menu">
										@foreach($main->submenu as $sub)
											@if($sub->status_setting == 1 && $sub->join_database=='')
												<li>
													<a href="{{ route('content.index',['id'=>$sub->id, 'mode'=>'sub']) }}">
													<!-- <a href="/content/{{$sub->id}}&&sub"> -->
														<span>{{ $sub->name }}</span>
													</a>
												</li>
											@endif
										@endforeach
									</ul>
								</li>
								@else
								
								<li>
									<a href="{{ route('content.index',['id'=>$main->id, 'mode'=>'main']) }}">
									<!-- <a href="/content/{{$main->id}}&&main"> -->
										<i class="fas fa-home fa-fw"></i> 
										<span>{{ $main->name }}</span>
									</a>
								</li>
								@endif

							@endif
						@endforeach
					@endif
				
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fas fa-lg fa-fw m-r-10 fa-user-plus"></i> 
							<span>บุคคล</span>
						</a>
						<ul class="sub-menu">

							@if(!empty($group[0]))
								@foreach($group as $row)
									@if($row->status_setting == 1)
										<li>
											<a href="{{ route('content.borad',[$row->id]) }}">
												<span>{{ $row->name }}</span>
											</a>
										</li>
									@endif
								@endforeach
							@elseif(!empty($group) && !is_array($group) && !empty($group->id))
								<li>
									<a href="{{ route('content.borad',[$group->id]) }}">
										<span>{{ $group->name }}</span>
									</a>
								</li>
							@endif
							
						</ul>
					</li>

					<li>
						<a href="{{route('company.index')}}">
							<i class="fas fa-lg fa-fw m-r-10 fa-building"></i> 
							<span>บริษัท</span>
						</a>
					</li>
					<li>
						<a href="http://emp.nsru.ac.th/newspaper/32">
							<i class="fas fa-lg fa-fw m-r-10 fa-bullhorn"></i> 
							<span>ข่าว/ประกาศ</span>
						</a>
					</li>
				<!-- 	<li>
						<a href="/calender_activity">
							<i class="fas fa-lg fa-fw m-r-10 fa-calendar"></i> 
							<span>ปฏิทินกิจกรรม</span>
						</a>
					</li> -->
					<li>
						<a href="http://emp.nsru.ac.th/calendar/12">
							<i class="fas fa-lg fa-fw m-r-10 fa-camera-retro"></i> 
							<span>กิจกรรม</span>
						</a>
					</li>
				@endif
				@if($per == 2 || $per == 3)
					<li>
						<a href="{{route('member.index')}}">
							<i class="fas fa-lg fa-fw m-r-10 fa-unlock"></i> 
							<span>สิทธิ์การใช้งาน</span>
						</a>
					</li>
				@endif	
				@if($per == 3)
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fas fa-cog fa-fw"></i>
							<span>จัดการเมนู</span>
						</a>
						<ul class="sub-menu">
							<li><a href="{{route('menu.index')}}">Menu</a></li>
							<li><a href="{{route('people.index')}}">people</a></li>
							<li><a href="{{route('template.set')}}">content</a></li>

						</ul>
					</li>
				@endif
									
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		 @yield('body_content')
		 @yield('people_all')
		 @yield('company')
		 @yield('product')
		 @yield('activity')
		 @yield('news')
		 @yield('calenderActivity')
		 @yield('setting_menu')
		 @yield('setting_people')
		 @yield('setting_content')
		 @yield('member')
		 @yield('admin')


		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/js/app.min.js"></script>
	<script src="assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/summernote/dist/summernote.min.js"></script>
	<script src="assets/js/demo/form-summernote.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-keytable/js/dataTables.keytable.min.js"></script>
	<script src="assets/plugins/datatables.net-keytable-bs4/js/keytable.bootstrap4.min.js"></script>
	<script src="assets/js/demo/table-manage-keytable.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="assets/plugins/moment/min/moment.min.js"></script>
	<script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="assets/plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="assets/js/demo/form-plugins.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/switchery/switchery.min.js"></script>
	<script src="assets/plugins/abpetkov-powerange/dist/powerange.min.js"></script>
	<script src="assets/js/demo/form-slider-switcher.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/dropzone/dist/min/dropzone.min.js"></script>
	<script src="assets/plugins/highlight.js/highlight.min.js"></script>
	<script src="assets/js/demo/render.highlight.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->


<script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add_text_datetime').click(function(){  
           i++;  
           var html = '';
           	html += '<tr id="row'+i+'">';
           	html += '	<td>';
           	html += '		<input type="text" name="datetime_activity[]" placeholder="วันและเวลา ที่มีกิจกรรม" class="form-control name_list xxx"  id="datepicker-autoClose" />';
          	html += '	</td>';
           	html += '	<td>';
           	html += '		<div class="input-group " >';
			html += '			<input type="text" class="form-control" name="time_begin_activity[]" placeholder="เวลาเริ่มต้น"/>';
			html += '				<span class="input-group-addon">';
			html += '					<i class="fa fa-clock"></i>';
			html += '				</span>';
			html += '		</div>';
			html += '	</td>	';
	        html += '   <td>';
	        html += '        <div class="input-group " >';
			html += '			<input type="text" class="form-control" name="time_end_activity[]" placeholder="เวลาสิ้นสุด"/>';
			html += '				<span class="input-group-addon">';
			html += '					<i class="fa fa-clock"></i>';
			html += '				</span>';							
			html += '		</div>	';
	        html += '   </td>';
           	html += '	<td>';
           	html += '		<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>';
           	html += '	</td>';
           	html += '</tr>';
           $('#dynamic_field').append(html);  
           $('.xxx').datepicker();

      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  

	    var readURL = function(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('.avatar').attr('src', e.target.result);
	            }
	    
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	    

	    $(".file-upload").on('change', function(){
	        readURL(this);
	    });



	});

	</script>
	 @yield('script_content')
	 @yield('script_menu')
</body>
</html>
