@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-xl-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach ($group as $row)
                        <p class="fw-bold fs-4"><a href="{{ route('people.edit', [$row->id]) }}">{{ $row->name }}</a></p>
                        {{--                        <p class="ms-3 mb-0 fw-bold">ตำแหน่ง :</p> --}}
                        <div class="ms-1">
                            {{--                            @foreach ($row->position() as $value) --}}
                            {{--                                {{$value->ordinal}}. {{$value->name}} --}}
                            {{--                                <a class="btn btn-danger btn-sm" href="{{ route('people.edit',[$row->id]) }}" --}}
                            {{--                                   role="button">ลบ</a> --}}
                            {{--                                <br> --}}
                            {{--                            @endforeach --}}
                            <table class="table table-bordered table-hover table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col" width="15%" class="text-center">ลำดับ</th>
                                        <th scope="col">ชื่อตำแหน่ง</th>
                                        <th scope="col" width="15%" class="text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($row->position->count() == 0)
                                        @foreach ($row->position as $key => $value)
                                            <tr>
                                                {{--                                        <td class="text-center">{{$value->ordinal}}</td> --}}
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-sm"
                                                        href="{{ route('people.position.delete', [$value->id]) }}"
                                                        role="button">ลบ</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">แบบบันทึกกลุ่มบุคคล</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    @include('backend.people.form_setting')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_menu')
    <script>
        $('.dynamic-add-table').click(function() {

            var table = $(this).data('table');
            var i = $('.input-i-' + table).val();
            i++;
            $('.input-i-' + table).val(i);
            // console.log(i);
            // var full_title = $(this).data('name_title');
            // const name_array = full_title.split("/");
            // var class_name = name_array[1];

            var input_id = table + '_id[]';
            var input_name = table + '_name[]';
            var ordinal_name = 'ordinal_' + table + '[]';

            var html = '';
            html += '<div class="mb-1 row">';
            html += '   <div class="col-md-2">';
            html += '   <input type="number" class="form-control number-tr-' + table + '" name="' + ordinal_name +
                '" value="' + i + '">';
            html += '   </div>';
            html += '   <div class="col-md-6">';
            html += '       <input type="hidden" class="form-control " name="' + input_id + '" value="">';
            html += '       <input type="text" class="form-control" name="' + input_name + '" >';
            html += '   </div>';
            html += '    <div class="col-md-1">';
            html +=
                '       <button type="button" class="btn  btn-danger text-white btn-remove-table" data-table="' +
                table + '">';
            html += '       <i class="fas fa-lg fa-fw fa-minus-circle"></i></button>';
            html += '   </div>';
            html += '</div>';
            $('.dynamic-show-div-' + table).append(html);
        });

        $(document).on('click', '.btn-remove-table', function() {
            $(this).parent().parent().remove();
            var table = $(this).data('table');
            var numItems = $('.number-tr-' + table).length;

            var j;
            $('.number-tr-' + table).each(function(i, obj) {
                j = i + 1;
                $(this).val(j);
            });
            // console.log('j: ' + j);

            $('.input-i-' + table).val(j);
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.status_setting_group').click(function() {
                var group_id = $(this).attr('group-id');
                var status = $(this).is(":checked") ? 1 : 0;
                $.ajax({
                    url: '{{ route('people.setting_update') }}',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'mode': 'people',
                        'group_id': group_id,
                        'status_setting': status
                    },
                    dataType: 'json',
                    success: function(data) {
                        // alert(data.alert);
                    }
                });
            });
        });
    </script>
@endsection
