@extends('admin.master')
@section('document')
    <div id="content" class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="panel">
                    <div class="panel-body">
                        @include('admin.document.form_document')
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <table id="data-table-default"
                               class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                            <tr>
                                <th width="1%">ลำดับ</th>
                                <th width="4%">ประเภทหนังสือ</th>
                                <th width="4%">เลขทะเบียนส่ง</th>
                                <th width="4%">ที่</th>
                                <th>ลงวันที่</th>
                                <th width="5%" class="text-nowrap">ถึง</th>
                                <th width="6%" class="text-nowrap">จาก</th>
                                <th width="">ชื่อเรื่อง</th>
                                <th width="">ผู้ปฏิบัติ</th>
                                <th width="">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($document as $row)
                                <tr class="odd gradeX">
                                    <td class="f-s-600 text-inverse">{{$row->id}}</td>
                                    <td class="f-s-600 text-inverse">{{ $row->type == 1 ? 'ภายนอก' : 'ภายใน'}}</td>
                                    <td class="f-s-600 text-inverse">{{$row->number}}</td>
                                    <td class="f-s-600 text-inverse">{{$row->string_number}}</td>
                                    <td class="f-s-600 text-inverse">{{$row->date_register}}</td>
                                    <td class="f-s-600 text-inverse">{{$row->office_from}}</td>
                                    <td class="f-s-600 text-inverse">{{$row->office_to}}</td>
                                    <td class="f-s-600 text-inverse">{{$row->title}}</td>
                                    <td class="f-s-600 text-inverse">{{$row->account_active}}</td>

                                    <td>
                                        {{--                                        <a class="btn btn-yellow" href="{{route('document.edit',[$row->id])}}" role="button">แก้ไข</a>--}}
                                        <a class="btn btn-red" href="{{route('document_rdi.delete',[$row->id])}}"
                                           role="button">ลบ</a>
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
        @section('script_menu')
            <script>
                $('#data-table-default').DataTable({
                    responsive: true,
                    order: [[1, 'desc']]
                });
            </script>
@endsection