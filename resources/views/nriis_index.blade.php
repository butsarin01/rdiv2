@extends('master1')

@section('title', 'สถาบันวิจัยและพัฒนา มหาวิทยาลัยราชภัฏนครสวรรค์')

@section('post_activity2')
<div id="google_translate_element" ></div>

	<div class="p-b-20">
		<h3 class="f1-l-3 cl2 p-b-1  respon2 p-t-5 p-l-5" style="background-color: #fff;">
			NRIIS API
		</h3>
		<hr width=100% size=5  style="margin-top:0.5rem; background-color: burlywood;" class="p-t-2">
		
		<!-- <button type="submit" onclick="javascript:pull()">pull</button> -->
		<!-- <button type="button"  class="btn btn-primary pull" >pull</button>
		<div class="show"></div> -->

		<table  class="table table-bordered">
			<thead>
				<tr>
					<th>รหัสโครงการ</th>
					<!-- <th>รหัสข้อเสนอโครงการ</th> -->
					<th>ชื่อโครงการภาษาไทย</th>
					<th>ประเภทโครงการ</th>
					<th>ทุนวิจัย</th>
					<th>ชื่อนักวิจัย</th>
					<th>งบประมาณเสนอขอ</th>
				</tr>
			</thead>
			<tbody>
				@if(!empty($proposals))
                   @foreach($proposals as $proposal)
					<tr>
						<td>{{$proposal->projectID}} <br> <font style="color: blue;">{{$proposal->propEvalResult}}</font></td>
						<!-- <td>{{$proposal->projectProposalID}}</td> -->
						<td>{{$proposal->projectNameTH}}</td>
						<td>{{$proposal->projectType}}</td>
						<td>{{$proposal->researchFundName}}</td>
						<td>{{$proposal->researcherName}}</td>
						<td>
							<?php 
								$number = floor($proposal->budgetsubmit);
								echo number_format($number, 3); 
							?>
						</td>
					</tr>
					@endforeach
                @endif
			</tbody>
		</table>	






	</div>


				



			
@endsection

@section('script_content')
<script>

function googleTranslateElementInit() {
	new google.translate.TranslateElement({
		pageLanguage: 'th',
      	includedLanguages: 'th,en,zh-CN,zh-TW',
      	layout: google.translate.TranslateElement.InlineLayout.SIMPLE
	}, 'google_translate_element');
}

</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<script type="text/javascript">
		// function pull(){
		// 	var settings = {
		// 	  "url": "http://api.nriis.nrct.go.th/...",
		// 	  "method": "GET, POST, PUT, DELETE",
		// 	  "headers": {
		// 	    "Authorization": "Bearer <Token>"
		// 	  }
		// 	}
		// }

		// $(".pull").on("click",function(){
		//     console.log("jgfkfgkdshgk");
		    
	 //      	$.ajax({
		//       	url: "http://api.nriis.nrct.go.th/service/user/v1/authenticate",
		//       	method: "POST",
		//       	data: {"loginName" : "Kreak.J", "loginPassword" : "nsru123!"},
		//       	dataType: 'JSON',
		//         // headers:{  
		//         //    	"Authorization": "Bearer <Token>"
		//         // },  
		//         success:function(data){
		//           console.log(data);
		//         },
		//   		error: function (data) {
  //                   console.log('Error:', data);
  //               }
	 //      	});
		// });
	</script>
@endsection