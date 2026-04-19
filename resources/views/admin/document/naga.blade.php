@extends('admin.master')
@section('document')
    <div id="content" class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="panel">
                    <div class="panel-body">
                        @include('admin.document.form_naga')
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                            <tr>
                                <th width="1%">ลำดับ</th>
                                <th width="4%" >ปีงบประมาณ</th>
                                <th width="4%" >เลขอ้างอิง</th>
                                <th width="27%">ชื่อเอกสาร</th>
                                <th width="5%"class="text-nowrap">โครงการ</th>
                                <th width="6%"class="text-nowrap">งบประมาณ</th>
                                <th width="10%">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($document as $row)
                                <tr class="odd gradeX">
                                    <td  class="f-s-600 text-inverse">{{$row->id}}</td>
                                    <td  class="f-s-600 text-inverse">{{$row->year}}</td>
                                    <td  class="f-s-600 text-inverse">{{$row->string_number}}</td>
                                    <td  class="f-s-600 text-inverse">{{$row->title}}</td>
                                    <td  class="f-s-600 text-inverse">{{$row->type}}</td>
                                    <td  class="f-s-600 text-inverse">{{$row->budget}}</td>

                                    <td>
                                        {{--                                        <a class="btn btn-yellow" href="{{route('document.edit',[$row->id])}}" role="button">แก้ไข</a>--}}
                                        <a class="btn btn-red" href="{{route('reference_naga.delete',[$row->id])}}" role="button">ลบ</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
@endsection