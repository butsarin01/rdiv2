@extends('master1')

@section('title', 'สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์')

@section('activity_detail')
<div class="p-b-70">
	@if(!empty($data_borad))
		<h3 class="f1-l-3 cl2 p-b-1  respon2 p-t-5 p-l-5" style="background-color: #fff;">
				{{$data_borad->name}}
		</h3>
		<hr width=100% size=5  style="margin-top:0.5rem; background-color: burlywood;" class="p-t-2"><br>
	@endif

	@if(!empty($data_people) && $data_borad->id == 1) 
		@foreach($data_people as $data)
			@if(!empty($data->people[0]))
				<!-- <h3 class="f1-l-3 cl2 p-b-1  respon2 p-t-5 p-l-5" style="background-color: #fff;">
					{{$data->name}}
				</h3>
				<hr width=100% size=5  style="margin-top:0.5rem; background-color: burlywood;" class="p-t-2"><br> -->
				<div class="p-b-5">
					<div class="how2 how2-cl4 flex-s-c">
						<h4 class=" cl3 " align="center" >
							<b> {{$data->name}}</b>
						</h4>
					</div>
				</div>

				<div class="row">
					@foreach($data->people as $p)
						<div class="col-sm-6 p-r-25 p-r-15-sr991">
							<div class="p-b-20">
								<center>
									@if(!empty($p->ldep_username))
										<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="size-w-15 wrap-pic-w hov1 trans-03" target="_blank">
											<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)) {{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}"  style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa;max-width: 150px;">
										</a>
									@else
										<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)) {{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}"  style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa;max-width: 150px;">
									@endif
								</center>

								<div class=" text-center flex-col-s-c p-t-10">
									@if(!empty($p->ldep_username))
										<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="f1-s-5 cl3 hov-cl10 trans-03" target="_blank">
											<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
										</a>
									@else
										<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
									@endif

									ตำแหน่ง : {{$p->position()}} <br>
									เบอร์โทร : {{$p->telephone}} <br>
									อีเมล : {{$p->email}}<br>
							FB : {{$p->position_self}}
								</div>
							</div>
						</div>
					@endforeach
				</div>	
			@endif
		@endforeach
	@endif

	@if(!empty($data_people) && $data_borad->id == 2) 
	<div class="row">
		<div class="col-md-4">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				@foreach($data_people as $key => $data)
					<!-- @if(!empty($data->people[0])) -->
			 		<a class ="nav-link {{$key == 0 ? 'active' : ''}}" id="v-pills-home-tab" data-toggle="pill" href="#v-{{$data->name}}" role="tab" aria-controls="v-pills-home" aria-selected="{{$key == 0 ? 'true' : 'false'}}">{{$data->name}}</a>
			 		<!-- @endif -->
			  	@endforeach
			</div>
		</div>
		<div class="col-md-8">
			<div class="tab-content" id="v-pills-tabContent">
				@foreach($data_people as $key => $data)
					<div class="tab-pane fade {{$key == 0 ? 'show active' : ''}} " id="v-{{$data->name}}" role="tabpanel" aria-labelledby="v-{{$data->name}}-tab">
						
							<div class="p-b-5">
								<div class="how2 how2-cl4 flex-s-c">
									<h4 class=" cl3 " align="center" >
										<b> {{$data->name}}</b>
									</h4>
								</div>
							</div>
						@if(!empty($data->people[0]))
							@foreach($data->people as $p)
								<div class="col-sm-12 p-r-25 p-r-15-sr991">
									<div class="p-b-20 row justify-content-center">
										<div class="col-md-4">
										<center>
											@if(!empty($p->ldep_username))
												<!-- <a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="size-w-15 wrap-pic-w hov1 trans-03" target="_blank"> -->
													<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)) {{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}"  style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa;max-width: 140px;">
												<!-- </a> -->
											@else
												<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)) {{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}"  style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa;max-width: 140px;">
											@endif
										</center>
										</div>
										<div class="col-md-7">
										<div class="text-left  p-t-10">
											@if(!empty($p->ldep_username))
												<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="f1-s-5 cl3 hov-cl10 trans-03" target="_blank">
													<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
												</a>
											@else
												<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
											@endif
											<br>

											ตำแหน่ง : {{$p->position()}} <br>
											@if(!empty($p->telephone))
												เบอร์โทร : {{$p->telephone}} <br>
												อีเมล : {{$p->email}}<br>
												FB : {{$p->position_self}}
											@endif

										</div>
										</div>
									</div>
								</div>
							@endforeach
						@else
							<h5 class="text-center">ไม่พบข้อมูล</h5>
						@endif
					</div>
				@endforeach
			</div>
		</div>
	</div>
		
		
		
	@endif

</div>

@endsection


@section('show_product')
<section class="bg0 p-t-60 p-b-35">
	<div class="container">
		<div class="row justify-content-center">

		</div>
	</div>
</section>
@endsection
