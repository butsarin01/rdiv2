
@extends('admin.master')
@section('news')
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
						<i class="fas fa-lg fa-fw m-r-10 fa-plus-circle text-blue "></i> แบบบันทึกข้อมูลข่าว
					</div>
					<div id="collapseOne" class="collapse" data-parent="#accordion">
						<div class="card-body">
							<form action="" method="POST" name="summernote_form" enctype="multipart/form-data" >
							<div class="form-group row m-b-15">
								<div class="col-md-8 col-sm-8">
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="fullname">ชื่อหัวข้อข่าว  :</label>
										<div class="col-md-8 col-sm-8">
											<input class="form-control" type="text" id="fullname" name="fullname" placeholder="" data-parsley-required="true" />
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 ">
									<label class="col-md-3 col-sm-3 col-form-label">ไฟล์</label>
									<div class="col-md-9 col-sm-9 ">
										<input class="form-control file-upload" type="file" id="fullname" name="fullname" placeholder="" data-parsley-required="true" />
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
									<th width="1%"></th>
									<th width="1%" data-orderable="false"></th>
									<th class="text-nowrap">Rendering engine</th>
									<th class="text-nowrap">Browser</th>
									<th class="text-nowrap">Platform(s)</th>
									<th class="text-nowrap">Engine version</th>
									<th class="text-nowrap">CSS grade</th>
								</tr>
							</thead>
							<tbody>
								<tr class="odd gradeX">
									<td width="1%" class="f-s-600 text-inverse">1</td>
									<td width="1%" class="with-img"><img src="../assets/img/user/user-1.jpg" class="img-rounded height-30" /></td>
									<td>Trident</td>
									<td>Internet Explorer 4.0</td>
									<td>Win 95+</td>
									<td>4</td>
									<td>X</td>
								</tr>
								
								<tr class="gradeU">
									<td width="1%" class="f-s-600 text-inverse">58</td>
									<td width="1%" class="with-img"><img src="../assets/img/user/user-1.jpg" class="img-rounded height-30" /></td>
									<td>Other browsers</td>
									<td>All others</td>
									<td>-</td>
									<td>-</td>
									<td>U</td>
								</tr>
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