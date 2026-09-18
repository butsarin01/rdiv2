@extends('backend.master')
@section('content')
    <h1 class="page-header fw-bold"><i class="fas fa-lg fa-fw me-2 fa-cog"></i>จัดการข้อมูลสิทธิ์การใช้งาน<small
            class="fw-bold ps-2">(ผู้ดูแลระบบ)</small></h1>
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-default1">

                <div class="panel-body">
                    {{--                    <h4 class="text-blue-500 mb-0 pt-2"> --}}
                    {{--                        <i class="fas fa-lg fa-fw me-2 fa-cog"></i> --}}
                    {{--                        จัดการข้อมูลสิทธิ์การใช้งาน ของ (ผู้ดูแลระบบ) --}}
                    {{--                    </h4> --}}
                    {{--                    <hr> --}}
                    @include('backend.member.form')

                    <div class="row justify-content-center">
                        <div class="col-9">
                            <table id="data-table-keytable1" class="table table table-hover align-middle mt-3 ">
                                <thead>
                                    <tr class="bg-default-400">
                                        <th width="10%" class="text-center">ลำดับ</th>
                                        <th class="text-nowrap text-center">รายชื่อ</th>
                                        <th class="text-nowrap text-center">สิทธิ์การใช้งาน</th>
                                        <th class="text-nowrap text-center">แก้ไข</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member as $row)
                                        <tr class="odd gradeX text-center">
                                            <td width="1%" class="f-s-600 text-inverse">{{ $row->id }}</td>
                                            <td width="40%" class="with-img">{{ $row->fullname }}</td>
                                            <td width="40%" class="with-img">{{ $row->permission() }}</td>
                                            <td>
                                                <a class="btn btn-red" href="{{ route('member.delete', [$row->id]) }}"
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

        </div>
    </div>
@endsection
@section('script_content')
    <script>
        var html = '';
        $(document).on("click", ".btn-search", function() {
            var text_name = $(".name_search").val();
            html = '';
            serachusername(text_name);

            // $.ajax({
            //     url: "https://e-asset.nsru.ac.th/service/get/sys-token",
            //     type: "get",
            //     data: {'userRequestor': 'butsarin.n'},
            //     dataType: 'json',
            //     headers: {
            //         'X-CSRF-TOKEN': '{{ csrf_token() }}',
            //     },
            //     success: function (response) {
            //         // console.log(response);

            //         $('.input-hidden-accessToken').val(response['accessToken']);
            //         // var token = $('.input-hidden-accessToken').val();
            //         var token = response['accessToken'];
            //         var user = text_name;
            //         serachusername(token, user);

            //     }
            // })
        });
        $(document).on("change", ".select-search", function() {

            var user = $('.select-search option:selected').text();
            var ldap = $('.select-search option:selected').val();
            $('input[name=first_name]').val(user);
            $('input[name=ldap]').val(ldap);
            $('select[name=permission_id]').attr('disabled', false);
        });

        function serachusername(user, mode) {
            $.ajax({
                url: "{{ route('emp_data_list', ['name' => '']) }}/" + user,
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log(response);
                    if (response.length > 0) {
                        var text = 'พบรายชื่อใกล้เคียง ' + response.length + ' รายการ';
                    } else {
                        var text = 'ไม่พบรายชื่อใกล้เคียง';
                    }

                    $('.result-count-member').removeClass('hide');
                    $('.result-count-member').text(text);

                    html = '<option value="">เลือกผู้ใช้</option>';
                    $('.select-search').html('');
                    $.each(response, function(key, value) {
                        optionText = value['userFullName'];
                        optionvalue = value['userID'];
                        html += '<option value="' + optionvalue + '">' + optionText + '</option>';
                    });
                    $('.select-search').append(html);
                }
            });

        }
    </script>
@endsection('script')
