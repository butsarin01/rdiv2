@extends('backend.master')
@section('content')
    <div class="row">
        <div class="panel  ">
            <div class="panel-body text-center">
                <div class="py-3">
                    {{--                        {{ !empty($text) ? $text : 'ปกติ' }} <br>--}}
{{--                    <i class="far fa-5x fa-fw fa-face-smile text-green mb-2"></i>--}}
{{--                    <i class="far fa-5x fa-fw fa-face-smile-beam text-green mb-2"></i>--}}
                    <h1>สวัสดี</h1>
                    <i class="far fa-5x fa-fw fa-face-grin-beam text-green mb-2"></i>

                    <h2> {{session()->get('user.full_name')}}</h2>
                    <h5>
                        ({{session()->get('user.permission_name')}})
                        {{session()->get('user.major_org')}}</h5>
                </div>
            </div>
        </div>
    </div>

@endsection
