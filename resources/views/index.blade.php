@extends('master')

@section('title', 'หน่วยงานตรวจสอบภายใน มหาวิทยาลัยราชภัฏนครสวรรค์')

@section('headline1')

	<!-- Headline -->
	<div class="container">
		<div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
				<span class="text-uppercase cl2 p-r-8">
					ข่าวประชาสัมพันธ์ : 
				</span>

				<span class="dis-inline-block cl6 slide100-txt pos-relative size-w-0 " data-in="fadeInDown" data-out="fadeOutDown">

					@if(!empty($news_cut))

						@foreach($news_cut as $row)
							<span class="dis-inline-block slide100-txt-item animated visible-false">
								{{$row->title}}
							</span>
						@endforeach

					@endif


				</span>
			</div>

			<div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
				<input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
				<button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
					<i class="zmdi zmdi-search"></i>
				</button>
			</div>
		</div>
	</div>
@endsection

@section('slider1')
	<!-- Feature post -->
	<section class="bg0"style="background-image: url('images/gplaypattern@2x.png');">
		<div class="container">
			<div class="row m-rl--1">
				<?php $i = 0; ?>
				@if(!empty($event_cut))
				@foreach($event_cut as $event)

				@if(!empty($i == 0))
				<div class="col-md-6 p-rl-1 p-b-2">
					<div class="bg-img1 size-a-3 how1 pos-relative" style="background-image: url({{$event->cover_url}});">
						<a href="{{ route('index.activity_detail',[$event->id]) }}" class="dis-block how1-child1 trans-03"></a>

						<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
							<!-- <a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
								Business
							</a> -->

							<h3 class="how1-child2 m-t-14 m-b-10">
								<a href="{{ route('index.activity_detail',[$event->id]) }}" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
									{{$event->name}}
								</a>
							</h3>

							<!-- <span class="how1-child2">
								<span class="f1-s-4 cl11">
									Jack Sims
								</span>

								<span class="f1-s-3 cl11 m-rl-3">
									-
								</span>

								<span class="f1-s-3 cl11">
									Feb 16
								</span>
							</span> -->
						</div>
					</div>
				</div>
				<div class="col-md-6 p-rl-1">
					<div class="row m-rl--1">
				@elseif($i != 0)
						@if($i == 1)
						<div class="col-12 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-4 how1 pos-relative" style="background-image: url({{$event->cover_url}});">
								<a href="{{ route('index.activity_detail',[$event->id]) }}" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-24">
									<!-- <a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
										Culture
									</a> -->

									<h3 class="how1-child2 m-t-14">
										<a href="{{ route('index.activity_detail',[$event->id]) }}" class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03">
											{{$event->name}}
										</a>
									</h3>
								</div>
							</div>
						</div>
						@else
						<div class="col-sm-6 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-5 how1 pos-relative" style="background-image: url({{$event->cover_url}});">
								<a href="{{ route('index.activity_detail',[$event->id]) }}" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
									<!-- <a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
										Life Style
									</a> -->

									<h3 class="how1-child2 m-t-14">
										<a href="{{ route('index.activity_detail',[$event->id]) }}" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
											{{$event->name}}
										</a>
									</h3>
								</div>
							</div>
						</div>
						@endif
				@elseif($i == 3)
					</div>
				</div>
				@endif
				<?php $i++; ?>
				@endforeach
				@endif
			</div>
		</div>
	</section>
@endsection

@section('post')
<div class="col-md-12 col-lg-12 p-b-20" style="background-color: #ffffff">
	<div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
		<h3 class="f1-m-2 cl3 tab01-title">
			ข่าวกิจกรรม
		</h3>
	</div>
	<div class="row p-t-35">
		
	

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic carousel</h4>
                    <div class="owl-carousel">
                    	@if(!empty($news_cut))
                    	@foreach($news_cut as $event)
                    	 <div class="item"> <img src="{{$event->cover_link}}" alt="image" /> </div>
                    	 @endforeach
                    	 @endif
              
                    </div>
                </div>
            </div>
        </div>
		        
	</div>
	
</div>
@endsection
@section('post2')
<div class="col-md-12 col-lg-12 p-b-20" style="background-color: #ffffff">
	
	<div class="row">
		
	

        <div id="carouselExampleIndicators2" class="carousel slide " data-ride="carousel">

		            <div class="carousel-inner ">
		            	<center>
		        
	                	<div class="carousel-item active">
	                		<div class="cropped2">
	      						<img src="images/93835256_1448165522012092_2519679080010350592_n.jpg" />
	    					</div>
	                		<!-- <figure>
							    <img src="images/93835256_1448165522012092_2519679080010350592_n.jpg" />
							</figure> -->
	                	</div>
	                	<div class="carousel-item ">
	                		<div class="cropped2">
	      						<img src="images/93846551_864176207341400_3997210278658834432_n.jpg" />
	    					</div>
	                		<!-- <figure>
							    <img src="images/93846551_864176207341400_3997210278658834432_n.jpg" />
							</figure> -->
	                	</div>
	                	<div class="carousel-item ">
	                		
							<!-- <figure>
							    <img src="images/94057275_2676472412632724_8899211905629945856_n.jpg" />
							</figure> -->
	                		<!-- <img src="images/94057275_2676472412632724_8899211905629945856_n.jpg" alt="" style="height: 120px;width: auto;"> -->
	                		<div class="cropped2">
	      						<img src="images/94057275_2676472412632724_8899211905629945856_n.jpg" />
	    					</div>
	                	</div>
	                </center>
		         	</div>
		         <!--End carousel-->
		      	
		      	</div>
		        
	</div>
	
</div>
@endsection

@section('post_activity')
	<!-- Post -->
	

	
	
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<div class="p-b-15">

				<!-- <div class="p-b-15 p-r-10 p-r-0-sr991">
					<div class="how2 how2-cl4 flex-sb-c m-b-35"style="background: linear-gradient(90deg, rgb(94, 211, 157) 0%, rgba(82, 184, 142, 0) 60%, rgba(192, 227, 203, 0) 100%)">
						<h3 class="f1-m-2 cl3 tab01-title">
							ข่าว/ประกาศ 
						</h3>
						<a href="{{ route('index.news_all') }}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
							อ่านทั้งหมด
							<i class="fs-12 m-l-5 fa fa-caret-right"></i>
						</a>
					</div>

					<div class="flex-wr-sb-s">
						@if(!empty($news_cut))
						<?php $i = 0; ?>
						@foreach($news_cut as $event)
						<?php $i++; ?>	

						@if($i == 1)
							<div class="size-w-6 w-full-sr575">
						@elseif($i == 2)
							<div class="size-w-7 w-full-sr575">
						@endif
								<div class="m-b-30">
									<a href="{{ route('index.news_detail',[$event->id]) }}" class="wrap-pic-w hov1 trans-03">
										<img src="{{$event->cover_link}}" alt="IMG">
									</a>

									<div class="p-t-25">
										<h5 class="p-b-5">
											<a href="{{ route('index.news_detail',[$event->id]) }}" class="f1-m-3 cl2 hov-cl10 trans-03">
												{{$event->title}}
											</a>
										</h5>

										<span class="cl8">
											<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
												วันที่
											</a>

											<span class="f1-s-3">
												{{$event->created_at->thai_date_normal()}}
			                              	
											</span>
										</span>
									</div>
								</div>
							@if($i == 1)
								</div>
							@elseif($i == 3)
								</div>
							@endif	
					@endforeach
					@endif
					</div>
				</div> -->

				<div class="p-b-15">
					<div class="how2 how2-cl4 flex-sb-c m-b-35"style="background: linear-gradient(90deg, rgb(94, 211, 157) 0%, rgba(82, 184, 142, 0) 60%, rgba(192, 227, 203, 0) 100%)">
						<h3 class="f1-m-2 cl3 tab01-title">
							เอกสารประชาสัมพันธ์
						</h3>
						<a href="{{route('index.document_all',6)}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
							อ่านทั้งหมด
							<i class="fs-12 m-l-5 fa fa-caret-right"></i>
						</a>
					</div>
					@if(!empty($data_detail_menu4))
						<?php $i = 0; ?>
							@foreach($data_detail_menu4 as $row)
							<?php $i++; ?>	
							@if($i <= 6)
								<div class="how1  flex-wr-sb-s m-b-15">
									<a href="{{route('index.content_show',['document',$row->id])}}" class="size-w-1 wrap-pic-w hov1 trans-03 text-center">
										@if(!empty($row->thumbnail))
											<img src="{{asset('storage/document_img/'.$row->thumbnail)}}" class="img-rounded height-70" />
										@else
											@if(!empty($row->file))
											<img src="{{asset($row->file_type())}}" style="width:auto;  height: 50px;" >
											@endif
										@endif
										<!-- <img src="{{asset('storage/document_img/'.$row->thumbnail)}}" alt="IMGDonec metus orci, malesuada et lectus vitae"> -->
									</a>

									<div class="size-w-2">
										<h5 class="p-t-15">
											<a href="{{route('index.content_show',['document',$row->id])}}" class="f1-s-5 cl3 hov-cl10 trans-03">
												{{$row->name}}
											</a>
										</h5>

										
									</div>
								</div>
							@endif
							@endforeach
					@endif
				</div>
				<div class="p-b-15">
					<div class="how2 how2-cl4 flex-sb-c m-b-35"style="background: linear-gradient(90deg, rgb(94, 211, 157) 0%, rgba(82, 184, 142, 0) 60%, rgba(192, 227, 203, 0) 100%)">
						<h3 class="f1-m-2 cl3 tab01-title">
							แผนการตรวจสอบ
						</h3>
						<a href="{{route('index.document_all',2)}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
							อ่านทั้งหมด
							<i class="fs-12 m-l-5 fa fa-caret-right"></i>
						</a>
					</div>
					@if(!empty($data_detail_menu5))
						<?php $i = 0; ?>
							@foreach($data_detail_menu5 as $row)
							<?php $i++; ?>	
							@if($i <= 3)
								<div class="how1  flex-wr-sb-s m-b-15">
									<a href="{{route('index.content_show',['document',$row->id])}}" class="size-w-1 wrap-pic-w hov1 trans-03 text-center">
										@if(!empty($row->thumbnail))
											<img src="{{asset('storage/document_img/'.$row->thumbnail)}}" class="img-rounded height-70" />
										@else
											@if(!empty($row->file))
											<img src="{{asset($row->file_type())}}" style="width:auto;  height: 50px;" >
											@endif
										@endif
									</a>

									<div class="size-w-2">
										<h5 class="p-t-15">
											<a href="{{route('index.content_show',['document',$row->id])}}" class="f1-s-5 cl3 hov-cl10 trans-03">
												{{$row->name}}
											</a>
										</h5>

										
									</div>
								</div>
							@endif
							@endforeach
					@endif
				</div>

			</div>
		</div>

		<div class="col-md-6 col-lg-6">
			<div class="p-l-10 p-rl-0-sr991 p-b-20">
				<!-- Stay Connected -->
				<div class="p-b-15">
					<div class="how2 how2-cl4 flex-sb-c m-b-35"style="background: linear-gradient(90deg, rgb(94, 211, 157) 0%, rgba(82, 184, 142, 0) 60%, rgba(192, 227, 203, 0) 100%)">
						<h3 class="f1-m-2 cl3 tab01-title ">
							ระเบียบที่เกี่ยวข้อง
						</h3>
						<a href="{{route('index.document_all',4)}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
							อ่านทั้งหมด
							<i class="fs-12 m-l-5 fa fa-caret-right"></i>
						</a>
					</div>
					@if(!empty($data_detail_menu2))
						<?php $i = 0; ?>
							@foreach($data_detail_menu2 as $row)
							<?php $i++; ?>	
							@if($i <= 3)
								<div class="how1  flex-wr-sb-s m-b-15">
									<a href="{{route('index.content_show',['document',$row->id])}}" class="size-w-1 wrap-pic-w hov1 trans-03 text-center">
										@if(!empty($row->thumbnail))
											<img src="{{asset('storage/document_img/'.$row->thumbnail)}}" class="img-rounded height-70" />
										@else
											@if(!empty($row->file))
											<img src="{{asset($row->file_type())}}" style="width:auto;  height: 50px;" >
											@endif
										@endif
									</a>

									<div class="size-w-2">
										<h5 class="p-t-15">
											<a href="{{route('index.content_show',['document',$row->id])}}" class="f1-s-5 cl3 hov-cl10 trans-03">
												{{$row->name}}
											</a>
										</h5>

										
									</div>
								</div>
							@endif
							@endforeach
					@endif
				</div>
				<div class="p-b-20">
					<div class="how2 how2-cl4 flex-sb-c m-b-35"style="background: linear-gradient(90deg, rgb(94, 211, 157) 0%, rgba(82, 184, 142, 0) 60%, rgba(192, 227, 203, 0) 100%)">
						<h3 class="f1-m-2 cl3 tab01-title">
							เอกสาร/แบบฟอร์ม
						</h3>
						<a href="{{route('index.document_all',5)}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
							อ่านทั้งหมด
							<i class="fs-12 m-l-5 fa fa-caret-right"></i>
						</a>
					</div>
					@if(!empty($data_detail_menu1))
						<?php $i = 0; ?>
							@foreach($data_detail_menu1 as $row)
							<?php $i++; ?>	
							@if($i <= 3)
							<div class="how1  flex-wr-sb-s m-b-30">
								<a href="{{route('index.content_show',['document',$row->id])}}" class="size-w-1 wrap-pic-w hov1 trans-03 text-center">
									@if(!empty($row->thumbnail))
										<img src="{{asset('storage/document_img/'.$row->thumbnail)}}" class="img-rounded height-70" />
									@else
										@if(!empty($row->file))
										<img src="{{asset($row->file_type())}}" style="width:auto;  height: 50px;" >
										@endif
									@endif
								</a>

								<div class="size-w-2">
									<h5 class="p-t-15">
										<a href="{{route('index.content_show',['document',$row->id])}}" class="f1-s-5 cl3 hov-cl10 trans-03">
											{{$row->name}}
										</a>
									</h5>

									
								</div>
							</div>
								@endif
							@endforeach
						@endif
				</div>


				<div class="p-b-5">
					<div class="how2 how2-cl4 flex-sb-c m-b-35"style="background: linear-gradient(90deg, rgb(94, 211, 157) 0%, rgba(82, 184, 142, 0) 60%, rgba(192, 227, 203, 0) 100%)">
						<h3 class="f1-m-2 cl3 tab01-title">
							หน่วยงานที่เกี่ยวข้อง
						</h3>
						<a href="{{route('index.content_show',['main',4])}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
							อ่านทั้งหมด
							<i class="fs-12 m-l-5 fa fa-caret-right"></i>
						</a>
					</div>
					
					<div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">

			            <div class="carousel-inner ">
			            	<center>
			            	<?php $i = 0; ?>
			             @if(!empty($data_detail_menu3))
			                @foreach($data_detail_menu3 as $row)
							
							<div class="carousel-item @if($i==0) active @endif ">
							    <a href="{{route('index.content_detail',[$row->id])}}" class="size-w-1  hov1 
								trans-03 text-center">
									<img src="{{asset('storage/content/'.$row->thumbnail)}}" alt="" style="height: 120px;width: auto;">
								</a>

								<div class="size-w-2">
									<h5 class="p-b-5">
										<a href="{{route('index.content_detail',[$row->id])}}" class="f1-s-5 cl3 hov-cl10 trans-03">
											{{$row->title}}
										</a>
									</h5>
								</div>
							
				            </div> 
				            <?php $i++; ?>
			            	@endforeach
		                @endif
		                </center>
			         	</div>
			         <!--End carousel-->
			      	
			      	</div>
				</div>

			
					
			</div>
		</div>

	</div> 
		<!-- <div class="col-md-12 col-lg-12 p-b-35" >
			<div class="how2 how2-cl4 flex-sb-c m-b-35" style="background: linear-gradient(90deg, rgb(94, 211, 157) 0%, rgba(82, 184, 142, 0) 60%, rgba(192, 227, 203, 0) 100%)">
				<h3 class="f1-m-2 cl3 tab01-title" >
					เอกสารล่าสุด
				</h3>
				<a href="{{ route('index.document_all')}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03 text-right" >
					อ่านทั้งหมด
					<i class="fs-12 m-l-5 fa fa-caret-right"></i>
				</a>
			</div>

			<div class="row ">
				@if(!empty($document))
					@foreach($document as $row)
					<div class="col-sm-6 col-md-3">
						<div class="">
							<a href="{{route('index.content_show',['document',$row->id])}}" class="wrap-pic-w hov1 trans-03">
								<img src="{{asset('storage/document_img/'.$row->thumbnail)}}" alt="IMG" >
							</a>

							<div class="p-t-16">
								<h5 class="p-b-5">
									<a href="{{route('index.content_show',['document',$row->id])}}" class="f1-m-1 cl2 hov-cl10 trans-03">
										{{$row->name}}
									</a>
								</h5>
							</div>
						</div>
					</div>
					@endforeach
				@endif
			</div>
		</div> -->

		
<!-- </div> -->



			
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
