@extends('backend.master')
@section('content')
    <div id="content" class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="panel  ">
                    <div class="panel-body">
                        @include('backend.people.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
