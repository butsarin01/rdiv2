@extends('master1')

@section('title', 'สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์')
@section('post_activity')
	<!-- <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
		<h3 class="f1-m-2 cl3 tab01-title">
			กิจกรรม
		</h3>
	</div> -->
	<h3 class="f1-l-3 cl2 p-b-1  respon2 p-t-5 p-l-5" style="background-color: #fff;">
		กิจกรรม
	</h3>
	<hr width=100% size=5  style="margin-top:0.5rem; background-color: burlywood;" class="p-t-2">

<div class="row p-t-35">
	@if(!empty($event_cut))
	@foreach($event_cut as $event)

	<div class="col-sm-4 p-r-25 p-r-15-sr991">
		<!-- Item latest -->
		<div class="m-b-45">
			<a href="{{ route('index.activity_detail',[$event->id]) }}" class="wrap-pic-w hov1 trans-03">
				<img src="{{$event->cover_url}}" alt="IMG">
			</a>

			<div class="p-t-16">
				<h5 class="p-b-5">
					<a href="{{ route('index.activity_detail',[$event->id]) }}" class="f1-m-4 cl2 hov-cl10 trans-03">
						{{$event->name}}
					</a>
				</h5>

				<span class="cl8">

					<span class="f1-s-3 m-rl-3">
						<i class="fas fa-lg fa-fw m-r-3 fa-calendar-alt"></i>
					</span>

					<span class="f1-s-3">
						
						{{$event->begin_date->thai_date_normal()}}

					</span>
				</span>
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
