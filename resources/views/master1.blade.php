<!DOCTYPE html>
<html lang="en">
<head>
	<title>สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<Meta http-equiv="content-language" content="TH">
	<meta name="description" content="สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์">
	<meta name="keywords" content="สถาบันวิจัยและพัฒนา,มหาวิทยาลัยราชภัฏนครสวรรค์, สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์">
	<meta name="author" content="ARITC สำนักวิทยบริการและเทคโนโลยีสารสนเทศ มหาวิทยาลัยราชภัฏนครสวรรค์">
	<!-- <meta name="robots" content="all"> -->
	<!-- <meta name="Copyright" content="ข้อความสัญญาอนุญาต"> -->

	<meta property="og:title" content="สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://rdi.nsru.ac.th/" />
	<meta property="og:site_name" content="rdi nsru" />
	<meta property="og:description" content="สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์" />
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
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/dataTable1.10.12.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/r-2.2.3/datatables.min.css"/> -->
 
 	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/kt-2.5.1/datatables.min.css"/> -->
 

@yield('style')


<style>
	 .stretch-card>.card {
     width: 100%;
     min-width: 100%
 }

 body {
     background-color: #f9f9fa;
     font-family: 'Sarabun', sans-serif;
	 filter: grayscale(0.7) !important;
 }

 .flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }
 .carousel_height{
 	height: 380px;
 }

.padding {
     padding: 3rem
 }

@media (max-width:1193px) {
    .padding {
        padding: 1.5rem
    }
    .carousel_height{
	 	height: 309px;
	 }
    
}
@media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }

 }
 @media (max-width:986px) {
     .carousel_height{
	 	height: 232px;
	 }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
     .carousel_height{
	 	height: 178px;
	 }
    
 }
  @media (max-width:575px) {
     .carousel_height{
	 	height: 186px;
	 }
    
 }
  @media (max-width:414px) {
     .carousel_height{
	 	height: 134px;
	 }
    
 }
 @media (max-width:375px) {
     .carousel_height{
	 	height: 115px;
	 }
    
 }
 @media (max-width:360px) {
     .carousel_height{
	 	height: 120px;
	 }
    
 }
 @media (max-width:320px) {
     .carousel_height{
	 	height: 90px;
	 }
    
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
	.show_pc{
		display: contents;
	}
	.show_moblie{
		display: none;
	}

	@media only screen and (orientation: portrait) {
		.show_pc{
			display:none ;
		}
		.show_moblie{
			display: contents;
		}
	}
</style>
</head>
<body class="animsition"  >
	
	<!-- Header -->
	<header>
		<div class="container-menu-desktop" style="background-color: #ffc107; ">

			<!--tab ข่าวประชาสัมพันธ์ บนสุด  -->
			<!-- <div class="topbar" style="background-color: rgb(124, 124, 124);">
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
						<a  class="btn btn-blue" href="{{route('login')}}" role="button">Login</a>
					</div>
				</div>
			</div> -->

			

			@include('header_moblie')
			@include('header_desktop')

		</div>
	</header>

	<!-- BEGIN #slider -->
	@yield('slider2')
	

	<section class="bg0 "style="/*background-image: url('images/gplaypattern@2x.png');*/">
		<div class="container bg0 p-t-20" style=" /*box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, .1);*/">
			@yield('post0')	
			@yield('post_activity0')
		
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-9">
					@yield('post_activity2')
					
					@yield('post_activity')
					@yield('activity_detail')
					
				</div>
				<div class="col-md-10 col-lg-3">
					<div class="p-l-10 p-rl-0-sr991 p-b-20 p-t-10 p-r-10">
						@if(!empty($md))
						

						<div class="flex-c-s p-t-8 p-b-5 text-center">
							<a href="#">
								<img class="" src="{{asset('storage/people/'.$md->thumbnail)}}" alt="@if(!empty($md->prefix_id)) {{$md->prefix()}} @endif {{$md->name}} {{$md->lastname}}" style="max-width: 70%;">
								<br>
								
							</a>
						</div>
						<div class="p-b-5">
							<div class="how20 how2-cl4 flex-s-c">
								<h4 class=" cl3 " align="center" style="font-size: 14px;">
									<p class="text-center "><b> @if(!empty($md->prefix_id)){{$md->prefix()}} @endif{{$md->name}} {{$md->lastname}}</b></p>
										{{$md->position()}}
								</h4>
							</div>
						</div>
						@endif
						@if(!empty($banner))
							@foreach($banner as $row)
								<div class="m-b-10 text-center">
									@if(!empty($row->link))
									<a href="{{$row->link}}" target="_blank">
										<img class="max-w-full" src="{{asset('storage/index/'.$row->file)}}" alt="{{$row->name}}"></a>
									@else
									<a href="#" data-toggle="modal" data-target="#exampleModal{{$row->id}}">
										<img class="max-w-full" src="{{asset('storage/index/'.$row->file)}}" alt="{{$row->name}}"></a>
									@endif
								</div>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>		
	</section>
	@if(!empty($banner))
		@foreach($banner as $row)
		<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg1" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">{{$row->name}}</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
			      <div class="modal-body">
			        <div class="row">
			        	<div class="col-12 text-center">
								<img class="max-w-full" src="{{asset('storage/index/'.$row->file)}}" alt="{{$row->name}}">
			        	</div>
			        </div>
			      </div>
			     <!--  <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div> -->
			    </div>
			  </div>
			</div>
		@endforeach
	@endif
	<!-- Messenger ปลั๊กอินแชท Code -->
    <!-- <div id="fb-root"></div> -->

    <!-- Your ปลั๊กอินแชท code -->
    <!-- <div id="fb-customer-chat" class="fb-customerchat"></div> -->

   <!--  <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "112518403876078");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script> -->

    <!-- Your SDK code -->
    <!-- <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v16.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script> -->

<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="สถาบันวิจัยและพัฒนา"
  agent-id="bf6f6946-308a-41c8-b205-f845a49bd851"
  language-code="th"
></df-messenger>
    
	<footer>
		<div class="bg2 p-t-6 p-b-6">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 p-b-2">
						<!-- <br> -->
						<div class="row p-t-10">	
							<div class="col-md-3">
								@if(!empty($template[0]))
									@foreach($template as $data) 
										<a href="http://rdi.nsru.ac.th/">
											<img class="wrap-pic-w" src="{{asset('storage/template/'.$data->logo_menu)}}" alt="rdi" style="width: 60px;">
										</a>
									@endforeach
								@endif
							</div>
							<div class="col-md-9">
								<p class="f1-s-1 cl11  p-b-10">
									สถาบันวิจัยและพัฒนา <br>มหาวิทยาลัยราชภัฏนครสวรรค์ ศูนย์การศึกษาย่านมัทรี
									398/1 หมู่ 3 ตำบลย่านมัทรี อำเภอพยุหะคีรี
									จังหวัดนครสวรรค์ 60130
								</p>
							</div>
						</div>

						<div>
							
						<div class="row">	
								
							<div class="col-md-12">	
								<p class="f1-s-1 cl11">
									056-219100 ต่อ หมายเลขโทรศัพท์ภายใน
								</p>
								<p class="f1-s-1 cl11 ">
									8715 ผู้อำนวยการ <br>
									8716 รักษาการหัวหน้าสำนักงานฯ <br>
									8717 ฝ่ายธุรการ, ฝ่ายบริการวิชาการ, ประกันคุณภาพฯ <br>
									8718 ฝ่ายการเงิน-พัสดุ, ฝ่ายวิจัย, โครงการ อพ.สธ. <br>
								</p>
							</div>

							
						</div>

							<div class="p-t-10">
								<a href="https://www.facebook.com/smart.rdinsru.58" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-facebook-f"></span>
								</a>
								<a  class="btn btn-blue" href="{{route('login')}}" role="button">สำหรับผู้ดูแลระบบ</a>
								
							</div>
							<!-- <div class="right-topbar "> -->
								<!-- <a  class="btn btn-blue" href="{{route('login')}}" role="button">Login</a> -->
							<!-- </div> -->
						</div>
					</div>

					<div class="col-sm-6 col-lg-4 p-b-2">
						<div class="size-h-3 flex-s-c">
							<h5 class="f1-m-7 cl0">
								ระบบสารสนเทศ
							</h5>
						</div>

						<ul class="m-t--12">
							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="https://e-office.nsru.ac.th/v3/index.php" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									E-OFFICE
								</a>
							</li>

							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="https://e-meeting.nsru.ac.th/" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									E-MEETING
								</a>
							</li>

							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="http://mis.nsru.ac.th/" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									NSRU MIS
								</a>
							</li>

							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="http://e-journal.nrct.go.th/" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									NRCT OFFICIAL E-JOURNAL
								</a>
							</li>

							
						</ul>
					</div>

					<div class="col-sm-6 col-lg-4 p-b-2">
						<div class="size-h-3 flex-s-c">
							<h5 class="f1-m-7 cl0">
								เว็บไซต์ที่เกี่ยวข้อง
							</h5>
						</div>

						<ul class="m-t--12">
							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="https://www.nrct.go.th/" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									สำนักงานการวิจัยแห่งชาติ
								</a>
							</li>
							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="https://www.nrct.go.th/th/%E0%B8%AB%E0%B8%99%E0%B8%B2%E0%B8%AB%E0%B8%A5%E0%B8%81.aspx#.Vb8QsvOqpBc" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									ห้องสมุดงานวิจัยสาธารณะ
								</a>
							</li>

							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="http://www.tnrr.in.th/2558/" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									คลังข้อมูลงานวิจัยไทย
								</a>
							</li>

							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="http://www.nrms.go.th/" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									ระบบบริหารงานวิจัยแห่งชาติ
								</a>
							</li>

						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="bg11">
			<div class="container size-h-4 flex-c-c p-tb-10">
				<span class="f1-s-1 cl0 txt-center">
					Copyright © 2021 NSRU , <a href="http://aritc.nsru.ac.th/index.php">ARITC</a>  All rights reserved.
					<!-- <a href="#" class="f1-s-1 cl10 hov-link1"> -->
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</span>
			</div>
		</div>
	</footer>

	

	<!-- Back to top -->
	<!-- <div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div> -->

	
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
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/kt-2.5.1/datatables.min.js"></script> -->


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

