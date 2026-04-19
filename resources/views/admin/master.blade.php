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
	<link href="../assets/css/default/app.css" rel="stylesheet" />
	<!-- <link href="{{ URL::to('assets/css/default/app.css')}}" rel="stylesheet" /> -->

	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE CSS ================== -->
	<link href="../assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatables.net-keytable-bs4/css/keytable.bootstrap4.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<!-- <link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" /> -->
	<!-- <link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" /> -->
	<link href="../assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<!-- <link href="../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" /> -->
	<link href="../assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="../assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<!-- <link href="../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" /> -->
	<link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<!-- <link href="../assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" /> -->
	<link href="../assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE CSS STYLE ================== -->	
	<link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
	<link href="../assets/plugins/abpetkov-powerange/dist/powerange.min.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="../assets/plugins/dropzone/dist/min/dropzone.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
<link href="../bootstrap-datepicker-thai-thai/css/datepicker.css" rel="stylesheet" media="screen">
	
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
	.show_pc{
		display: none !important;
	}
	.show_moblie{
		display: contents !important;
	}

	@media only screen and (orientation: portrait) {
		.show_pc{
			display: none;
		}
		.show_moblie{
			display: none;
		}
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
		@include('admin.menu')

		 @yield('body_content')
		 @yield('people_all')
		 @yield('company')
		 @yield('document')
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
	<script src="../assets/js/app.min.js"></script>
	<script src="../assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../assets/plugins/summernote/dist/summernote.min.js"></script>
	<script src="../assets/js/demo/form-summernote.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="../assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="../assets/plugins/datatables.net-keytable/js/dataTables.keytable.min.js"></script>
	<script src="../assets/plugins/datatables.net-keytable-bs4/js/keytable.bootstrap4.min.js"></script>
	<script src="../assets/js/demo/table-manage-keytable.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="../assets/plugins/moment/min/moment.min.js"></script>
	<!-- <script src="../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script> -->
	<script src="../assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="../assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="../assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<!-- <script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script> -->
	<script src="../assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="../assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="../assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="../assets/plugins/tag-it/js/tag-it.min.js"></script>
	<!-- <script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> -->
	<script src="../assets/plugins/select2/dist/js/select2.min.js"></script>
	<!-- <script src="../assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script> -->
	<script src="../assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="../assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="../assets/plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="../assets/js/demo/form-plugins.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../assets/plugins/switchery/switchery.min.js"></script>
	<script src="../assets/plugins/abpetkov-powerange/dist/powerange.min.js"></script>
	<script src="../assets/js/demo/form-slider-switcher.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../assets/plugins/dropzone/dist/min/dropzone.min.js"></script>
	<script src="../assets/plugins/highlight.js/highlight.min.js"></script>
	<script src="../assets/js/demo/render.highlight.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
  <script src="../bootstrap-datepicker-thai-thai/js/bootstrap-datepicker.js"></script>
    <script src="../bootstrap-datepicker-thai-thai/js/bootstrap-datepicker-thai.js"></script>
    <script src="../bootstrap-datepicker-thai-thai/js/locales/bootstrap-datepicker.th.js"></script>

    <script id="example_script"  type="text/javascript">
      function demo() {
        $('.datepicker').datepicker({inline: true,});
      }
    </script>

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
