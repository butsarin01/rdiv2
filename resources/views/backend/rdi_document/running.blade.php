@extends('backend.master')
@section('content')
<div class="rdi-register">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1">e-GP-Running</h1>
            <p class="text-muted mb-0">ทะเบียน e-GP และ Running Number แยกตามปีงบประมาณ</p>
        </div>
        <span class="badge bg-primary fs-6">ทั้งหมด {{ number_format($totalCount) }} รายการ</span>
    </div>
    <div class="panel"><div class="panel-body">
        <nav class="nav nav-pills gap-2" aria-label="ปีงบประมาณ">
            <a href="{{ route('running.show', ['year' => 'all']) }}" class="nav-link {{ $selectedYear === 'all' ? 'active' : '' }}" @if ($selectedYear === 'all') aria-current="page" @endif>
                ทุกปี <span class="badge bg-secondary ms-1">{{ number_format($totalCount) }}</span>
            </a>
            @foreach ($years as $yearSummary)
                <a href="{{ route('running.show', ['year' => $yearSummary->year]) }}" class="nav-link {{ $selectedYear === (string) $yearSummary->year ? 'active' : '' }}" @if ($selectedYear === (string) $yearSummary->year) aria-current="page" @endif>
                    {{ $yearSummary->year === 'unassigned' ? 'ไม่ระบุปี' : 'ปี '.$yearSummary->year }}
                    @if ($yearSummary->year !== 'unassigned' && !preg_match('/^[0-9]{4}$/', (string) $yearSummary->year))
                        <span class="badge bg-warning text-dark">ตรวจสอบปี</span>
                    @endif
                    <span class="badge bg-secondary ms-1">{{ number_format($yearSummary->total) }}</span>
                </a>
            @endforeach
        </nav>
    </div></div>
    <div class="panel"><div class="panel-body">
        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger" role="alert"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        @include('backend.rdi_document.form_running')
    </div></div>
    <div class="panel"><div class="panel-body">
        <h2 class="h5 mb-3">
            {{ $selectedYear === 'all' ? 'รายการทุกปี' : ($selectedYear === 'unassigned' ? 'รายการที่ไม่ระบุปี' : 'ปีงบประมาณ '.$selectedYear) }}
            <span class="badge bg-primary ms-1">{{ number_format($document->count()) }} รายการ</span>
        </h2>
        <div class="table-responsive">
            <table @if ($document->isNotEmpty()) id="data-table-keytable" @endif class="table table-striped table-bordered table-td-valign-middle w-100">
                <thead><tr>
                    <th>ลำดับ</th><th>ปีงบประมาณ</th><th>Running Number</th><th>e-GP Number</th><th>ชื่อเอกสาร</th><th>โครงการ</th><th>งบประมาณ (บาท)</th><th>ผู้รับผิดชอบ</th><th>ผู้ขาย/ผู้รับจ้าง</th><th>วันที่กรอกข้อมูล</th><th>จัดการ</th>
                </tr></thead>
                <tbody>
                    @forelse ($document as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ trim((string) $row->year) ?: 'ไม่ระบุปี' }}</td>
                            <td>{{ $row->runing_number }}</td><td>{{ $row->gp_number }}</td>
                            <td>{{ $row->title }}</td><td>{{ $row->type_project }}</td>
                            <td class="text-end">{{ is_numeric($row->budget) ? number_format((float) $row->budget, 2) : ($row->budget ?: '-') }}</td>
                            <td>{{ $row->person_responsible }}</td><td>{{ $row->person_seller }}</td><td>{{ $row->date_save }}</td>
                            <td><a class="btn btn-red btn-sm" href="{{ route('running.delete', $row->id) }}">ลบ</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="11" class="text-center text-muted py-4">ไม่พบรายการในปีที่เลือก</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div></div>
</div>
@endsection
