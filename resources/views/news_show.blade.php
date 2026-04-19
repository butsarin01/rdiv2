@extends('master1')

@section('title', 'Page Title')




@section('post_activity')
					<!-- <div class="col-md-10 col-lg-8 p-b-20"> -->
					<div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
						<h3 class="f1-m-2 cl3 tab01-title">
							ข่าวประชาสัมพันธ์
						</h3>
					</div>

					<div class="row p-t-35">
					@if(!empty($news))
						@foreach($news as $row)

						<div class="col-sm-3 p-r-25 p-r-15-sr991">
							<!-- Item latest -->	
							<div class="m-b-45">
								<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
									<img src="{{$row->cover_link}}" alt="IMG">
								</a>

								<div class="p-t-16">
									<h5 class="p-b-5">
										<a href="{{ route('index.news_detail',[$row->id]) }}" class="f1-m-4 cl2 hov-cl10 trans-03">
											{{$row->title}}
										</a>
									</h5>

								<!-- 	<span class="cl8">
										<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
											by ---
										</a>

										<span class="f1-s-3 m-rl-3">
											-
										</span>

										<span class="f1-s-3">
											20/20/2020
										</span>
									</span> -->
								</div>
							</div>
						</div>

						@endforeach
					@endif
						

						

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
