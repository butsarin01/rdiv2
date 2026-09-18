@extends('backend.master')
@section('content')
    <div id="content" class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="panel  ">
                    {{--                    <div class="pull-right p-4"> --}}
                    {{--                        <a href="{{route('content.direct_line_report',['id'=>$mode_id])}}" class="btn btn-purple">ออกรายงาน</a> --}}
                    {{--                    </div> --}}
                    <h3 class="pt-4 text-center">
                        @if (!empty($mode))
                            {{ $mode }}
                        @endif
                    </h3>
                    <div class="row justify-content-center">
                        <form action="{{ route('content.select_direct_line') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row justify-content-center mb-1">
                                <div class="col-md-6 text-center">
                                    @if (!empty($status))
                                        @foreach ($status as $row)
                                            {{--                                    <a href="{{route('content.direct_status',['name'=> $type_menu,'id'=> $mode_id,'status'=> $row->id])}}" --}}
                                            {{--                                       class="btn btn-outline-{{$row->color}} m-r-10 m-l-10  @if ($type_menu == 2 && $row->id == 3) hide @endif  "> --}}
                                            {{--                                        <i class="far fa-lg fa-fw m-r-5 fa-{{$row->icon}}"></i>{{$row->name}} {{$row->status_count}} --}}
                                            {{--                                    </a> --}}
                                            {{--                                     <button type="button" class="btn btn-outline-{{$row->color}}"><i class="far fa-lg fa-fw m-r-5 fa-{{$row->icon}}"></i>{{$row->name}} {{$row->status_count}}</button> --}}
                                            <button type="button"
                                                class="btn btn-outline-{{ $row->color }} btn-get-status my-2 "
                                                data-status_id="{{ $row->id }}" data-status_name="{{ $row->name }}">
                                                <i
                                                    class="far fa-lg fa-fw me-2 fa-{{ $row->icon }}"></i>{{ $row->name }}
                                                {{ $row->status_count }}
                                            </button>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <input type="text" class="form-control hide" name="sub_menu_id" value="{{ $mode_id }}">
                            <input type="text" class="form-control hide" name="type_menu" value="{{ $type_menu }}">
                            <div class="form-group row mb-2  selected_status_show_input hide">
                                <label for="" class="col-md-2 text-end">สถานะ :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="status_accept_name" value="">
                                    <input type="text" class="form-control hide" name="status_accept_id" value="">
                                </div>
                                <div class="col-md-1">
                                    {{--                                 <a href="" class="label label-inverse"><i class="fas fa-lg fa-fw fa-times-circle"></i></a> --}}
                                    <a class="btn  btn-icon btn-circle btn-danger clear_status_show"><i
                                            class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-5 hide">
                                <label for="date_range" class="col-form-label col-md-2 text-end ">ช่วงวันที่ :
                                    (เดือน/วัน/ปี)</label>
                                <div class="col-md-6">
                                    <div class="input-group input-daterange ">
                                        <input type="text" class="form-control" name="start_date"
                                            placeholder="Date Start">
                                        <span class="input-group-addon mx-2">to</span>
                                        <input type="text" class="form-control" name="end_date" placeholder="Date End">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-default" type="submit"> ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h2 class="text-center">
                        @if (!empty($ss))
                            {{ $ss }}
                        @endif
                    </h2>
                    {{--                <a href="{{route('content.direct_line_report',['id'=>$type_menu])}}" class="btn btn-outline-danger"><i class="fas fa-lg fa-fw m-r-3 fa-print"></i>ดูรายงาน</a> --}}

                    <div class="panel-body">
                        <table id="data-table-keytable" class="table table-striped1 table-bordered table-td-valign-middle"
                            width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="7%">ลำดับ</th>
                                    <th width="12%">วันที่</th>
                                    {{--                                <th width="12%" class="text-nowrap">ประเภทเรื่อง</th> --}}
                                    <th width="" class="text-nowrap">เรื่อง</th>
                                    <th width="28%" class="text-nowrap">จาก</th>
                                    <th width="12%" class="text-nowrap">file</th>
                                    <th width="20%" class="text-nowrap">สถานะ</th>
                                    {{--                                <th width="5%" class="text-nowrap">ลบ</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($data_direct))
                                    <?php $i = 0; ?>
                                    @foreach ($data_direct as $key => $row)
                                        <?php $i++; ?>
                                        <tr id="row_{{ $row->id }}" class="odd gradeX">
                                            <td class="text-center">
                                                {{ !empty($row->number_order) ? $row->number_order : $key + 1 }} </td>
                                            <td>{{ $row->thai_datefull() }}</td>
                                            {{--                                        <td>{{$row->type_title_direct()}}</td> --}}
                                            <td>{{ $row->title }}</td>
                                            <td>
                                                จาก : {{ $row->name_type_person() }} <br>
                                                ชื่อ-นามสกุล : {{ $row->name_person }}<br>
                                                ช่องทางการติดต่อ : {{ $row->email_person }}
                                            </td>
                                            <td class="text-center">
                                                @if (!empty($row->file))
                                                    @php([$name, $type] = explode('.', $row->file))
                                                    <a class="btn btn-default" target="_blank"
                                                        href="{{ asset('storage/file_direct/' . $row->file) }}">file_{{ $type }}</a>
                                                @elseif(!empty($row->files[0]))
                                                    @php($i = 0)
                                                    @foreach ($row->files as $row1)
                                                        @php($i++)
                                                        @php([$name, $type] = explode('.', $row1->file))
                                                        <a class="btn btn-default" target="_blank"
                                                            href="{{ asset('storage/file_direct/' . $row1->file) }}">file_{{ $i }}_{{ $type }}</a>
                                                    @endforeach
                                                @else
                                                    ไม่มีไฟล์
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row->status_accept(); ?>

                                                <a class="btn btn-yellow " target="_blank"
                                                    href="{{ route('content.direct_pdf', ['id' => $row->id]) }}"
                                                    data-id="{{ $row->id }}">
                                                    <i class="far fa-lg fa-fw me-2 fa-file-pdf"></i>PDF
                                                </a>
                                                {{-- <a class="btn btn-danger "
                                                    href="{{ route('content.direct_line_delete', ['id' => $row->id]) }}"
                                                    data-id="{{ $row->id }}">ลบ</a> --}}
                                                <button class="btn btn-danger btn-delete" data-id="{{ $row->id }}">
                                                    ลบ
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-dialog-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">รายละเอียดข้อเสนอแนะและความคิดเห็น </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" name="form_main_menu_update" enctype="multipart/form-data"
                        action="{{ route('content.chage_status_direct') }}">
                        @csrf
                        <input type="text" class="hide" name="direct_id" value="">
                        <input type="text" class="hide" name="user_accept"
                            value="{{ session()->get('user.ldap_username') }}">
                        <input type="text" class="hide" name="user_fullname"
                            value="{{ session()->get('user.full_name') }}">
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end ">วันที่ : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder="" name="direct_created_at"
                                    disabled>
                            </div>
                        </div>

                        <div class="form-group row mb-2 type_person">
                            <label class="col-form-label col-md-3 text-end">ประเภทผู้ติดต่อ : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder="" name="direct_type_person"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end ">ชื่อ-นามสกุล : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder="" name="direct_name_person"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end">ช่องทางการติดต่อ : </label>
                            <div class="col-md-8">
                                <input type="email" class="form-control mb-2" placeholder=""
                                    name="direct_email_person" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-2 phone_person">
                            <label class="col-form-label col-md-3 text-end">เบอร์โทร : </label>
                            <div class="col-md-8">
                                <input type="email" class="form-control mb-2" placeholder=""
                                    name="direct_phone_person" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end">เรื่องที่ติดต่อ : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder="" name="direct_title"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end">รายละเอียด : </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" name="direct_detail" disabled></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-2  checkFile">
                            <label class="col-form-label col-md-3 text-end">ไฟล์แนบ : </label>
                            <div class="col-md-8 ">
                                <a class="btn btn-grey" target="_blank" href=""><i
                                        class="far fa-lg fa-fw m-r-5 fa-file"></i></a>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row m-b-10 align-items-start">
                            <label class="col-md-3 col-form-label text-end">สถานะการรับเรื่อง : </label>
                            <div class="col-md-9">
                                @if (!empty($status))
                                    @foreach ($status as $row)
                                        @if ($row->id != 1)
                                            <div
                                                class="form-check form-check-inline @if ($type_menu == 2 && $row->id == 3) hide @endif ">
                                                <input class="form-check-input" type="radio" name="status_accept"
                                                    id="{{ $row->id }}" value="{{ $row->id }}"
                                                    @if ($row->id == 2) checked="" @endif>
                                                <label class="form-check-label" for="{{ $row->id }}">
                                                    {{ $row->name }} {{ $row->detail }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <p class="show_accept hide" style="color: blue;">โดย (<label
                                        class="show_detail_accept"></label>) </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row me-2 justify-content-end text-end">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-lg">บันทึก</button>
                                <a href="javascript:;" class="btn btn-default btn-lg" data-dismiss="modal">ยกเลิก</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-dialog-detail2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">รายละเอียดข้อมูลคำร้องเรียน </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" name="form_main_menu_update" enctype="multipart/form-data"
                        action="{{ route('content.chage_status_direct') }}">
                        @csrf
                        <input type="text" class="hide" name="direct_id" value="">
                        <input type="text" class="hide" name="user_accept"
                            value="{{ session()->get('user.ldap_username') }}">
                        <input type="text" class="hide" name="user_fullname"
                            value="{{ session()->get('user.full_name') }}">
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end ">วันที่ : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder="" name="direct_created_at2"
                                    disabled>
                            </div>
                        </div>

                        <div class="form-group row mb-2 hide">
                            <label class="col-form-label col-md-3 text-end">ประเภทผู้ติดต่อ : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder=""
                                    name="direct_type_person2" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end ">ชื่อ-นามสกุล : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder=""
                                    name="direct_name_person2" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end">ช่องทางการติดต่อ : </label>
                            <div class="col-md-8">
                                <input type="email" class="form-control mb-2" placeholder=""
                                    name="direct_email_person2" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end">ประเภทเรื่อง : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder="" name="direct_type2"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end">เรื่องที่ติดต่อ : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder="" name="direct_title2"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-2 hide1">
                            <label class="col-form-label col-md-3 text-end">หน่วยงานที่ร้องเรียน : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" placeholder="" name="direct_agency2"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-form-label col-md-3 text-end">รายละเอียด : </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" name="direct_detail2" disabled></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-2 checkFile">
                            <label class="col-form-label col-md-3 text-end">ไฟล์แนบ : </label>
                            <div class="col-md-8 ">
                                <a class="btn btn-grey" target="_blank" href=""><i
                                        class="far fa-lg fa-fw m-r-5 fa-file"></i>333</a>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row m-b-10  align-items-start">
                            <label class="col-md-3 col-form-label text-end align-items-start">สถานะการรับเรื่อง
                                : </label>
                            <div class="col-md-9 ">
                                @if (!empty($status))
                                    @foreach ($status as $row)
                                        @if ($row->id != 1)
                                            <div class="form-check form-check-inline pt-2">
                                                <input class="form-check-input radio_status_accept" type="radio"
                                                    name="status_accept" id="2{{ $row->id }}"
                                                    value="{{ $row->id }}"
                                                    @if ($row->id == 2) checked="" @endif>
                                                <label class="form-check-label" for="2{{ $row->id }}">
                                                    {{--                                            รับเรื่อง เพื่อพิจารณา --}}
                                                    {{ $row->name }} {{ $row->detail }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="show_accept hide" style="color: #06b765;">รับเรื่อง : โดย (<label
                                        class="show_detail_accept"></label>)
                                </div>
                                <div class="show_forward hide" style="color: #0000ff;">ส่งต่อ : โดย (<label
                                        class="show_detail_forward"></label>)
                                </div>
                                <div class="show_cancal hide" style="color: #c80ab0;">ยกเลิก : โดย (<label
                                        class="show_detail_cancal"></label>)
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-b-10  align-items-start show_comment hide">
                            <label class="col-md-3 col-form-label text-end align-items-start text-red">สาเหตุที่ยกเลิก
                                : </label>
                            <div class="col-md-8 ">
                                <textarea class="form-control" rows="3" name="comment"></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="row me-2 justify-content-end text-end">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-lg">บันทึก</button>
                                <a href="javascript:;" class="btn btn-default btn-lg"
                                    data-bs-dismiss="modal">ปิดหน้าต่าง</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_content')
    <script>
        $(document).on("click", ".btn-get-status", function() {
            var status_id = $(this).data('status_id');
            var status_name = $(this).data('status_name');

            $('.selected_status_show_input').removeClass('hide');
            $('input[name="status_accept_name"]').val(status_name);
            $('input[name="status_accept_id"]').val(status_id);
        });
        $(document).on("change", ".radio_status_accept", function() {
            var status_accept = $(this).val();
            if (status_accept == 4) {
                $('.show_comment').removeClass('hide');
            } else {
                $('.show_comment').addClass('hide');
            }
        });
        $(document).on("click", ".clear_status_show", function() {
            $('.selected_status_show_input').addClass('hide');
            $('input[name="status_accept_name"]').val("");
            $('input[name="status_accept_id"]').val("");
        });
        $(document).on("click", ".checkDetail", function() {
            var direct_id = $(this).data('id');
            var _token = $('input[name="_token"]').val();
            var url = "{{ route('content.fetch_direct_line') }}";
            var ln = "";
            // $('.show_accept').empty();
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    direct_id: direct_id,
                    _token: _token
                },
                success: function(result) {
                    // $('.' + dependent).html(result);
                    console.log(result);
                    $('input[name="direct_id"]').val(result.detail.id);
                    $('input[name="direct_title"]').val(result.detail.title);

                    if (result.detail.lastname_person != null) {
                        ln = result.detail.lastname_person;
                    }
                    var name = result.detail.name_person + " " + ln;

                    $('input[name="direct_name_person"]').val(name);
                    $('input[name="direct_email_person"]').val(result.detail.email_person);
                    $('textarea[name="direct_detail"]').val(result.detail.detail);
                    $('input[name="direct_created_at"]').val(result.date);

                    if (result.detail.type_person_direct_id != null) {
                        $('.type_person').removeClass('hide');
                        $('input[name="direct_type_person"]').val(result.type_person);
                    } else {
                        $('.type_person').addClass('hide');
                    }

                    if (result.detail.phone_person != null) {
                        $('.phone_person').removeClass('hide');
                        $('input[name="direct_phone_person"]').val(result.detail.phone_person);
                    } else {
                        $('.phone_person').addClass('hide');
                    }

                    if (result.detail.status_accept_id > 1) {
                        $('input[name="status_accept"][value="' + result.detail.status_accept_id + '"]')
                            .prop('checked', true);
                        $('.show_accept').removeClass('hide');
                        $('.show_detail_accept').text(result.detail.user_fullname_accept + ' ' + result
                            .detail.date_accept);
                    } else if (result.detail.status_accept_id == 1) {
                        $('input[name="status_accept"][value="2"]').prop('checked', true);
                        $('.show_accept').addClass('hide');
                        $('.show_detail_accept').empty();
                    }

                    if (result.detail.file != null) {
                        $('.checkFile').removeClass('hide');
                    } else {
                        $('.checkFile').addClass('hide');
                    }

                }
            });
            console.log(direct_id);

        });
        $(document).on("click", ".checkDetail2", function() {
            var direct_id = $(this).data('id');
            var _token = $('input[name="_token"]').val();
            var url = "{{ route('content.fetch_direct_line') }}";
            // $('.show_accept').empty();
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    direct_id: direct_id,
                    _token: _token
                },
                success: function(result) {
                    // $('.' + dependent).html(result);
                    console.log(result);
                    $('input[name="direct_id"]').val(result.detail.id);
                    $('input[name="direct_title2"]').val(result.detail.title);
                    $('input[name="direct_type2"]').val(result.detail.name_menu);
                    $('input[name="direct_type_person2"]').val(result.detail.name_menu);
                    $('input[name="direct_name_person2"]').val(result.detail.name_person);
                    $('input[name="direct_email_person2"]').val(result.detail.email_person);
                    $('textarea[name="direct_detail2"]').val(result.detail.detail);
                    $('input[name="direct_created_at2"]').val(result.date);
                    $('input[name="direct_agency2"]').val(result.agency);

                    if (result.detail.status_accept_id > 1) {
                        $('input[name="status_accept"][value="' + result.detail.status_accept_id + '"]')
                            .prop('checked', true);
                        if (result.detail.user_fullname_accept != null) {
                            $('.show_accept').removeClass('hide');
                            $('.show_detail_accept').text(result.detail.user_fullname_accept + ' ' +
                                result.detail.date_accept);
                        } else {
                            $('.show_accept').addClass('hide');
                        }
                        if (result.detail.user_fullname_forward != null) {
                            $('.show_forward').removeClass('hide');
                            $('.show_detail_forward').text(result.detail.user_fullname_forward + ' ' +
                                result.detail.date_forward);
                        } else {
                            $('.show_forward').addClass('hide');
                        }
                        if (result.detail.user_fullname_cancal != null) {
                            $('.show_cancal').removeClass('hide');
                            $('.show_detail_cancal').text(result.detail.user_fullname_cancal + ' ' +
                                result.detail.date_cancal);
                        } else {
                            $('.show_cancal').addClass('hide');
                        }


                        $('.type_title_direct option[value=' + result.detail.type_title_direct_id + ']')
                            .prop('selected', true);

                    } else if (result.detail.status_accept_id == 1) {
                        $('input[name="status_accept"][value="2"]').prop('checked', true);
                        $('.show_accept').addClass('hide');
                        $('.show_detail_accept').empty();
                        $('.show_forward').addClass('hide');
                        $('.show_detail_forward').empty();
                        $('.type_title_direct option:selected').prop('selected', false);
                        // console.log(555555);
                    }

                    if (result.detail.file != null) {
                        $('.checkFile').removeClass('hide');
                    } else {
                        $('.checkFile').addClass('hide');
                    }
                }
            });
            console.log(direct_id);

        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.btn-delete').click(function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'ยืนยันการลบ?',
                text: "ข้อมูลนี้จะถูกลบถาวร!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่, ลบเลย',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('content.direct_line_delete') }}",
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: id
                        },
                        success: function(res) {
                            if (res.status) {
                                Swal.fire(
                                    'ลบแล้ว!',
                                    res.message,
                                    'success'
                                );

                                $('#row_' + id).fadeOut(500, function() {
                                    $(this).remove();
                                });
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'ผิดพลาด!',
                                'ไม่สามารถลบข้อมูลได้',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endsection
