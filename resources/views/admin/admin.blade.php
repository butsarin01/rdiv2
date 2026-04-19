@extends('admin.master')
@section('admin')
<div id="content" class="content">
<div class="row">
	<h1>{{session()->get('user.permisstion_name')}} </h1>
	<h2> {{session()->get('user.full_name')}}</h2>
</div>
</div>
@endsection
