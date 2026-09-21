@extends('backend.master')
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
                        <input type="hidden" name="place" value="top">
                        <input type="hidden" name="ordinal" value="{{ $ordinal }}">
                        <input type="hidden" name="id" value="{{ $banner->id ?? '' }}">

                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">

                                <label class="col-form-label">
                                    {{ $banner ? 'แก้ไข Banner (ขนาด 2600*840 ,1300*420 ,650*210 ,1920*688)' : 'เพิ่ม Banner (ขนาด 2600*840 ,1300*420 ,650*210 ,1920*688)' }}
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
                                {{-- <div class="row mb-2">
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
                                </div> --}}

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
                    <table id="data-table-keytable" class="table table-hover table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="3%" class="text-center">ลำดับ</th>
                                <th width="15%" class="text-center">banner</th>
                                <th class="text-center">ข้อความ</th>
                                <th width="15%" class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($data_bannertop[0]))
                                @foreach ($data_bannertop as $row)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="text-center">{{ $row->ordinal }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/index/' . $row->file) }}"
                                                class="img-rounded h-100px" />
                                        </td>
                                        <td>
                                            <span class="fw-bold">ข้อความ : </span> {{ $row->name ?? '-' }} <br>
                                            <span class="fw-bold">link : </span> {{ $row->link ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('setting_index.update', ['place' => 'top', 'id' => $row->id]) }}">
                                                แก้ไข
                                            </a>

                                            <a class="btn btn-danger btn-sm" onclick="return confirm('ลบแบนเนอร์นี้?')"
                                                href="{{ route('setting_index.delete', ['place' => 'top', 'id' => $row->id]) }}">
                                                ลบ
                                            </a>
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
@endsection
