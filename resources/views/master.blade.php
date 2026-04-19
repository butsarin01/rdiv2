<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<Meta http-equiv="content-language" content="TH">
	<meta name="description" content="หน่วยงานตรวจสอบภายใน มหาวิทยาลัยราชภัฏนครสวรรค์">
	<meta name="keywords" content="หน่วยงานตรวจสอบภายใน,มหาวิทยาลัยราชภัฏนครสวรรค์, หน่วยงานตรวจสอบภายใน มหาวิทยาลัยราชภัฏนครสวรรค์">
	<meta name="author" content="ARITC สำนักวิทยบริการและเทคโนโลยีสารสนเทศ มหาวิทยาลัยราชภัฏนครสวรรค์">
	<!-- <meta name="robots" content="all"> -->
	<!-- <meta name="Copyright" content="ข้อความสัญญาอนุญาต"> -->

	<meta property="og:title" content="หน่วยงานตรวจสอบภายใน มหาวิทยาลัยราชภัฏนครสวรรค์" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://ubi.nsru.ac.th/" />
	<meta property="og:site_name" content="NSRUBI" />
	<meta property="og:description" content="หน่วยงานตรวจสอบภายใน มหาวิทยาลัยราชภัฏนครสวรรค์" />
<!--===============================================================================================-->	
	@if(!empty($template[0]))
		@foreach($template as $data)
		<meta property="og:image" content="{{asset('storage/template/'.$data->logo_main)}}" />	
		<link rel="icon" type="image/png" href="{{asset('storage/template/'.$data->logo_menu)}}"/>
		@endforeach
	@endif
	<!-- <link rel="icon" type="image/png" href="images/icons/favicon.png"/> -->
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

	<!-- <link href="css/simple-lightbox.min.css" rel="stylesheet" /> -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" />
	<!-- <link rel="stylesheet" type="text/css" href="css/dataTable1.10.12.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/r-2.2.3/datatables.min.css"/> -->
 
 	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/kt-2.5.1/datatables.min.css"/>
 

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-C281TMN654"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-C281TMN654');
</script>


<style>
	 .stretch-card>.card {
     width: 100%;
     min-width: 100%
 }

 body {
     background-color: #f9f9fa;
	 filter: grayscale(0.7) !important;
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

 .clipwrapper {
  position: relative;
  height: 225px;
}
.clip {
  position: absolute;
  clip: rect(50px 218px 155px 82px);
}
figure{
   width:340px; /*container-width*/
   overflow:hidden; /*hide bounds of image */
   margin:0;   /*reset margin of figure tag*/
}
figure img{
   display:block; /*remove inline-block spaces*/
   width:100%; /*make image streatch*/
   margin:-11.875% 0;
}

.cropped {
    width: 340px; /* width of container */
    height: 150px; /* height of container */
    overflow: hidden;
    /*border: 5px solid black;*/
}

.cropped img {
	display:block; 
	width:100%;
    margin: -25px 0px 0px -20px;
}
.cropped2 {
    width: 1120px; /* width of container */
    height: 250px; /* height of container */
    overflow: hidden;
    /*border: 5px solid black;*/
}

.cropped2 img {
	display:block; 
	width:100%;
    margin: -255px 0px 0px -20px;
}
    /*Now the CSS*/
    * {margin: 0; padding: 0;}

    .tree ul {
        padding-top: 20px; position: relative;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    .tree li {
        float: left; text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0 5px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    /*We will use ::before and ::after to draw the connectors*/

    .tree li::before, .tree li::after{
        content: '';
        position: absolute; top: 0; right: 50%;
        border-top: 1px solid #ccc;
        width: 50%; height: 20px;
    }
    .tree li::after{
        right: auto; left: 50%;
        border-left: 1px solid #ccc;
    }

    /*We need to remove left-right connectors from elements without
    any siblings*/
    .tree li:only-child::after, .tree li:only-child::before {
        display: none;
    }

    /*Remove space from the top of single children*/
    .tree li:only-child{ padding-top: 0;}

    /*Remove left connector from first child and
    right connector from last child*/
    .tree li:first-child::before, .tree li:last-child::after{
        border: 0 none;
    }
    /*Adding back the vertical connector to the last nodes*/
    .tree li:last-child::before{
        border-right: 1px solid #ccc;
        border-radius: 0 5px 0 0;
        -webkit-border-radius: 0 5px 0 0;
        -moz-border-radius: 0 5px 0 0;
    }
    .tree li:first-child::after{
        border-radius: 5px 0 0 0;
        -webkit-border-radius: 5px 0 0 0;
        -moz-border-radius: 5px 0 0 0;
    }

    /*Time to add downward connectors from parents*/
    .tree ul ul::before{
        content: '';
        position: absolute; top: 0; left: 50%;
        border-left: 1px solid #ccc;
        width: 0; height: 20px;
    }

    .tree li a{
        border: 1px solid #ccc;
        padding: 5px 10px;
        text-decoration: none;
        color: #666;
        font-family: arial, verdana, tahoma;
        font-size: 11px;
        display: inline-block;

        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    /*Time for some hover effects*/
    /*We will apply the hover effect the the lineage of the element also*/
    .tree li a:hover, .tree li a:hover+ul li a {
        background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
    }
    /*Connector styles on hover*/
    .tree li a:hover+ul li::after,
    .tree li a:hover+ul li::before,
    .tree li a:hover+ul::before,
    .tree li a:hover+ul ul::before{
        border-color:  #94a0b4;
    }

    /*Thats all. I hope you enjoyed it.
    Thanks :)*/

    /* Custom Config */

    .tree b, .tree p
    {
        font-size: 16px;
        font-family: 'Kanit', sans-serif;
    }

    .tree img
    {
        width:80px;
        border-radius:40px;
    }

    .wrapper {
	    position: relative;
	    padding-top: 80.25%;
	    overflow: hidden;
	    /*padding-bottom:150%*/
	}
	.wrapper embed{
		position: absolute;
		top: 0;
		left: 0;
		width : 100%;
		height: 100%;
	}
</style>
</head>
<body class="animsition" >
	
	<!-- Header -->
	<header>
		<div class="container-menu-desktop" style="background: linear-gradient(90deg, rgb(0, 173, 165) 0%, rgba(11, 173, 0, 0) 60%, rgba(37, 244, 102, 0.29) 100%);  ">
			<div class="topbar" style="background-color: rgb(124, 124, 124);">
				<div class="content-topbar container h-100">
					<div class="left-topbar">
						<span class="left-topbar-item flex-wr-s-c">
							<span class="text-uppercase cl0 p-r-8">
								ข่าวประชาสัมพันธ์ : 
							</span>
							<span class="dis-inline-block cl0 slide100-txt pos-relative size-w-0 " data-in="fadeInDown" data-out="fadeOutDown">
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
						</a>
						<a  class="btn btn-blue" href="{{route('login')}}" role="button">Login</a>
					</div>
				</div>
			</div>

			<!-- Header Mobile -->
			<div class="wrap-header-mobile">
				<!-- Logo moblie -->
				@if(!empty($template[0]))
					@foreach($template as $data) 		
					<div class="logo-mobile">
						<a href="/"><img src="{{asset('storage/template/'.$data->logo_main)}}" alt="IMG-LOGO"></a>
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
				
				<!-- <ul class="main-menu-m">
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
					<li>
						<a  class="btn btn-blue" href="{{route('login')}}" role="button">Login</a>
					</li>
				</ul> -->
				<ul class="main-menu-m">
					<li >
						<a href="/">หน้าหลัก</a>
					</li>
					@if(!empty($main_menu_all))
						@foreach($main_menu_all as $main)
							@if($main->status_setting == 1)
								@if(!empty($main->submenu[0]))
								<li >
									<a> <span class="arrow-main-menu-mo">{{ $main->name }}</span></a>
									<ul class="sub-menu-m">
									@foreach($main->submenu as $sub)
										@if($sub->status_setting == 1)

											@if($sub->join_database == 'board')
												@foreach($group as $row)
													@if($row->status_setting == 1)
														<li>
															<a href="{{ route('index.board',[$row->id]) }}">
																{{ $row->name }}
															</a>
														</li>
													@endif
												@endforeach
											@else
											<li>
												<a href="@if(!empty($sub->join_database)){{ route($sub->join_database) }}@else
												{{ route('index.content_show',['sub',$sub->id]) }}@endif
												">{{ $sub->name }}
												</a>
											</li>
											@endif
										@endif
									@endforeach
									</ul>
									<span class="arrow-main-menu-m">
										<i class="fa fa-angle-right" aria-hidden="true"></i>
									</span>
								</li>

								@else
									@if(!empty($main->join_database))
										@if($main->join_database == 'board')
											<li ><a>คณะบริหาร</a>
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
												<span class="arrow-main-menu-m">
													<i class="fa fa-angle-right" aria-hidden="true"></i>
												</span>
											</li>
										@elseif($main->join_database == 'type_document')
											<li ><a>เอกสาร</a>
												<ul class="sub-menu-m">
													@foreach($type_doc as $row)
														@if($row->status_setting == 1)
															<li>
																<a href="{{route('index.document_all',[$row->id])}}">{{ $row->name }}
																</a>
															</li>
														@endif
													@endforeach
												</ul>
											</li>
										@else
											<li >
												<a href="{{ route($main->join_database) }}">{{ $main->name }}</a>
											</li>
										@endif
									@else
										<li >
											<a href="{{ route('index.content_show',['main',$main->id]) }}">{{ $main->name }}</a>
										</li>
									@endif
								@endif	
							@endif
						@endforeach
					@endif
					<li >
						<a href="{{ route('nriis.index') }}">nriis</a>
					</li>
					<li class="justify-content-end">
						<!-- <a href="/"><i class="fa fa-search"></i></a> -->
						<a href="#demo" class="" data-toggle="collapse">
							<i class="fa fa-search"></i>
						</a>
						<div id="demo" class="collapse">
						    <!-- <div class="container"> -->
						    <div class="row justify-content-end">
						    	<div class="card" style="width: 50rem;" >
									<div class="card-body">
						    	<form class="form-inline" action="/action_page.php">
								 <label class="col-md-1" for="email">ประเภท:</label>
								  <input type="email" class="form-control" placeholder="" id="email">
								   <label class="col-md-1" for="email">หมวดหมู่:</label>
								  <input type="email" class="form-control" placeholder="" id="email">
								  <label class="col-md-1" for="pwd">คำค้น:</label>
								  <input type="password" class="form-control" placeholder="" id="pwd">
								  <div class="col-md-1">
								  	<button type="submit" class="btn btn-primary ">ค้นหา</button>
								  </div>
								  
								</form>
								</div>
								</div>
						    </div>
							<!-- </div> -->
						</div>	
					</li>

				</ul>
				
			</div>

			<!--  -->
			<div class="wrap-logo container" >
				@if(!empty($template[0]))
					@foreach($template as $data)
					<div class="logo">
						<a href="index.html"><img src="{{asset('storage/template/'.$data->logo_main)}}" alt="LOGO"></a>
					</div>	
					@endforeach
				@endif

				<div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">

		            <div class="carousel-inner ">
		            	<center>
		        
	                	<div class="carousel-item active">
	                		<div class="cropped">
	      						<img src="images/93835256_1448165522012092_2519679080010350592_n.jpg" />
	    					</div>
	                		<!-- <figure>
							    <img src="images/93835256_1448165522012092_2519679080010350592_n.jpg" />
							</figure> -->
	                	</div>
	                	<div class="carousel-item ">
	                		<div class="cropped">
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
	                		<div class="cropped">
	      						<img src="images/94057275_2676472412632724_8899211905629945856_n.jpg" />
	    					</div>
	                	</div>
	                </center>
		         	</div>
		         <!--End carousel-->
		      	
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
								<li >
									<a href="{{ route('nriis.index') }}">nriis</a>
								</li>
								
								@if(!empty($main_menu_all))
									@foreach($main_menu_all as $main)
										@if($main->status_setting == 1)
											@if(!empty($main->submenu[0]))
											<li >
												<a>{{ $main->name }}&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
												<ul class="sub-menu">
												@foreach($main->submenu as $sub)
													@if($sub->status_setting == 1)

														@if($sub->join_database == 'board')
															@foreach($group as $row)
																@if($row->status_setting == 1)
																	<li>
																		<a href="{{ route('index.board',[$row->id]) }}">{{ $row->name }}
																		</a>
																	</li>
																@endif
															@endforeach
														@else
														<li>
															<a href="@if(!empty($sub->join_database)){{ route($sub->join_database) }}@else
															{{ route('index.content_show',['sub',$sub->id]) }}@endif
															">{{ $sub->name }}
															</a>
														</li>
														@endif
													@endif
												@endforeach
												</ul>
											</li>

											@else
												@if(!empty($main->join_database))
													@if($main->join_database == 'board')
														<li ><a>บุคลากร&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
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
													@elseif($main->join_database == 'type_document')
														<li ><a>เอกสารที่เกี่ยวข้อง&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
															<ul class="sub-menu">
																@foreach($type_doc as $row)
																	<li>
																		<a href="{{route('index.document_all',[$row->id])}}">{{ $row->name }}
																		</a>
																	</li>
																@endforeach
															</ul>
														</li>
													@else	
														<li >
															<a href="{{ route($main->join_database) }}">{{ $main->name }}</a>
														</li>
													@endif
												@else
													<li >
														<a href="{{ route('index.content_show',['main',$main->id]) }}">{{ $main->name }}</a>
													</li>
												@endif
											@endif	
										@endif
									@endforeach
								@endif
								
							</ul>
						</nav>
						<div id="demo1" class="collapse">
						    <div class="container">
						    <div class="row justify-content-end">
						    	<div class="card" style="width: 100rem;background-color: #cee7cb;" >
  								<div class="card-body">
						    	<form method="POST" class="form-inline" action="{{ route('index.seach_document')}}" enctype="multipart/form-data">
						    		@csrf
								<label class="col-md-1" for="email">ประเภท:</label>
									{{ Form::select('type_document_id', App\Type_document::whereNull('type_quality_id')->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกประเภท...','class'=>'form-control']) }} 
								  	<!-- <input type="email" class="form-control" placeholder="" id="email"> -->
								<label class="col-md-1" for="email">หมวดหมู่:</label>
									{{ Form::select('category_document_id', App\Category_document::whereNull('type_quality_id')->pluck('name','id'), null, ['placeholder' => 'กรุณาเลือกหมวดหมู่...','class'=>'form-control']) }} 
								  	<!-- <input type="email" class="form-control" placeholder="" id="email"> -->
								  <label class="col-md-1" for="">คำค้น:</label>
								  <input type="text" class="form-control" placeholder="" id="" name="text_seach">
								  <div class="col-md-1">
								  	<button type="submit" class="btn btn-primary ">ค้นหา</button>
								  </div>
								</form>
								</div>
								</div>
						    </div>
							</div>
						</div>	
					</div>
				</div>
				@endif	
				@endforeach
			@endif	
		</div>
	</header>



	<!-- BEGIN #slider -->
	@yield('slider')
	

<section class="bg0 "style="background-image: url('images/gplaypattern@2x.png');">
	<div class="container bg0 p-t-20" style=" box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, .1);">
		@yield('post1')	
		@yield('post_activity')	
		@yield('post_activity2')
		@yield('activity_detail')
	</div>		
</section>


	

	

	
	



	

	

	

	<!-- Footer -->
	<footer >
		<div class="bg2 p-t-40 " style="background: linear-gradient(90deg, rgb(37, 244, 102, 0.29) 0%, rgba(11, 173, 0, 0) 60%, rgba(37, 244, 102, 0.29) 100%);  " >
			<div class="container">
				<div class="row">
					<div class="col-lg-3 p-b-20">
						<div class="size-h-3 flex-s-c">
							<a href="index.html">
								@if(!empty($data->logo_menu))
								<img class="max-s-full" src="{{asset('storage/template/'.$data->logo_menu)}}" alt="LOGO" style="height: 100px; max-width: 70%;">
								@endif
							</a>
						</div>
					</div>
					<div class="col-lg-9 p-b-20">
						<div>
							<p class="f1-s-1 cl2 p-b-16">
							หน่วยงานตรวจสอบภายใน สำนักงานอธิการบดี อาคารอัมรินทร์พิทักษ์ ชั้น 2 มหาวิทยาลัยราชภัฏนครสวรรค์ <br>
							398 หมู่ 9 ถ.สวรรค์วิถี อ.เมือง จ.นครสวรรค์ 60000
							</p>

							<p class="f1-s-1 cl2 p-b-16">
								โทรศัพท์ 056-219100 ต่อ 1117 
							</p>

							
						</div>
					</div>

					<!-- <div class="col-sm-6 col-lg-4 p-b-20">
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
								NSRUBI Fanpage
							</h5>
						</div>
						<div id="fb-root"></div>
						<script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v6.0"></script> -->

						

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

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!-- As A Vanilla JavaScript Plugin -->
	<script src="js/simple-lightbox.min.js"></script>
	<!-- As A jQuery Plugin -->
	<script src="js/jquery.min.js"></script>
	<!-- <script src="js/simple-lightbox.jquery.min.js"></script> -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
	<!-- <script type="text/javascript" charset="utf8" src="js/dataTable1.10.12.js"></script> -->
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/r-2.2.3/datatables.min.js"></script> -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/kt-2.5.1/datatables.min.js"></script>
@yield('show_pagination')
<script type="text/javascript">

	$(document).ready( function () {
	    $('#myTable').DataTable({
	    	    "bPaginate": true,
			    "bLengthChange": false,
			    "bFilter": false,
			    "bInfo": true,
			    "bAutoWidth": false,
			    "order" : [ [0, 'desc'] ]
	    });
	} );
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
		$(document).ready(function() {
			// $('#example').DataTable({
			//     // "bPaginate": true,
			//     // "bLengthChange": false,
			//     // "bFilter": true,
			//     // "bInfo": true,
			//     // "bAutoWidth": false 
			// });
			

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
			// As A Vanilla JavaScript Plugin
			var gallery = new SimpleLightbox('.gallery a', { 
			    /* options */ 
			});

			// As A jQuery Plugin -->
			var gallery = $('.gallery a').simpleLightbox({
			    /* options */
			});
		});

	</script>
@yield('script_content')
	
</body>
</html>

