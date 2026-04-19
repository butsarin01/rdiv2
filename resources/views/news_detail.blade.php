@extends('master1')

@section('title', 'Page Title')




@section('activity_detail')
	<!-- Post -->
				@if(!empty($news))
					<div class="p-b-70">
							<!-- <a href="#" class="f1-s-10 cl2 hov-cl10 trans-03 text-uppercase">
								Technology
							</a> -->

							<h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
								{{$news->title}}
							</h3>
							
							<div class="flex-wr-s-s p-b-40">
								<span class="f1-s-3 cl8 m-r-15">
									<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
										by John Alvarado
									</a>

									<span class="m-rl-3">-</span>

									<span>
										{{$news->created_at->thai_date_normal()}}
									</span>
								</span>

							</div>
							@if(!empty($news->cover_link))
								<div class="wrap-pic-max-w p-b-30 text-center">
									<img src="{{$news->cover_link}}" alt="IMG" height="1000">
								</div>
							@endif

							@if(!empty($news->detail))
								<p class="f1-s-11 cl6 p-b-25">
									{{$news->detail}}
								</p>
							@endif
						@endif
							
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
