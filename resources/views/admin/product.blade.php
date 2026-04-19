
@extends('admin.master')
@section('product')
<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin row -->
		<div class="row">
			<!-- begin col-12 -->
			<div class="col-xl-12">
				<!-- begin panel -->
				<div class="panel  ">
					<div class="panel-body">
						
						<h3>สินค้าของ {{$company->name}}</h3>
							<form action="{{route('product.insert')}}" method="POST" name="summernote_form" enctype="multipart/form-data" >
								@csrf
							<input class="form-control hide" type="text" id="member_id" name="member_id" placeholder="" data-parsley-required="true" value="{{session()->get('user.member_id')}}"/>
							<input class="form-control hide" type="text" id="company_id" name="company_id" placeholder="" data-parsley-required="true" value="{{$company->id}}"/>
							<input class="form-control hide" type="text" id="id" name="id" placeholder="" data-parsley-required="true" value=""/>	
							<div class="form-group row m-b-15">
								<div class="col-md-4 col-sm-4 ">
									<center>
									<!-- <div class="col-md-9 col-sm-9 "> -->
										<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="avatar" style="height: 180px; width: auto;">

										<br>
										<!-- <label class="col-md-3 col-sm-3 col-form-label">รูปสินค้า</label> -->
										<div class="col-md-9 col-sm-9 "> 

											<input class="form-control file-upload" type="file" id="image_name" name="image_name" placeholder="" data-parsley-required="true" />
										</div>
									</center>
								</div>
								<div class="col-md-8 col-sm-8">
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="name">ชื่อสินค้า :</label>
										<div class="col-md-10 col-sm-10">
											<input class="form-control" type="text" id="name" name="name" placeholder="" data-parsley-required="true" />
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-form-label col-md-2">ประเภทของสินค้า:</label>
										<div class="col-md-10">
											{{ Form::select('type_product_id', App\Type_Product::all()->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกคำนำหน้า...','class'=>'form-control']) }} 
										</div>
									</div>
									<div class="form-group row m-b-15">
										<label class="col-md-2 col-sm-2 col-form-label" for="list_price">ราคาทั่วไป  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="number" id="list_price" name="list_price" placeholder="" data-parsley-required="true" />
										</div>
									
										<label class="col-md-2 col-sm-2 col-form-label" for="our_price">ราคาของเรา  :</label>
										<div class="col-md-4 col-sm-4">
											<input class="form-control" type="number" id="our_price" name="our_price" placeholder="" data-parsley-required="true" />
										</div>
									</div>
									
									<div class="form-group float-right ">
										<button type="submit" class="btn btn-sm btn-primary m-r-5">บันทึก</button>
										<!-- <button type="submit" class="btn btn-sm btn-default">ยกเลิก</button> -->
									</div>
									
									


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
									<th width="1%">id</th>
									<th width="4%" data-orderable="false">รูปสินค้า</th>
									<th width="15%">สินค้า</th>
									<th width="3%"class="text-nowrap">ประเภทของสินค้า</th>
									<th width="3%"class="text-nowrap">ราคาทั่วไป</th>
									<th width="1%" >ราคาของเรา</th>
									<th width="3%">แก้ไข</th>
								</tr>
							</thead>
							<tbody>
								@foreach($product as $row)
								<tr class="odd gradeX" id="{{$row->id}}" >
									<td class="f-s-600 text-inverse">{{$row->id}}</td>
									<td data-target=thumbnail class="with-img">
										<img src="{{asset('storage/product/'.$row->thumbnail)}}" class="img-rounded height-70" /><br>{{$row->thumbnail}}</td>
									<td data-target=name>{{$row->name}}</td>
									<td data-target=type_product_id>{{$row->type_product_id}}</td>
									<td data-target=list_price>{{$row->list_price}}</td>
									<td data-target=our_price>{{$row->our_price}}</td>
									<td>
										<a class="btn btn-yellow"  role="button" data-role="update" data-id="{{$row->id}}">แก้ไข</a>
										<a class="btn btn-red" href="{{route('product.delete',[$row->id])}}" role="button">ลบ</a>
									</td>
									
								</tr>	
								@endforeach
								
								
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
@section('script_content')
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','a[data-role=update]',function(){
      // alert($(this).data('id'));
      var id = $(this).data('id');
      var thumbnail = $('#'+id).children('td[data-target=thumbnail]').text();
      var name = $('#'+id).children('td[data-target=name]').text();
      var type_product_id = $('#'+id).children('td[data-target=type_product_id]').text();
      var list_price = $('#'+id).children('td[data-target=list_price]').text();
      var our_price = $('#'+id).children('td[data-target=our_price]').text();

      // alert(id+thumbnail+name+type_product_id+list_price+our_price);

	  var aa = 'storage/people/'+thumbnail;
      $('#id').val(id);
      $('#name').val(name);
      $('select[name="type_product_id"]').val(type_product_id);
      $('#list_price').val(list_price);
      $('#our_price').val(our_price);
      // $('#image_name').val('asset(storage/people/'+thumbnail')');
     
	    // var readURL = function(input) {
	    //     if (input.files && input.files[0]) {
	    //         var reader = new FileReader();

	    //         reader.onload = function (e) {
	    //             $('.avatar').attr('src', e.target.result);
	    //         }
	    
	    //         reader.readAsDataURL(input.files[0]);
	    //     }
	    // }
	    $(".file-upload").on('change', function(){
	        aa(this);
	    });
	    // alert(aa);
    });

});
</script>
@endsection
