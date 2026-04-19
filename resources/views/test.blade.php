@extends('master1')

@section('title', 'สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์')

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

@section('slider2')
<section class="bg0 p-t-12 p-b-12">
	<div class="container">
		<div class="row justify-content-center"> 
			<div class="col-md-12 p-rl-1 p-b-2">
				<div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
		            <div class="carousel-inner carousel_height" >
		            	<center>
		            	<?php $i = 1; ?>
		            	@if(!empty($banner_top))
                    	@foreach($banner_top as $key => $row)
                    	 	<div class="carousel-item @if($key==0) active @endif">
                    	 		@if(!empty($row->link))
                    	 		<a href="{{$row->link}}" target="_blank">
                    	 			<img class="d-block w-100" src="{{asset('storage/index/'.$row->file)}}" alt="{{$row->name}}" style="/*object-fit: fill;*/" />
                    	 		</a>
                    	 		@else
                    	 			<img class="d-block w-100" src="{{asset('storage/index/'.$row->file)}}" alt="{{$row->name}}" style="/*object-fit: fill;*/" />
                    	 		@endif
                    	 		
                    	 	</div>
		            	<?php $i++; ?>

                    	@endforeach
                    	@endif
	                	</center>
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
  						<img src="../assets/img/2178.png" />
					</div>
            	</div>
            	<div class="carousel-item ">
            		<div class="cropped2">
  						<img src="../assets/img/2179.png" />
					</div>
            	</div>
            	<div class="carousel-item ">
            		<div class="cropped2">
  						<img src="../assets/img/2180.png" />
					</div>
            	</div>
            	</center>
         	</div>
		         <!--End carousel-->
		</div>
	</div>
</div>
@endsection

@section('post_activity1')
	<div class="row justify-content-center">
		<div class="col-md-10 col-lg-9">
			<div class="p-r-10 p-rl-0-sr991 p-b-20">
				<div class="p-b-25">
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="#default-tab-1" data-toggle="tab" class="nav-link active">
								<span class="d-sm-none">Tab 1</span>
								<span class="d-sm-block d-none"><i class="far fa-lg fa-fw m-r-10 fa-edit"></i>ประกาศทุน</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-2" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">Tab 2</span>
								<span class="d-sm-block d-none"><i class="far fa-lg fa-fw m-r-10 fa-edit"></i>ผลทุน</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-3" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">Tab 3</span>
								<span class="d-sm-block d-none"><i class="far fa-lg fa-fw m-r-10 fa-edit"></i>ข่าว</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-4" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">Tab 4</span>
								<span class="d-sm-block d-none"><i class="far fa-lg fa-fw m-r-10 fa-edit"></i>กิจกรรม</span>
							</a>
						</li>
					</ul>
					<div class="tab-content" >
				  		<div class="tab-pane fade show active p-10" id="default-tab-1" ><br>
				  			<div class="about mb-2">
				  				<div class="row">

				  				<!-- <div class="col-md-2">
				  					<h5 class="mb-1"><i class="fas fa-sm fa-fw m-r-3 fa-bookmark"></i><b>ประกาศทุน</b></h5>
				  				</div> -->
								<div class="col-md-12">
									@foreach($data_detail_menu1 as $data1)
										<span class="p-b-5 p-l-15">
											<a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$data1->file)}}" download="{{$data1->file}}" ><i class="fa fa-download"></i> {{$data1->name}}</a>
										</span>
									@endforeach
								</div>
								</div>
							</div>
							
							
					  	
				  		</div>
				  		<div class="tab-pane fade p-10" id="default-tab-2" >
				  			<div class="about mb-3">
								<!-- <h5 class="mb-1"><i class="fas fa-sm fa-fw m-r-3 fa-bookmark"></i><b> ผลทุน </b></h5> -->
								<div class="col-md-12">
									@foreach($data_detail_menu2 as $data1)
										<span class="p-b-5 p-l-15">
											<a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$data1->file)}}" download="{{$data1->file}}" ><i class="fa fa-download"></i> {{$data1->name}}</a>
										</span>
									@endforeach
								</div>
							</div>
				  		</div>
				  		<div class="tab-pane fade p-10" id="default-tab-3" >
				  			<div class="about mb-4">
								<!-- <h5 class="mb-1"><i class="fas fa-sm fa-fw m-r-3 fa-bookmark"></i><b>ข่าว</b></h5> -->
								<div class="col-md-12">
									@foreach($data_detail_menu3 as $data1)
										<span class="p-b-5 p-l-15">
											<a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$data1->file)}}" download="{{$data1->file}}" ><i class="fa fa-download"></i> {{$data1->name}}</a>
										</span>
									@endforeach
								</div>
							</div>	
				  		</div>
				  		<div class="tab-pane fade p-10" id="default-tab-4" >
				  			<div class="about mb-4">
								<!-- <h5 class="mb-1"><i class="fas fa-sm fa-fw m-r-4 fa-bookmark"></i><b>กิจกรรม</b></h5> -->
								@if(!empty($event_cut))
								@foreach($event_cut as $event)
								<div class="col-sm-4 p-r-25 p-r-15-sr991">
									<div class="m-b-45">
										<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
											<img src="{{$event->cover_url}}" alt="IMG">
										</a>

										<div class="p-t-16">
											<h5 class="p-b-5">
												<a href="{{ route('index.activity_detail',[$event->id]) }}" class="f1-m-4 cl2 hov-cl10 trans-03">
													{{$event->name}}
												</a>
											</h5>
										</div>
									</div>
								</div>
								@endforeach
								@endif
							</div>	
				  		</div>
				  		
				  		
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-10 col-lg-3">
			<div class="p-l-10 p-rl-0-sr991 p-b-20">
				<div class="p-b-5">
					<div class="how2 how2-cl4 flex-s-c">
						<h3 class="f1-m-2 cl3 tab01-title">
							ผู้อำนวยการสถาบันวิจัยและพัฒนา55
						</h3>
					</div>
				</div>

				<div class="flex-c-s p-t-8 p-b-35">
					<a href="#">
						<img class="max-w-full" src="../assets/img/001-206x300.jpg" alt="IMG">
						<br>
						<p class="text-center p-t-8"><b> ผศ.ดร.สมบูรณ์ นิยม </b></p>
					</a>
				</div>
				<div class="bg10 p-rl-35 p-t-28 p-b-35 m-b-5">
					<h5 class="f1-m-5 cl0 p-b-10">
						banner ข่าว1
					</h5>
					<p class="f1-s-1 cl0 p-b-25">
						Get all latest content delivered to your email a few times a month.
					</p>
				</div>
				<div class="bg10 p-rl-35 p-t-28 p-b-35 m-b-5">
					<h5 class="f1-m-5 cl0 p-b-10">
						banner ข่าว2
					</h5>
					<p class="f1-s-1 cl0 p-b-25">
						Get all latest content delivered to your email a few times a month.
					</p>
				</div>
				<div class="bg10 p-rl-35 p-t-28 p-b-35 m-b-5">
					<h5 class="f1-m-5 cl0 p-b-10">
						banner ข่าว3
					</h5>
					<p class="f1-s-1 cl0 p-b-25">
						Get all latest content delivered to your email a few times a month.
					</p>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('post_activity2')
<div class="p-r-10 p-rl-0-sr991 p-b-20">
	<div class="p-b-25">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a href="#default-tab-1" data-toggle="tab" class="nav-link active">
					<span class="d-sm-none">ประกาศรับทุนวิจัย</span>
					<span class="d-sm-block d-none"><i class="far fa-lg fa-fw m-r-10 fa-edit"></i>ประกาศรับทุนวิจัย</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="#default-tab-2" data-toggle="tab" class="nav-link">
					<span class="d-sm-none">ประกาศผลทุน</span>
					<span class="d-sm-block d-none"><i class="far fa-lg fa-fw m-r-10 fa-edit"></i>ประกาศผลทุน</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="#default-tab-3" data-toggle="tab" class="nav-link">
					<span class="d-sm-none">ข่าว</span>
					<span class="d-sm-block d-none"><i class="far fa-lg fa-fw m-r-10 fa-edit"></i>ข่าว</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="#default-tab-4" data-toggle="tab" class="nav-link">
					<span class="d-sm-none">กิจกรรม</span>
					<span class="d-sm-block d-none"><i class="far fa-lg fa-fw m-r-10 fa-edit"></i>กิจกรรม</span>
				</a>
			</li>
		</ul>
		<div class="tab-content" >
	  		<div class="tab-pane fade show active p-10" id="default-tab-1" ><br>
	  			<div class="about mb-2 m-t-10">
	  				<div class="row">
		  				<div class="col-md-12">
							@foreach($data_detail_menu1 as $data1)
								<span class="p-b-5 p-l-15">
									<!-- <a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$data1->file)}}" download="{{$data1->file}}" ><i class="fa fa-download"></i> {{$data1->name}}</a> -->
									@if(!empty($data1->file))
										<a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$data1->file)}}" download="{{$data1->name}}" >
										<!-- <i class="fa m-r-5 m-t-10 fa-download"></i> -->
	                                    <i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i>
										{{$data1->name}}</a>
									@else
										<i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i>
										{{$data1->name}}
									@endif
								</span><br>
							@endforeach
						</div>
					</div>
				</div>
				
				
		  	
	  		</div>
	  		<div class="tab-pane fade p-10" id="default-tab-2" >
	  			<div class="about mb-3 m-t-10">
					<!-- <h5 class="mb-1"><i class="fas fa-sm fa-fw m-r-3 fa-bookmark"></i><b> ผลทุน </b></h5> -->
					<div class="col-md-12">
						@foreach($data_detail_menu2 as $data1)
							<span class="p-b-5 p-l-15">
								<a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$data1->file)}}" download="{{$data1->file}}" ><i class="fa fa-download"></i> {{$data1->name}}</a>
							</span><br>
						@endforeach
					</div>
				</div>
	  		</div>
	  		<div class="tab-pane fade p-10" id="default-tab-3" >
	  			<div class="about mb-4 m-t-10">
					<!-- <h5 class="mb-1"><i class="fas fa-sm fa-fw m-r-3 fa-bookmark"></i><b>ข่าว</b></h5> -->
					<div class="col-md-12">
						@foreach($data_detail_menu3 as $data1)
							<span class="p-b-5 p-l-15">
								<!-- <a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$data1->file)}}" download="{{$data1->file}}" ><i class="fa fa-download"></i> {{$data1->name}}</a> -->
								@if(!empty($data1->file))
								<a class="cl2 hov-cl10 trans-03" href="{{asset('storage/document/'.$data1->file)}}" download="{{$data1->name}}" >
									<!-- <i class="fa m-r-5 m-t-10 fa-download"></i> -->
                                    <i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i>
									{{$data1->name}}</a>
								@elseif(!empty($data1->link))
									<a class="cl2 hov-cl10 trans-03" href="{{$data1->link}}" target="_blank" >
	                                    <i class="fas fa-lg fa-fw m-r-5 m-t-10 fa-link"></i>									{{$data1->name}}
									</a>
                                @else
                                	<i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-alt"></i>
									{{$data1->name}}
								@endif
							</span><br>
						@endforeach
					</div>
				</div>	
	  		</div>
	  		<div class="tab-pane fade p-10" id="default-tab-4" >
	  			<div class="about mb-4 m-t-10">
					<!-- <h5 class="mb-1"><i class="fas fa-sm fa-fw m-r-4 fa-bookmark"></i><b>กิจกรรม</b></h5> -->
					<div class="row">
                        @if(!empty($data_detail_menu4))
                            @foreach($data_detail_menu4 as $data)
                                <div class="col-sm-4 p-r-25 p-r-15-sr991">
                                    <div class="m-b-45">
                                        <a href="{{$data->link}}" target="_blank" class="wrap-pic-w hov1 trans-03">
                                            <img src="{{asset('storage/content/'.$data->thumbnail)}}"
                                                 alt="@if(!empty($data->title)){{$data->title}}@endif" >
                                        </a>

                                        <div class="p-t-16">
                                            <h5 class="p-b-5">
                                                <a href="{{$data->link}}" class="f1-m-4 cl2 hov-cl10 trans-03">
                                                    <b>{{$data->title}}</b>
                                                </a>
                                            </h5>
                                            @if($data->start_date != 0000-00-00)
                                                <span class="cl8">
                                                    <span class="f1-s-3 m-rl-3">
                                                        <i class="fas fa-lg fa-fw m-r-3 fa-calendar-alt"></i>
                                                    </span>
                                                    <span class="f1-s-3">
                                                        วันที่ {{$data->set_format_date_show()}}
                                                    </span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
					</div>
				</div>	
	  		</div>
	  		
	  		
		</div>
	</div>
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
