<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Mitr|Sarabun&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Mitr&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
<style>
	 .stretch-card>.card {
     width: 100%;
     min-width: 100%
 }

 body {
     background-color: #f9f9fa
 }

 .flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }

 @media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
 }

 .padding {
     padding: 3rem
 }

 .owl-carousel .item {
     margin: 3px
 }

 .owl-carousel .item img {
     display: block;
     width: 100%;
     height: auto
 }

 .owl-carousel .item {
     margin: 3px
 }

 .owl-carousel {
     margin-bottom: 15px
 }
</style>
</head>
<body class="animsition" >
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop" style="background: linear-gradient(90deg, rgb(0, 173, 165) 0%, rgba(11, 173, 0, 0) 60%, rgba(37, 244, 102, 0.29) 100%);  ">
			<div class="topbar" style="background-color: rgb(208, 250, 229);">
				<div class="content-topbar container h-100">
					<div class="left-topbar">
						<span class="left-topbar-item flex-wr-s-c">
							<span class="text-uppercase cl2 p-r-8">
								ข่าวประชาสัมพันธ์ : 
							</span>
							<span class="dis-inline-block cl2 slide100-txt pos-relative size-w-0 " data-in="fadeInDown" data-out="fadeOutDown">

								@if(!empty($news_cut))
									@foreach($news_cut as $row)
										<span class="dis-inline-block slide100-txt-item animated visible-false">
											{{$row->title}}
										</span>
									@endforeach

								@endif


							</span>
						</span>

						
					</div>

					<div class="right-topbar ">
						<!-- <a href="#">
							<span class="fab fa-facebook-f cl2"></span>
						</a> -->
						<a  class="btn btn-blue" href="{{route('login')}}" role="button">Login</a>
						<!-- <a href="#" class="left-topbar-item" style="font-size: 16px;"> 
							<span class="cl2">Log in</span>

						</a> -->
					</div>
				</div>
			</div>

			<!-- Header Mobile -->
			<div class="wrap-header-mobile">
				<!-- Logo moblie -->
				@if(!empty($template[0]))
					@foreach($template as $data) 		
					<div class="logo-mobile">
						<a href="index.html"><img src="{{asset('storage/template/'.$data->logo_menu)}}" alt="IMG-LOGO"></a>
					</div>
					@endforeach
				@endif
				
				<!-- Button show menu -->
				<div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>

			<!-- Menu Mobile -->
			<div class="menu-mobile">
				
				<ul class="main-menu-m">
					<li>
						<a href="index.html">หน้าหลัก</a>
						<ul class="sub-menu-m">
							<li><a href="index.html">Homepage v1</a></li>
							<li><a href="home-02.html">Homepage v2</a></li>
							<li><a href="home-03.html">Homepage v3</a></li>
						</ul>

						<span class="arrow-main-menu-m">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</span>
					</li>
					@if(!empty($main_menu_all))
					@foreach($main_menu_all as $main)
					@if($main->status_setting == 1)
					@if(!empty($main->submenu[0]))
					<li >
						<a href="#">{{ $main->name }}</a>
						<ul class="sub-menu-m">
						@foreach($main->submenu as $sub)
							@if($sub->status_setting == 1)
								<li>
									<a href="{{ route('index.content_show',[$sub->id, 'sub']) }}">{{ $sub->name }}
									</a>
								</li>
							@endif
						@endforeach
						</ul>
					</li>
					@else
						<li>
							<a href="{{ route('index.content_show',[$main->id, 'main']) }}">{{ $main->name }}</a>
						</li>
					@endif

					@endif
					@endforeach
					@endif

					<li >
						<a>คณะบริหาร</a>
						<ul class="sub-menu-m">
						@foreach($group as $row)
							@if($row->status_setting == 1)
								<li>
									<a href="{{ route('index.board',[$row->id]) }}">{{ $row->name }}
									</a>
								</li>
							@endif
						@endforeach
						</ul>
					</li>
					<li>
						<a  class="btn btn-blue" href="{{route('login')}}" role="button">Login</a>
					</li>

					
				</ul>
			</div>
			
			<!--  -->
			<div class="wrap-logo container" >
				<!-- Logo desktop -->
				@if(!empty($template[0]))
					@foreach($template as $data) 			
					<div class="logo">
						<a href="index.html"><img src="{{asset('storage/template/'.$data->logo_main)}}" alt="LOGO"></a>
					</div>	
					@endforeach
				@endif
				<!-- Banner -->
				<div class="banner-header">
					<a href="#"><img src="images/89056889_619995335233588_5878042763282350080_n.png" alt="IMG" width="200"></a>
				</div>
			</div>	
			
			@if(!empty($template[0]))
				@foreach($template as $data)
				@if(!empty($data->status_show_menu_top)) 	
				<div class="wrap-main-nav">
					<div class="main-nav" style="background-color: #ffffff;">
						<!-- Menu desktop -->
						<nav class="menu-desktop">
							<a class="logo-stick" href="index.html">
								<img src="images/logo.png" alt="LOGO">
							</a>

							<ul class="main-menu">
								<li class="main-menu-active">
									<a href="/">หน้าหลัก</a>
								</li>
								@if(!empty($main_menu_all))
									@foreach($main_menu_all as $main)
										@if($main->status_setting == 1)
											@if(!empty($main->submenu[0]))
											<li >
												<a>{{ $main->name }}</a>
												<ul class="sub-menu">
												@foreach($main->submenu as $sub)
													@if($sub->status_setting == 1)
														<li>
															<a href="{{ route('index.content_show',[$sub->id, 'sub']) }}">{{ $sub->name }}
															</a>
														</li>
													@endif
												@endforeach
												</ul>
											</li>

											@else
												<li >
													<a href="{{ route('index.content_show',[$main->id, 'main']) }}">{{ $main->name }}</a>
												</li>
											@endif

										@endif
									@endforeach
								@endif

								<li >
									<a>คณะบริหาร</a>
									<ul class="sub-menu">
									@foreach($group as $row)
										@if($row->status_setting == 1)
											<li>
												<a href="{{ route('index.board',[$row->id]) }}">{{ $row->name }}
												</a>
											</li>
										@endif
									@endforeach
									</ul>
								</li>

							</ul>
						</nav>
					</div>
				</div>
				@endif	
				@endforeach
			@endif	
		</div>
	</header>



	<!-- BEGIN #slider -->
	@yield('slider')
<section class="bg0 p-t-20"style="background-image: url('images/gplaypattern@2x.png');">
	<div class="container">

		@if(!empty($template[0]))
			@foreach($template as $data)
				@if(!empty($data->status_show_menu_left) || $data->status_show_menu_left == 1)
				<div class="col-md-10 col-lg-3">
					<div class="p-l-10 p-rl-0-sr991 ">						
					
						<div class="p-b-601">
							<div class="how2 how2-cl4 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
									Category
								</h3>
							</div>

							<ul class="p-t-35">
								@if(!empty($main_menu_all))
								@foreach($main_menu_all as $main)
									@if($main->status_setting == 1)
										@if(!empty($main->submenu[0]))
										<li class="how-bor3 p-rl-4">
											<a class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">{{ $main->name }}</a>
													
										</li>
											<!-- <ul class="sub-menu"> -->
											@foreach($main->submenu as $sub)
												@if($sub->status_setting == 1)
												<li class="how-bor3 p-rl-4">
													<a href="{{ route('index.content_show',[$sub->id, 'sub']) }}" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13"> <i class="fs-12 m-l-5 fa fa-caret-right"></i> {{ $sub->name }}</a>
												</li>
												@endif
											@endforeach
											<!-- </ul> -->
										<!-- </li> -->

										@else
											<li class="how-bor3 p-rl-4">
												<a href="{{ route('index.content_show',[$main->id, 'main']) }}" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">{{ $main->name }}</a>
											</li>
										@endif

									@endif
								@endforeach
								@endif
								
								@foreach($group as $row)
									@if($row->status_setting == 1)
									<li class="how-bor3 p-rl-4">
										<a href="{{ route('index.board',[$row->id]) }}" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">->{{ $row->name }}</a>
									</li>
									@endif
								@endforeach
								
								<li class="how-bor3 p-rl-4">
									<a href="{{ route('index.board',['id1'=>1,'id2'=>2]) }}" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										คณะบริหาร
									</a>
								</li>
								<li class="how-bor3 p-rl-4">
									<a href="{{ route('index.board',['id1'=>1]) }}" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										บุคลากร
									</a>
								</li>
								<li class="how-bor3 p-rl-4">
									<a href="{{ route('index.content_show',['','company']) }}" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										แนะนำบริษัทใหม่
									</a>
								</li>
								</li class="how-bor3 p-rl-4">
									<a href="#" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										การดำเนินกิจกรรม
									</a>
								</li>
							
								<li class="how-bor3 p-rl-4">
									<a href="#" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										ข่าว/ประกาศ
									</a>
								</li>

								<li class="how-bor3 p-rl-4">
									<a href="#" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										ปฎิทินกิจกรรม
									</a>
								</li>

								
							</ul>
						</div>
						
					</div>
				</di  v>
				<div class="col-md-10 col-lg-9">
				@endif	  
			@endforeach
			@else
				<div class="col-md-12 ">
			@endif
			@yield('post1')	
			@yield('post_activity')	
			@yield('post_activity2')
			@yield('activity_detail')
		</div>
	</div>		
</section>	

<section class="bg0 p-t-20"style="background-image: url('images/gplaypattern@2x.png');">
<!-- <img src="" style="position: absolute; height: 900px; width: auto;"> -->

	<div class="container" >		
		<div class="col-md-12 " >
			@yield('product')	

		</div>
	</div>	
		
</section>


	

	

	
	



	

	

	

	<!-- Footer -->
	<footer >
		<div class="bg2 p-t-40 " style="background: linear-gradient(90deg, rgb(37, 244, 102, 0.29) 0%, rgba(11, 173, 0, 0) 60%, rgba(37, 244, 102, 0.29) 100%);  " >
			<div class="container">
				<div class="row">
					<div class="col-lg-4 p-b-20">
						<div class="size-h-3 flex-s-c">
							<a href="index.html">
								<img class="max-s-full" src="{{asset('storage/template/'.$data->logo_menu)}}" alt="LOGO" style="height: 100px;">
							</a>
						</div>

						<div>
							<p class="f1-s-1 cl2 p-b-16">
							หน่วยบ่มเพาะวิสาหกิจมหาวิทยาลัยราชภัฏนครสวรรค์ <br>
							อาคารต้นน้ำ ชั้น 1 มหาวิทยาลัยราชภัฏนครสวรรค์ <br>
							398 ม.9 ถ.สวรรค์วิถี ต.นครสวรรค์ตก อ.เมือง จ.นครสวรรค์ 60000
							
							</p>

							<p class="f1-s-1 cl2 p-b-16">
								โทรศัพท์ 0-5688-2359, 0-5621-9100 ต่อ 1315<br>
								โทรสาร 0-5688-2360
							</p>

							<div class="p-t-15">
								<a href="#" class="fs-18 cl2 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-facebook-f"></span>
								</a>

								<a href="#" class="fs-18 cl2 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-twitter"></span>
								</a>

								<a href="#" class="fs-18 cl2 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-pinterest-p"></span>
								</a>

								<a href="#" class="fs-18 cl2 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-vimeo-v"></span>
								</a>

								<a href="#" class="fs-18 cl2 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-youtube"></span>
								</a>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-lg-4 p-b-20">
						<div class="size-h-3 flex-s-c">
							<h5 class="f1-m-7 cl2">
								Popular Posts
							</h5>
						</div>

						<ul>
							<li class="flex-wr-sb-s p-b-20">
								<a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
									<img src="images/popular-post-01.jpg" alt="IMG">
								</a>

								<div class="size-w-5">
									<h6 class="p-b-5">
										<a href="#" class="f1-s-5 cl2 hov-cl10 trans-03">
											Donec metus orci, malesuada et lectus vitae
										</a>
									</h6>

									<span class="f1-s-3 cl6">
										Feb 17
									</span>
								</div>
							</li>

							<li class="flex-wr-sb-s p-b-20">
								<a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
									<img src="images/popular-post-02.jpg" alt="IMG">
								</a>

								<div class="size-w-5">
									<h6 class="p-b-5">
										<a href="#" class="f1-s-5 cl2 hov-cl10 trans-03">
											Lorem ipsum dolor sit amet, consectetur
										</a>
									</h6>

									<span class="f1-s-3 cl6">
										Feb 16
									</span>
								</div>
							</li>

							<li class="flex-wr-sb-s p-b-20">
								<a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
									<img src="images/popular-post-03.jpg" alt="IMG">
								</a>

								<div class="size-w-5">
									<h6 class="p-b-5">
										<a href="#" class="f1-s-5 cl2 hov-cl10 trans-03">
											Suspendisse dictum enim quis imperdiet auctor
										</a>
									</h6>

									<span class="f1-s-3 cl6">
										Feb 15
									</span>
								</div>
							</li>
						</ul>
					</div>

					<div class="col-sm-6 col-lg-4 p-b-20">
						<div class="size-h-3 flex-s-c">
							<h5 class="f1-m-7 cl2">
								Category
							</h5>
						</div>

						  <div data-href="https://www.facebook.com/ButsarinJaae/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" class="fb-page fb_iframe_widget" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=113869198637480&amp;container_width=734&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FButsarinJaae%2F&amp;locale=th_TH&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=timeline"><span style="vertical-align: bottom; width: 340px; height:250px;"><iframe name="f1db80276096ff4" width="1000px" height="1000px" title="fb:page Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v6.0/plugins/page.php?adapt_container_width=true&amp;app_id=113869198637480&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D45%23cb%3Df260f68d260b39%26domain%3Ddevelopers.facebook.com%26origin%3Dhttps%253A%252F%252Fdevelopers.facebook.com%252Ff24cca8886dbb8c%26relation%3Dparent.parent&amp;container_width=734&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FButsarinJaae%2F&amp;locale=th_TH&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=timeline" style="border: none; visibility: visible; width: 340px; height: 250px;" class=""></iframe></span></div>
					</div>
				</div>
			</div>
		</div>

		<div class="bg11" style="background-color: rgb(194, 243, 219);">
			<div class="container  flex-c-c p-tb-15">
				<span class="f1-s-1 cl2 txt-center">
					Copyright © 2018 

					<a href="#" class="f1-s-1 cl2 hov-link1">Colorlib.</a>
					

					All rights reserved.

				</span>
			</div>
		</div>

	</footer>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>

	<!-- Modal Video 01-->
	<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document" data-dismiss="modal">
			<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

			<div class="wrap-video-mo-01">
				<div class="video-mo-01">
					<iframe src="https://www.youtube.com/embed/wJnBTPUQS5A?rel=0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<script type="text/javascript">
		$(document).ready(function() {

			$(".owl-carousel").owlCarousel({

			autoPlay: 3000,
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3],
			center: true,
			nav:true,
			loop:true,
			responsive: {
			600: {
			items: 4
			}
			}

			});

		});
	</script>
</body>
</html>

