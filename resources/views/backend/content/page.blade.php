@extends('backend.master')
@section('content')
    <div id="content" class="content">
        <div class="row">
            <div class="col-xl-12">

                <div class="panel panel-default ">
                    {{--                    <div class="panel-heading"> --}}
                    {{--                        <h4 class="panel-title">แบบบันทึกข้อมูล --}}
                    {{--                            @if (!empty($menu->name)) {{$menu->name}}  @endif --}}
                    {{--                        </h4> --}}
                    {{--                        <div class="panel-heading-btn"> --}}
                    {{--                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" --}}
                    {{--                               data-click="panel-expand"><i class="fa fa-expand"></i></a> --}}
                    {{--                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" --}}
                    {{--                               data-click="panel-reload"><i class="fa fa-redo"></i></a> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    <div class="panel-body">
                        <h4 class="text-blue-500 mb-0 pt-2">
                            <i class="far fa-lg fa-fw me-2 fa-pen-to-square"></i>
                            แบบบันทึกข้อมูล@if (!empty($menu->name))
                                {{ $menu->name }}
                            @endif
                        </h4>
                        <hr>
                        @include('backend.content.form')
                        <!--
                                                                                <input type="file" multiple id="gallery-photo-add">
                                                                                <div class="gallery"></div> -->
                    </div>
                </div>
            </div>
        </div>
        {{-- {{dd(is_array($data_detail_menu_all))}} --}}
        @if ($menu->number_of_data == 2 && empty($data_detail_menu))

            <div class="col-xl-12">
                <div class="panel  ">
                    <div class="panel-body">
                        <table id="data-table-keytable" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" width="1%">number</th>
                                    @if (!empty($menu->status_use_thumbnail))
                                        <th class="text-nowrap">image</th>
                                    @endif
                                    @if (!empty($menu->status_use_title))
                                        <th>title</th>
                                    @endif
                                    @if (!empty($menu->status_use_file))
                                        <th class="text-nowrap">file</th>
                                    @endif
                                    @if (!empty($menu->status_use_link))
                                        <th class="text-nowrap">link</th>
                                    @endif
                                    <th width="10%" class="text-nowrap">แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($data_detail_menu_all[0]))
                                    @foreach ($data_detail_menu_all as $number => $data)
                                        <tr class="odd gradeX">
                                            <td width="1%" class="f-s-600 text-inverse">
                                                {{ $data->number_show ?? $number + 1 }}
                                            </td>
                                            @if (!empty($menu->status_use_thumbnail))
                                                <td class="f-s-600 text-inverse">
                                                    @if ($data->thumbnail)
                                                        <img src="{{ asset('storage/content/' . $data->thumbnail) }}"
                                                            class="img-rounded h-100px" />
                                                            {{-- {{ $data->thumbnail }}" --}}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endif
                                            @if (!empty($menu->status_use_title))
                                                <td class="f-s-600 text-inverse">{{ $data->title ?? '-' }}</td>
                                            @endif

                                            @if (!empty($menu->status_use_file))
                                                <td class="f-s-600 text-inverse">
                                                    @if (!empty($data->file))
                                                        <a href="{{ asset('storage/file/' . $data->file) }}"
                                                            target="_blank">
                                                            {!! $data->setfile()['icon'] !!}
                                                        </a>
                                                    @else
                                                        -
                                                    @endif

                                                </td>
                                            @endif

                                            @if (!empty($menu->status_use_link))
                                                <td class="f-s-600 text-inverse">
                                                    @if (!empty($data->link))
                                                        <a href="{{ $data->link }}" target="_blank"
                                                            class="btn btn-outline-green"><i class="fa fa-link"></i></a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endif


                                            <td>
                                                <a class="btn btn-yellow"
                                                    href="{{ route('content.edit', [$menu->id, $mode, $data->id]) }}"
                                                    role="button">แก้ไข</a>
                                                <a class="btn btn-red"
                                                    href="{{ route('content.delete_detail_menu', [$data->id]) }}"
                                                    role="button">ลบ</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @endif

    </div>
@endsection
