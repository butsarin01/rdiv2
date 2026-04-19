@extends('master1')

@section('title', 'สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์')

@section('activity_detail')
<div class="p-b-70">
	@if(!empty($people1))   
	@foreach($people1 as $data)
	<h3 class="f1-l-3 cl2 p-b-1  respon2 p-t-5 p-l-5" style="background-color: #fff;">
		{{$data->name}}
	</h3>
	<hr width=100% size=5  style="margin-top:0.5rem; background-color: burlywood;" class="p-t-2"><br>
	@if($data->id == 1)
	<div class="row justify-content-center">
		<?php $i = 0; ?> 
		@foreach($data->people as $p)
			@if($i == 0 || $i == 1)
				<div class="col-sm-6 p-r-25 p-r-15-sr991">
					<div class="p-b-45">
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

							{{$p->position()}} <br>
							เบอร์โทร : {{$p->telephone}} <br>
							อีเมล : {{$p->email}} <br>
							{{$p->position_self}}
						</div>
					</div>
				</div>
			<!-- <div class="col-md-6">
				<div class="row p-b-30 p-l-5">
					<div class="co-md-3">
						<center>
							@if(!empty($p->ldep_username))
							<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="size-w-15 wrap-pic-w hov1 trans-03" target="_blank">
								<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}" style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa; max-width: 130px;">
							</a>
							@else
							<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}" style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa; max-width: 130px;">
							@endif
						</center>
					</div>
					<div class="co-md-9">
						<div class="text-left p-t-10 p-l-10">
							@if(!empty($p->ldep_username))
							<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="f1-s-5 cl3 hov-cl10 trans-03" target="_blank">
								<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
							</a>
							@else
							<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
							@endif
							<br>
							{{$p->position()}}<br>
							<b>เบอร์โทร :</b> 0-5621-9100 ต่อ 1156 <br>
							<b>อีเมล : </b>somboon@nsru.ac.th
						</div>
					</div>

				</div>

			</div> -->
			@endif
		<?php $i++; ?>
		@endforeach
<br> <br>
		<?php $j = 1; ?> 
		@foreach($data->people as $p)
		@if($j >= 3)
		<div class="col-sm-6" style="padding-right: 5px; padding-left: 5px;">
			<div class="p-b-30">
				<center>
					@if(!empty($p->ldep_username))
					<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="size-w-15 wrap-pic-w hov1 trans-03" target="_blank">
						<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}" style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa; max-width: 150px;">
					</a>
					@else
					<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}" style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa; max-width: 150px;">
					@endif


				</center>

				<div class="text-center p-t-10">
					@if(!empty($p->ldep_username))
					<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="f1-s-5 cl3 hov-cl10 trans-03" target="_blank">
						<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
					</a>
					@else
					<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
					@endif
					<br>
					{{$p->position()}}<br>
					เบอร์โทร : {{$p->telephone}} <br>
					อีเมล : {{$p->email}}<br>
					{{$p->position_self}}
				</div>
			</div>
		</div>
		<!-- <div class="col-md-6">
			<div class="row p-b-30 p-l-5">
				<div class="co-md-4">
					<center>
						@if(!empty($p->ldep_username))
						<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="size-w-15 wrap-pic-w hov1 trans-03" target="_blank">
							<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}" style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa; max-width: 140px;">
						</a>
						@else
						<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}" style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa; max-width: 140px;">
						@endif
					</center>
				</div>
				<div class="co-md-8">
					<div class="text-left p-t-10 p-l-10 align-items-center">
						@if(!empty($p->ldep_username))
						<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="f1-s-5 cl3 hov-cl10 trans-03" target="_blank">
							<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
						</a>
						@else
						<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> 
						@endif
						<br>
						{{$p->position()}}<br>
						<b>เบอร์โทร :</b> 0-5621-9100 ต่อ 1156 <br>
						<b>อีเมล : </b>somboon@nsru.ac.th
					</div>
				</div>

			</div>

		</div> -->



		@endif
		<?php $j++; ?>
		@endforeach
	</div>
	@endif
	@if($data->id == 2)
	<div class="row justify-content-center">
		@foreach($data->people as $p)
		<div class="col-sm-4" style="padding-right: 5px; padding-left: 5px;">
			<div class="p-b-30">
				<center>
					@if(!empty($p->ldep_username))
					<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="size-w-15 wrap-pic-w hov1 trans-03" target="_blank">
						<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}" class="" style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa;max-width: 150px;">
					</a>
					@else
					<img src="{{asset('storage/people/'.$p->thumbnail)}}" alt="@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}" class="" style="border-radius: 10px; border : solid #deb887; background-color:#aaabaa;max-width: 150px;">
					@endif
				</center>

				<div class="text-center p-t-10">
					@if(!empty($p->ldep_username))
					<a href="http://www.nsru.ac.th/personal_info/index.php?ldap={{$p->ldep_username}}" class="f1-s-5 cl3 hov-cl10 trans-03" target="_blank">
						<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> <br>
					</a>
					@else
					<b>@if(!empty($p->prefix_id)){{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}}</b> <br>
					@endif	
					{{$p->position()}}<br>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	@endif

	@endforeach

	@endif

	@if(!empty($people2))   
	@foreach($people2 as $data)
	<b>{{$data->name}}</b>
	<?php $i = 0; ?> 
	@foreach($data->people as $p)
	@if($i == 0)
	@if(!empty($p->thumbnail))
	<div class="wrap-pic-max-w p-b-30 text-center">
		<img src="{{asset('storage/people/'.$p->thumbnail)}}" 
		height="100" alt="IMG"><br>

		@if(!empty($p->prefix_id)) {{$p->prefix()}} @endif {{$p->name}} {{$p->lastname}} <br>
		{{$p->position()}}<br>
		{{$p->position_self}}
	</div>
	@endif
	@endif
	@if($i > 0)
	<div class="text-center">
		<table>
			<td class="text-center">{{$p->position()}}</td>
			<td class="text-center">{{$p->position_self}}</td>

		</table>
	</div>

	@endif



	<?php $i++; ?>


	@endforeach



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
