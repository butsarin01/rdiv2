@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card ">
                <div class="card-body">
                    @include('backend.people.form')
                </div>
            </div>


            <div class="panel mt-3">
                <div class="panel-body">
                    <span class="text-indigo-600 fw-bold fs-4 ">
                        <i class="fas fa-lg fa-fw me-2 fa-user-group "></i>
                        รายชื่อข้อมูลบุคคล {{ $group_id->name }}
                    </span>
                    <hr>
                    <table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="1%">id</th>
                                <th width="1%" data-orderable="false">รูป</th>
                                <th class="text-nowrap">ตำแหน่ง</th>
                                <th class="text-nowrap">ชื่อ-นามสกุล</th>
                                <th class="text-nowrap">แก้ไข</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peopleAll_id as $row)
                                <tr class="odd gradeX">
                                    <td class="f-s-600 text-inverse">{{ $row->id }}</td>
                                    <td class="with-img text-center">
                                        <img src="{{ $row->show_image() }}" class="rounded h-50px" />
                                        {{--                                    <span class="fs-10px">{{$row->thumbnail}}</span> --}}
                                    </td>
                                    <td>{{ $row->position() }}</td>
                                    <td>
                                        {{ $row->prefix() }}{{ $row->name }} {{ $row->lastname }}<br>
                                        {{ $row->position_self }}
                                    </td>
                                    <td>
                                        <a class="btn btn-yellow" href="{{ route('content.edit_people', [$row->id]) }}"
                                            role="button">แก้ไข</a>

                                        <a class="btn btn-red" href="{{ route('content.delete_people', [$row->id]) }}"
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).on("click", ".btn-search", function() {
            var text_name = $(".name_search").val();
            html = '';
            serachusername(text_name);
        });
        $(document).on("change", "#select-fullname", function() {
            $('.show-select-member').removeClass('hide');
            // var user = $('#select-fullname option:selected').text();
            var select = $(this).find('option:selected');
            var user = $(select).text();
            // var major = select.data('major');
            // var minor = select.data('minor');
            var name_eng = select.data('name_eng');
            var lastname_eng = select.data('lastname_eng');
            var userID = $(this).val();
            console.log(userID);

            $('input[name=username]').val(userID);
            $('input[name=name_eng]').val(name_eng);
            $('input[name=lastname_eng]').val(lastname_eng);
            // $('#major_id option:contains(' + major + ')').attr('selected', 'selected');

            search_data_core(userID);

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
                        html += '<option value="' + optionvalue + '" data-major="' + value['majorOrg'] +
                            '" data-minor="' + value['minorOrg'] + '" data-name_eng="' + value[
                                'userFirstNameEN'] + '"data-lastname_eng="' + value['userLastNameEN'] +
                            '">' + optionText + '</option>';
                    });
                    // } else {
                    //     $.each(response, function (key, value) {
                    //         if (jQuery.inArray(value['majorOrg'], major_name) != -1) {
                    //             optionText = value['userFullName'];
                    //             optionvalue = value['userID'];
                    //             html += '<option value="' + optionvalue + '" data-major="' + value['majorOrg'] + '" data-minor="' + value['minorOrg'] + '" data-name_eng="' + value['userFirstNameEN'] + '"data-lastname_eng="' + value['userLastNameEN'] + '">' + optionText + '</option>';
                    //         }
                    //     });
                    // }
                    $('.select-search').append(html);
                }
            });
        }

        function search_data_core(account) {
            $("#loading_ldep_username").removeClass('hide');
            $.ajax({
                url: "{{ route('dynamic_data_staff.fetch') }}",
                type: "POST",
                data: {
                    account: account
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response);
                    $("#loading_ldep_username").addClass('hide');
                    $('input[name=people_name]').val(response[0].first_name);
                    $('input[name=people_lastname]').val(response[0].last_name);
                    $('input[name=people_email]').val(response[1]);
                    $('input[name=link_image]').val(response[0].portrait_image);
                    $('#show_img_member').attr('src', response[0].portrait_image);
                    $('input[name=ldep_username]').val(response[0].ldap_username);

                    // $('#ref_prefix_id option[text=' + response[0].name_title + ']').attr('selected', 'selected');
                    $('#ref_prefix_id option[text=' + response[0].name_title + ']').prop("selected", true);
                }
            });
        }
    </script>
@endsection
