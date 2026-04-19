@extends('master1')

@section('title', 'สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์')




@section('activity_detail')
	<!-- Post -->
				@if(!empty($event_cut))
					<div class="p-b-70">
							<!-- <a href="#" class="f1-s-10 cl2 hov-cl10 trans-03 text-uppercase">
								Technology
							</a> -->

							<h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
								{{$event_cut->name}}
							</h3>
							
							<div class="flex-wr-s-s p-b-20">
								<span class="f1-s-3 cl8 m-r-15">
									<!-- <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
										by John Alvarado
									</a> -->

									<span class="m-rl-3"><i class="fas fa-lg fa-fw m-r-3 fa-calendar-alt"></i></span>
									<span>
										{{$event_cut->created_at->thai_date_normal()}}
									
									</span>
								</span>

								
							</div>

							<div class="wrap-pic-max-w p-b-20 text-center">
								<img src="{{$event_cut->cover_url}}" alt="สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์" class="img-responsive" >
							</div>

							<p class="f1-s-11 cl6 p-b-25">
								{{$event_cut->description}}
							</p>

							

							<div class="row ">
							@if(!empty($gallery_cut))
								@foreach($gallery_cut as $image)

								<!-- <div class="col-sm-3 p-r-25 p-r-15-sr991"> -->
									<!-- <div class="m-b-45"> -->
									<a  href="{{$image->filepath}}?image={{$image->id}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-lg-3 col-md-4 col-6 my-3 wrap-pic-w hov1 trans-03">
										<img src="{{$image->filepath}}?image={{$image->id}}" class="img-fluid card "/>
									</a>
		   							<!-- </div> -->
		                      	<!-- </div> -->
		                      	@endforeach
							@endif

						
						</div>
	<!-- Tag -->
							<!-- <div class="flex-s-s p-t-12 p-b-15">
								<span class="f1-s-12 cl5 m-r-8">
									Tags:
								</span>
								
								<div class="flex-wr-s-s size-w-0">
									<a href="#" class="f1-s-12 cl8 hov-link1 m-r-15">
										Streetstyle
									</a>

									<a href="#" class="f1-s-12 cl8 hov-link1 m-r-15">
										Crafts
									</a>
								</div>
							</div> -->

							<!-- Share -->
							<!-- <div class="flex-s-s">
								<span class="f1-s-12 cl5 p-t-1 m-r-15">
									Share:
								</span>
								
								<div class="flex-wr-s-s size-w-0">
									<a href="#" class="dis-block f1-s-13 cl0 bg-facebook borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
										<i class="fab fa-facebook-f m-r-7"></i>
										Facebook
									</a>

									<a href="#" class="dis-block f1-s-13 cl0 bg-twitter borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
										<i class="fab fa-twitter m-r-7"></i>
										Twitter
									</a>

									<a href="#" class="dis-block f1-s-13 cl0 bg-google borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
										<i class="fab fa-google-plus-g m-r-7"></i>
										Google+
									</a>

									<a href="#" class="dis-block f1-s-13 cl0 bg-pinterest borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
										<i class="fab fa-pinterest-p m-r-7"></i>
										Pinterest
									</a>
								</div>
							</div> -->
						</div>
					@endif


				
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
