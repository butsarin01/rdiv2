@extends('master')

@section('title', 'Page Title')

@section('headline')

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
	<section class="bg0" style="background-image: url('images/gplaypattern@2x.png');">
		<div class="container">
			<div class="row m-rl--1">
				<?php $i = 0; ?>
				@if(!empty($event_cut))
				@foreach($event_cut as $event)

				@if(!empty($i == 0))
				<div class="col-md-6 p-rl-1 p-b-2">
					<div class="bg-img1 size-a-3 how1 pos-relative" style="background-image: url({{$event->cover_url}});">
						<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

						<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
							<!-- <a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
								Business
							</a> -->

							<h3 class="how1-child2 m-t-14 m-b-10">
								<a href="blog-detail-01.html" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
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
								<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-24">
									<!-- <a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
										Culture
									</a> -->

									<h3 class="how1-child2 m-t-14">
										<a href="blog-detail-01.html" class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03">
											{{$event->name}}
										</a>
									</h3>
								</div>
							</div>
						</div>
						@else
						<div class="col-sm-6 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-5 how1 pos-relative" style="background-image: url({{$event->cover_url}});">
								<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
									<!-- <a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
										Life Style
									</a> -->

									<h3 class="how1-child2 m-t-14">
										<a href="blog-detail-01.html" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
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

@section('slider')
<section class="bg0" style="background-image: url('images/gplaypattern@2x.png');">
	<img src="images/Untitled-3.png" style="position: absolute; height: 465px; width: auto;">
	<div class="container">
		
		<div class="row justify-content-md-center ">
			<div id="carouselExampleControls" class="carousel slide " data-ride="carousel" >
			  <div class="carousel-inner " align = 'center'>
			  	@if(!empty($event_cut))
			  	<?php $i = 0; ?>
				@foreach($event_cut as $event)
				    <div class="carousel-item  @if(!empty($i == 0))active @endif" >

				      <img class="d-block w-90" src="{{$event->cover_url}}" alt="{{$event->name}}" style="height:450px;  width: auto;">
				      <div class="carousel-caption d-none d-md-block">
					    <h5>{{$event->name}}</h5>
					  </div>
				    </div>
				    <?php $i++; ?>
			    @endforeach
				@endif
			   
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
			
		</div>
	</div>
</section>

@endsection


@section('post_activity')
	<!-- Post -->
	

	<!-- <div class="col-md-10 col-lg-9"> -->
		<div class="p-b-20" style="background-color: #ffffff">
			<!-- Entertainment -->
			<div class="tab01 p-b-20">
				<div class="tab01-head how2 how2-cl2 bocl12 flex-s-c m-r-10 m-r-0-sr991" style="background-color: #d7edcd;">
					<!-- Brand tab -->
					<h3 class="f1-m-2 cl13 tab01-title">
						Entertainment
					</h3>

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#tab1-1" role="tab"><b>ข่าว/ประกาศ</b></a>
						</li>

						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tab1-2" role="tab">กิจกรรม</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tab1-3" role="tab">ปฏิทิน</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tab1-4" role="tab">บทความ</a>
						</li>

						
						<li class="nav-item-more dropdown dis-none">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-ellipsis-h"></i>
							</a>

							<ul class="dropdown-menu">
								
							</ul>
						</li>
					</ul>

					<!--  -->
					<a href="category-01.html" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
						View all
						<i class="fs-12 m-l-5 fa fa-caret-right"></i>
					</a>
				</div>
					

				<!-- Tab panes -->
				<div class="tab-content p-t-35">
					<div class="tab-pane fade show active" id="tab1-1" role="tabpanel">
						<div class="row">
						@if(!empty($news_cut))
						<?php $i = 0; ?>
						@foreach($news_cut as $event)
						<?php $i++; ?>	
						@if($i == 1)
							<div class="col-sm-6 p-r-25 p-r-15-sr991">
								<!-- Item post -->	
								<div class="m-b-30">
									<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
										<img src="{{$event->cover_link}}" alt="IMG" >
									</a>

									<div class="p-t-20">
										<h5 class="p-b-5">
											<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
												{{$event->title}}
											</a>
										</h5>

										<span class="cl8">
											<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
												
											</a>

											<!-- <span class="f1-s-3 m-rl-3">
												-
											</span>

											<span class="f1-s-3">
												Feb 18
											</span> -->
										</span>
									</div>
								</div>
							</div>
							<div class="col-sm-6 p-r-25 p-r-15-sr991">
						@elseif($i < 5)
								<div class="flex-wr-sb-s m-b-30">
									<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
										<img src="{{$event->cover_link}}" alt="IMG" style="height: 100px; width: 200px;">
									</a>

									<div class="size-w-2">
										<h5 class="p-b-5">
											<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
												{{$event->title}}
											</a>
										</h5>

										<span class="cl8">
											<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
											
											</a>

											<!-- <span class="f1-s-3 m-rl-3">
												-
											</span>

											<span class="f1-s-3">
												Feb 17
											</span> -->
										</span>
									</div>
								</div>
						@else	
							</div>
						@endif
						
						@endforeach
						@endif
						</div>
					</div>

					
					
				


				</div>
			</div>
		</div>
@endsection

@section('post_activity1')
<div class="col-md-12 col-lg-12 p-b-20" style="background-color: #ffffff">
	<div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991" style="background: linear-gradient(90deg, rgb(94, 211, 157) 0%, rgba(82, 184, 142, 0) 60%, rgba(192, 227, 203, 0) 100%)">
		<h3 class="f1-m-2 cl3 tab01-title">
			ข่าวกิจกรรม
		</h3>
	</div>
	<div class="row p-t-35">
		@foreach($news_cut as $event)
		<div class="col-sm-4 p-r-25 p-r-15-sr991">
			<div class="m-b-45">
				<a href="" class="wrap-pic-w hov1 trans-03">
					<img src="{{$event->cover_link}}" alt="IMG">
				</a>

				<div class="p-t-16">
					<h5 class="p-b-5">
						<a href="" class="f1-m-3 cl2 hov-cl10 trans-03" >
							{{$event->title}}
						</a>
					</h5>

					<span class="cl8">
						<a href="" class="f1-s-4 cl8 hov-cl10 trans-03">
							{{$event->title}}
						</a>

						
					</span>
				</div>
			</div>
		</div>
		@endforeach

	</div>


	
</div>
@endsection

@section('product')
	<div class="col-md-12 col-lg-12 " style="background-color: #ffffff">
		<div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991" style="background: linear-gradient(90deg, rgb(94, 211, 157) 0%, rgba(82, 184, 142, 0) 60%, rgba(192, 227, 203, 0) 100%)">
			<h3 class="f1-m-2 cl3 tab01-title">
				แนะนำบริษัทใหม่
			</h3>
		</div>

		<div class="row p-t-35" >


			@if(!empty($company))
			@foreach($company as $row_company)


			@if(!empty($template[0]))
			@foreach($template as $data)
				@if(!empty($data->status_show_menu_left) || $data->status_show_menu_left == 1)
				<div class="col-sm-6 p-r-25 p-r-15-sr991">
				@else
				<div class="col-sm-4 p-r-25 p-r-15-sr991">
				@endif
			@endforeach
			@endif
			<!-- <div class="col-sm-6 p-r-25 p-r-15-sr991"> -->
				<!-- Item latest -->	
				<div class="m-b-45">
					<a href="{{ route('index.content_show',[$row_company->id, 'company']) }}" class="wrap-pic-w hov1 trans-03">
						<img src="{{asset('storage/company/'.$row_company->thumbnail)}}" alt="IMG" style="height: 250px; width: auto;">
					</a>

					<div class="p-t-16">
						<h5 class="p-b-5">
							<a href="{{ route('index.content_show',[$row_company->id, 'company']) }}" class="f1-m-3 cl2 hov-cl10 trans-03" >
								{{$row_company->name}} 
							</a>
						</h5>

						<span class="cl8">
							<a href="{{ route('index.content_show',[$row_company->id, 'company']) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
								by {{$row_company->owner}} เบอร์โทร : {{$row_company->telephone}}
							</a>

							<span class="f1-s-3 m-rl-3">
								-
							</span>

							<span class="f1-s-3">
								{{$row_company->date_join}}
							</span>
						</span>
					</div>
				</div>
			</div>
			@endforeach
			@endif


			
			

			

		</div>
	</div>



			
@endsection


@section('show_product')
	<!-- Latest -->
	<section class="bg0  ">
		<div class="container">
			<div class="row justify-content-center">
				
			</div>
		</div>
	</section>
@endsection
