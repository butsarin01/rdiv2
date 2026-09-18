@extends('backend.master')
@section('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 24px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ccc;
            transition: .3s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background: #28a745;
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }
    </style>
@endsection
@section('content')
    <h1 class="page-header fw-bold"><i class="far fa-lg fa-fw me-2 fa-image"></i>แบบบันทึกข้อมูล ({{ $title_menu }})<small
            class="fw-bold ps-2">(ผู้ดูแลระบบ)</small></h1>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel">
                <div class="panel-body">

                    @php
                        $banner = $data_banner[0] ?? null;
                        $ordinal = $banner?->ordinal ?? ($data_bannertop->count() ?? 0) + 1;
                    @endphp

                    <form action="{{ route('setting_index.insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="place" value="popup">
                        <input type="hidden" name="ordinal" value="{{ $ordinal }}">
                        <input type="hidden" name="id" value="{{ $banner->id ?? '' }}">

                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">

                                <label class="col-form-label">
                                    {{ $banner ? 'แก้ไข Banner' : 'เพิ่ม Banner' }}
                                </label><br>

                                {{-- รูป --}}
                                <img src="{{ $banner ? asset('storage/index/' . $banner->file) : asset('/images/empty2.png') }}"
                                    class="img-thumbnail preview mb-2" id="preview_image_name" style="max-height:300px">

                                <input type="file" name="file" class="form-control file-upload mb-2"
                                    data-target="#preview_image_name" {{ $banner ? '' : 'required' }} accept="image/*">

                                {{-- ชื่อ --}}
                                <div class="row mb-2">
                                    <label class="col-md-2 col-form-label">ชื่อ Banner</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $banner->name ?? '' }}">
                                    </div>
                                </div>

                                {{-- link --}}
                                <div class="row mb-2">
                                    <label class="col-md-2 col-form-label">Link</label>
                                    <div class="col-md-10">
                                        <input type="text" name="link" class="form-control"
                                            value="{{ $banner->link ?? '' }}">
                                    </div>
                                </div>

                                {{-- วันที่ --}}
                                <div class="row mb-2">
                                    <label class="col-md-2 col-form-label">วันที่เริ่มต้น</label>
                                    <div class="col-md-4">
                                        <input type="date" name="date_start" class="form-control"
                                            value="{{ $banner->date_start ?? '' }}">
                                    </div>
                                    <label class="col-md-2 col-form-label">วันที่สิ้นสุด</label>
                                    <div class="col-md-4">
                                        <input type="date" name="date_end" class="form-control"
                                            value="{{ $banner->date_end ?? '' }}">
                                    </div>
                                </div>

                                {{-- สถานะ --}}
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">สถานะ</label>
                                    <div class="col-md-10 text-start pt-2">
                                        <label class="me-3">
                                            <input type="radio" name="status_show" value="1"
                                                {{ ($banner->status_show ?? 1) == 1 ? 'checked' : '' }}>
                                            เปิดใช้งาน
                                        </label>
                                        <label>
                                            <input type="radio" name="status_show" value="0"
                                                {{ ($banner->status_show ?? 1) == 0 ? 'checked' : '' }}>
                                            ปิดใช้งาน
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    บันทึก
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel  ">
                <div class="panel-body">
                    <table id="data-table-keytable1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="3%" class="text-center">#</th>
                                <th width="15%" class="text-center">รูป</th>
                                <th>รายละเอียด</th>
                                <th width="12%" class="text-center">สถานะ</th>
                                <th width="15%" class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($data_bannertop[0]))
                                @foreach ($data_bannertop as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->ordinal }}</td>

                                        <td class="text-center">
                                            <img src="{{ asset('storage/index/' . $row->file) }}" class="img-thumbnail"
                                                style="max-height:100px">
                                        </td>

                                        <td>
                                            <b>{{ $row->name ?? '-' }}</b><br>
                                            <small class="fw-bold">Link:</small>
                                            <a href="{{ $row->link }}" target="_blank">{{ $row->link ?? '-' }}</a><br>
                                            <small class="fw-bold">Start:</small> {{ $row->date_start ?? '-' }} |
                                            <small class="fw-bold">End:</small> {{ $row->date_end ?? '-' }}
                                        </td>

                                        {{-- สวิตช์ --}}
                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status" data-id="{{ $row->id }}"
                                                    {{ $row->status_show ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('setting_index.update', ['popup', $row->id]) }}">
                                                แก้ไข
                                            </a>

                                            <a class="btn btn-danger btn-sm" onclick="return confirm('ลบแบนเนอร์นี้?')"
                                                href="{{ route('setting_index.delete', ['popup', $row->id]) }}">
                                                ลบ
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5" class="text-center">ไม่พบข้อมูล</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>


        </div>
    </div>
@endsection
@section('script_content')
    <script>
        document.querySelectorAll('.toggle-status').forEach(el => {
            el.addEventListener('change', function() {
                fetch("{{ route('setting_index.toggle') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: this.dataset.id
                    })
                });
            });
        });
    </script>
@endsection
