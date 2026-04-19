
@extends('master1')

@section('title', 'สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์')

@section('activity_detail')

<div class="p-b-20">

	<h4 class="f1-l-4 cl2 p-b-1  respon2 p-t-5 p-l-5" style="background-color: #fff;">
		@if(!empty($menu->name)) {{$menu->name}}  @endif
		@if(!empty($data_company)) {{$data_company->name}}  @endif
		@if(!empty($company_mode)) {{$company_mode}}  @endif
		@if(!empty($data_document)) {{$data_document->name}}  @endif

		@if(!empty($document_mode)) {{$document_mode}}  @endif
	</h4>
	<hr width=100% size=5  style="margin-top:0.5rem; background-color: burlywood;" class="p-t-2">


	@if(!empty($data_detail_menu))

		@if($menu->number_of_data == 2 ) <div class="row justify-content-center">@endif
			@foreach($data_detail_menu as $data)

			@if(!empty($data->title))
				<b class="cl2" style="font-size: 24px;">{{$data->title}}</b><br>
			@endif
			@if(!empty($data->file))
				<object data="{{asset('storage/file/'.$data->file)}}" type="application/pdf" width="100%" height="800px">
				</object>
			@endif
			@if(!empty($data->detail))
				<p class="f1-s-11 cl6 p-b-25">
					 <?php echo $data->detail; ?> 
				</p>
				@endif

			@endforeach
		@if($menu->number_of_data == 2 )</div>@endif
           
	@endif

</div>


@endsection

