@extends('master1')

@section('title', 'Page Title')

@section('activity_detail')
		
<div class="p-b-70">

	<h3 class="f1-l-3 cl2 p-b-16  respon2">
		@if(!empty($data_detail_menu->title)) {{$data_detail_menu->title}}  @endif
		@if(!empty($quality)) {{$quality->name_th}}  ({{$quality->name_eng}})  ประจำปีการศึกษา {{$year}} @endif
	</h3>
	<!-- 	<div class="flex-wr-s-s ">
			<span class="f1-s-3 cl8 m-r-15">
				<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03"> by John Alvarado </a>
				<span class="m-rl-3">-</span>
				<span> Feb 18 	</span>
			</span>
		</div> -->
		@if(!empty($data_detail_menu))

				@if(!empty($data_detail_menu->thumbnail))
				<!-- <div class="wrap-pic-max-w p-b-30 text-center"> -->
					@if(!empty($data_detail_menu->link))
						<a href="{{$data_detail_menu->link}}">
							<img src="{{asset('storage/content/'.$data_detail_menu->thumbnail)}}" 
							height="200" alt="IMG">	
						</a>
					@else
					<div class="wrap-pic-max-w p-b-30 text-center">
						<img src="{{asset('storage/content/'.$data_detail_menu->thumbnail)}}" 
						@if(!empty($data_detail_menu->detail)) height="200" @endif alt="IMG">
					</div>
					@endif

				<!-- </div> -->
				@endif

				@if(!empty($data_detail_menu->title))
				<p class="f1-s-11 cl6 p-b-25 text-center">
					@if(!empty($data_detail_menu->link))
						<a href="{{$data_detail_menu->link}}"><b>{{$data_detail_menu->title}}</b></a>
					@else
						<b>{{$data_detail_menu->title}} 
							@if(!empty($data_detail_menu->filetype))
								({{$data_detail_menu->filetype}})
								<a class="btn btn-primary" href="{{asset('storage/file/'.$data_detail_menu->file)}}" role="button" download="{{$data_detail_menu->file}}" ><i class="fa fa-download"></i>Download</a>
							@endif
						</b>

					@endif
				</p>
				@endif

				@if(!empty($data_detail_menu->detail))
				<p class="f1-s-11 cl6 p-b-25">
					 <?php echo $data_detail_menu->detail; ?> 
				</p>
				@endif

				@if(!empty($data_detail_menu->file)) 
					@if($data_detail_menu->filetype == 'pdf')
						<embed  src="{{asset('storage/file/'.$data_detail_menu->file)}}" type="application/pdf" width="100%" height="600px" />
					@endif
				@endif



				
		@endif


		@if(!empty($data_quality))
		<div class="flex-wr-sb-s  how-bor2">
			@foreach($data_quality as $row1)
			<div class="size-w-5 w-full-sr575 m-b-15">
				<h4 class="p-b-5" style="font-size: 20px; color: cornflowerblue;">{{$row1->name}}</h4>
				@foreach($row1->category as $row2)
					<h5 class="p-b-5" style="font-size: 18px; color: sandybrown;">{{$row2->name}}</h5>
					@foreach($row2->document as $row3)
					<div class="m-l-15 col-md-12">
						<p class="p-b-4" >{{$row3->name}}</p>
						@if($row3->detail)
							<p class="f1-s-1 cl6 p-b-3">{{$row3->detail}}</p>
						@endif
							<a class="show_pc cl2 hov-cl10 trans-03 " href="{{asset('storage/document/'.$row3->file)}}" target="_blank" >
                                ไฟล์ : <i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i>
							</a>
						
							<button type="button" class="show_moblie btn btn-default " data-toggle="modal" data-target=".bd-example-modal-lg-{{$row3->id}}"> <i class="far fa-lg fa-fw m-r-5 fa-file-alt"></i>เอกสาร</button>
							<div class="modal fade bd-example-modal-lg-{{$row3->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel{{$row3->id}}" aria-hidden="true">
							  <div class="modal-dialog ">
							    <div class="modal-content">
							    	<div class="modal-header">
								        <h4 class="modal-title" id="myLargeModalLabel{{$row3->id}}">{{$row3->name}}</h4>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">×</span>
								        </button>
								    </div>
							    	<div class="modal-body">
							    		<div class="wrap-pic-max-w p-b-10 col-md-6 col-sm-3">
								        @foreach($row3->img as $row4)
								      		<img src="{{asset('storage/sub_document/'.$row3->id.'/'.$row4->file)}}" alt="">
										@endforeach
										</div>
								     </div>
							    </div>
							  </div>
							</div>
					</div>
						<hr>
					@endforeach

				@endforeach

			</div>
			@endforeach
		</div>
		@endif



		<!-- Share -->
		<br>
		<br>
		<!-- <div class="flex-s-s">
			<span class="f1-s-12 cl5 p-t-1 m-r-15">
				Share:
			</span>
			
			<div class="flex-wr-s-s size-w-0">
				<a href="#" class="dis-block f1-s-13 cl0 bg-facebook borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
					<i class="fab fa-facebook-f m-r-7"></i>
					Facebook
				</a>

			</div>
		</div> -->
</div>



				



@endsection


@section('show_product')
	<!-- Latest -->
	<section class="bg0 p-t-60 p-b-35">
		<div class="container">
			<div class="row justify-content-center">
				
			</div>
		</div>
	</section>
@endsection
