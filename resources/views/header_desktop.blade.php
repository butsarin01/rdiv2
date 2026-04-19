<!-- logo desktop -->
<div class="wrap-logo  container" >
	@if(!empty($template[0]))
		@foreach($template as $data) 	
			<div class="logo">
				<a href="/"><img src="{{asset('storage/template/'.$data->logo_main)}}" alt="IMG-LOGO"></a>
			</div>
		@endforeach
	@endif

	<!-- banner ด้านขวาของ logo  -->
	<!-- <div class="row d-flex justify-content-end"> -->
	<!-- <div class="row ">
		<div class="col-md-8 col-sm-4 m-b-10 ">
			<a href="http://nsru.drms.in.th/Login" class="btn btn-secondary " target="_blank">
				<h2 class="flag-icon flag-icon-th width-full m-r-10 m-t-0 m-b-3" title="th" id="th"></h2> 
				<b class="text-inverse">เข้าสู่ระบบบริหารจัดการงานวิจัยทุนภายใน (DRMS)</b>
			</a>
		</div>
	</div> -->
	<!-- <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
        <div class="carousel-inner ">
        	<center>
            	<div class="carousel-item active">
            		<div class="cropped">
  						<img src="../assets/img/2178.png" />
					</div>
            	</div>
            	<div class="carousel-item ">
            		<div class="cropped">
  						<img src="../assets/img/2178.png" />
					</div>
            	</div>
            	<div class="carousel-item ">
            		<div class="cropped">
  						<img src="../assets/img/2178.png" />
					</div>
            	</div>
        	</center>
     	</div>
  	</div> -->
</div>

<!-- Menu desktop -->
<div class="wrap-main-nav">
	<div class="main-nav" style="background-color: #ffffff;">
		<nav class="menu-desktop">
			@if(!empty($template[0]))
				@foreach($template as $data) 	
				<a class="logo-stick" href="index.html">
					<img src="{{asset('storage/template/'.$data->logo_menu)}}" alt="LOGO">
				</a>
				@endforeach
			@endif

			<ul class="main-menu">
				<li class="main-menu-active">
					<a href="/">หน้าหลัก</a>
				</li>
				@if(!empty($main_menu_all))
					@foreach($main_menu_all as $main)
						@if($main->status_setting == 1)
							@if(!empty($main->submenu[0]))
							<li >
								<a>{{ $main->name }} &nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
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
										@elseif($sub->join_database == 'type_document')
										@if($sub->join_database_id == 26)
											@foreach($type_doc as $row)
												@if($row->id == $sub->join_database_id)
													@foreach($row->category as $row1)
														<li>
															<a href="{{ route('index.document_category',[$row1->id]) }}">{{ $row1->name }}</a>
														</li>
													@endforeach
												@endif
											@endforeach
										@else
											@foreach($type_doc as $row)
												@if($row->id == $sub->join_database_id)
													@foreach($row->category as $row1)
														<li>
															<a href="{{ route('index.document_category',[$row1->id]) }}">{{ $row1->name }}</a>
														</li>
													@endforeach
												@endif
											@endforeach
										@endif
											
										@elseif(!empty($sub->link))
											<li>
												<a href="{{ $sub->link->link }}" target="_blank">{{ $sub->name }}</a>
											</li>
													
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
									@else
										<li >
											@if(!empty($main->id != 6))
											 	<a href="{{ route($main->join_database) }}">{{ $main->name }}</a>
											@elseif(!empty($main->id == 6))
												<a href="{{ route($main->join_database,[4]) }}">{{ $main->name }}</a>
											@endif
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
				<!-- <li >
					<a href="{{ route('nriis.index') }}">nriis</a>
				</li> -->
				<!-- <li class="justify-content-end">
					<a href="/"><i class="fa fa-search"></i></a>
					<a href="#demo1" class="" data-toggle="collapse">
						ค้นหาเอกสาร &nbsp; <i class="fa fa-search"></i>
					</a>
				</li> -->
				
			</ul>
		</nav>
	</div>
</div>