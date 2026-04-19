<!-- Header Mobile -->
<div class="wrap-header-mobile">
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
<div class="menu-mobile" style="background-color: #fdbf07">
	<ul class="main-menu-m" style="background-color: #fdbf07">
		<li style="background-color: #fdbf07">
			<a href="/">หน้าหลัก</a>
		</li>
		@if(!empty($main_menu_all))
			@foreach($main_menu_all as $main)
				@if($main->status_setting == 1)
					@if(!empty($main->submenu[0]))
					<li style="background-color: #fdbf07">
						<a> <span class="arrow-main-menu-mo">{{ $main->name }}</span></a>
						<ul class="sub-menu-m">
						@foreach($main->submenu as $sub)
							@if($sub->status_setting == 1)

								@if($sub->join_database == 'board')
									@foreach($group as $row)
										@if($row->status_setting == 1)
											<li >
												<a href="{{ route('index.board',[$row->id]) }}">
													{{ $row->name }}
												</a>
											</li>
										@endif
									@endforeach
								@elseif($sub->join_database == 'type_document')
									@foreach($type_doc as $row)
										@if($row->id == $sub->join_database_id)
											@foreach($row->category as $row1)
												<li >
													<a href="{{ route('index.document_category',[$row1->id]) }}">{{ $row1->name }}</a>
												</li>
											@endforeach
										@endif
									@endforeach
								@elseif(!empty($sub->link))
									<li >
										<a href="{{ $sub->link->link }}" target="_blank">{{ $sub->name }}</a>
									</li>
								@else
								<li >
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
								@foreach($type_doc as $row)
									@if($row->id == $sub->join_database_id)
										@foreach($row->category as $row1)
											<li >
												<a href="{{ route('index.document_category',[$row1->id]) }}">{{ $row1->name }}
												</a>
											</li>
										@endforeach
									@endif
								@endforeach
							@else
								<li >
									<a href="{{ route($main->join_database) }}">{{ $main->name }}</a>
								</li>
							@endif
						@else
							<li style="background-color: #fdbf07">
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
			<a href="#demo" class="" data-toggle="collapse">
				<i class="fa fa-search"></i>
			</a>
			<div id="demo" class="collapse">
			    <div class="container">
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
				</div>
			</div>	
		</li> -->
	</ul>
</div>
