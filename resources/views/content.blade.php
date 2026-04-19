@dd(555555555555555555);
@extends('master1')

@section('title', 'สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์')

@section('activity_detail')
		
<div class="p-b-20">

	<h3 class="f1-l-3 cl2 p-b-1  respon2 p-t-5 p-l-5" style="background-color: #fff;">
		@if(!empty($menu->name)) {{$menu->name}}  @endif
		@if(!empty($data_company)) {{$data_company->name}}  @endif
		@if(!empty($company_mode)) {{$company_mode}}  @endif
		@if(!empty($data_document)) {{$data_document->name}} @endif

		@if(!empty($document_mode)) {{$document_mode}}  @endif
	</h3>
	<hr width=100% size=5  style="margin-top:0.5rem; background-color: burlywood;" class="p-t-2">
	

	@if(!empty($data_detail_menu))

		@if($menu->number_of_data == 2 ) <div class="row justify-content-center">@endif
			@foreach($data_detail_menu as $data) 

			@if($menu->number_of_data == 2)
				@if(!empty($data->detail))
					<div class="col-sm-4 p-r-25 p-r-15-sr991">
						<div class="m-b-45">
						@if(!empty($data->thumbnail))	
							<a href="{{route('index.content_detail',[$data->id])}}" class="wrap-pic-w hov1 trans-03">
								<img src="{{asset('storage/content/'.$data->thumbnail)}}" alt="IMG" height="200" >
							</a>
						@endif	
							<div class="p-t-25">
								@if(!empty($data->title))	
									<h5 class="p-b-5">
										<a href="{{route('index.content_detail',[$data->id])}}" class="f1-m-3 cl2 hov-cl10 trans-03">
											{{$data->title}}
										</a>
									</h5>
								@endif	
							</div>
						</div>
					</div>
				@else
					@if(!empty($data->thumbnail))
					<div class="wrap-pic-80-w p-t-30 text-center">
						@if(!empty($data->link))
							<a href="{{$data->link}}">
								<img src="{{asset('storage/content/'.$data->thumbnail)}}" class="wrap-pic-w hov1 trans-03"
								height="200" alt="@if(!empty($data->title)){{$data->title}}@endif">	
							</a>
						@elseif(!empty($data->file)) 
							@if($data->filetype == 'pdf')
								<a href="{{route('index.content_detail',[$data->id])}}">
									<img src="{{asset('storage/content/'.$data->thumbnail)}}" download="{{$data->file}}" class="wrap-pic-w hov1 trans-03"
									height="200" alt="@if(!empty($data->title)){{$data->title}}@endif">	
								</a>
							@else
								<a href="{{asset('storage/file/'.$data->file)}}">
									<img src="{{asset('storage/content/'.$data->thumbnail)}}" download="{{$data->file}}" class="wrap-pic-w hov1 trans-03" height="200" alt="@if(!empty($data->title)){{$data->title}}@endif">	
								</a>
							@endif
						@else
						5
							<img src="{{asset('storage/content/'.$data->thumbnail)}}" alt="@if(!empty($data->title)){{$data->title}}@endif" height="200"
							style="width: auto;height: 200px;">
						@endif
					</div>
					@endif
				
					@if(!empty($data->title))
					<div class="col-md-12  text-center">
						<p class="f1-s-11 cl6 ">
							@if(!empty($data->link))
								<a href="{{$data->link}}"><b>{{$data->title}}</b></a>

							@elseif(!empty($data->file)) 
								@if($data->filetype == 'pdf')
									<a href="{{route('index.content_detail',[$data->id])}}"><b>{{$data->title}} ({{$data->filetype}})</b></a>

									<a class="btn btn-primary" href="{{asset('storage/file/'.$data->file)}}" role="button" download="{{$data->file}}" ><i class="fa fa-download"></i>Download</a>
								@else
									<a href="{{asset('storage/file/'.$data->file)}}" download="{{$data->file}}"><b>{{$data->title}} ({{$data->filetype}})</b></a>

									<a class="btn btn-primary" href="{{asset('storage/file/'.$data->file)}}" role="button" download="{{$data->file}}" ><i class="fa fa-download"></i> Download</a>
								@endif

							@else
								<b>{{$data->title}}</b>
							@endif
						</p>
					</div>
					@endif
				@endif

			@endif

			@if($menu->number_of_data == 1)
				@if(!empty($data->thumbnail))
					@if(!empty($data->link))
						<a href="{{$data->link}}">
							<img src="{{asset('storage/content/'.$data->thumbnail)}}" 
							height="200" alt="IMG">	
						</a>
					@elseif(!empty($data->file)) 
						<a href="{{asset('storage/file/'.$data->file)}}">
							<img src="{{asset('storage/content/'.$data->thumbnail)}}" download="{{$data->file}}" class="wrap-pic-w hov1 trans-03"
							height="200" alt="IMG">	
						</a>
					@else
						<div class="wrap-pic-max-w p-b-30 text-center">
							<img src="{{asset('storage/content/'.$data->thumbnail)}}" 
							@if(!empty($data->detail)) height="200" @endif alt="IMG">
						</div>
					@endif

				@endif

				
				@if(!empty($data->title))
					<p class="f1-s-11 cl6 ">
						@if(!empty($data->link))
							<a href="{{$data->link}}"><b>{{$data->title}}</b></a>
						@elseif(!empty($data->file)) 
							<a href="{{asset('storage/file/'.$data->file)}}" download="{{$data->file}}"><b>{{$data->title}}</b></a>
						@else
							<b>{{$data->title}}</b>
						@endif
					</p>
				@endif

				@if(!empty($data->detail))

				<p class="f1-s-11 cl6 p-b-15 ">
					 <?php echo $data->detail; ?> 
				</p>
				@endif

				@if(!empty($data->file))
					<object data="{{asset('storage/file/'.$data->file)}}" type="application/pdf" width="100%" height="800px"> 
					</object>
				@endif

			@endif

			@endforeach
			@if($menu->number_of_data == 2 )</div>@endif
	@endif

	@if(!empty($data_company))
		<div class="row m-rl--1">
			<div class="col-md-6 p-rl-1 p-b-2">
				<div class="wrap-pic-max-w p-b-30 text-center">
					<img src="{{asset('storage/company/'.$data_company->thumbnail)}}" 
					 height="400" alt="IMG">
				</div>
			
			</div>
			<div class="col-md-6 p-rl-1 p-b-2">
				<h5 class="p-b-5">
					@if(!empty($data_company->owner)) 
						<i class="fs-12 m-l-5 fa fa-caret-right"></i>เจ้าของโครงการ :  {{$data_company->owner}}<br>
					@endif
					@if(!empty($data_company->telephone)) 
						<i class="fs-12 m-l-5 fa fa-caret-right"></i>เบอร์โทร :  {{$data_company->telephone}}<br>
					@endif
					@if(!empty($data_company->date_join)) 
						<i class="fs-12 m-l-5 fa fa-caret-right"></i>วันที่เข้าร่วม :  {{$data_company->date_join}}<br>
					@endif
					@if(!empty($data_company->date_join)) 
						<i class="fs-12 m-l-5 fa fa-caret-right"></i>ประโยชน์ที่ได้รับจาก NSRUBI :	<br>  การอบรมหลักสูตรแบบเข้มเพื่อการเป็นผู้ประกอบการ 4 หลักสูตร :  <br>
						<?php echo $data_company->benefit; ?><br>
					@endif
					@if(!empty($data_company->status_office)) 
						<i class="fs-12 m-l-5 fa fa-caret-right"></i>สถานภาพการดำเนินธุรกิจในปัจจุบัน :	@if($data_company->status_office == 1) 
							กำลังดำเนินธุรกิจ
						@endif
						<br>
					@endif
				</h5>
			</div>
		</div>
		<br>
		@if(!empty($data_product))
			<h5 class="f1-l-3 cl2 p-b-16  respon2">
				สินค้า :
			</h5>
			@foreach($data_product as $data)
				<div class="col-sm-3 p-r-25 p-r-15-sr991">
					<div class="m-b-45" style="background-color: #efefef">
						<center>
							<img src="{{asset('storage/product/'.$data->thumbnail)}}" alt="IMG" style="height: 100px; width: auto;">
							<br>
							<div class="p-t-16">
								<h4 class="p-b-5">
										{{$data->name}} <br>
										ราคาทั่วไป : <S>{{$data->list_price}}</S> บาท<br>
										ราคาของเรา : {{$data->our_price}} บาท<br>

								</h4>
							</div>
						</center>
					</div>
				</div>
			@endforeach
		@endif
	@endif

	@if(!empty($company_all))
		<div class="row p-t-35">
			@foreach($company_all as $row_company)
			<div class="col-sm-4 p-r-25 p-r-15-sr991">
				<div class="m-b-45"style="background-color: #efefef">
				
					<div class="text-center">
					<a href="{{ route('index.content_show',['company',$row_company->id ]) }}" class="big" > 
						<img src="{{asset('storage/company/'.$row_company->thumbnail)}}" alt="IMG" style="height: 230px; width: auto;">
					</a>
					</div>
					

					<div class="p-t-16">
						<h4 class="p-b-5">
							<a href="{{ route('index.content_show',['company',$row_company->id ]) }}" class="f1-m-3 cl2 hov-cl10 trans-03" >
								{{$row_company->name}} 
							</a>
						</h4>

						<span class="cl8">
							<a href="{{ route('index.content_show',['company',$row_company->id ]) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
								by {{$row_company->owner}} เบอร์โทร : {{$row_company->telephone}}
							</a><br>

						</span>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				{{$company_all->links()}}
			</div>
		</div>
	@endif
	
	@if(!empty($company_year))
		<div class="accordion" id="accordionExample">
			@foreach($company_year as $row_company)
			<div class="card">

			    <div class="card-header" id="heading{{$row_company->year_join}}">
			      <h2 class="mb-0 ">
			        <button class="btn btn-link f1-m-2 cl2 hov-cl10 trans-03" type="button" data-toggle="collapse" data-target="#collapse{{$row_company->year_join}}" aria-expanded="true" aria-controls="collapse{{$row_company->year_join}}">
			           <div class="row justify-content-between">
					    <div class="col-sm-9">
					         ผู้เข้ารับการบ่มเพาะจาก NSRUBI ปี {{$row_company->year_join}} 
					    </div>
					    <div class="col-sm-3">
					         จำนวน {{$row_company->company_count}} บริษัท
					    </div>
					  </div>
			        </button>
			      </h2>
			    </div>

			    <div id="collapse{{$row_company->year_join}}" class="collapse " aria-labelledby="heading{{$row_company->year_join}}" data-parent="#accordionExample">
			      <div class="card-body">

			        <table class="table table-hover">
					 
					  <tbody>
					  	@foreach($row_company->company as $row)
					    <tr>
					      	<td>
						      	<h4 class="p-b-5">
									<a href="{{ route('index.content_show',['company',$row->id ]) }}" class="f1-m-1 cl2 hov-cl10 trans-03" >
										{{$row->name}} 
									</a>
								</h4>
							</td>
					      <td>
						    <span class="cl8">
								<a href="{{ route('index.content_show',['company',$row->id ]) }}" class="f1-s-5 cl8 hov-cl10 trans-03">
									{{$row->owner}}<br> เบอร์โทร : {{$row->telephone}}
								</a>
							</span>
						  </td>
					    </tr>
					   	@endforeach
					  </tbody>
					</table>
			      </div>
			    </div>

			</div>
			@endforeach
		 
		</div>
	@endif

	@if(!empty($document_all))
		<div class="row justify-content-center">
			
			<!-- @foreach($document_all as $row_document)
				<div class="col-sm-4 p-r-25 p-r-15-sr991">
					<div class="m-b-45"style="background-color: #efefef">
					
						<div class="text-center">
						<a href="{{ route('index.content_show',['document',$row_document->id ]) }}" class="big" > 
							<img src="{{asset('storage/document_img/'.$row_document->thumbnail)}}" alt="IMG" style="height: 230px; width: auto;">
						</a>
						</div>
						
						<div class="p-t-16">
							<h4 class="p-b-5">
								<a href="{{ route('index.content_show',['document',$row_document->id ]) }}" class="f1-m-3 cl2 hov-cl10 trans-03" >
									{{$row_document->name}} 
								</a>
							</h4>

							<span class="cl8">
								<a href="{{ route('index.content_show',['document',$row_document->id ]) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
									ประเภท:  {{$row_document->type_document()}} 
								</a><br>

							</span>
						</div>
					</div>
				</div>
			@endforeach -->
	
			
			<div class="container">
				<table id="myTable" class="table table-hover m-t-30 ">
				  <thead>
				    <tr>
				      <th scope="col">ลำดับ</th>
				      <!-- <th scope="col">ประเภท</th> -->
				      
				      <!-- <th scope="col">วันที่</th> -->
				      <th scope="col">เอกสาร</th>
				      <th scope="col"></th>
				      <th scope="col">ไฟล์</th>

				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($document_all as $row_document)
				    <tr>
				      <td scope="row">{{$row_document->id}} </td>
				      <!-- <td>{{$row_document->type_document()}}</td> -->
				      
				      <!-- <td>{{$row_document->thai_datefull()}}</td> -->
				      <td>
				      	<a href="{{ route('index.content_show',['document',$row_document->id ]) }}" class=" cl2 hov-cl10 trans-03" >{{$row_document->name}}</a> 
				      </td>
				      <td>
				      	<img src="{{asset($row_document->file_type())}}" height="50">
				      </td>
				      <td><a class="btn btn-primary" href="{{asset('storage/document/'.$row_document->file)}}" role="button" download="{{$row_document->file}}" ><i class="fa fa-download"></i> Download</a></td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>

			</div>
	
			
		</div>
	@endif

	@if(!empty($data_document))
		<div class="row m-rl--1">
			<div class="col-md-4 p-rl-1 p-b-2 p-t-10" >
				<div class="wrap-pic-max-w p-b-30 text-center">
					 <?php $type =  substr($data_document->file, -3);; ?>

					 @if(!empty($data_document->thumbnail))
					<img src="{{asset('storage/document_img/'.$data_document->thumbnail)}}" 
					 height="200" alt="IMG" download="{{$data_document->file}}">
					 @elseif($type == 'pdf')
						<!-- <embed  src="{{asset('storage/document/'.$data_document->file)}}" type="application/pdf" width="100%" height="300px" /> -->
						<!-- 	<object data="{{asset('storage/document/'.$data_document->file)}}" type="application/pdf" width="100%" height="300px"> 
							</object> -->

							<div class="wrapper" >
							    <!-- <object data="{{asset('storage/document/'.$data_document->file)}}" type="application/pdf" width="100%" height="100%"></object> -->
							    <embed  src="{{asset('storage/document/'.$data_document->file)}}" type="application/pdf" />
							</div>
					@endif
				</div>
			
			</div>

			<div class="col-md-6 p-rl-1 p-b-2 ">
				<h5 class="f1-l-4 cl2 p-b-16  respon2">
					เอกสารหลัก :
				</h5>
				<h5 class="p-b-5">
					@if(!empty($data_document->name)) 
						<div class="row ">
						    <div class="col col-sm-4 text-right" >ชื่อเอกสาร :</div>
						    <div class="col col-sm-7">{{$data_document->name}} (pdf{{$data_document->filetype}})</div>
						</div>
					@endif
					@if(!empty($data_document->file)) 
					<div class="row ">
						    <div class="col col-sm-4 text-right" >ไฟล์เอกสาร :</div>
						    <div class="col col-sm-7">

								<a class="btn btn-primary" href="{{asset('storage/document/'.$data_document->file)}}" role="button" download="{{$data_document->file}}" ><i class="fa fa-download"></i> Download</a>
						    </div>
						</div>
					
					@endif

					@if(!empty($data_document->type_document_id)) 
						<div class="row">
						    <div class="col col-sm-4 text-right">ประเภทเอกสาร :</div>
						    <div class="col col-sm-6">{{$data_document->type_document()}}</div>
						</div>
					@endif
					
					
					@if(!empty($data_document->status_use)) 
						<div class="row">
						    <div class="col col-sm-4 text-right">สถานการใช้ในปัจจุบัน :</div>
						    <div class="col col-sm-6">
						    	@if($data_document->status_use == 1) 
									ใช้งาน
								@endif
						    </div>
						</div>
					@endif
				</h5>

				<br>
				@if(!empty($data_sub_document))
				<h5 class="f1-l-4 cl2 p-b-16  respon2">
					เอกสารร่วม :
				</h5>
					@foreach($data_sub_document as $row)
					<!-- <div class="col-sm-3 p-r-25 p-r-15-sr991"> -->
						<!-- <div class="m-b-45" > -->
							<center>
								<!-- <div class="p-t-16"> -->
									<h4 class="p-b-5">
										<div class="row ">
										    <div class="col col-sm-4 text-right" >ชื่อเอกสาร :</div>
										    <div class="col col-sm-7 text-left">{{$row->name}} ({{$row->filetype}})</div>
										</div>
										<div class="row ">
										    <div class="col col-sm-4 text-right" >ไฟล์เอกสาร :</div>
										    <div class="col col-sm-7 text-left">
												<a class="btn btn-primary" href="{{asset('storage/sub_document/'.$row->file)}}" role="button" download="{{$row->file}}" ><i class="fa fa-download"></i> Download</a>
										    </div>
										</div>
									</h4>
								<!-- </div> -->
							</center>
						<!-- </div> -->
					<!-- </div> -->

					@endforeach
					
				@endif

			</div>
		</div>
	@endif

	@if(!empty($document_category))
		<div class="row justify-content-center">
			<div class="container">
				
				@foreach($document_category as $row_document)
				
				  	@if($have == 1)
				  		<h4 class="p-b-10" style="font-size: 20px;">{{$row_document->name}}</h4>
				  		@foreach($row_document->sub_doc as $row_doc)
				  			<span class="p-b-5 p-l-15 cl2">
				  				@if(!empty($row_doc->file))
								<a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$row_doc->file)}}" download="{{$row_doc->name}}" >
									<!-- <i class="fa m-r-5 m-t-10 fa-download"></i> -->
                                    <i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i>
									{{$row_doc->name}}</a>
								@else
									<i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i>
									{{$row_doc->name}}
								@endif
							</span><br>
							@if(!empty($row_doc->detail_doc))
							<?php $i = 0; ?>
						  		@foreach($row_doc->detail_doc as $sub_doc)
						  		<?php $i++; ?>
						  			<span class="p-b-5 p-l-45 cl2">
										<a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$row_doc->id.'/'.$sub_doc->file)}}" download="{{$sub_doc->name}}" >
											<!-- <i class="fa m-r-5 m-t-10 fa-download"></i> -->
		                                    <!-- <i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i> -->
		                                    {{$i}} . {{$sub_doc->name}}</a>
									</span><br>
						  		@endforeach
							@endif
				  		@endforeach
				  		<hr>
				  	@else
				  	
				  	@php
				  		$time = '';
				  	 	@if($document_mode == 'ข่าว')
				  	 	$time = '-';
				  	 	@endif
				  	 @endphp
					   <!-- <div class="p-t-16"> -->
							<span class="p-b-5 cl2">
								@if(!empty($row_document->file))
								<a class="cl2 hov-cl10 trans-03 align-items-center" href="{{asset('storage/document/'.$row_document->file)}}" download="{{$row_document->name}}" >
                                    <!-- <i class="fas fa-xs fa-fw m-r-5 m-b-3 fa-circle cl18"></i> -->
                                    <i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i>
                                    {{$time}}{{$row_document->name}}</a>
                                @else
                                	<i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i>
									{{$time}}{{$row_document->name}}
								@endif
							</span><br>
                        @if(!empty($row_document->detail_doc))
                            <?php $i = 0; ?>
                            @foreach($row_document->detail_doc as $sub_doc)
                                <?php $i++; ?>
                                <span class="p-b-5 p-l-45 cl2">
										<a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$row_document->id.'/'.$sub_doc->file)}}" download="{{$sub_doc->name}}" >
											<!-- <i class="fa m-r-5 m-t-10 fa-download"></i> -->
                                            <!-- <i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i> -->
		                                    {{$i}} . {{$sub_doc->name}}</a>
									</span><br>
                            @endforeach
                        @endif
						<!-- </div> -->
					@endif
				@endforeach

				@if($count_doc > 15)
				<div class="row m-t-20">
					<div class="col-md-12 text-center">
						{{$document_category->links()}}
					</div>
				</div>
				@endif
			</div>

		</div>
	@endif

</div>


@endsection


@section('show_pagination')
	<script>
	// $(document).ready(function(){

	//  $(document).on('click', '.pagination a', function(event){
	//   event.preventDefault(); 
	//   var page = $(this).attr('href').split('page=')[1];
	//   // alert(page);
	//   fetch_data(page);
	//  });

	//  function fetch_data(page)
	//  {
	//   $.ajax({
	//    url:"document_all/fetch_data?page="+page,
	//    success:function(data)
	//    {
	//     $('#table_data').html(data);
	//    }
	//   });
	//  }
	 
	// });
	</script>
@endsection
